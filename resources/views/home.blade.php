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
                { src: 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=1600&q=85', label: 'Pesona Alam Subang' },
                { src: 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=1600&q=85', label: 'Keindahan Alam Pegunungan' },
                { src: 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=1600&q=85', label: 'Pantai Pondok Bali' },
                { src: 'https://images.unsplash.com/photo-1444492417251-9c84a5fa18e0?w=1600&q=85', label: 'Agrowisata Subang' },
                { src: 'https://images.unsplash.com/photo-1555400038-63f5ba517a47?w=1600&q=85', label: 'Budaya & Tradisi Subang' },
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
                <div class="flex justify-center">
                    <div class="w-72 h-48 bg-white/10 rounded-2xl border border-white/20 flex flex-col items-center justify-center gap-3">
                        <div class="text-6xl">🏙️</div>
                        <p class="text-white/50 text-xs text-center px-4">Slot Ilustrasi Kota Subang<br>800×533px</p>
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
                ['judul'=>'Profil Kota Subang',     'sub'=>'Mengenal keindahan dan potensi Kota Subang'],
                ['judul'=>'Festival Budaya Subang',  'sub'=>'Kekayaan budaya dan tradisi masyarakat Sunda'],
                ['judul'=>'Wisata Alam Subang',      'sub'=>'Destinasi alam yang memukau di Kabupaten Subang'],
            ] as $v)
            <div class="group relative bg-gray-900 rounded-2xl overflow-hidden aspect-video cursor-pointer hover:shadow-2xl transition-all">
                <div class="absolute inset-0 bg-gradient-to-br from-green-900 to-green-700 flex items-center justify-center">
                    <span class="text-6xl opacity-20">🎬</span>
                </div>
                <div class="absolute inset-0 bg-black/30 group-hover:bg-black/20 transition-colors"></div>
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="w-14 h-14 bg-white/90 group-hover:bg-white rounded-full flex items-center justify-center shadow-2xl transition-all group-hover:scale-110">
                        <svg class="w-6 h-6 text-green-700 ml-1" fill="currentColor" viewBox="0 0 20 20"><path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/></svg>
                    </div>
                </div>
                <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/70 to-transparent">
                    <p class="text-white font-bold text-sm">{{ $v['judul'] }}</p>
                    <p class="text-white/60 text-xs mt-0.5">{{ $v['sub'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══ FOOTER CTA ══ --}}
<section class="bg-gray-900 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="flex justify-center mb-5">
            <div class="w-14 h-14 bg-green-700 rounded-2xl flex items-center justify-center shadow-lg">
                <img src="{{ asset('images/logo-subang.png') }}" alt="Logo" class="w-11 h-11 object-contain"
                     onerror="this.parentElement.innerHTML='<svg viewBox=\'0 0 40 40\' class=\'w-10 h-10\'><circle cx=\'20\' cy=\'20\' r=\'18\' fill=\'white\'/><path d=\'M20 6 L22 14 L30 14 L24 19 L26 27 L20 22 L14 27 L16 19 L10 14 L18 14 Z\' fill=\'#16a34a\'/></svg>'">
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
