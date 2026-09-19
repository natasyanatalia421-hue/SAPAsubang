@extends('layouts.app')
@section('title', 'Beranda')

@section('content')

<style>
    @keyframes homeSlideShow {
        0%, 20% { opacity: 1; }
        25%, 95% { opacity: 0; }
        100% { opacity: 1; }
    }
    .home-slide {
        opacity: 0;
        animation: homeSlideShow 20s infinite;
    }
</style>

{{-- ══════════════════════════════════════════════
     HERO — LAYOUT SPLIT PERSIS SEPERTI DESAIN
══════════════════════════════════════════════ --}}
<section class="relative overflow-hidden" x-data="{
    current: 0,
    slides: [
        '{{ asset('images/bc2.jpeg') }}',
        '{{ asset('images/bc.jpeg') }}',
        '{{ asset('images/bc1.jpeg') }}',
        '{{ asset('images/bc3.jpeg') }}',
    ],
    init() { setInterval(() => { this.current = (this.current + 1) % this.slides.length }, 5000) }
}" x-init="init()">

    {{-- ── FOTO BACKGROUND PENUH ── --}}
    @foreach([
        asset('images/bc2.jpeg'),
        asset('images/bc.jpeg'),
        asset('images/bc1.jpeg'),
        asset('images/bc3.jpeg'),
    ] as $slideIndex => $slide)
           <div class="home-slide absolute inset-0 z-0"
               style="animation-delay: -{{ $slideIndex * 5 }}s;">
            <img src="{{ $slide }}?v=20260920" alt="Subang" class="h-full w-full object-cover" loading="eager">
        </div>
    @endforeach

    {{-- Overlay gradien agar teks terbaca --}}
    <div class="absolute inset-0 bg-gradient-to-r from-black/75 via-black/40 to-black/20 z-[1]"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent z-[1]"></div>

    {{-- Dekorasi daun kiri (latar belakang) --}}
    <div class="absolute left-0 top-0 bottom-0 w-48 pointer-events-none select-none z-10 opacity-90">
        <svg viewBox="0 0 180 600" class="w-full h-full">
            <ellipse cx="20"  cy="80"  rx="75" ry="100" fill="#15803d" transform="rotate(-20 20 80)"   opacity=".95"/>
            <ellipse cx="10"  cy="240" rx="60" ry="90"  fill="#16a34a" transform="rotate(15 10 240)"   opacity=".80"/>
            <ellipse cx="40"  cy="420" rx="65" ry="95"  fill="#14532d" transform="rotate(-12 40 420)"  opacity=".90"/>
            <ellipse cx="15"  cy="580" rx="50" ry="75"  fill="#15803d" transform="rotate(18 15 580)"   opacity=".75"/>
            <circle cx="70" cy="540" r="18" fill="white" opacity=".7"/>
            <circle cx="70" cy="540" r="9"  fill="#fde68a" opacity=".9"/>
            <circle cx="50" cy="200" r="10" fill="white" opacity=".5"/>
            <circle cx="50" cy="200" r="5"  fill="#bbf7d0" opacity=".7"/>
        </svg>
    </div>

    {{-- Dekorasi daun kanan --}}
    <div class="absolute right-0 top-0 bottom-0 w-16 pointer-events-none select-none z-10 opacity-80">
        <svg viewBox="0 0 70 600" class="w-full h-full">
            <ellipse cx="60" cy="150" rx="45" ry="70" fill="#15803d" transform="rotate(20 60 150)" opacity=".8"/>
            <ellipse cx="65" cy="380" rx="38" ry="58" fill="#16a34a" transform="rotate(-15 65 380)" opacity=".7"/>
        </svg>
    </div>

    <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-0 items-stretch min-h-[460px]">

            {{-- KIRI: Teks --}}
            <div class="flex flex-col justify-center py-10 pr-0 lg:pr-8">
                <p class="text-yellow-400 font-bold text-base italic mb-3">
                    — Selamat Datang di
                </p>
                <div class="mb-2">
                    <p class="font-black text-white leading-tight" style="font-size:clamp(1.4rem,3vw,2rem);text-shadow:1px 1px 4px rgba(0,0,0,.5);">Alamnya Indah</p>
                    <p class="font-black leading-tight" style="font-size:clamp(1.4rem,3vw,2rem);color:#4ade80;text-shadow:1px 1px 4px rgba(0,0,0,.5);">Budayanya Kaya</p>
                    <p class="font-black text-white leading-tight" style="font-size:clamp(1.4rem,3vw,2rem);text-shadow:1px 1px 4px rgba(0,0,0,.5);">Wisatanya Memikat</p>
                </div>
                <h1 class="font-black text-white leading-none mb-1 flex items-end gap-2"
                    style="font-size:clamp(3.5rem,7vw,5.5rem);text-shadow:2px 2px 8px rgba(0,0,0,.7);">
                    Kota
                    <svg class="w-7 h-7 mb-2 flex-shrink-0" viewBox="0 0 30 30"><ellipse cx="15" cy="15" rx="13" ry="10" fill="#16a34a" transform="rotate(-30 15 15)"/><ellipse cx="18" cy="12" rx="8" ry="5" fill="#4ade80" transform="rotate(-20 18 12)"/></svg>
                </h1>
                <h1 class="font-black text-white leading-none mb-6"
                    style="font-size:clamp(3.5rem,7vw,5.5rem);text-shadow:2px 2px 8px rgba(0,0,0,.7);">
                    Subang
                    <svg class="w-7 h-7 inline mb-1 ml-1" viewBox="0 0 30 30"><ellipse cx="15" cy="15" rx="13" ry="10" fill="#16a34a" transform="rotate(-30 15 15)"/><ellipse cx="18" cy="12" rx="8" ry="5" fill="#4ade80" transform="rotate(-20 18 12)"/></svg>
                </h1>

                <div class="mb-4">
                    <a href="{{ route('tentang') }}"
                       class="inline-flex items-center gap-2 bg-yellow-400 hover:bg-yellow-300 text-yellow-900 font-bold px-6 py-3 rounded-full shadow-lg transition-all hover:-translate-y-0.5 text-sm">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        Pesona Kota Subang →
                    </a>
                </div>

                <div class="flex items-center gap-2 text-white/70 text-xs">
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    <span>Pesona Alam Subang</span>
                    <div class="flex-1 h-px bg-white/30 ml-1"></div>
                </div>
            </div>

            {{-- KANAN: kosong — foto sudah jadi background penuh --}}
            <div class="hidden lg:flex items-center justify-end py-6">
                <div class="text-right">
                    <p class="text-white font-black text-2xl leading-snug drop-shadow-lg">Alamnya Indah</p>
                    <p class="text-yellow-300 font-black text-2xl leading-snug drop-shadow-lg">Budayanya Kaya</p>
                    <p class="text-white font-black text-2xl leading-snug drop-shadow-lg">Wisatanya Memikat</p>
                </div>
            </div>
        </div>
    </div>

    {{-- ── Dots slideshow + label SUBANG ── --}}
    <div class="relative z-20 px-6 pb-4 flex items-center justify-between">
        <div class="flex items-center gap-2 bg-black/30 backdrop-blur-sm px-4 py-2 rounded-full">
            <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
            <span class="text-white/80 text-xs font-medium">Pesona Alam Subang</span>
        </div>
        <div class="hidden lg:block">
            <div class="bg-white/80 backdrop-blur-sm text-green-800 font-black text-lg tracking-[0.5em] px-6 py-2 rounded-full shadow-xl border-b-4 border-green-600">
                SUBANG
            </div>
        </div>
        <div class="flex items-center gap-2">
            <template x-for="(s, i) in slides" :key="i">
                <button @click="current = i"
                        class="rounded-full transition-all duration-300"
                        :class="current === i ? 'w-7 h-2.5 bg-yellow-400' : 'w-2.5 h-2.5 bg-white/50 hover:bg-white/80'">
                </button>
            </template>
        </div>
    </div>

    {{-- ── 4 Tombol di bawah ── --}}
    <div class="relative z-20 border-t border-white/20 bg-black/30 backdrop-blur-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex flex-wrap justify-center gap-3">

            {{-- Sejarah & Budaya — putih + border --}}
            <a href="{{ route('tentang') }}"
               class="flex items-center gap-2.5 bg-white hover:bg-gray-50 text-gray-800 font-bold px-5 py-2.5 rounded-full shadow-sm transition-all hover:-translate-y-0.5 text-sm border-2 border-gray-200">
                <span class="w-7 h-7 bg-green-100 rounded-full flex items-center justify-center">
                    <svg class="w-4 h-4 text-green-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                </span>
                Sejarah & Budaya →
            </a>

            {{-- Wisata & Kuliner — hijau --}}
            <a href="{{ route('wisata') }}"
               class="flex items-center gap-2.5 bg-green-700 hover:bg-green-600 text-white font-bold px-5 py-2.5 rounded-full shadow-sm transition-all hover:-translate-y-0.5 text-sm">
                <span class="w-7 h-7 bg-white/20 rounded-full flex items-center justify-center">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 11l19-9-9 19-2-8-8-2z"/></svg>
                </span>
                Wisata & Kuliner →
            </a>

            {{-- Laporan — ungu --}}
            <a href="{{ route('laporan.publik') }}"
               class="flex items-center gap-2.5 bg-purple-600 hover:bg-purple-500 text-white font-bold px-5 py-2.5 rounded-full shadow-sm transition-all hover:-translate-y-0.5 text-sm">
                <span class="w-7 h-7 bg-white/20 rounded-full flex items-center justify-center">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><rect x="8" y="2" width="8" height="4" rx="1"/><line x1="9" y1="12" x2="15" y2="12"/><line x1="9" y1="16" x2="15" y2="16"/></svg>
                </span>
                Laporan →
            </a>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════
     BANNER SUBANG
