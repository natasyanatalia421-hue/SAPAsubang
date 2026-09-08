<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Laporan milik user, terbaru duluan
        $reports = Report::with('category')
            ->where('user_id', $user->id)
            ->orderByDesc('created_at')
            ->paginate(10);

        // Laporan yang didukung user
        $supported = Report::with('category')
            ->whereHas('supports', fn($q) => $q->where('user_id', $user->id))
            ->whereNotIn('status', ['ditolak'])
            ->orderByDesc('created_at')
            ->get();

        // Statistik ringkas
        $stats = [
            'total'    => Report::where('user_id', $user->id)->count(),
            'aktif'    => Report::where('user_id', $user->id)->whereNotIn('status', ['ditolak', 'selesai'])->count(),
            'selesai'  => Report::where('user_id', $user->id)->where('status', 'selesai')->count(),
            'ditolak'  => Report::where('user_id', $user->id)->where('status', 'ditolak')->count(),
        ];

        return view('user.dashboard', compact('reports', 'supported', 'stats'));
    }
}
