@extends('layouts.app')
@section('title', 'Beranda')

@section('content')

{{-- ══════════════════════════════════════════════
     HERO — SLIDESHOW FOTO PENUH (seperti JSC)
══════════════════════════════════════════════ --}}
<section class="relative overflow-hidden bg-black" style="height:calc(100vh - 64px);"
         x-data="{
            current: 0,
            slides: [
                { src: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQPw4z3g1Fb0oG-zczgHXoxUUzN5Q9wP-HSwS7N6wIyXQ&s=10', label: 'Pesona Alam Subang' },
                { src: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSTo2X6gO9m-47elRPW_U46mccEbjWipwMa6UGTemwAgw&s=10', label: 'Keindahan Alam Pegunungan' },
                { src: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS-ZExt61gJFfpezP8C3I-sMGBQpctgJJw7UQjwUBE4nQ&s=10', label: 'Pantai Pondok Bali' },
                { src: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR7kcwCaqrVr-lw0UnyHYd_3lY-ew0cPWkdE-brRMDp7w&s=10', label: 'Agrowisata Subang' },
                { src: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ_trxgJNYWnyv4sqJdj1mcU-ZZCQr06Wmt0UVC5L1KfQ&s=10', label: 'Budaya & Tradisi Subang' },
            ],
            init() {
                setInterval(() => { this.current = (this.current + 1) % this.slides.length }, 4500)
            }
         }"
         x-init="init()">

    {{-- ── Slides ── --}}
    <template x-for="(slide, i) in slides" :key="i">
        <div class="absolute inset-0 transition-opacity duration-1000"
             :class="current === i ? 'opacity-100' : 'opacity-0'">
            <img :src="slide.src" alt="" class="w-full h-full object-cover scale-105"
                 style="animation: kenburns 8s ease-in-out infinite alternate;"
                 :style="current === i ? 'transform:scale(1.08)' : 'transform:scale(1)'">
        </div>
    </template>

    {{-- Overlay gradien --}}
    <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/40 to-transparent"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-black/20"></div>

    {{-- ── Daun kiri ── --}}
    <div class="absolute left-0 top-0 bottom-0 w-40 pointer-events-none select-none z-10">
        <svg viewBox="0 0 160 700" class="w-full h-full">
            <ellipse cx="15"  cy="80"  rx="65" ry="95"  fill="#15803d" transform="rotate(-22 15 80)"   opacity=".9"/>
            <ellipse cx="8"   cy="250" rx="52" ry="80"  fill="#16a34a" transform="rotate(16 8 250)"    opacity=".75"/>
            <ellipse cx="35"  cy="430" rx="58" ry="88"  fill="#14532d" transform="rotate(-14 35 430)"  opacity=".85"/>
            <ellipse cx="10"  cy="590" rx="45" ry="68"  fill="#15803d" transform="rotate(20 10 590)"   opacity=".70"/>
            <ellipse cx="25"  cy="700" rx="40" ry="55"  fill="#166534" transform="rotate(-8 25 700)"   opacity=".65"/>
            {{-- Bunga kecil --}}
            <circle cx="55" cy="620" r="12" fill="white" opacity=".6"/>
            <circle cx="55" cy="620" r="6"  fill="#fde68a" opacity=".8"/>
        </svg>
    </div>

    {{-- ── Daun kanan ── --}}
    <div class="absolute right-0 top-0 bottom-0 w-36 pointer-events-none select-none z-10">
        <svg viewBox="0 0 145 700" class="w-full h-full">
            <ellipse cx="130" cy="100" rx="60" ry="90"  fill="#15803d" transform="rotate(26 130 100)"  opacity=".85"/>
            <ellipse cx="140" cy="280" rx="48" ry="75"  fill="#16a34a" transform="rotate(-20 140 280)" opacity=".75"/>
            <ellipse cx="120" cy="470" rx="55" ry="82"  fill="#14532d" transform="rotate(18 120 470)"  opacity=".80"/>
            <ellipse cx="135" cy="640" rx="42" ry="62"  fill="#166534" transform="rotate(-12 135 640)" opacity=".65"/>
            {{-- Daun kecil --}}
            <ellipse cx="100" cy="200" rx="28" ry="42"  fill="#4ade80" transform="rotate(-30 100 200)" opacity=".5"/>
        </svg>
    </div>

    {{-- ── Konten utama ── --}}
    <div class="relative z-20 flex flex-col h-full">

        {{-- Label kanan atas --}}
        <div class="absolute top-8 right-20 hidden lg:block text-right">
            <p class="text-white font-black text-xl leading-snug"
               style="text-shadow:2px 2px 8px rgba(0,0,0,.9);">Alamnya Indah</p>
            <p class="text-yellow-300 font-black text-xl leading-snug"
               style="text-shadow:2px 2px 8px rgba(0,0,0,.9);">Budayanya Kaya</p>
            <p class="text-white font-black text-xl leading-snug"
               style="text-shadow:2px 2px 8px rgba(0,0,0,.9);">Wisatanya Memikat</p>
            {{-- Daun kecil dekorasi --}}
            <div class="mt-1 flex justify-end">
                <svg viewBox="0 0 40 30" class="w-10 h-8">
                    <ellipse cx="20" cy="15" rx="18" ry="12" fill="#4ade80" transform="rotate(-20 20 15)" opacity=".8"/>
                </svg>
            </div>
        </div>

        {{-- Teks hero kiri tengah --}}
        <div class="flex-1 flex items-center px-8 sm:px-14 lg:px-20">
            <div class="max-w-2xl">
                <p class="text-yellow-300 font-bold text-xl italic mb-2 drop-shadow-lg"
                   style="text-shadow:1px 1px 8px rgba(0,0,0,.8);">
                    Selamat Datang di
                </p>
                <h1 class="font-black text-white leading-none mb-4"
                    style="font-size:clamp(3.5rem,9vw,7rem);text-shadow:3px 3px 16px rgba(0,0,0,.9);font-family:'Plus Jakarta Sans',sans-serif;">
                    Kota Subang
                </h1>
                {{-- Badge kuning --}}
                <div class="inline-flex items-center bg-yellow-400 text-yellow-900 font-black px-5 py-2 rounded-full text-sm mb-8 shadow-2xl">
                    🌿 Pesona Kota Subang
                </div>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('tentang') }}"
                       class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-md hover:bg-white/30 text-white font-bold px-6 py-3.5 rounded-full border border-white/40 transition-all shadow-xl text-sm">
                        Jelajahi Sekarang →
                    </a>
                    <a href="{{ route('laporan.publik') }}"
                       class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-500 text-white font-bold px-6 py-3.5 rounded-full transition-all shadow-xl text-sm">
                        📝 Buat Laporan
                    </a>
                </div>
            </div>
        </div>

        {{-- Label SUBANG tengah atas --}}
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-8 hidden lg:block pointer-events-none">
            <div class="bg-white/80 backdrop-blur-md text-green-800 font-black text-xl tracking-[0.6em] px-8 py-2.5 rounded-full shadow-2xl border-b-4 border-green-600">
                SUBANG
            </div>
        </div>

        {{-- ── 4 Tombol kategori ── --}}
        <div class="px-4 pb-5 flex flex-wrap justify-center gap-3">
            <a href="{{ route('tentang') }}"
               class="flex items-center gap-2.5 bg-green-700/90 hover:bg-green-600 backdrop-blur-md text-white font-bold px-5 py-2.5 rounded-full shadow-2xl transition-all hover:-translate-y-1 text-sm border border-green-500/60">
                <span class="w-7 h-7 bg-white/20 rounded-full flex items-center justify-center">🏛️</span>Sejarah & Budaya
            </a>
            <a href="{{ route('wisata') }}"
               class="flex items-center gap-2.5 bg-blue-700/90 hover:bg-blue-600 backdrop-blur-md text-white font-bold px-5 py-2.5 rounded-full shadow-2xl transition-all hover:-translate-y-1 text-sm border border-blue-500/60">
                <span class="w-7 h-7 bg-white/20 rounded-full flex items-center justify-center">🏔️</span>Wisata & Kuliner
            </a>
            <a href="{{ route('berita') }}"
               class="flex items-center gap-2.5 backdrop-blur-md text-white font-bold px-5 py-2.5 rounded-full shadow-2xl transition-all hover:-translate-y-1 text-sm border border-orange-400/60"
               style="background:rgba(234,88,12,0.9);">
                <span class="w-7 h-7 bg-white/20 rounded-full flex items-center justify-center">📰</span>Berita
            </a>
            <a href="{{ route('laporan.publik') }}"
               class="flex items-center gap-2.5 bg-purple-700/90 hover:bg-purple-600 backdrop-blur-md text-white font-bold px-5 py-2.5 rounded-full shadow-2xl transition-all hover:-translate-y-1 text-sm border border-purple-500/60">
                <span class="w-7 h-7 bg-white/20 rounded-full flex items-center justify-center">📋</span>Laporan
            </a>
        </div>

        {{-- ── Slideshow dots + label ── --}}
        <div class="px-4 pb-4 flex items-center justify-between">
            {{-- Label slide aktif --}}
            <div class="flex items-center gap-2 bg-black/30 backdrop-blur-sm px-4 py-2 rounded-full">
                <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                <span class="text-white/80 text-xs font-medium" x-text="slides[current].label"></span>
            </div>
            {{-- Dots navigasi --}}
            <div class="flex items-center gap-2">
                <template x-for="(s, i) in slides" :key="i">
                    <button @click="current = i"
                            class="transition-all duration-300 rounded-full"
                            :class="current === i ? 'w-8 h-2.5 bg-yellow-400' : 'w-2.5 h-2.5 bg-white/40 hover:bg-white/70'">
                    </button>
                </template>
            </div>
            {{-- Navigasi panah --}}
            <div class="flex gap-2">
                <button @click="current = (current - 1 + slides.length) % slides.length"
                        class="w-9 h-9 bg-white/20 backdrop-blur-sm hover:bg-white/40 text-white rounded-full flex items-center justify-center transition-all border border-white/30">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button @click="current = (current + 1) % slides.length"
                        class="w-9 h-9 bg-white/20 backdrop-blur-sm hover:bg-white/40 text-white rounded-full flex items-center justify-center transition-all border border-white/30">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>

        {{-- ── Banner "Subang Kota dengan sejuta pesona" ── --}}
        <div class="bg-gradient-to-r from-green-900/95 via-green-800/95 to-green-900/95 backdrop-blur-sm py-3.5 px-8 flex items-center justify-between border-t border-green-700/50">
            <div class="flex items-center gap-3">
                <div class="w-0.5 h-10 bg-yellow-400 rounded-full"></div>
                <div>
                    <p class="text-white font-black text-lg italic leading-none" style="font-family:'Plus Jakarta Sans',sans-serif;">Subang</p>
                    <p class="text-yellow-300 text-xs font-semibold italic mt-0.5">Kota dengan sejuta pesona 🌿</p>
                </div>
            </div>
            {{-- Foto polaroid --}}
            <div class="hidden lg:flex gap-3 items-center">
                @foreach(['🌊','🏔️','🎭','🍍'] as $ic)
                <div class="bg-white p-1.5 rounded-xl shadow-2xl rotate-1 hover:rotate-0 hover:-translate-y-1 transition-all cursor-pointer">
                    <div class="w-14 h-12 bg-gray-200 rounded-lg flex items-center justify-center text-xl">{{ $ic }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ══ STATS ══ --}}
<section class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5">
        <div class="grid grid-cols-2 sm:grid-cols-4 divide-x divide-gray-100 text-center">
            @foreach([
                ['val'=>$stats['total'],  'lbl'=>'Total Laporan',  'icon'=>'📋','clr'=>'text-green-700'],
                ['val'=>$stats['selesai'],'lbl'=>'Terselesaikan',  'icon'=>'✅','clr'=>'text-green-600'],
                ['val'=>$stats['proses'], 'lbl'=>'Dalam Proses',   'icon'=>'⏳','clr'=>'text-orange-500'],
                ['val'=>$stats['pelapor'],'lbl'=>'Warga Terdaftar','icon'=>'👥','clr'=>'text-blue-600'],
            ] as $s)
            <div class="py-4 px-2">
                <div class="text-xl mb-0.5">{{ $s['icon'] }}</div>
                <div class="text-2xl font-extrabold {{ $s['clr'] }}">{{ number_format($s['val']) }}</div>
                <div class="text-xs text-gray-500 mt-0.5">{{ $s['lbl'] }}</div>
            </div>
            @endforeach
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

        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-14">
            <div class="col-span-2 sm:col-span-2 rounded-2xl overflow-hidden bg-gray-100 h-56 sm:h-64">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTsMR8vC4vTDz0n5C_RfzsPBcSt_SW12uM71KkzKouAQA&s=10"
                     alt="Pemandangan Kabupaten Subang" class="w-full h-full object-cover">
            </div>
            <div class="rounded-2xl overflow-hidden bg-gray-100 h-56 sm:h-64">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQfj-K8VW0volXC3X79Qbz2S064uUHXZ12V_JB5gU3tqQ&s=10"
                     alt="Alam Subang" class="w-full h-full object-cover">
            </div>
            <div class="rounded-2xl overflow-hidden bg-gray-100 h-56 sm:h-64">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQnU0GIu_ZXgVZgky3RGLt20QGnf8_sahLCVqThM1sjHA&s=10"
                     alt="Sawah di Subang" class="w-full h-full object-cover">
            </div>
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
            <div class="p-6 rounded-2xl border border-gray-100 hover:border-green-200 hover:shadow-md transition-all">
                <div class="w-11 h-11 bg-green-50 border border-green-100 rounded-xl flex items-center justify-center text-green-600 mb-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        {!! $item['icon'] !!}
                    </svg>
                </div>
                <h3 class="text-sm font-semibold text-gray-800 mb-2">{{ $item['title'] }}</h3>
                <p class="text-xs text-gray-500 leading-relaxed">{{ $item['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══ DESTINASI UNGGULAN ══ --}}
<section class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-8">
            <div>
                <div class="flex items-center gap-2 mb-2"><div class="w-8 h-0.5 bg-yellow-400"></div><span class="text-yellow-600 text-xs font-bold uppercase tracking-widest">Destinasi Unggulan</span></div>
                <h2 class="text-2xl font-extrabold text-gray-900">Jelajahi Keindahan Subang</h2>
            </div>
            <a href="{{ route('wisata') }}" class="text-sm font-semibold text-green-700 hover:text-green-800">Lihat Semua →</a>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach([
                ['nama'=>'Curug Cileat',      'cat'=>'Wisata Alam',    'foto'=>'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQPw4z3g1Fb0oG-zczgHXoxUUzN5Q9wP-HSwS7N6wIyXQ&s=10'],
                ['nama'=>'Kebun Teh Ciater',  'cat'=>'Agrowisata',     'foto'=>'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR7kcwCaqrVr-lw0UnyHYd_3lY-ew0cPWkdE-brRMDp7w&s=10'],
                ['nama'=>'Pantai Pondok Bali','cat'=>'Wisata Pantai',  'foto'=>'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS-ZExt61gJFfpezP8C3I-sMGBQpctgJJw7UQjwUBE4nQ&s=10'],
                ['nama'=>'Museum Subang',     'cat'=>'Wisata Sejarah', 'foto'=>'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTm8JOfJGlMxzxhWZzQNx5eTurqVAfaYesDRh2WXSQCaA&s=10'],
            ] as $d)
            <div class="group relative rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all hover:-translate-y-1 aspect-[3/4]">
                <img src="{{ $d['foto'] }}"
                     alt="{{ $d['nama'] }}"
                     loading="lazy"
                     class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                <div class="absolute bottom-0 left-0 right-0 p-4">
                    <div class="flex items-center gap-1.5 mb-1">
                        <div class="w-5 h-5 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        </div>
                        <span class="text-white font-bold text-sm leading-none">{{ $d['nama'] }}</span>
                    </div>
                    <span class="text-white/70 text-xs">{{ $d['cat'] }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══ BANNER SUBANG ══ --}}
<section class="relative overflow-hidden bg-green-800 py-14">
    {{-- Slot foto background banner — ganti div ini dengan <img src="..." class="absolute inset-0 w-full h-full object-cover opacity-20"> --}}
    <div class="absolute inset-0 bg-gradient-to-r from-green-900/50 to-green-700/30 flex items-center justify-center opacity-30 pointer-events-none">
        <span class="text-white/20 text-8xl font-black tracking-widest select-none">SUBANG</span>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
            <div>
                <h2 class="text-3xl sm:text-4xl font-black text-white leading-tight mb-3 italic">
                    Subang<br><span class="text-yellow-300">Kota dengan sejuta pesona</span>
                </h2>
                <button class="flex items-center gap-3 bg-yellow-400 hover:bg-yellow-300 text-yellow-900 font-bold px-5 py-3 rounded-full transition-all text-sm mt-4">
                    <div class="w-8 h-8 bg-yellow-900/20 rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/></svg>
                    </div>
                    Tonton Video Profil
                </button>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                @foreach([
                    ['🏔️','Alam yang Indah','Gunung, air terjun, pantai, dan kebun teh'],
                    ['🎭','Budaya yang Kaya','Seni tradisional dan adat istiadat Sunda'],
                    ['🍍','Hasil Bumi Melimpah','Nanas, teh, dan perkebunan lainnya'],
                    ['👥','Masyarakat Ramah','Hidup berdampingan dengan budaya lokal'],
                ] as [$ic,$t,$d])
                <div class="text-center">
                    <div class="text-3xl mb-2">{{ $ic }}</div>
                    <div class="text-white font-bold text-xs mb-1">{{ $t }}</div>
                    <p class="text-green-200/70 text-[11px] leading-snug">{{ $d }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ══ BERITA TERBARU ══ --}}
<section class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-end justify-between mb-10">
            <div>
                <p class="text-green-600 text-xs font-bold uppercase tracking-widest mb-2">Informasi Terkini</p>
                <h2 class="text-3xl font-extrabold text-gray-900">Terbaru dari Subang</h2>
            </div>
            <a href="{{ route('berita') }}" class="text-sm font-semibold text-green-700 hover:underline hidden sm:block">Lihat lebih banyak →</a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($berita as $b)
            <a href="{{ route('berita.show',$b['slug']) }}"
               class="group bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <div class="aspect-video bg-gray-100 flex flex-col items-center justify-center gap-2 relative overflow-hidden">
                    <span class="text-5xl group-hover:scale-110 transition-transform duration-300">{{ $b['icon'] }}</span>
                    <span class="text-xs text-gray-400">Foto Berita 600×338px</span>
                    <div class="absolute top-3 left-3">
                        <span class="text-[11px] font-bold text-white px-2.5 py-1 rounded-full shadow"
                              style="background:{{ $b['warna'] ?? '#16a34a' }}">{{ $b['kategori'] }}</span>
                    </div>
                </div>
                <div class="p-5">
                    <div class="text-xs text-gray-400 mb-2">{{ $b['tanggal'] }}</div>
                    <h3 class="font-bold text-gray-800 text-sm leading-snug line-clamp-2 group-hover:text-green-700 transition-colors">{{ $b['judul'] }}</h3>
                    <p class="text-xs text-gray-500 mt-2 line-clamp-2 leading-relaxed">{{ $b['ringkasan'] }}</p>
                    <span class="mt-3 inline-block text-xs font-bold text-green-700 group-hover:underline">Baca Selengkapnya →</span>
                </div>
            </a>
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
            <a href="{{ route('berita') }}"          class="bg-gray-800 hover:bg-gray-700 text-white font-semibold px-5 py-2.5 rounded-xl text-sm border border-gray-700 transition-colors">Berita</a>
            <a href="{{ route('tentang') }}"         class="bg-gray-800 hover:bg-gray-700 text-white font-semibold px-5 py-2.5 rounded-xl text-sm border border-gray-700 transition-colors">Tentang Subang</a>
            <a href="{{ route('panduan') }}"         class="bg-gray-800 hover:bg-gray-700 text-white font-semibold px-5 py-2.5 rounded-xl text-sm border border-gray-700 transition-colors">Panduan</a>
        </div>
    </div>
</section>

@endsection