══════════════════════════════════════════════ --}}
<section class="relative overflow-hidden py-8">
    <img src="{{ asset('images/bc3.jpeg') }}?v=20260920" alt="Pesona Kabupaten Subang" class="absolute inset-0 h-full w-full object-cover">
    <div class="absolute inset-0 bg-black/55"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row items-center justify-between gap-8">
            <div class="text-center lg:text-left">
                <p class="text-white font-black text-2xl italic leading-none mb-1">
                    <span class="text-yellow-300">Subang</span>
                </p>
                <p class="text-white text-lg font-bold">Kota dengan sejuta pesona</p>
                <p class="text-white/80 text-sm mt-2 max-w-md leading-relaxed">
                    Dari keindahan alam, kekayaan budaya, hingga kuliner khas yang menggugah selera, semua ada di Subang.
                </p>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-5">
                @foreach([
                    ['icon'=>'🏔️','label'=>'Alam yang Indah'],
                    ['icon'=>'🎭','label'=>'Budaya yang Kaya'],
                    ['icon'=>'🍍','label'=>'Hasil Bumi Melimpah'],
                    ['icon'=>'👥','label'=>'Masyarakat Ramah'],
                ] as $item)
                <div class="text-center min-w-[90px]">
                    <div class="text-3xl mb-2">{{ $item['icon'] }}</div>
                    <p class="text-white font-bold text-xs leading-snug">{{ $item['label'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════
     MENGENAL SUBANG
══════════════════════════════════════════════ --}}
<section class="bg-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center max-w-2xl mx-auto mb-14">
            <p class="text-green-600 text-xs font-bold uppercase tracking-widest mb-2">Profil daerah</p>
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-5">Mengenal Kabupaten Subang</h2>
            <p class="text-gray-500 text-sm leading-relaxed">
                Kabupaten Subang di Provinsi Jawa Barat memiliki jejak sejarah panjang, mulai dari permukiman
                masa prasejarah, pengaruh kerajaan Sunda dan penyebaran Islam, hingga masa kolonial ketika
                sebagian besar lahannya dikelola sebagai kawasan perkebunan karet dan teh oleh perusahaan
                Belanda Pamanoekan en Tjiasemlanden (P&amp;T Lands). Warisan itulah yang membentuk Subang
                menjadi daerah agraris dengan hasil bumi melimpah seperti sekarang.
            </p>
            <a href="/tentang"
               class="inline-flex items-center gap-1.5 text-sm font-semibold text-green-600 hover:text-green-700 mt-5">
                Baca profil lengkap Subang
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach([
                [
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>',
                    'title' => 'Sejarah singkat',
                    'desc'  => 'Jejak permukiman di Subang sudah ada sejak masa prasejarah, dibuktikan temuan kapak batu neolitikum di Binong, Kalijati, dan Sagalaherang. Wilayah ini kemudian menjadi bagian kekuasaan kerajaan Sunda sebelum berkembang menjadi kawasan perkebunan pada masa kolonial Belanda.',
                ],
                [
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>',
                    'title' => 'Suku dan bahasa',
                    'desc'  => 'Mayoritas warga Subang berasal dari suku Sunda dengan bahasa Sunda sebagai bahasa keseharian, sementara sebagian wilayah pesisir utara menggunakan dialek Jawa Cirebon akibat percampuran budaya sejak masa kerajaan Mataram.',
                ],
                [
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19V6l12-2v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2z"/>',
                    'title' => 'Kesenian Sisingaan',
                    'desc'  => 'Sisingaan adalah kesenian khas Subang berupa boneka berbentuk singa yang diarak dan ditunggangi anak-anak, biasa ditampilkan pada perayaan khitanan, hari kemerdekaan, dan acara adat lainnya.',
                ],
                [
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 21c-4-2-7-6-7-10a7 7 0 0114 0c0 4-3 8-7 10z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 11v6"/>',
                    'title' => 'Kota Nanas',
                    'desc'  => 'Nanas madu menjadi komoditas unggulan Subang dan mudah ditemui di sepanjang jalur Jalancagak. Selain dijual segar, nanas juga diolah menjadi dodol dan keripik sebagai oleh-oleh khas daerah.',
                ],
                [
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 20l6-10 4 6 3-4 5 8H3z"/>',
                    'title' => 'Wisata alam',
                    'desc'  => 'Berdekatan dengan kaki Gunung Tangkuban Parahu, Subang memiliki kawasan wisata alam seperti pemandian air panas Ciater, hamparan kebun teh, dan garis pantai di pesisir utara seperti Pamanukan dan Blanakan.',
                ],
                [
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>',
                    'title' => 'Wilayah administratif',
                    'desc'  => 'Kabupaten Subang terbagi ke dalam 30 kecamatan dengan Kota Subang sebagai ibu kota, berbatasan dengan Indramayu di utara, Sumedang di timur, Bandung Barat dan Purwakarta di selatan, serta Karawang di barat.',
                ],
            ] as $item)
            <div class="group relative flex h-full flex-col overflow-hidden rounded-2xl border border-gray-200 bg-white p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:border-green-200 hover:shadow-xl">
                <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-green-500 via-emerald-400 to-yellow-300"></div>
                <div class="mb-5 flex items-start justify-between">
                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-green-50 text-green-700 ring-8 ring-green-50/60">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            {!! $item['icon'] !!}
                        </svg>
                    </div>
                    <span class="text-xs font-black tracking-widest text-gray-300">0{{ $loop->iteration }}</span>
                </div>
                <h3 class="mb-3 text-base font-extrabold text-gray-900 transition-colors group-hover:text-green-700">{{ $item['title'] }}</h3>
                <p class="flex-1 text-sm leading-6 text-gray-500">{{ $item['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══ APP SAPASUBANG ══ --}}
<section class="bg-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div>
                <p class="text-green-600 text-xs font-bold uppercase tracking-widest mb-3">Platform Digital</p>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 leading-snug mb-5">
                    SAPAsubang<br><span class="text-green-700">#BikinSubangLebihBaik</span>
                </h2>
                <p class="text-gray-600 leading-relaxed mb-8">Platform pelaporan masalah fasilitas umum Kota Subang. Mudah, cepat, dan langsung ditindaklanjuti petugas.</p>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('laporan.publik') }}" class="inline-flex items-center gap-2 bg-green-700 hover:bg-green-600 text-white font-bold px-6 py-3 rounded-xl text-sm shadow-md transition-all">Mulai Melapor →</a>
                    <a href="{{ route('panduan') }}" class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-6 py-3 rounded-xl text-sm transition-all">Lihat Panduan</a>
                </div>
            </div>
            <div class="relative flex justify-center">
                <div class="bg-gray-900 rounded-[2.5rem] p-3 shadow-2xl w-60">
                    <div class="bg-white rounded-[2rem] overflow-hidden" style="height:460px;">
                        <div class="bg-green-700 px-3 py-2 flex items-center gap-1.5">
                            <div class="flex gap-1"><div class="w-2 h-2 rounded-full bg-red-400"></div><div class="w-2 h-2 rounded-full bg-yellow-400"></div><div class="w-2 h-2 rounded-full bg-green-400"></div></div>
                            <div class="flex-1 bg-white/20 rounded text-center text-[8px] text-white/80 py-0.5">sapasubang.go.id</div>
                        </div>
                        <div class="p-3 space-y-2.5">
                            <div class="bg-green-600 text-white text-xs font-bold px-3 py-2 rounded-xl text-center">📝 Buat Laporan Sekarang</div>
                            <div class="text-[10px] font-bold text-gray-700">Laporan Terbaru</div>
                            @foreach($laporanTerbaru->take(4) as $r)
                            <div class="flex gap-2 bg-gray-50 rounded-xl p-2 border border-gray-100">
                                <div class="w-9 h-9 bg-gray-200 rounded-lg flex items-center justify-center text-base flex-shrink-0">{{ $r->category->icon ?? '📋' }}</div>
                                <div class="flex-1 min-w-0">
                                    <div class="text-[9px] font-semibold text-gray-700 line-clamp-1">{{ Str::limit($r->deskripsi,28) }}</div>
                                    <div class="text-[8px] text-green-600 mt-0.5">{{ $r->category->nama_kategori }}</div>
                                    <div class="text-[7px] text-gray-400">{{ $r->created_at->diffForHumans() }}</div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="absolute -top-4 -right-4 bg-yellow-400 text-yellow-900 font-black text-sm px-4 py-2 rounded-2xl shadow-xl rotate-3">
                    {{ number_format($stats['total']) }}+ Laporan
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══ 4 PRINSIP ══ --}}
<section class="bg-green-700 py-20 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10"><svg width="100%" height="100%"><defs><pattern id="dots" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse"><circle cx="15" cy="15" r="1.8" fill="white"/></pattern></defs><rect width="100%" height="100%" fill="url(#dots)"/></svg></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <p class="text-green-200 text-xs font-bold uppercase tracking-widest mb-3">Komitmen Kami</p>
            <h2 class="text-3xl font-extrabold text-white mb-3">Mewujudkan Subang Cerdas & Berkelanjutan</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach([
                ['🤝','Smart Synergy','Sinergi warga, pemerintah, dan teknologi untuk kemajuan Kota Subang.'],
                ['📱','Mobile First','Layanan mudah diakses dari smartphone untuk semua warga.'],
                ['📊','Data Driven','Kebijakan berbasis data laporan warga yang akurat dan real-time.'],
                ['🌐','Digital Xperience','Pengalaman digital inklusif untuk semua lapisan masyarakat.'],
            ] as [$ic,$t,$d])
            <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-6 hover:bg-white/20 transition-all text-center group">
                <div class="text-4xl mb-4 group-hover:scale-110 transition-transform duration-300">{{ $ic }}</div>
                <h3 class="font-bold text-white text-base mb-2">{{ $t }}</h3>
                <p class="text-green-100/80 text-sm leading-relaxed">{{ $d }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══ LAPORAN MASYARAKAT ══ --}}
