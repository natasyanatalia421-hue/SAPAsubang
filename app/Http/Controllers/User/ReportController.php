<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Report;
use App\Models\ReportSupport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    /** Form buat laporan baru */
    public function create()
    {
        $categories = Category::where('aktif', true)->orderBy('nama_kategori')->get();
        return view('user.reports.create', compact('categories'));
    }

    /** Simpan laporan atau tampilkan laporan duplikat */
    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'foto_sebelum'=> 'required|image|max:5120', // maks 5 MB
            'latitude'    => 'required|numeric|between:-90,90',
            'longitude'   => 'required|numeric|between:-180,180',
            'deskripsi'   => 'required|string|min:10|max:1000',
        ], [
            'category_id.required'  => 'Pilih kategori laporan.',
            'foto_sebelum.required' => 'Foto masalah wajib disertakan.',
            'foto_sebelum.image'    => 'File harus berupa gambar.',
            'foto_sebelum.max'      => 'Ukuran foto maksimal 5 MB.',
            'latitude.required'     => 'Lokasi GPS wajib diisi.',
            'longitude.required'    => 'Lokasi GPS wajib diisi.',
            'deskripsi.required'    => 'Deskripsi masalah wajib diisi.',
            'deskripsi.min'         => 'Deskripsi minimal 10 karakter.',
        ]);

        // ── Cek duplikasi berdasarkan kategori + radius 100 meter ───────────────
        $nearby = Report::findNearby(
            (float) $data['latitude'],
            (float) $data['longitude'],
            (int)   $data['category_id'],
            100 // meter
        );

        if ($nearby) {
            // Ada laporan serupa — tanya user apakah ingin mendukung
            return redirect()->route('user.reports.duplicate', $nearby->id)
                ->with('from_lat',  $data['latitude'])
                ->with('from_lng',  $data['longitude'])
                ->with('category_id', $data['category_id']);
        }

        // ── Simpan foto ─────────────────────────────────────────────────────────
        $fotoPath = $request->file('foto_sebelum')->store('reports/before', 'public');

        // ── Buat laporan baru ───────────────────────────────────────────────────
        $report = Report::create([
            'kode_laporan' => Report::generateKode(),
            'user_id'      => Auth::id(),
            'category_id'  => $data['category_id'],
            'foto_sebelum' => $fotoPath,
            'latitude'     => $data['latitude'],
            'longitude'    => $data['longitude'],
            'deskripsi'    => $data['deskripsi'],
            'status'       => 'menunggu_verifikasi',
        ]);

        // Catat log status awal
        \App\Models\ReportStatusLog::create([
            'report_id'   => $report->id,
            'status_lama' => null,
            'status_baru' => 'menunggu_verifikasi',
            'diubah_oleh' => Auth::id(),
            'catatan'     => 'Laporan dibuat oleh user.',
        ]);

        return redirect()->route('user.reports.show', $report->id)
            ->with('success', "Laporan berhasil dikirim dengan kode {$report->kode_laporan}.");
    }

    /** Halaman duplikat — tunjukkan laporan serupa */
    public function duplicate(Report $report)
    {
        $report->load('category', 'user', 'supports');
        $alreadySupported = ReportSupport::where('report_id', $report->id)
            ->where('user_id', Auth::id())
            ->exists();

        return view('user.reports.duplicate', compact('report', 'alreadySupported'));
    }

    /** User mendukung laporan orang lain */
    public function support(Report $report)
    {
        $userId = Auth::id();

        // Cegah duplikat dukungan
        if (ReportSupport::where('report_id', $report->id)->where('user_id', $userId)->exists()) {
            return back()->with('info', 'Anda sudah pernah mendukung laporan ini.');
        }

        // Cegah mendukung laporan sendiri
        if ($report->user_id === $userId) {
            return back()->with('info', 'Anda tidak dapat mendukung laporan milik sendiri.');
        }

        ReportSupport::create(['report_id' => $report->id, 'user_id' => $userId]);

        return redirect()->route('user.reports.show', $report->id)
            ->with('success', 'Dukungan Anda berhasil ditambahkan.');
    }

    /** Detail laporan */
    public function show(Report $report)
    {
        // User hanya bisa lihat laporan sendiri atau laporan yang didukungnya
        $user = Auth::user();
        $isSupporter = ReportSupport::where('report_id', $report->id)
            ->where('user_id', $user->id)->exists();

        if ($report->user_id !== $user->id && !$isSupporter) {
            abort(403, 'Anda tidak memiliki akses ke laporan ini.');
        }

        $report->load('category', 'user', 'statusLogs.changedBy', 'evidence', 'supports');
        $supportCount = $report->supports()->count();

        return view('user.reports.show', compact('report', 'supportCount'));
    }
}
