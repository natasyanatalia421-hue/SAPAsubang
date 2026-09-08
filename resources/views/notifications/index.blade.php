@extends('layouts.dashboard')
@section('title', 'Notifikasi')
@section('page-title', 'Notifikasi')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
        <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
            <h3 class="font-semibold text-gray-800">🔔 Semua Notifikasi</h3>
            <span class="text-xs text-gray-400">{{ $notifications->total() }} notifikasi</span>
        </div>

        @if($notifications->isEmpty())
            <div class="py-16 text-center text-gray-400">
                <div class="text-5xl mb-3">🔕</div>
                <p class="font-medium text-gray-600">Belum ada notifikasi.</p>
            </div>
        @else
            <div class="divide-y divide-gray-50">
                @foreach($notifications as $notif)
                <div class="flex items-start gap-4 px-5 py-4 {{ !$notif->sudah_dibaca ? 'bg-blue-50/50' : '' }}">
                    {{-- Indikator belum dibaca --}}
                    <div class="flex-shrink-0 mt-1.5">
                        @if(!$notif->sudah_dibaca)
                            <div class="w-2.5 h-2.5 rounded-full bg-blue-500"></div>
                        @else
                            <div class="w-2.5 h-2.5 rounded-full bg-gray-200"></div>
                        @endif
                    </div>

                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-gray-800">{{ $notif->judul }}</p>
                        <p class="text-sm text-gray-600 mt-0.5 leading-relaxed">{{ $notif->pesan }}</p>
                        <div class="flex items-center gap-3 mt-2">
                            <p class="text-xs text-gray-400">{{ $notif->created_at->diffForHumans() }}</p>
                            @if($notif->report_id)
                                @php
                                    $reportRoute = match(auth()->user()->role) {
                                        'admin'   => route('admin.reports.show', $notif->report_id),
                                        'petugas' => route('petugas.tasks.show', $notif->report_id),
                                        default   => route('user.reports.show', $notif->report_id),
                                    };
                                @endphp
                                <a href="{{ $reportRoute }}"
                                   class="text-xs text-blue-600 hover:text-blue-800 font-medium hover:underline">
                                    Lihat laporan →
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="px-5 py-3 border-t border-gray-100">
                {{ $notifications->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