<section class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-end justify-between mb-10">
            <div>
                <p class="text-green-600 text-xs font-bold uppercase tracking-widest mb-2">Dari Warga Subang</p>
                <h2 class="text-3xl font-extrabold text-gray-900">Laporan Masyarakat</h2>
            </div>
            <a href="{{ route('laporan.publik') }}" class="text-sm font-semibold text-green-700 hover:underline hidden sm:block">Lihat Semua →</a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($laporanTerbaru as $r)
            <div class="bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-lg transition-all">
                <div class="h-44 bg-gray-100 relative overflow-hidden flex flex-col items-center justify-center">
                    @if(!str_starts_with($r->foto_sebelum,'demo/') && Storage::disk('public')->exists($r->foto_sebelum))
                        <img src="{{ Storage::url($r->foto_sebelum) }}" class="w-full h-full object-cover">
                    @else
                        <span class="text-5xl mb-1">{{ $r->category->icon ?? '📋' }}</span>
                        <span class="text-xs text-gray-400">Slot Foto Laporan</span>
                    @endif
                    <div class="absolute top-2 right-2">@include('components.status-badge',['status'=>$r->status])</div>
                </div>
                <div class="p-4">
                    <span class="text-xs font-bold text-green-700 bg-green-50 px-2.5 py-0.5 rounded-full">{{ $r->category->nama_kategori }}</span>
                    <p class="font-semibold text-gray-800 text-sm mt-2 line-clamp-2 leading-snug">{{ $r->deskripsi }}</p>
                    <div class="flex items-center justify-between mt-3 pt-3 border-t border-gray-50 text-xs text-gray-400">
                        <span>📍 Subang</span>
                        <span>👍 {{ $r->supports_count }}</span>
                        <span>{{ $r->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══ CARA KERJA ══ --}}
