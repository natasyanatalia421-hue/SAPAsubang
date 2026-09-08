@extends('layouts.app')
@section('title', 'Laporan Serupa Ditemukan')
@section('page-title', 'Laporan Serupa Ditemukan')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-amber-50 border border-amber-200 rounded-2xl p-6 mb-6">
        <div class="flex items-start gap-3">
            <span class="text-3xl">⚠️</span>
            <div>
                <h2 class="font-bold text-amber-800 text-lg">Ada laporan serupa di lokasi ini!</h2>
                <p class="text-amber-700 text-sm mt-1">
                    Sistem menemukan laporan dengan kategori dan lokasi yang berdekatan (dalam radius 100 meter).
                    Daripada membuat laporan duplikat, Anda bisa mendukung laporan ini.
                </p>
            </div>
        </div>
    </div>

    {{-- Detail laporan yang ditemukan --}}
    <div class="bg-white rounded-2xl border border-gray-200 p-6 space-y-5">
        <div class="flex items-center gap-3">
            <span class="text-3xl">{{ $nearby->category->icon }}</span>
            <div>
                <p class="font-semibold text-gray-800">{{ $nearby->kode_laporan }}</p>
                <p class="text-sm text-gray-500">{{ $nearby->category->nama_kategori }}</p>
            </div>
            <div class="ml-auto">
                @include('components.status-badge', ['status' => $nearby->status])
            </div>
        </div>

        @if($nearby->foto_sebelum)
        <img src="{{ Storage::url($nearby->foto_sebelum) }}"
             onerror="this.src='https://placehold.co/600x300?text=Foto+Laporan'"
             class="w-full h-48 object-cover rounded-xl">
        @endif

        <div>
            <p class="text-sm font-medium text-gray-700 mb-1">Deskripsi:</p>
            <p class="text-sm text-gray-600">{{ $nearby->deskripsi }}</p>
        </div>

        <div class="grid grid-cols-2 gap-4 text-sm">
            <div class="bg-gray-50 rounded-lg p-3">
                <p class="text-gray-500 text-xs">Dilaporkan oleh</p>
                <p class="font-medium text-gray-800">{{ $nearby->user->name }}</p>
            </div>
            <div class="bg-gray-50 rounded-lg p-3">
                <p class="text-gray-500 text-xs">Waktu laporan</p>
                <p class="font-medium text-gray-800">{{ $nearby->created_at->format('d M Y, H:i') }}</p>
            </div>
            <div class="bg-gray-50 rounded-lg p-3">
                <p class="text-gray-500 text-xs">Jumlah pendukung</p>
                <p class="font-medium text-gray-800">{{ $nearby->support_count }} orang</p>
            </div>
            @if($nearby->prioritas)
            <div class="bg-gray-50 rounded-lg p-3">
                <p class="text-gray-500 text-xs">Prioritas</p>
                @include('components.prioritas-badge', ['prioritas' => $nearby->prioritas])
            </div>
            @endif
        </div>

        {{-- Peta lokasi --}}
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">📍 Lokasi Laporan</p>
            <div id="map-duplicate" class="w-full h-40 rounded-xl border border-gray-200"></div>
        </div>

        {{-- Tombol aksi --}}
        <div class="flex gap-3 pt-2">
            @if($alreadySupported)
                <div class="flex-1 bg-green-100 text-green-700 text-center py-3 rounded-xl text-sm font-medium">
                    ✅ Anda sudah mendukung laporan ini
                </div>
            @else
                <form method="POST" action="{{ route('user.reports.support', $nearby) }}" class="flex-1">
                    @csrf
                    <button type="submit"
                            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-xl transition-colors">
                        👍 Dukung Laporan Ini
                    </button>
                </form>
            @endif

            <a href="{{ route('user.reports.create') }}"
               class="flex-1 border border-gray-300 text-gray-700 text-center py-3 rounded-xl text-sm font-medium hover:bg-gray-50 transition-colors">
                Buat Laporan Baru Tetap
            </a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const map = L.map('map-duplicate').setView([{{ $nearby->latitude }}, {{ $nearby->longitude }}], 16);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { attribution: '© OpenStreetMap' }).addTo(map);
    L.marker([{{ $nearby->latitude }}, {{ $nearby->longitude }}], {
        icon: L.divIcon({ html: '<div style="font-size:28px;margin-top:-14px;margin-left:-14px;">📍</div>', iconSize: [28,28], iconAnchor:[14,28] })
    }).addTo(map).bindPopup('{{ $nearby->kode_laporan }}').openPopup();
});
</script>
@endpush
