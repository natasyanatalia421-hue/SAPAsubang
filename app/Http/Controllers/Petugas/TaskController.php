<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Services\ReportService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function __construct(private ReportService $svc) {}

    public function show(Report $report)
    {
        // Pastikan laporan ini memang milik petugas ini
        if ($report->petugas_id !== Auth::id()) {
            abort(403, 'Bukan tugas Anda.');
        }

        $report->load('category', 'user', 'statusLogs.changedBy', 'evidence');
        return view('petugas.tasks.show', compact('report'));
    }

    /** Terima tugas → menuju lokasi */
    public function accept(Report $report)
    {
        $this->authorizeTask($report);

        if ($report->status !== 'ditugaskan') {
            return back()->with('error', 'Status laporan tidak sesuai.');
        }

        $report->update(['status' => 'menuju_lokasi']);
        $this->svc->changeStatus($report, 'menuju_lokasi', 'Petugas menerima tugas dan menuju lokasi.');

        return back()->with('success', 'Tugas diterima. Status diperbarui ke "Menuju Lokasi".');
    }

    /** Tandai sedang ditangani */
    public function startWork(Report $report)
    {
        $this->authorizeTask($report);

        if ($report->status !== 'menuju_lokasi') {
            return back()->with('error', 'Status laporan tidak sesuai.');
        }

        $report->update(['status' => 'sedang_ditangani']);
        $this->svc->changeStatus($report, 'sedang_ditangani', 'Petugas tiba di lokasi dan mulai menangani.');

        return back()->with('success', 'Status diperbarui ke "Sedang Ditangani".');
    }

    /** Kirim bukti penanganan → menunggu konfirmasi */
    public function submitEvidence(Request $request, Report $report)
    {
        $this->authorizeTask($report);

        if (!in_array($report->status, ['sedang_ditangani'])) {
            return back()->with('error', 'Status laporan tidak sesuai untuk mengirim bukti.');
        }

        $data = $request->validate([
            'foto_sesudah'        => 'required|image|max:5120',
            'keterangan_pekerjaan'=> 'required|string|min:10|max:1000',
        ], [
            'foto_sesudah.required'         => 'Foto sesudah penanganan wajib disertakan.',
            'foto_sesudah.image'            => 'File harus berupa gambar.',
            'keterangan_pekerjaan.required' => 'Keterangan pekerjaan wajib diisi.',
            'keterangan_pekerjaan.min'      => 'Keterangan minimal 10 karakter.',
        ]);

        $fotoPath = $request->file('foto_sesudah')->store('reports/after', 'public');

        \App\Models\ReportEvidence::create([
            'report_id'            => $report->id,
            'foto_sesudah'         => $fotoPath,
            'keterangan_pekerjaan' => $data['keterangan_pekerjaan'],
            'petugas_id'           => Auth::id(),
        ]);

        $report->update(['status' => 'menunggu_konfirmasi']);
        $this->svc->changeStatus($report, 'menunggu_konfirmasi', 'Bukti penanganan dikirim, menunggu konfirmasi admin.');

        return back()->with('success', 'Bukti berhasil dikirim. Menunggu konfirmasi admin.');
    }

    private function authorizeTask(Report $report): void
    {
        if ($report->petugas_id !== Auth::id()) {
            abort(403, 'Bukan tugas Anda.');
        }
    }
}