<section class="bg-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <p class="text-green-600 text-xs font-bold uppercase tracking-widest mb-2">Mudah & Cepat</p>
            <h2 class="text-3xl font-extrabold text-gray-900">Cara Kerja SAPAsubang</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 relative">
            <div class="hidden lg:block absolute top-9 left-[12.5%] right-[12.5%] h-0.5 bg-green-100"></div>
            @foreach([
                ['01','📷','Foto & Laporkan','Foto masalah, GPS ambil lokasi, pilih kategori, kirim.'],
                ['02','✅','Verifikasi Admin','Admin periksa dan tentukan prioritas penanganan.'],
                ['03','👷','Petugas Ditugaskan','Petugas terdekat ditugaskan menuju lokasi.'],
                ['04','🔔','Selesai & Notifikasi','Bukti dikirim, admin konfirmasi, Anda dapat notifikasi.'],
            ] as [$n,$ic,$t,$d])
            <div class="text-center relative z-10">
                <div class="w-18 h-18 bg-green-50 border-2 border-green-200 rounded-2xl flex items-center justify-center text-3xl mx-auto mb-4 shadow-sm w-20 h-20">{{ $ic }}</div>
                <div class="text-xs font-black text-green-500 mb-2 tracking-widest">{{ $n }}</div>
                <h3 class="font-bold text-gray-800 mb-2 text-sm">{{ $t }}</h3>
                <p class="text-xs text-gray-500 leading-relaxed max-w-[170px] mx-auto">{{ $d }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══ KOLABORASI ══ --}}
