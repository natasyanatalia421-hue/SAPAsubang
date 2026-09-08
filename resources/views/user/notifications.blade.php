@extends('layouts.app')
@section('title', 'Notifikasi')
@section('page-title', 'Notifikasi Saya')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <h3 class="font-semibold text-gray-800">Semua Notifikasi</h3>
            <form method="POST" action="{{ route('user.notifications.readAll') }}">
                @csrf
                <button class="text-xs text-indigo-600 hover:underline">Tandai semua dibaca</button>
            </form>
        </div>

        @forelse($notifications as $notif)
        <div class="{{ $notif->sudah_dibaca ? '' : 'bg-blue-50 border-l-4 border-blue-400' }} px-6 py-4 border-b border-gray-50 last:border-0">
            <div class="flex items-start gap-3">
                <span class="text-xl shrink-0">{{ $notif->sudah_dibaca ? '🔔' : '🔴' }}</span>
                <div class="flex-1">
                    <p class="text-sm font-semibold text-gray-800">{{ $notif->judul }}</p>
                    <p class="text-sm text-gray-600 mt-0.5">{{ $notif->pesan }}</p>
                    <div class="flex items-center gap-4 mt-1">
                        <p class="text-xs text-gray-400">{{ $notif->created_at->format('d M Y, H:i') }}</p>
                        @if($notif->report_id)
                        <a href="{{ route('user.reports.show', $notif->report_id) }}"
                           class="text-xs text-indigo-600 hover:underline">Lihat laporan →</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-16 text-gray-400">
            <div class="text-5xl mb-3">🔔</div>
            <p>Tidak ada notifikasi</p>
        </div>
        @endforelse
    </div>

    <div class="mt-4">{{ $notifications->links('components.pagination') }}</div>
</div>
@endsection
