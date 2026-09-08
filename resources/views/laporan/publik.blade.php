@extends('layouts.app')
@section('title', 'Laporan Masyarakat')

@section('content')

{{-- ══ HEADER ══ --}}
<div class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div>
                <div class="flex items-center gap-2 mb-1.5">
                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                    </svg>
                    <span class="text-green-600 text-xs font-bold uppercase tracking-widest">Peta laporan</span>
                </div>
                <h1 class="text-2xl font-bold text-gray-900">Semua laporan warga Subang</h1>
            </div>
            <a href="{{ route('laporan.publik') }}" class="text-sm font-semibold text-green-600 hover:text-green-700">
                Lihat semua →
            </a>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- ══ KOLOM KIRI: Peta + Laporan ══ --}}
        <div class="lg:col-span-2 space-y-5">

            {{-- Peta --}}
            <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm">
                {{-- Peta Kabupaten Subang — koordinat -6.5744, 107.7599 --}}
                <div id="peta-subang" style="height:380px;"></div>
            </div>

            {{-- Filter --}}
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3">

                    {{-- Filter kategori --}}
                    <div class="flex flex-wrap gap-2">
                        <a href="{{ route('laporan.publik') }}"
                           class="px-3 py-1.5 text-xs font-semibold rounded-lg border transition-colors
                                  {{ !request('kategori') ? 'bg-gray-900 text-white border-gray-900' : 'bg-white text-gray-600 border-gray-200 hover:border-gray-400' }}">
                            Semua kategori
                        </a>
                        @foreach($categories as $cat)
                        <a href="{{ route('laporan.publik', ['kategori' => $cat->id]) }}"
                           class="px-3 py-1.5 text-xs font-medium rounded-lg border transition-colors
                                  {{ request('kategori') == $cat->id ? 'bg-gray-900 text-white border-gray-900' : 'bg-white text-gray-600 border-gray-200 hover:border-gray-400' }}">
                            {{ $cat->nama_kategori }}
                        </a>
                        @endforeach
                    </div>

                    <span class="text-xs text-gray-400 flex-shrink-0">
                        {{ number_format($reports->total()) }} laporan ditemukan
                    </span>
                </div>

                {{-- Daftar --}}
                @if($reports->isEmpty())
                <div class="py-16 text-center">
                    <p class="text-gray-400 text-sm">Belum ada laporan untuk kategori ini.</p>
                </div>
                @else
                <div class="divide-y divide-gray-50">
                    @foreach($reports as $r)
                    <div class="flex gap-4 p-5 hover:bg-gray-50/50 transition-colors">

                        {{-- Status badge kiri atas --}}
                        <div class="flex-shrink-0">
                            @if(!str_starts_with($r->foto_sebelum, 'demo/') && Storage::disk('public')->exists($r->foto_sebelum))
                            <div class="w-20 h-16 rounded-xl overflow-hidden bg-gray-100">
                                <img src="{{ Storage::url($r->foto_sebelum) }}" class="w-full h-full object-cover" alt="">
                            </div>
                            @else
                            <div class="w-20 h-16 rounded-xl bg-gray-100 flex items-center justify-center text-3xl">
                                {{ $r->category->icon ?? '📋' }}
                            </div>
                            @endif
                        </div>

                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between gap-2 mb-2 flex-wrap">
                                <div class="flex items-center gap-2 flex-wrap">
                                    @include('components.status-badge', ['status' => $r->status])
                                    <span class="text-xs text-gray-500 font-medium">{{ $r->category->nama_kategori }}</span>
                                </div>
                            </div>

                            <p class="text-sm font-semibold text-gray-800 line-clamp-2 leading-snug mb-2">
                                {{ Str::limit($r->deskripsi, 90) }}
                            </p>

                            <div class="flex items-center gap-4 text-xs text-gray-400 flex-wrap">
                                <span class="flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    </svg>
                                    Subang
                                </span>
                                <span>▲ {{ $r->supports_count }} warga setuju</span>
                                <span>{{ $r->created_at->diffForHumans() }}</span>
                            </div>
                        </div>

                        {{-- Tombol dukung --}}
                        <div class="flex-shrink-0 self-center">
                            @auth
                                @if(auth()->user()->isUser())
                                @php $sudahDukung = $r->supports->contains('user_id', auth()->id()); @endphp
                                @if($sudahDukung || $r->user_id === auth()->id())
                                    <span class="text-xs text-green-600 font-semibold bg-green-50 border border-green-100 px-3 py-1.5 rounded-lg">✓ Setuju</span>
                                @elseif(!in_array($r->status, ['ditolak','selesai']))
                                    <form method="POST" action="{{ route('user.reports.support', $r->id) }}">
                                        @csrf
                                        <button type="submit"
                                                class="text-xs bg-gray-900 hover:bg-gray-700 text-white font-semibold px-4 py-1.5 rounded-lg transition-colors">
                                            + Dukung
                                        </button>
                                    </form>
                                @endif
                                @endif
                            @else
                                @if(!in_array($r->status, ['ditolak','selesai']))
                                <a href="{{ route('login') }}"
                                   class="text-xs bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 font-medium px-3 py-1.5 rounded-lg transition-colors">
                                    + Dukung
                                </a>
                                @endif
                            @endauth
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Muat lebih --}}
                @if($reports->hasMorePages())
                <div class="p-5 text-center border-t border-gray-100">
                    <a href="{{ $reports->nextPageUrl() }}"
                       class="inline-flex items-center gap-2 px-6 py-2.5 border border-gray-200 rounded-xl text-sm text-gray-600 hover:bg-gray-50 hover:border-gray-300 transition-colors font-medium">
                        Muat laporan lainnya
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </a>
                </div>
                @endif
                @endif
            </div>
        </div>

        {{-- ══ KOLOM KANAN: Sidebar ══ --}}
        <div class="space-y-5">

            {{-- CTA Buat Laporan --}}
            <div class="bg-green-700 rounded-2xl p-6 text-white">
                <h3 class="font-bold text-base mb-2">Ada masalah di sekitar Anda?</h3>
                <p class="text-green-100 text-xs leading-relaxed mb-4">
                    Laporkan sekarang, gratis dan tidak perlu ke kantor kelurahan.
                </p>
                @auth
                    @if(auth()->user()->isUser())
                    <a href="{{ route('user.reports.create') }}"
                       class="w-full flex items-center justify-center gap-2 bg-white text-green-700 font-bold px-4 py-2.5 rounded-xl text-sm hover:bg-green-50 transition-colors">
                        Buat laporan sekarang
                    </a>
                    @endif
                @else
                <a href="{{ route('login') }}"
                   class="w-full flex items-center justify-center gap-2 bg-white text-green-700 font-bold px-4 py-2.5 rounded-xl text-sm hover:bg-green-50 transition-colors">
                    Buat laporan sekarang
                </a>
                @endauth
            </div>

            {{-- Statistik --}}
            <div class="bg-white rounded-2xl border border-gray-200 p-5 shadow-sm">
                <h3 class="font-semibold text-gray-800 text-sm mb-4">Statistik</h3>
                <div class="space-y-2.5">
                    @foreach([
                        ['Total laporan',     $stats['total']],
                        ['Selesai ditangani', $stats['selesai']],
                        ['Sedang diproses',   $stats['proses']],
                    ] as [$lbl,$val])
                    <div class="flex justify-between items-center py-2 border-b border-gray-50 last:border-0">
                        <span class="text-sm text-gray-600">{{ $lbl }}</span>
                        <span class="text-sm font-bold text-gray-800">{{ number_format($val) }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Kategori --}}
            <div class="bg-white rounded-2xl border border-gray-200 p-5 shadow-sm">
                <h3 class="font-semibold text-gray-800 text-sm mb-3">Kategori Aduan</h3>
                <div class="space-y-0.5">
                    @foreach($categories as $cat)
                    <a href="{{ route('laporan.publik', ['kategori' => $cat->id]) }}"
                       class="flex items-center justify-between px-2 py-2 rounded-lg hover:bg-gray-50 transition-colors group
                              {{ request('kategori') == $cat->id ? 'bg-green-50' : '' }}">
                        <div class="flex items-center gap-2">
                            <span class="text-base leading-none">{{ $cat->icon }}</span>
                            <span class="text-sm {{ request('kategori') == $cat->id ? 'text-green-700 font-semibold' : 'text-gray-600 group-hover:text-gray-800' }}">
                                {{ $cat->nama_kategori }}
                            </span>
                        </div>
                        <span class="text-xs text-gray-400">{{ $cat->reports_count ?? 0 }}</span>
                    </a>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Koordinat pusat Kabupaten Subang yang BENAR
    var SUBANG_LAT = -6.5744;
    var SUBANG_LNG = 107.7599;
    var SUBANG_ZOOM = 11;

    var map = L.map('peta-subang').setView([SUBANG_LAT, SUBANG_LNG], SUBANG_ZOOM);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors',
        maxZoom: 18
    }).addTo(map);

    var colors = {
        menunggu_verifikasi: '#EAB308', ditolak: '#EF4444',
        terverifikasi: '#3B82F6',       ditugaskan: '#8B5CF6',
        menuju_lokasi: '#6366F1',       sedang_ditangani: '#F97316',
        menunggu_konfirmasi: '#06B6D4', selesai: '#22C55E'
    };

    var points = @json($mapPoints);
    var coords = [];

    points.forEach(function(p) {
        var c = colors[p.status] || '#6B7280';
        var icon = L.divIcon({
            className: '',
            html: '<div style="width:13px;height:13px;border-radius:50%;background:' + c +
                  ';border:2.5px solid white;box-shadow:0 2px 5px rgba(0,0,0,.3)"></div>',
            iconSize: [13,13], iconAnchor: [6,6]
        });

        L.marker([p.lat, p.lng], {icon: icon})
            .addTo(map)
            .bindPopup(
                '<div style="font-family:system-ui,sans-serif;font-size:12px;min-width:160px">' +
                '<div style="font-weight:700;margin-bottom:3px">' + p.kode + '</div>' +
                '<div style="color:#555;margin-bottom:4px">' + p.kategori + '</div>' +
                '<span style="background:#f5f5f5;color:#555;padding:2px 8px;border-radius:20px;font-size:10px">' +
                p.status_label + '</span></div>'
            );

        coords.push([p.lat, p.lng]);
    });

    // Pastikan peta menampilkan Subang — validasi koordinat
    if (coords.length > 0) {
        try {
            var bounds = L.latLngBounds(coords);
            var center = bounds.getCenter();
            // Validasi: koordinat harus di wilayah Jawa Barat/Subang
            var inSubang = center.lat > -7.5 && center.lat < -5.5 &&
                           center.lng > 106.0 && center.lng < 109.0;
            if (inSubang) {
                map.fitBounds(bounds, {padding: [50, 50], maxZoom: 14});
            } else {
                map.setView([SUBANG_LAT, SUBANG_LNG], SUBANG_ZOOM);
            }
        } catch(e) {
            map.setView([SUBANG_LAT, SUBANG_LNG], SUBANG_ZOOM);
        }
    }
});
</script>
@endpush
