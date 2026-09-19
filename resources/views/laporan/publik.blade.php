@extends('layouts.app')
@section('title', 'Laporan & Pengaduan')

@section('content')

{{-- ══ HERO ══ --}}
<section class="relative overflow-hidden" style="min-height:420px;">
    <div class="absolute inset-0 z-0 bg-cover" style="background-image:url('{{ asset('images/bc1.jpeg') }}?v=20260920'); background-position:center 45%; background-size:cover;"></div>
    <div class="absolute inset-0 z-[1] bg-white/80"></div>
    {{-- Dekorasi daun kiri --}}
    <div class="absolute left-0 top-0 bottom-0 z-[2] pointer-events-none select-none opacity-60 w-40">
        <svg viewBox="0 0 160 500" class="h-full w-full">
            <ellipse cx="30" cy="120" rx="55" ry="90" fill="#86efac" transform="rotate(-30 30 120)" opacity=".7"/>
            <ellipse cx="15" cy="280" rx="40" ry="70" fill="#4ade80" transform="rotate(20 15 280)" opacity=".5"/>
            <ellipse cx="60" cy="400" rx="35" ry="60" fill="#bbf7d0" transform="rotate(-15 60 400)" opacity=".6"/>
        </svg>
    </div>
    {{-- Dekorasi daun kanan --}}
    <div class="absolute right-0 top-0 bottom-0 z-[2] pointer-events-none select-none opacity-50 w-32">
        <svg viewBox="0 0 140 500" class="h-full w-full">
            <ellipse cx="110" cy="100" rx="50" ry="80" fill="#86efac" transform="rotate(25 110 100)" opacity=".6"/>
            <ellipse cx="130" cy="300" rx="38" ry="65" fill="#4ade80" transform="rotate(-20 130 300)" opacity=".5"/>
        </svg>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">

            {{-- Kiri: Teks --}}
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <div class="w-6 h-6 bg-green-100 border border-green-300 rounded flex items-center justify-center">
                        <svg class="w-3.5 h-3.5 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    </div>
                    <span class="text-green-700 text-sm font-semibold">Laporan & Pengaduan</span>
                </div>
                <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-900 leading-tight mb-5">
                    Laporkan Masalah<br>di Kota Subang
                </h1>
                <p class="text-gray-600 text-sm leading-relaxed mb-8 max-w-md">
                    Bersama kita wujudkan Subang yang lebih bersih, aman, nyaman, dan berkelanjutan. Laporkan berbagai permasalahan di lingkungan sekitar Anda dengan mudah dan cepat.
                </p>
                @auth
                    @if(auth()->user()->isUser())
                    <a href="{{ route('user.reports.create') }}"
                       class="inline-flex items-center gap-2 bg-green-700 hover:bg-green-800 text-white font-bold px-7 py-3.5 rounded-full transition-all shadow-lg text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                        Buat Laporan Sekarang →
                    </a>
                    @endif
                @else
                <a href="{{ route('login') }}"
                   class="inline-flex items-center gap-2 bg-green-700 hover:bg-green-800 text-white font-bold px-7 py-3.5 rounded-full transition-all shadow-lg text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                    Buat Laporan Sekarang →
                </a>
                @endauth
            </div>

        </div>
    </div>
</section>

