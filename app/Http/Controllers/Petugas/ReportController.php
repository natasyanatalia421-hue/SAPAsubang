<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Report;
use App\Models\ReportEvidence;
use App\Models\ReportStatusLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * Detail laporan yang ditugaskan ke petugas ini.
     */
    public function show(Report $report)
    {
        // Pastikan laporan ini memang ditugaskan ke petugas yang login
        if ($report->petugas_id !== Auth::id()) {
            abort(403, 'Laporan ini tidak ditugaskan kepada Anda.');
        }

        $report->load('category', 'user', 'statusLogs.changedBy', 'evidence', 'supports');

        return view('petugas.report-detail', compact('report'));
    }

    /**
     * Ubah status laporan (terima tugas, menuju lokasi, mulai tangani).
     */
    public function updateStatus(Request $request, Report $report)
    {
        if ($report->petugas_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'status' => ['required', 'in:menuju_lokasi,sedang_ditangani'],
        ]);

        // Validasi state machine
        $allowedTransitions = [
            'ditugaskan'       => 'menuju_lokasi',
            'menuju_lokasi'    => 'sedang_ditangani',
        ];

        if (!isset($allowedTransitions[$report->status]) || $allowedTransitions[$report->status] !== $request->status) {
            return back()->with('error', 'Perubahan status tidak valid.');
        }

        $oldStatus = $report->status;
        $report->update(['status' => $request->status]);

        $keteranganMap = [
            'menuju_lokasi'    => 'Petugas sedang menuju lokasi.',
            'sedang_ditangani' => 'Petugas sudah di lokasi dan mulai menangani.',
        ];

        ReportStatusLog::create([
            'report_id'  => $report->id,
            'status_lama'=> $oldStatus,
            'status_baru'=> $request->status,
            'diubah_oleh'=> Auth::id(),
            'catatan'    => $keteranganMap[$request->status],
        ]);

        return back()->with('success', 'Status laporan berhasil diperbarui.');
    }

    /**
     * Kirim bukti penanganan (foto sesudah + keterangan).
     */
    public function submitEvidence(Request $request, Report $report)
    {
        if ($report->petugas_id !== Auth::id()) {
            abort(403);
        }

        if ($report->status !== 'sedang_ditangani') {
            return back()->with('error', 'Status laporan harus "Sedang Ditangani" untuk mengirim bukti.');
        }

        $request->validate([
            'foto_sesudah'          => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'keterangan_pekerjaan'  => ['required', 'string', 'min:10', 'max:1000'],
        ]);

        // Upload foto bukti
        $fotoPath = $request->file('foto_sesudah')->store('evidence', 'public');

        // Simpan bukti
        ReportEvidence::create([
            'report_id'             => $report->id,
            'foto_sesudah'          => $fotoPath,
            'keterangan_pekerjaan'  => $request->keterangan_pekerjaan,
            'petugas_id'            => Auth::id(),
        ]);

        // Perbarui status laporan
        $oldStatus = $report->status;
        $report->update([
            'status'         => 'menunggu_konfirmasi',
            'catatan_revisi' => null, // Reset catatan revisi setelah kirim ulang
        ]);

        ReportStatusLog::create([
            'report_id'  => $report->id,
            'status_lama'=> $oldStatus,
            'status_baru'=> 'menunggu_konfirmasi',
            'diubah_oleh'=> Auth::id(),
            'catatan'    => 'Bukti penanganan dikirim, menunggu konfirmasi admin.',
        ]);

        // Notifikasi ke admin
        $adminUsers = \App\Models\User::where('role', 'admin')->get();
        foreach ($adminUsers as $admin) {
            Notification::kirim(
                $admin->id,
                'Bukti Penanganan Dikirim',
                "Petugas " . Auth::user()->name . " telah mengirim bukti untuk laporan {$report->kode_laporan}. Silakan periksa.",
                $report->id
            );
        }

        return back()->with('success', 'Bukti penanganan berhasil dikirim. Menunggu konfirmasi admin.');
    }

    /**
     * Daftar semua laporan yang pernah ditugaskan.
     */
    public function history()
    {
        $reports = Report::where('petugas_id', Auth::id())
            ->with('category', 'user')
            ->orderByDesc('updated_at')
            ->paginate(15);

        return view('petugas.history', compact('reports'));
    }
}
