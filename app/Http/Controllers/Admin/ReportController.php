<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\User;
use App\Notifications\LaporanSelesai;
use App\Services\ReportService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function __construct(private ReportService $svc) {}

    /** Detail laporan */
    public function show(Report $report)
    {
        $report->load('user', 'category', 'petugas', 'admin', 'statusLogs.changedBy', 'evidence', 'supports.user');
        $supportCount = $report->supports()->count();
        $petugas = User::where('role', 'petugas')->with('officer')->get();

        return view('admin.reports.show', compact('report', 'supportCount', 'petugas'));
    }

    /** Verifikasi laporan → terverifikasi + set prioritas */
    public function verify(Request $request, Report $report)
    {
        $data = $request->validate([
            'prioritas' => 'required|in:rendah,sedang,tinggi,darurat',
            'catatan'   => 'nullable|string|max:500',
        ]);

        $report->update([
            'status'    => 'terverifikasi',
            'prioritas' => $data['prioritas'],
            'admin_id'  => Auth::id(),
        ]);

        $this->svc->changeStatus($report, 'terverifikasi', $data['catatan'] ?? null);

        return back()->with('success', 'Laporan berhasil diverifikasi.');
    }

    /** Tolak laporan */
    public function reject(Request $request, Report $report)
    {
        $data = $request->validate([
            'alasan_ditolak' => 'required|string|min:10|max:500',
        ], ['alasan_ditolak.required' => 'Alasan penolakan wajib diisi.']);

        $report->update([
            'status'          => 'ditolak',
            'alasan_ditolak'  => $data['alasan_ditolak'],
            'admin_id'        => Auth::id(),
        ]);

        $this->svc->changeStatus($report, 'ditolak', $data['alasan_ditolak']);

        return back()->with('success', 'Laporan telah ditolak dan notifikasi dikirim ke pelapor.');
    }

    /** Tugaskan petugas */
    public function assign(Request $request, Report $report)
    {
        $data = $request->validate([
            'petugas_id' => 'required|exists:users,id',
        ], ['petugas_id.required' => 'Pilih petugas yang akan ditugaskan.']);

        $report->update([
            'status'     => 'ditugaskan',
            'petugas_id' => $data['petugas_id'],
            'admin_id'   => Auth::id(),
        ]);

        $this->svc->changeStatus($report, 'ditugaskan', 'Petugas ditugaskan oleh admin.');

        return back()->with('success', 'Petugas berhasil ditugaskan dan notifikasi telah dikirim.');
    }

    /** Admin konfirmasi bukti → selesai */
    public function complete(Request $request, Report $report)
    {
        $data = $request->validate([
            'catatan' => 'nullable|string|max:500',
        ]);

        $report->update(['status' => 'selesai']);
        $this->svc->changeStatus($report, 'selesai', $data['catatan'] ?? 'Pekerjaan dikonfirmasi selesai oleh admin.');

        // Kirim email ke pelapor + semua pendukung
        collect([$report->user])
            ->merge($report->supporters)
            ->unique('id')
            ->each(fn ($penerima) => $penerima->notify(new LaporanSelesai($report)));

        return back()->with('success', 'Laporan dikonfirmasi selesai. Notifikasi telah dikirim ke pelapor dan pendukung.');
    }

    /** Admin minta revisi → status kembali ke sedang_ditangani */
    public function requestRevision(Request $request, Report $report)
    {
        $data = $request->validate([
            'catatan_revisi' => 'required|string|min:10|max:500',
        ], ['catatan_revisi.required' => 'Catatan revisi wajib diisi.']);

        $report->update([
            'status'         => 'sedang_ditangani',
            'catatan_revisi' => $data['catatan_revisi'],
        ]);

        $this->svc->changeStatus($report, 'sedang_ditangani', $data['catatan_revisi']);

        return back()->with('success', 'Permintaan revisi dikirim ke petugas.');
    }
}