{{-- ══ STATS BAR ══ --}}
<section class="bg-white border-y border-gray-100 py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-6 text-center divide-x divide-gray-100">
            @foreach([
                ['icon'=>'<svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>', 'val'=>$stats['total'],  'lbl'=>'Total Laporan Masuk'],
                ['icon'=>'<svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',  'val'=>$stats['selesai'], 'lbl'=>'Laporan Terselesaikan'],
                ['icon'=>'<svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>', 'val'=>$stats['proses'],  'lbl'=>'Dalam Proses'],
                ['icon'=>'<svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>', 'val'=>$stats['menunggu'],'lbl'=>'Laporan Menunggu'],
            ] as $s)
            <div class="px-4">
                <div class="flex justify-center mb-2 text-green-600">{!! $s['icon'] !!}</div>
                <div class="text-3xl font-extrabold text-gray-900">{{ number_format($s['val']) }}</div>
                <div class="text-xs text-gray-500 mt-1">{{ $s['lbl'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══ CARA MELAPOR + LAPORAN TERBARU ══ --}}
<section class="bg-gray-50 py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-[1.05fr_0.95fr]">

            {{-- Kiri: Cara Melapor --}}
            <div>
                <div class="mb-6 flex items-end justify-between gap-4">
                    <div>
                        <p class="mb-1 text-[11px] font-bold uppercase tracking-[0.18em] text-green-600">Mulai dari sini</p>
                        <h2 class="text-2xl font-extrabold text-gray-900">Cara Melapor</h2>
                    </div>
                    <span class="hidden rounded-full bg-green-100 px-3 py-1 text-[11px] font-bold text-green-700 sm:inline-flex">4 langkah mudah</span>
                </div>
                <p class="mb-8 max-w-md text-sm leading-relaxed text-gray-500">Ikuti alur singkat berikut agar laporan Anda cepat dipahami dan ditindaklanjuti.</p>

                <div class="grid grid-cols-2 gap-3 sm:grid-cols-4 sm:gap-4 relative">
                    {{-- garis penghubung --}}
                    <div class="absolute top-8 left-[12.5%] right-[12.5%] h-0.5 bg-green-100 z-0 hidden sm:block"></div>

                    @foreach([
                        ['icon'=>'📍','title'=>'Temukan Lokasi Masalah','desc'=>'Pastikan Anda berada di titik lokasi yang tepat.'],
                        ['icon'=>'📸','title'=>'Ambil Foto','desc'=>'Dokumentasikan masalah dengan foto yang jelas.'],
                        ['icon'=>'🏷️','title'=>'Pilih Kategori','desc'=>'Pilih jenis masalah dan tambahkan keterangan (opsional).'],
                        ['icon'=>'📤','title'=>'Kirim Laporan','desc'=>'Laporan akan diverifikasi admin dan ditindaklanjuti oleh pihak terkait.'],
                    ] as $step)
                    <div class="group relative z-10 rounded-2xl border border-gray-200 bg-white p-3 text-center shadow-sm transition hover:-translate-y-1 hover:border-green-200 hover:shadow-md sm:p-4">
                        <div class="relative mx-auto mb-3 flex h-14 w-14 items-center justify-center rounded-2xl border-2 border-green-200 bg-green-50 text-2xl shadow-sm">
                            {{ $step['icon'] }}
                        </div>
                        <h4 class="mb-1 text-xs font-bold leading-snug text-gray-800">{{ $step['title'] }}</h4>
                        <p class="text-[11px] leading-snug text-gray-500">{{ $step['desc'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Kanan: Laporan Terbaru --}}
            <div>
                <div class="mb-6 flex items-end justify-between gap-4">
                    <div>
                        <p class="mb-1 text-[11px] font-bold uppercase tracking-[0.18em] text-green-600">Masuk hari ini</p>
                        <h2 class="text-2xl font-extrabold text-gray-900">Laporan Terbaru</h2>
                    </div>
                    <a href="#daftar-laporan" class="shrink-0 text-xs font-bold text-green-700 transition hover:text-green-900">
                        Lihat semua →
                    </a>
                </div>

                @if($todayReports->isEmpty())
                <div class="rounded-2xl border border-dashed border-gray-300 bg-white px-5 py-8 text-center">
                    <div class="mb-2 text-3xl">📭</div>
                    <p class="text-sm font-semibold text-gray-700">Belum ada laporan hari ini</p>
                    <p class="mt-1 text-xs text-gray-500">Laporan baru akan muncul di sini setelah dikirim warga.</p>
                </div>
                @else
                <div class="space-y-3">
                    @foreach($todayReports as $r)
                    <div class="group overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm transition hover:-translate-y-0.5 hover:border-green-200 hover:shadow-md">
                        <div class="flex gap-3 p-3.5">
                            {{-- Foto kecil --}}
                            <div class="flex h-16 w-20 flex-shrink-0 items-center justify-center overflow-hidden rounded-xl bg-green-50 text-2xl ring-1 ring-gray-100">
                                @if(!str_starts_with($r->foto_sebelum,'demo/') && Storage::disk('public')->exists($r->foto_sebelum))
                                    <img src="{{ Storage::url($r->foto_sebelum) }}" class="w-full h-full object-cover">
                                @else
                                    {{ $r->category->icon ?? '📋' }}
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-1.5 mb-1 flex-wrap">
                                    <span class="text-[10px] font-bold text-white px-2 py-0.5 rounded-full" style="background:{{ ['menunggu_verifikasi'=>'#EAB308','ditolak'=>'#EF4444','terverifikasi'=>'#3B82F6','ditugaskan'=>'#8B5CF6','menuju_lokasi'=>'#6366F1','sedang_ditangani'=>'#F97316','menunggu_konfirmasi'=>'#06B6D4','selesai'=>'#22C55E'][$r->status] ?? '#6B7280' }}">
                                        {{ $r->category->nama_kategori }}
                                    </span>
                                    @include('components.status-badge', ['status' => $r->status])
                                </div>
                                <p class="line-clamp-1 text-sm font-bold leading-snug text-gray-800 group-hover:text-green-700">{{ $r->deskripsi }}</p>
                                <div class="mt-2 flex items-center gap-3 text-[11px] text-gray-400">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                                        Kec. Subang
                                    </span>
                                    <span>{{ $r->user->name ?? 'Warga Subang' }}</span>
                                    <span>{{ $r->created_at->format('H:i') }} WIB</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>

            {{-- Kanan: Peta laporan Kota Subang --}}
            <div class="relative">
                <div class="h-[320px] overflow-hidden rounded-3xl border border-green-100 bg-green-50 shadow-xl">
                    <div id="subang-report-map" class="h-full w-full"></div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══ KATEGORI LAPORAN ══ --}}
