<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::with('report')
            ->where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->paginate(20);

        // Tandai semua sebagai sudah dibaca
        Notification::where('user_id', Auth::id())
            ->where('sudah_dibaca', false)
            ->update(['sudah_dibaca' => true]);

        return view('notifications.index', compact('notifications'));
    }

    /** API endpoint — jumlah notifikasi belum dibaca (untuk badge) */
    public function unreadCount()
    {
        $count = Notification::where('user_id', Auth::id())
            ->where('sudah_dibaca', false)
            ->count();

        return response()->json(['count' => $count]);
    }

    public function markRead(Notification $notification)
    {
        if ($notification->user_id !== Auth::id()) abort(403);
        $notification->update(['sudah_dibaca' => true]);
        return response()->json(['ok' => true]);
    }
}
