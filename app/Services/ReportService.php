<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\Report;
use App\Models\ReportStatusLog;
use App\Models\ReportSupport;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportService
{
    /**
     * Ubah status laporan + catat log + kirim notifikasi relevan
     */
    public function changeStatus(Report $report, string $newStatus, ?string $catatan = null, ?User $actor = null): void
    {
        $actor    ??= Auth::user();
        $oldStatus  = $report->status;

        DB::transaction(function () use ($report, $newStatus, $oldStatus, $catatan, $actor) {
            $report->update(['status' => $newStatus]);

            ReportStatusLog::create([
                'report_id'   => $report->id,
                'status_lama' => $oldStatus,
                'status_baru' => $newStatus,
                'diubah_oleh' => $actor->id,
                'catatan'     => $catatan,
            ]);

            $this->sendNotification($report, $newStatus, $catatan);
        });
    }

    /**
     * Kirim notifikasi berdasarkan status baru
     */
    private function sendNotification(Report $report, string $status, ?string $catatan): void
    {
        $kode = $report->kode_laporan;

        switch ($status) {
            case 'ditolak':
                Notification::kirim(
                    $report->user_id,
                    'Laporan Ditolak',
                    "Laporan {$kode} Anda ditolak. Alasan: " . ($report->alasan_ditolak ?? $catatan ?? '-'),
                    $report->id
                );
                break;

            case 'ditugaskan':
                if ($report->petugas_id) {
                    Notification::kirim(
                        $report->petugas_id,
                        'Tugas Baru',
                        "Anda ditugaskan menangani laporan {$kode} ({$report->category->nama_kategori}).",
                        $report->id
                    );
                }
                break;

            case 'menunggu_konfirmasi':
                if ($report->admin_id) {
                    Notification::kirim(
                        $report->admin_id,
                        'Bukti Pekerjaan Masuk',
                        "Petugas {$report->petugas?->name} mengirim bukti penanganan {$kode}. Silakan periksa.",
                        $report->id
                    );
                }
                break;

            case 'sedang_ditangani':
                // Revisi dari admin — beri tahu petugas
                if ($report->petugas_id && $catatan) {
                    Notification::kirim(
                        $report->petugas_id,
                        'Revisi Pekerjaan',
                        "Admin meminta revisi pada laporan {$kode}. Catatan: {$catatan}",
                        $report->id
                    );
                }
                break;

            case 'selesai':
                // Beri tahu pelapor
                Notification::kirim(
                    $report->user_id,
                    'Laporan Selesai ✅',
                    "Laporan {$kode} yang Anda buat sudah diselesaikan.",
                    $report->id
                );
                // Beri tahu semua yang mendukung
                $supporters = ReportSupport::where('report_id', $report->id)
                    ->where('user_id', '!=', $report->user_id)
                    ->pluck('user_id');

                foreach ($supporters as $uid) {
                    Notification::kirim(
                        $uid,
                        'Laporan yang Anda Dukung Selesai ✅',
                        "Laporan {$kode} yang Anda dukung sudah diselesaikan.",
                        $report->id
                    );
                }
                break;
        }
    }
}