<section class="bg-white py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-2 mb-2">
            <span class="text-green-600 text-lg">🌿</span>
            <h2 class="text-xl font-extrabold text-gray-900">Kategori Laporan</h2>
        </div>
        <p class="text-gray-500 text-sm mb-7">Pilih kategori masalah yang ingin Anda laporkan.</p>

        <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-4">
            <a href="{{ route('laporan.publik') }}"
               class="group flex min-h-[108px] flex-col items-center justify-center gap-2 rounded-2xl border-2 px-4 py-4 text-center transition-all
                      {{ !request('kategori') ? 'border-green-600 bg-green-50' : 'border-gray-200 bg-white hover:border-green-300' }}">
                <span class="flex h-10 w-10 items-center justify-center rounded-full bg-gray-100 text-lg transition group-hover:bg-green-100">◉</span>
                <span class="text-xs font-bold text-gray-700">Semua laporan</span>
            </a>
            @foreach($categories as $cat)
            <a href="{{ route('laporan.publik', ['kategori' => $cat->id]) }}"
               class="group flex min-h-[108px] flex-col items-center justify-center gap-2 rounded-2xl border-2 px-3 py-4 text-center transition-all
                      {{ request('kategori') == $cat->id ? 'border-green-600 bg-green-50' : 'border-gray-200 bg-white hover:border-green-300 hover:bg-green-50' }}">
                <span class="flex h-10 w-10 items-center justify-center rounded-full bg-green-50 text-lg transition group-hover:scale-105">{{ $cat->icon }}</span>
                <span class="text-xs font-bold leading-tight text-gray-700">{{ $cat->nama_kategori }}</span>
                <span class="text-[10px] text-gray-400">{{ $cat->reports_count }} laporan</span>
            </a>
            @endforeach
        </div>
    </div>
</section>

