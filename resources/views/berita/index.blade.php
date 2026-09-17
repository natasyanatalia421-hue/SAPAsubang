@extends('layouts.app')
@section('title', 'Berita')

@section('content')

{{-- ══ HERO ══ --}}
<section class="relative overflow-hidden" style="min-height:300px;">
    {{-- Slot foto hero — ganti div ini dengan: <img src="/images/berita-hero.jpg" class="absolute inset-0 w-full h-full object-cover"> --}}
    <div class="absolute inset-0 bg-gradient-to-br from-green-100 via-teal-50 to-green-50 flex items-center justify-end pr-12 pointer-events-none">
        <div class="flex flex-col items-center gap-2 opacity-30 select-none">
            <svg class="w-12 h-12 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            <span class="text-xs text-green-400 font-medium">Foto Hero 1400×300px</span>
        </div>
    </div>
    <div class="absolute inset-0 bg-gradient-to-r from-white/95 via-white/85 to-transparent"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
        <p class="text-green-700 font-bold text-sm mb-1 italic">Informasi Terkini</p>
        <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-900 leading-tight mb-4">Kota Subang</h1>
        <p class="text-gray-600 text-sm leading-relaxed max-w-md mb-7">
            Berita, kegiatan, dan informasi terbaru seputar pembangunan, pelayanan, dan kehidupan masyarakat di Kota Subang.
        </p>
        <a href="#berita-list" class="inline-flex items-center gap-2 bg-green-700 hover:bg-green-800 text-white font-bold px-6 py-3 rounded-full transition-all shadow-md text-sm">
            Jelajahi Subang →
        </a>
    </div>

    <div class="absolute top-1/2 right-8 -translate-y-1/2 hidden lg:block text-right">
        <p class="text-green-800 font-black text-2xl italic leading-tight">Subang</p>
        <p class="text-green-700 font-bold text-lg italic">Maju, Hijau,</p>
        <p class="text-green-600 font-bold text-lg italic">Berkelanjutan</p>
    </div>
</section>

{{-- ══ FILTER KATEGORI ══ --}}
<section id="berita-list" class="bg-white border-b border-gray-100 sticky top-16 z-30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-2 py-3 overflow-x-auto">
            @php
            $kategoris = [
                ['slug'=>'semua',        'icon'=>'🔘', 'label'=>'Semua'],
                ['slug'=>'pemerintahan', 'icon'=>'🏛️', 'label'=>'Pemerintahan'],
                ['slug'=>'pembangunan',  'icon'=>'🔧', 'label'=>'Pembangunan'],
                ['slug'=>'sosial',       'icon'=>'👥', 'label'=>'Sosial'],
                ['slug'=>'pendidikan',   'icon'=>'🎓', 'label'=>'Pendidikan'],
                ['slug'=>'lingkungan',   'icon'=>'🌿', 'label'=>'Lingkungan'],
                ['slug'=>'ekonomi',      'icon'=>'📈', 'label'=>'Ekonomi'],
                ['slug'=>'kesehatan',    'icon'=>'🏥', 'label'=>'Kesehatan'],
                ['slug'=>'infrastruktur','icon'=>'🏗️', 'label'=>'Infrastruktur'],
            ];
            $aktif = request('kategori', 'semua');
            @endphp
            @foreach($kategoris as $kat)
            <a href="{{ route('berita', ['kategori' => $kat['slug']]) }}"
               class="flex-shrink-0 flex items-center gap-1.5 px-4 py-2 rounded-full text-xs font-semibold transition-all whitespace-nowrap
                      {{ $aktif === $kat['slug'] ? 'bg-green-700 text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-green-50 hover:text-green-700' }}">
                <span>{{ $kat['icon'] }}</span>{{ $kat['label'] }}
            </a>
            @endforeach
        </div>
    </div>
</section>

{{-- ══ GRID BERITA ══ --}}
<section class="bg-gray-50 py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
            @foreach($berita as $b)
            <a href="{{ route('berita.show', $b['slug']) }}"
               class="group bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-lg transition-all hover:-translate-y-0.5">
                {{-- Slot foto berita — ganti div ini dengan <img src="{{ $b['foto'] ?? '/images/berita/xxx.jpg' }}" class="w-full h-full object-cover"> --}}
                <div class="relative aspect-video bg-gray-100 overflow-hidden border-b border-dashed border-gray-200 flex flex-col items-center justify-center gap-1">
                    <span class="text-3xl">{{ $b['icon'] }}</span>
                    <span class="text-[10px] text-gray-400 font-medium">Foto 600×338px</span>
                    {{-- Badge kategori --}}
                    <div class="absolute top-2 left-2">
                        <span class="text-[10px] font-bold text-white px-2 py-0.5 rounded-full shadow-sm"
                              style="background: {{ $b['warna'] ?? '#16a34a' }}">
                            {{ $b['kategori'] }}
                        </span>
                    </div>
                </div>
                <div class="p-4">
                    <div class="flex items-center gap-1 text-[11px] text-gray-400 mb-2">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        {{ $b['tanggal'] }}
                    </div>
                    <h3 class="font-bold text-gray-800 text-sm leading-snug line-clamp-2 group-hover:text-green-700 transition-colors mb-2">{{ $b['judul'] }}</h3>
                    <p class="text-xs text-gray-500 leading-relaxed line-clamp-3">{{ $b['ringkasan'] }}</p>
                    <span class="mt-3 inline-block text-xs font-bold text-green-700 group-hover:underline">Baca Selengkapnya →</span>
                </div>
            </a>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="flex items-center justify-center gap-2">
            <button class="w-8 h-8 rounded-full border border-gray-200 flex items-center justify-center text-gray-500 hover:bg-gray-100 text-sm">‹</button>
            @foreach([1,2,3,4,5] as $p)
            <button class="w-8 h-8 rounded-full text-sm font-semibold transition-colors {{ $p===1 ? 'bg-green-700 text-white' : 'border border-gray-200 text-gray-600 hover:bg-gray-100' }}">{{ $p }}</button>
            @endforeach
            <span class="text-gray-400 text-sm">...</span>
            <button class="w-8 h-8 rounded-full border border-gray-200 flex items-center justify-center text-gray-500 hover:bg-gray-100 text-sm">›</button>
        </div>
    </div>
</section>

@endsection
