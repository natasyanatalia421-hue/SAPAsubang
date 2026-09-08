<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $stats = [
            'ditugaskan'        => Report::where('petugas_id', $userId)->where('status', 'ditugaskan')->count(),
            'dalam_proses'      => Report::where('petugas_id', $userId)->whereIn('status', ['menuju_lokasi', 'sedang_ditangani'])->count(),
            'menunggu_konfirmasi' => Report::where('petugas_id', $userId)->where('status', 'menunggu_konfirmasi')->count(),
            'selesai'           => Report::where('petugas_id', $userId)->where('status', 'selesai')->count(),
        ];

        // Tugas aktif
        $activeTasks = Report::with(['category', 'user'])
            ->where('petugas_id', $userId)
            ->whereIn('status', ['ditugaskan', 'menuju_lokasi', 'sedang_ditangani', 'menunggu_konfirmasi'])
            ->orderByDesc('updated_at')
            ->get();

        // Riwayat tugas selesai
        $history = Report::with(['category'])
            ->where('petugas_id', $userId)
            ->where('status', 'selesai')
            ->orderByDesc('updated_at')
            ->paginate(10);

        // Data peta — disiapkan di controller agar tidak ada fn() di Blade @json
        $mapTasks = $activeTasks->map(fn($r) => [
            'kode'  => $r->kode_laporan,
            'lat'   => $r->latitude,
            'lng'   => $r->longitude,
            'status'=> $r->status,
            'url'   => route('petugas.tasks.show', $r->id),
            'kat'   => $r->category->nama_kategori,
        ])->values();

        return view('petugas.dashboard', compact('stats', 'activeTasks', 'history', 'mapTasks'));
    }
}