{{-- ══ DAFTAR SEMUA LAPORAN ══ --}}
<section id="daftar-laporan" class="bg-gray-50 py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-6 flex-wrap gap-3">
            <div>
                <p class="mb-1 text-[11px] font-bold uppercase tracking-[0.18em] text-green-600">Arsip pengaduan warga</p>
                <h2 class="font-extrabold text-gray-900 text-lg">Semua Laporan <span class="text-sm font-normal text-gray-400">({{ $reports->total() }})</span></h2>
            </div>
            <span class="rounded-full bg-white px-3 py-2 text-xs font-semibold text-gray-500 shadow-sm">Terbaru ke terlama</span>
        </div>

        @if($reports->isEmpty())
        <div class="text-center py-16 bg-white rounded-2xl border border-gray-100">
            <div class="text-5xl mb-3">📭</div>
            <p class="text-gray-500 text-sm">Belum ada laporan untuk kategori ini.</p>
        </div>
        @else
        <div class="space-y-4">
            @foreach($reports as $r)
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                <div class="flex gap-4 p-4">
                    {{-- Foto --}}
                    <div class="w-24 h-20 flex-shrink-0 rounded-xl overflow-hidden bg-gray-100 flex items-center justify-center text-3xl">
                        @if(!str_starts_with($r->foto_sebelum,'demo/') && Storage::disk('public')->exists($r->foto_sebelum))
                            <img src="{{ Storage::url($r->foto_sebelum) }}" class="w-full h-full object-cover">
                        @else
                            {{ $r->category->icon ?? '📋' }}
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between gap-2 flex-wrap mb-1.5">
                            <div class="flex items-center gap-2 flex-wrap">
                                <span class="text-[11px] font-bold text-white px-2.5 py-0.5 rounded-full"
                                      style="background:{{ ['menunggu_verifikasi'=>'#EAB308','ditolak'=>'#EF4444','terverifikasi'=>'#3B82F6','ditugaskan'=>'#8B5CF6','menuju_lokasi'=>'#6366F1','sedang_ditangani'=>'#F97316','menunggu_konfirmasi'=>'#06B6D4','selesai'=>'#22C55E'][$r->status] ?? '#6B7280' }}">
                                    {{ $r->category->nama_kategori }}
                                </span>
                                @include('components.status-badge', ['status' => $r->status])
                            </div>
                        </div>
                        <p class="text-sm font-semibold text-gray-800 line-clamp-2 leading-snug mb-2">{{ $r->deskripsi }}</p>
                        <div class="flex items-center gap-4 text-xs text-gray-400 flex-wrap">
                            <span class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                                Kec. Subang
                            </span>
                            <span>👍 {{ $r->supports_count }}</span>
                            <span class="font-semibold text-gray-500">{{ $r->created_at->translatedFormat('d M Y, H:i') }} WIB</span>
                        </div>
                    </div>
                    {{-- Tombol dukung --}}
                    <div class="flex-shrink-0 self-center">
                        @auth
                            @if(auth()->user()->isUser())
                            @php $sudahDukung=$r->supports->contains('user_id',auth()->id()); @endphp
                            @if($sudahDukung||$r->user_id===auth()->id())
                                <span class="text-xs text-green-600 font-semibold bg-green-50 border border-green-100 px-3 py-1.5 rounded-lg">✓</span>
                            @elseif(!in_array($r->status,['ditolak','selesai']))
                                <form method="POST" action="{{ route('user.reports.support',$r->id) }}">
                                    @csrf
                                    <button class="text-xs bg-green-700 hover:bg-green-800 text-white font-semibold px-4 py-1.5 rounded-lg transition-colors">+ Dukung</button>
                                </form>
                            @endif
                            @endif
                        @else
                            @if(!in_array($r->status,['ditolak','selesai']))
                            <a href="{{ route('login') }}" class="text-xs bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 font-medium px-3 py-1.5 rounded-lg transition-colors">+ Dukung</a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-8 flex justify-center">
            {{ $reports->appends(request()->query())->links() }}
        </div>
        @endif
    </div>
</section>

{{-- ══ FAB BUAT LAPORAN ══ --}}
<div class="fixed bottom-6 right-6 z-40">
    @auth
        @if(auth()->user()->isUser())
        <a href="{{ route('user.reports.create') }}"
           class="flex items-center gap-2 bg-green-700 hover:bg-green-800 text-white font-bold px-5 py-3.5 rounded-2xl shadow-xl transition-all hover:-translate-y-0.5 text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
            Buat Laporan
        </a>
        @endif
    @else
    <a href="{{ route('login') }}"
       class="flex items-center gap-2 bg-green-700 hover:bg-green-800 text-white font-bold px-5 py-3.5 rounded-2xl shadow-xl transition-all hover:-translate-y-0.5 text-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
        Buat Laporan
    </a>
    @endauth
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const element = document.getElementById('subang-report-map');
    if (!element || typeof L === 'undefined') return;

    const map = L.map(element, {
        zoomControl: true,
        scrollWheelZoom: false,
        dragging: true,
    }).setView([-6.5715, 107.7585], 11);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors',
        maxZoom: 19,
    }).addTo(map);

    const boundary = [
        [-6.525, 107.715], [-6.505, 107.755], [-6.515, 107.805],
        [-6.555, 107.835], [-6.605, 107.825], [-6.635, 107.785],
        [-6.625, 107.735], [-6.595, 107.700], [-6.550, 107.695],
    ];
    L.polygon(boundary, {
        color: '#15803d', weight: 2, fillColor: '#86efac', fillOpacity: 0.16,
    }).addTo(map);

    const colors = {
        menunggu_verifikasi: '#eab308', terverifikasi: '#3b82f6',
        ditugaskan: '#8b5cf6', menuju_lokasi: '#6366f1',
        sedang_ditangani: '#f97316', menunggu_konfirmasi: '#06b6d4', selesai: '#22c55e',
    };
    const points = @json($mapPoints->values());
    points.filter(point => point.lat && point.lng).forEach(point => {
        const color = colors[point.status] || '#6b7280';
        L.circleMarker([Number(point.lat), Number(point.lng)], {
            radius: 7, color: '#fff', weight: 2, fillColor: color, fillOpacity: 0.95,
        }).addTo(map);
    });

    setTimeout(() => map.invalidateSize(), 100);
});
</script>
@endpush