<section class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-green-700 rounded-3xl overflow-hidden relative">
            <div class="absolute inset-0 opacity-10"><svg width="100%" height="100%"><defs><pattern id="dots2" x="0" y="0" width="25" height="25" patternUnits="userSpaceOnUse"><circle cx="12" cy="12" r="1.5" fill="white"/></pattern></defs><rect width="100%" height="100%" fill="url(#dots2)"/></svg></div>
            <div class="relative grid grid-cols-1 lg:grid-cols-2 gap-8 p-10 lg:p-14 items-center">
                <div>
                    <h2 class="text-3xl font-extrabold text-white leading-snug mb-4">Mari bersama mewujudkan Subang yang lebih baik!</h2>
                    <p class="text-green-100/80 leading-relaxed mb-8 text-sm">Setiap laporan Anda berkontribusi langsung pada perbaikan kota. Bergabunglah dengan warga Subang yang sudah peduli.</p>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('register') }}" class="inline-flex items-center gap-2 bg-yellow-400 hover:bg-yellow-300 text-yellow-900 font-bold px-6 py-3 rounded-xl text-sm transition-all">Daftar Sekarang — Gratis</a>
                        <a href="{{ route('laporan.publik') }}" class="inline-flex items-center gap-2 bg-white/20 hover:bg-white/30 border border-white/30 text-white font-semibold px-6 py-3 rounded-xl text-sm transition-all">Lihat Laporan</a>
                    </div>
                </div>

                {{-- Foto ilustrasi Kota Subang (ganti src bila punya foto sendiri) --}}
                <div class="flex justify-center">
                    <div class="w-full max-w-sm aspect-[3/2] rounded-2xl overflow-hidden border border-white/30 shadow-2xl relative group">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTsMR8vC4vTDz0n5C_RfzsPBcSt_SW12uM71KkzKouAQA&s=10"
                             alt="Ilustrasi Kota Subang"
                             loading="lazy"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>
                        <p class="absolute bottom-3 left-4 text-white text-xs font-semibold drop-shadow">📍 Kabupaten Subang</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══ VIDEO ══ --}}
