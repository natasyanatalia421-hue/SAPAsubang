@extends('layouts.dashboard')
@section('title', $report->kode_laporan)
@section('page-title', 'Detail Laporan')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    {{-- Header --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-start justify-between flex-wrap gap-3">
            <div>
                <h2 class="text-xl font-bold text-gray-800">{{ $report->kode_laporan }}</h2>
                <p class="text-gray-500 text-sm mt-1">{{ $report->category->icon }} {{ $report->category->nama_kategori }}</p>
                <p class="text-gray-400 text-xs mt-1">Dilaporkan {{ $report->created_at->diffForHumans() }}</p>
            </div>
            <div class="flex flex-col items-end gap-2">
                @include('components.status-badge', ['status' => $report->status])
                @if($report->prioritas)
                    @include('components.priority-badge', ['prioritas' => $report->prioritas])
                @endif
                <span class="text-xs text-gray-500">👍 {{ $supportCount }} dukungan</span>
            </div>
        </div>

        @if($report->status === 'ditolak' && $report->alasan_ditolak)
        <div class="mt-4 bg-red-50 border border-red-200 rounded-xl p-4">
            <p class="text-sm font-medium text-red-700">❌ Alasan Penolakan:</p>
            <p class="text-sm text-red-600 mt-1">{{ $report->alasan_ditolak }}</p>
        </div>
        @endif
    </div>

    {{-- Foto Sebelum & Sesudah --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <h3 class="font-semibold text-gray-800 mb-4">📸 Foto</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <p class="text-xs font-medium text-gray-500 mb-2 uppercase tracking-wide">Sebelum</p>
                <div class="aspect-video bg-gray-100 rounded-xl overflow-hidden">
                    @if(str_starts_with($report->foto_sebelum, 'demo/'))
                        <div class="w-full h-full flex items-center justify-center text-4xl bg-gray-200">{{ $report->category->icon }}</div>
                    @else
                        <img src="{{ Storage::url($report->foto_sebelum) }}" class="w-full h-full object-cover"
                             alt="Foto sebelum" loading="lazy">
                    @endif
                </div>
            </div>
            @if($report->latestEvidence)
            <div>
                <p class="text-xs font-medium text-gray-500 mb-2 uppercase tracking-wide">Sesudah Penanganan</p>
                <div class="aspect-video bg-gray-100 rounded-xl overflow-hidden">
                    @if(str_starts_with($report->latestEvidence->foto_sesudah, 'demo/'))
                        <div class="w-full h-full flex items-center justify-center text-4xl bg-green-100">✅</div>
                    @else
                        <img src="{{ Storage::url($report->latestEvidence->foto_sesudah) }}" class="w-full h-full object-cover"
                             alt="Foto sesudah" loading="lazy">
                    @endif
                </div>
                <p class="text-xs text-gray-500 mt-2">{{ $report->latestEvidence->keterangan_pekerjaan }}</p>
            </div>
            @endif
        </div>
    </div>

    {{-- Deskripsi & Lokasi --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <h3 class="font-semibold text-gray-800 mb-3">📝 Detail Laporan</h3>
        <p class="text-gray-700 text-sm leading-relaxed">{{ $report->deskripsi }}</p>

        <div class="mt-4 flex items-center gap-2 text-sm text-gray-500">
            <span>📍</span>
            <span>{{ number_format($report->latitude, 5) }}, {{ number_format($report->longitude, 5) }}</span>
        </div>

        {{-- Peta lokasi --}}
        <div class="mt-4 rounded-xl overflow-hidden border border-gray-200" id="report-map" style="height: 220px;"></div>
    </div>

    {{-- Timeline status --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <h3 class="font-semibold text-gray-800 mb-4">📋 Riwayat Status</h3>
        <div class="space-y-4">
            @foreach($report->statusLogs as $log)
            <div class="flex gap-3">
                <div class="flex flex-col items-center">
                    <div class="w-3 h-3 rounded-full bg-blue-500 flex-shrink-0 mt-1"></div>
                    @if(!$loop->last)<div class="w-0.5 flex-1 bg-gray-200 mt-1"></div>@endif
                </div>
                <div class="pb-4 flex-1">
                    <div class="flex items-center gap-2 flex-wrap">
                        <span class="text-sm font-medium text-gray-800">
                            @include('components.status-badge', ['status' => $log->status_baru])
                        </span>
                        <span class="text-xs text-gray-400">oleh {{ $log->changedBy->name }}</span>
                    </div>
                    @if($log->catatan)
                        <p class="text-xs text-gray-500 mt-1">{{ $log->catatan }}</p>
                    @endif
                    <p class="text-xs text-gray-400 mt-1">{{ $log->created_at->format('d M Y, H:i') }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const lat = {{ $report->latitude }};
    const lng = {{ $report->longitude }};
    const map = L.map('report-map').setView([lat, lng], 16);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { attribution: '© OpenStreetMap' }).addTo(map);
    L.marker([lat, lng]).addTo(map)
        .bindPopup('<b>{{ $report->kode_laporan }}</b><br>{{ $report->category->nama_kategori }}')
        .openPopup();
});
</script>
@endpush
