@extends('layouts.app')
@section('title', $report->kode_laporan)
@section('page-title', 'Detail Laporan')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    {{-- Header info --}}
    <div class="bg-white rounded-2xl border border-gray-200 p-6">
        <div class="flex items-start justify-between gap-4 flex-wrap">
            <div>
                <div class="flex items-center gap-3 flex-wrap">
                    <span class="text-2xl">{{ $report->category->icon }}</span>
                    <h2 class="text-xl font-bold text-gray-800">{{ $report->kode_laporan }}</h2>
                    @include('components.status-badge', ['status' => $report->status])
                    @if($report->prioritas)
                        @include('components.prioritas-badge', ['prioritas' => $report->prioritas])
                    @endif
                </div>
                <p class="text-gray-600 text-sm mt-1">{{ $report->category->nama_kategori }}</p>
                <p class="text-gray-400 text-xs mt-0.5">Dilaporkan {{ $report->created_at->format('d M Y, H:i') }}</p>
            </div>
            <div class="text-right text-sm">
                <p class="text-gray-500">{{ $report->supports->count() }} Pendukung</p>
                @if($report->petugas)
                    <p class="text-gray-600 mt-1">Petugas: <span class="font-medium">{{ $report->petugas->name }}</span></p>
                @endif
            </div>
        </div>

        @if($report->alasan_ditolak)
        <div class="mt-4 bg-red-50 border border-red-200 rounded-xl p-4">
            <p class="text-sm font-semibold text-red-700">Alasan Penolakan:</p>
            <p class="text-sm text-red-600 mt-1">{{ $report->alasan_ditolak }}</p>
        </div>
        @endif
    </div>

    {{-- Foto sebelum & sesudah --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div class="bg-white rounded-2xl border border-gray-200 p-4">
            <p class="text-sm font-semibold text-gray-700 mb-3">Foto Sebelum</p>
            <img src="{{ Storage::url($report->foto_sebelum) }}"
                 onerror="this.src='https://placehold.co/400x250?text=Foto+Sebelum'"
                 class="w-full h-48 object-cover rounded-xl">
        </div>

        @if($report->latestEvidence)
        <div class="bg-white rounded-2xl border border-gray-200 p-4">
            <p class="text-sm font-semibold text-gray-700 mb-3">Foto Sesudah</p>
            <img src="{{ Storage::url($report->latestEvidence->foto_sesudah) }}"
                 onerror="this.src='https://placehold.co/400x250?text=Foto+Sesudah'"
                 class="w-full h-48 object-cover rounded-xl">
            <p class="text-xs text-gray-500 mt-2">{{ $report->latestEvidence->keterangan_pekerjaan }}</p>
        </div>
        @else
        <div class="bg-gray-50 rounded-2xl border border-dashed border-gray-200 p-4 flex items-center justify-center">
            <div class="text-center text-gray-400">
                <p class="text-sm">Foto sesudah belum tersedia</p>
            </div>
        </div>
        @endif
    </div>

    {{-- Deskripsi --}}
    <div class="bg-white rounded-2xl border border-gray-200 p-6">
        <p class="text-sm font-semibold text-gray-700 mb-2">Deskripsi Masalah</p>
        <p class="text-gray-600 text-sm leading-relaxed">{{ $report->deskripsi }}</p>
    </div>

    {{-- Peta --}}
    <div class="bg-white rounded-2xl border border-gray-200 p-6">
        <p class="text-sm font-semibold text-gray-700 mb-3">📍 Lokasi Masalah</p>
        <div id="map-detail" class="w-full h-52 rounded-xl border border-gray-200"></div>
        <p class="text-xs text-gray-400 mt-2">
            {{ number_format($report->latitude, 6) }}, {{ number_format($report->longitude, 6) }}
        </p>
    </div>

    {{-- Timeline status --}}
    <div class="bg-white rounded-2xl border border-gray-200 p-6">
        <p class="text-sm font-semibold text-gray-700 mb-4">Riwayat Status</p>
        <div class="relative">
            <div class="absolute left-3.5 top-0 bottom-0 w-0.5 bg-gray-200"></div>
            <div class="space-y-4">
                @foreach($report->statusLogs as $log)
                <div class="flex gap-4 relative">
                    <div class="w-7 h-7 rounded-full bg-indigo-100 border-2 border-indigo-500 flex items-center justify-center shrink-0 z-10">
                        <div class="w-2 h-2 rounded-full bg-indigo-500"></div>
                    </div>
                    <div class="flex-1 pb-2">
                        <p class="text-sm font-medium text-gray-800">
                            {{ \App\Models\Report::$statusLabels[$log->status_baru] ?? $log->status_baru }}
                        </p>
                        @if($log->catatan)
                        <p class="text-xs text-gray-500 mt-0.5">{{ $log->catatan }}</p>
                        @endif
                        <p class="text-xs text-gray-400 mt-1">
                            oleh {{ $log->changedBy->name }} — {{ $log->created_at->format('d M Y, H:i') }}
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const map = L.map('map-detail').setView([{{ $report->latitude }}, {{ $report->longitude }}], 16);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { attribution: '© OpenStreetMap' }).addTo(map);
    L.marker([{{ $report->latitude }}, {{ $report->longitude }}], {
        icon: L.divIcon({ html: '<div style="font-size:28px;margin-top:-14px;margin-left:-14px;">📍</div>', iconSize:[28,28], iconAnchor:[14,28] })
    }).addTo(map).bindPopup('{{ $report->kode_laporan }}').openPopup();
});
</script>
@endpush
