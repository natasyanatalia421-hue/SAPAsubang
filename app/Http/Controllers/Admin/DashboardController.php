<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik ringkas
        $stats = [
            'total'               => Report::count(),
            'menunggu_verifikasi' => Report::where('status', 'menunggu_verifikasi')->count(),
            'sedang_proses'       => Report::whereIn('status', ['terverifikasi', 'ditugaskan', 'menuju_lokasi', 'sedang_ditangani', 'menunggu_konfirmasi'])->count(),
            'selesai'             => Report::where('status', 'selesai')->count(),
            'ditolak'             => Report::where('status', 'ditolak')->count(),
        ];

        // Laporan terbaru menunggu verifikasi
        $pending = Report::with(['user', 'category'])
            ->where('status', 'menunggu_verifikasi')
            ->withCount('supports')
            ->orderByDesc('created_at')
            ->take(5)
            ->get();

        // Semua laporan untuk tabel
        $reports = Report::with(['user', 'category', 'petugas'])
            ->withCount('supports')
            ->orderByDesc('created_at')
            ->paginate(15);

        $totalPetugas = User::where('role', 'petugas')->count();

        // Data peta — disiapkan di controller agar tidak ada fn() di Blade @json
        $mapReports = $reports->getCollection()->map(fn($r) => [
            'id'      => $r->id,
            'kode'    => $r->kode_laporan,
            'lat'     => $r->latitude,
            'lng'     => $r->longitude,
            'status'  => $r->status,
            'kategori'=> $r->category->nama_kategori,
            'url'     => route('admin.reports.show', $r->id),
        ])->values();

        return view('admin.dashboard', compact('stats', 'pending', 'reports', 'totalPetugas', 'mapReports'));
    }
}