<section class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <p class="text-green-600 text-xs font-bold uppercase tracking-widest mb-2">Kenali Lebih Dekat</p>
            <h2 class="text-3xl font-extrabold text-gray-900">Video Profil Kota Subang</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
            @foreach([
                [
                    'judul' => 'Profil Kota Subang',
                    'sub'   => 'Mengenal keindahan dan potensi Kota Subang',
                    'yt'    => 'U0rZBBV5yBY',
                ],
                [
                    'judul' => 'Festival Budaya Subang',
                    'sub'   => 'Kekayaan budaya dan tradisi masyarakat Sunda',
                    'yt'    => 'rCdrXxlmeRY',
                ],
                [
                    'judul' => 'Wisata Alam Subang',
                    'sub'   => 'Destinasi alam yang memukau di Kabupaten Subang',
                    'yt'    => 'LU4NVgfuOms',
                ],
            ] as $v)
            <a href="https://www.youtube.com/watch?v={{ $v['yt'] }}"
               target="_blank" rel="noopener noreferrer"
               class="group relative bg-gray-900 rounded-2xl overflow-hidden aspect-video block hover:shadow-2xl transition-all">

                {{-- Latar hijau, tampil bila thumbnail gagal dimuat --}}
                <div class="absolute inset-0 bg-gradient-to-br from-green-900 to-green-700 flex items-center justify-center">
                    <span class="text-6xl opacity-20">🎬</span>
                </div>

                {{-- Thumbnail otomatis dari YouTube --}}
                <img src="https://img.youtube.com/vi/{{ $v['yt'] }}/hqdefault.jpg"
                     alt="{{ $v['judul'] }}"
                     loading="lazy"
                     onerror="this.style.display='none'"
                     class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

                <div class="absolute inset-0 bg-black/40 group-hover:bg-black/25 transition-colors"></div>

                {{-- Tombol play --}}
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="w-14 h-14 bg-white/90 group-hover:bg-white rounded-full flex items-center justify-center shadow-2xl transition-all group-hover:scale-110">
                        <svg class="w-6 h-6 text-green-700 ml-1" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                        </svg>
                    </div>
                </div>

                {{-- Judul --}}
                <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/80 to-transparent">
                    <p class="text-white font-bold text-sm">{{ $v['judul'] }}</p>
                    <p class="text-white/70 text-xs mt-0.5">{{ $v['sub'] }}</p>
                    <span class="inline-flex items-center gap-1 text-[11px] font-semibold text-yellow-300 mt-1.5">
                        ▶ Tonton di YouTube
                    </span>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

