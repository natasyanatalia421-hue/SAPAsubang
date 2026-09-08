@extends('layouts.dashboard')
@section('title', 'Laporan Serupa Ditemukan')
@section('page-title', 'Laporan Serupa Ditemukan')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">

    {{-- Alert --}}
    <div class="bg-amber-50 border border-amber-200 rounded-2xl p-5 flex gap-4">
        <div class="text-3xl flex-shrink-0">⚠️</div>
        <div>
            <h3 class="font-semibold text-amber-800">Laporan serupa sudah ada!</h3>
            <p class="text-sm text-amber-700 mt-1">
                Sistem mendeteksi laporan dengan kategori yang sama dalam radius 100 meter dari lokasi Anda.
                Anda dapat mendukung laporan tersebut agar lebih cepat ditangani.
            </p>
        </div>
    </div>

    {{-- Laporan yang ditemukan --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 space-y-4">
        <div class="flex items-start justify-between gap-3 flex-wrap">
            <div>
                <div class="flex items-center gap-2">
                    <span class="text-2xl">{{ $report->category->icon }}</span>
                    <div>
                        <h4 class="font-bold text-gray-800">{{ $report->kode_laporan }}</h4>
                        <p class="text-sm text-gray-500">{{ $report->category->nama_kategori }}</p>
                    </div>
                </div>
            </div>
            <div class="flex flex-col items-end gap-1">
                @include('components.status-badge', ['status' => $report->status])
                <span class="text-xs text-gray-500">👍 {{ $report->supports->count() }} dukungan</span>
            </div>
        </div>

        <p class="text-sm text-gray-700 bg-gray-50 rounded-xl p-3">{{ $report->deskripsi }}</p>

        {{-- Foto --}}
        <div class="aspect-video bg-gray-100 rounded-xl overflow-hidden">
            @if(str_starts_with($report->foto_sebelum, 'demo/'))
                <div class="w-full h-full flex items-center justify-center text-5xl">{{ $report->category->icon }}</div>
            @else
                <img src="{{ Storage::url($report->foto_sebelum) }}" class="w-full h-full object-cover" alt="Foto laporan">
            @endif
        </div>

        {{-- Peta --}}
        <div id="dup-map" class="rounded-xl overflow-hidden border border-gray-200" style="height:200px;"></div>

        <p class="text-xs text-gray-400">
            Dilaporkan oleh {{ $report->user->name }} — {{ $report->created_at->diffForHumans() }}
        </p>
    </div>

    {{-- Action buttons --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 space-y-4">
        @if($alreadySupported)
            <div class="bg-green-50 border border-green-200 rounded-xl p-4 text-center">
                <p class="text-green-700 font-medium">✅ Anda sudah mendukung laporan ini sebelumnya.</p>
            </div>
        @else
            <div class="text-center space-y-3">
                <p class="text-sm text-gray-600">Pilih tindakan Anda:</p>
                <div class="flex flex-col sm:flex-row gap-3">
                    {{-- Dukung laporan ini --}}
                    <form method="POST" action="{{ route('user.reports.support', $report->id) }}" class="flex-1">
                        @csrf
                        <button type="submit"
                                class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-xl transition-colors flex items-center justify-center gap-2">
                            👍 Dukung Laporan Ini
                        </button>
                    </form>

                    {{-- Tetap buat laporan baru --}}
                    <a href="{{ route('user.reports.create') }}"
                       class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 rounded-xl transition-colors flex items-center justify-center gap-2 text-sm">
                        📝 Buat Laporan Baru
                    </a>
                </div>
                <p class="text-xs text-gray-400">
                    Mendukung laporan membantu admin memprioritaskan penanganan masalah yang sama.
                </p>
            </div>
        @endif

        <div class="text-center">
            <a href="{{ route('user.dashboard') }}" class="text-sm text-gray-500 hover:text-gray-700 hover:underline">
                ← Kembali ke Dashboard
            </a>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const lat = {{ $report->latitude }};
    const lng = {{ $report->longitude }};
    const map = L.map('dup-map').setView([lat, lng], 16);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { attribution: '© OpenStreetMap' }).addTo(map);
    L.marker([lat, lng]).addTo(map)
        .bindPopup('{{ $report->kode_laporan }}: {{ $report->category->nama_kategori }}')
        .openPopup();
});
</script>
@endpush
