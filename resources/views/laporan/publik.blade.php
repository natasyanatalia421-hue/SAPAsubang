@extends('layouts.app')
@section('title', 'Laporan & Pengaduan')

@section('content')

{{-- ══ HERO ══ --}}
<section class="relative overflow-hidden bg-gradient-to-br from-green-50 via-white to-green-50" style="min-height:420px;">
    {{-- Dekorasi daun kiri --}}
    <div class="absolute left-0 top-0 bottom-0 pointer-events-none select-none opacity-60 w-40">
        <svg viewBox="0 0 160 500" class="h-full w-full">
            <ellipse cx="30" cy="120" rx="55" ry="90" fill="#86efac" transform="rotate(-30 30 120)" opacity=".7"/>
            <ellipse cx="15" cy="280" rx="40" ry="70" fill="#4ade80" transform="rotate(20 15 280)" opacity=".5"/>
            <ellipse cx="60" cy="400" rx="35" ry="60" fill="#bbf7d0" transform="rotate(-15 60 400)" opacity=".6"/>
        </svg>
    </div>
    {{-- Dekorasi daun kanan --}}
    <div class="absolute right-0 top-0 bottom-0 pointer-events-none select-none opacity-50 w-32">
        <svg viewBox="0 0 140 500" class="h-full w-full">
            <ellipse cx="110" cy="100" rx="50" ry="80" fill="#86efac" transform="rotate(25 110 100)" opacity=".6"/>
            <ellipse cx="130" cy="300" rx="38" ry="65" fill="#4ade80" transform="rotate(-20 130 300)" opacity=".5"/>
        </svg>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
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

            {{-- Kanan: Foto + card konfirmasi --}}
            <div class="relative">
                {{-- Slot foto hero laporan --}}
                <div class="rounded-3xl overflow-hidden shadow-xl bg-gray-100 aspect-[4/3] flex flex-col items-center justify-center border border-dashed border-gray-300">
                    <svg class="w-12 h-12 text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span class="text-xs text-gray-400">Foto Kota Subang — 800×600px</span>
                </div>
                {{-- Card floating --}}
                <div class="absolute bottom-4 right-4 bg-white rounded-2xl shadow-xl border border-gray-100 px-5 py-4 max-w-[220px]">
                    <div class="flex items-start gap-3">
                        <div class="w-9 h-9 bg-green-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <div>
                            <p class="font-bold text-gray-800 text-sm leading-tight">Laporan Anda Akan Ditindaklanjuti</p>
                            <p class="text-xs text-gray-500 mt-1 leading-snug">Setiap laporan akan diverifikasi dan diproses oleh tim terkait.</p>
                        </div>
                    </div>
                </div>
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
<section class="bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">

            {{-- Kiri: Cara Melapor --}}
            <div>
                <div class="flex items-center gap-2 mb-2">
                    <span class="text-green-600 text-lg">🌿</span>
                    <h2 class="text-xl font-extrabold text-gray-900">Cara Melapor</h2>
                </div>
                <p class="text-gray-500 text-sm mb-8">Ikuti langkah mudah berikut untuk melaporkan masalah di Kota Subang.</p>

                <div class="grid grid-cols-4 gap-4 relative">
                    {{-- garis penghubung --}}
                    <div class="absolute top-8 left-[12.5%] right-[12.5%] h-0.5 bg-green-100 z-0 hidden sm:block"></div>

                    @foreach([
                        ['icon'=>'📍','title'=>'Temukan Lokasi Masalah','desc'=>'Pastikan Anda berada di titik lokasi yang tepat.'],
                        ['icon'=>'📸','title'=>'Ambil Foto','desc'=>'Dokumentasikan masalah dengan foto yang jelas.'],
                        ['icon'=>'🏷️','title'=>'Pilih Kategori','desc'=>'Pilih jenis masalah dan tambahkan keterangan (opsional).'],
                        ['icon'=>'📤','title'=>'Kirim Laporan','desc'=>'Laporan akan diverifikasi admin dan ditindaklanjuti oleh pihak terkait.'],
                    ] as $step)
                    <div class="relative z-10 text-center">
                        <div class="w-14 h-14 bg-white border-2 border-green-200 rounded-2xl flex items-center justify-center text-2xl mx-auto mb-3 shadow-sm">
                            {{ $step['icon'] }}
                        </div>
                        <h4 class="font-bold text-gray-800 text-xs leading-snug mb-1">{{ $step['title'] }}</h4>
                        <p class="text-[11px] text-gray-500 leading-snug">{{ $step['desc'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Kanan: Laporan Terbaru --}}
            <div>
                <div class="flex items-center justify-between mb-5">
                    <div class="flex items-center gap-2">
                        <span class="text-green-600 text-lg">📋</span>
                        <h2 class="text-xl font-extrabold text-gray-900">Laporan Terbaru</h2>
                    </div>
                    <a href="#daftar-laporan" class="text-sm font-semibold text-green-700 hover:text-green-800 flex items-center gap-1">
                        Lihat Semua →
                    </a>
                </div>

                <div class="space-y-3">
                    @foreach($reports->take(5) as $r)
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                        <div class="flex gap-3 p-3">
                            {{-- Foto kecil --}}
                            <div class="w-20 h-16 flex-shrink-0 rounded-xl overflow-hidden bg-gray-100 flex items-center justify-center text-2xl">
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
                                <p class="text-sm font-semibold text-gray-800 line-clamp-1 leading-snug">{{ $r->deskripsi }}</p>
                                <div class="flex items-center gap-3 mt-1 text-[11px] text-gray-400">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                                        Kec. Subang
                                    </span>
                                    <span>{{ $r->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
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

        <div class="flex flex-wrap gap-3">
            <a href="{{ route('laporan.publik') }}"
               class="flex flex-col items-center gap-2 px-6 py-4 rounded-2xl border-2 transition-all
                      {{ !request('kategori') ? 'border-green-600 bg-green-50' : 'border-gray-200 bg-white hover:border-green-300' }}">
                <span class="text-2xl">🔘</span>
                <span class="text-xs font-semibold text-gray-700">Semua</span>
            </a>
            @foreach($categories as $cat)
            <a href="{{ route('laporan.publik', ['kategori' => $cat->id]) }}"
               class="flex flex-col items-center gap-2 px-5 py-4 rounded-2xl border-2 transition-all
                      {{ request('kategori') == $cat->id ? 'border-green-600 bg-green-50' : 'border-gray-200 bg-white hover:border-green-300 hover:bg-green-50' }}">
                <span class="text-2xl">{{ $cat->icon }}</span>
                <span class="text-xs font-semibold text-gray-700 whitespace-nowrap">{{ $cat->nama_kategori }}</span>
            </a>
            @endforeach
        </div>
    </div>
</section>

{{-- ══ DAFTAR SEMUA LAPORAN ══ --}}
<section id="daftar-laporan" class="bg-gray-50 py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-6 flex-wrap gap-3">
            <h2 class="font-extrabold text-gray-900 text-lg">
                Semua Laporan
                <span class="text-sm font-normal text-gray-400 ml-2">({{ $reports->total() }})</span>
            </h2>
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
                            <span>{{ $r->created_at->diffForHumans() }}</span>
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
document.addEventListener('DOMContentLoaded', function() {
    // Peta laporan di halaman publik (jika ada di section lain nanti)
});
</script>
@endpush