{{-- ══ FOOTER CTA ══ --}}
<section class="bg-gray-900 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="flex justify-center mb-5">
            <div class="w-14 h-14 bg-green-700 rounded-2xl flex items-center justify-center shadow-lg">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQI0C7APY1RPu0BH5O4dpR3vVgHiZuHWxEYmLiaDN4HXQ&s=10"
                     alt="Logo Subang"
                     class="w-11 h-11 object-contain">
            </div>
        </div>
        <h2 class="text-2xl font-extrabold text-white mb-2">SAPAsubang</h2>
        <p class="text-gray-400 text-sm mb-8 max-w-md mx-auto">Sistem Aduan & Pelaporan Aspirasi Subang</p>
        <div class="flex flex-wrap justify-center gap-3 mb-10">
            <a href="{{ route('laporan.publik') }}" class="bg-green-600 hover:bg-green-500 text-white font-bold px-5 py-2.5 rounded-xl text-sm transition-colors">Buat Laporan</a>
            <a href="{{ route('tentang') }}"         class="bg-gray-800 hover:bg-gray-700 text-white font-semibold px-5 py-2.5 rounded-xl text-sm border border-gray-700 transition-colors">Tentang Subang</a>
            <a href="{{ route('panduan') }}"         class="bg-gray-800 hover:bg-gray-700 text-white font-semibold px-5 py-2.5 rounded-xl text-sm border border-gray-700 transition-colors">Panduan</a>
        </div>
    </div>
</section>

@endsection