@extends('layouts.app')
@section('title', 'Beranda')

@section('content')

{{-- ══ HERO ══ --}}
<section class="relative overflow-hidden min-h-[420px] sm:min-h-[480px] lg:min-h-[560px]">
    {{-- Slot foto hero — ganti src dengan foto asli Anda --}}
    <div class="absolute inset-0">
        <div class="w-full h-full bg-gradient-to-br from-green-200 via-green-100 to-teal-100 flex items-center justify-center">
            {{-- PLACEHOLDER FOTO HERO --}}
            {{-- Ganti div di atas dengan: <img src="/images/hero-subang.jpg" alt="Kota Subang" class="w-full h-full object-cover"> --}}
            <div class="text-center text-green-400 select-none">
                <svg class="w-16 h-16 mx-auto mb-2 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <p class="text-sm font-medium opacity-60">Foto Hero — 1600×900px</p>
            </div>
        </div>
        <div class="absolute inset-0 bg-gradient-to-r from-green-900/85 via-green-800/60 to-transparent"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20 lg:py-28 flex items-center">
        <div class="max-w-xl">
            <p class="text-yellow-300 font-semibold text-sm mb-2 tracking-wide">Selamat Datang di</p>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-4">Kota Subang</h1>
            <p class="text-green-100/90 text-base sm:text-lg leading-relaxed mb-8 max-w-md">
                Jelajahi keindahan alam, kekayaan budaya, serta pesona yang tak terlupakan.
            </p>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('tentang') }}" class="inline-flex items-center gap-2 bg-yellow-400 hover:bg-yellow-300 text-yellow-900 font-bold px-6 py-3 rounded-full transition-all shadow-lg text-sm">Jelajahi Sekarang →</a>
                <a href="{{ route('laporan.publik') }}" class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm hover:bg-white/30 text-white font-semibold px-6 py-3 rounded-full border border-white/30 transition-all text-sm">Lihat Laporan</a>
            </div>
        </div>
        <div class="absolute bottom-8 right-8 hidden lg:block">
            <div class="bg-green-800/80 backdrop-blur-sm text-white font-black text-2xl tracking-widest px-6 py-3 rounded-2xl border border-green-600/50 shadow-xl">SUBANG</div>
            <p class="text-right text-yellow-300 text-sm font-semibold mt-2 italic">Subang Maju, Sejahtera</p>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════
     STATS BAR
══════════════════════════════════════════════ --}}
<section class="border-y border-gray-100 bg-gray-50/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-y-6 sm:gap-y-0 sm:divide-x divide-gray-100 text-center">
            @foreach([
                [$stats['total'],   'Total laporan'],
                [$stats['selesai'], 'Selesai ditangani'],
                [$stats['proses'],  'Sedang diproses'],
                [$stats['pelapor'], 'Warga terdaftar'],
            ] as [$val,$lbl])
            <div class="px-6 py-2">
                <div class="text-2xl sm:text-3xl font-bold text-gray-900">{{ number_format($val) }}</div>
                <div class="text-xs text-gray-500 mt-1">{{ $lbl }}</div>
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
                <img src="https://images.unsplash.com/photo-1587474260584-136574528ed5?w=800&q=80"
                     alt="Pemandangan Kabupaten Subang" class="w-full h-full object-cover">
            </div>
            <div class="rounded-2xl overflow-hidden bg-gray-100 h-56 sm:h-64">
                <img src="https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?w=400&q=80"
                     alt="Alam Subang" class="w-full h-full object-cover">
            </div>
            <div class="rounded-2xl overflow-hidden bg-gray-100 h-56 sm:h-64">
                <img src="https://images.unsplash.com/photo-1518173946687-a4c8892bbd9f?w=400&q=80"
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
                ['nama'=>'Curug Cileat',    'cat'=>'Wisata Alam',    'icon'=>'🌊', 'ukuran'=>'600×800px'],
                ['nama'=>'Kebun Teh Ciater','cat'=>'Agrowisata',     'icon'=>'🍃', 'ukuran'=>'600×800px'],
                ['nama'=>'Pantai Pondok Bali','cat'=>'Wisata Pantai','icon'=>'🏖️', 'ukuran'=>'600×800px'],
                ['nama'=>'Museum Subang',   'cat'=>'Wisata Sejarah', 'icon'=>'🏛️', 'ukuran'=>'600×800px'],
            ] as $d)
            <div class="group relative rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all hover:-translate-y-1 aspect-[3/4]">
                {{-- Slot foto destinasi — ganti div ini dengan <img src="..." alt="{{ $d['nama'] }}" class="absolute inset-0 w-full h-full object-cover"> --}}
                <div class="absolute inset-0 bg-gradient-to-br from-gray-200 to-gray-300 flex flex-col items-center justify-center gap-2">
                    <span class="text-5xl">{{ $d['icon'] }}</span>
                    <span class="text-xs text-gray-500 font-medium">{{ $d['ukuran'] }}</span>
                </div>
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

{{-- ══ LAPORAN TERBARU ══ --}}
<section class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-8">
            <div>
                <div class="flex items-center gap-2 mb-2"><div class="w-8 h-0.5 bg-yellow-400"></div><span class="text-yellow-600 text-xs font-bold uppercase tracking-widest">SAPAsubang</span></div>
                <h2 class="text-2xl font-extrabold text-gray-900">Laporan Masyarakat Terbaru</h2>
            </div>
            <a href="{{ route('laporan.publik') }}" class="text-sm font-semibold text-green-700">Lihat Semua →</a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
            @foreach($laporanTerbaru as $r)
            <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                <div class="relative h-40 bg-gray-100 overflow-hidden">
                    @if(!str_starts_with($r->foto_sebelum, 'demo/') && Storage::disk('public')->exists($r->foto_sebelum))
                        <img src="{{ Storage::url($r->foto_sebelum) }}" class="w-full h-full object-cover">
                    @else
                        {{-- Placeholder jika belum ada foto --}}
                        <div class="w-full h-full flex flex-col items-center justify-center bg-gray-100 gap-1">
                            <span class="text-4xl">{{ $r->category->icon ?? '📋' }}</span>
                            <span class="text-xs text-gray-400">Belum ada foto</span>
                        </div>
                    @endif
                    <div class="absolute top-2 right-2">@include('components.status-badge', ['status' => $r->status])</div>
                </div>
                <div class="p-4">
                    <span class="text-xs font-semibold text-green-700 bg-green-50 px-2 py-0.5 rounded-full">{{ $r->category->nama_kategori }}</span>
                    <p class="text-sm font-semibold text-gray-800 mt-2 line-clamp-2 leading-snug">{{ $r->deskripsi }}</p>
                    <div class="flex items-center justify-between mt-3 text-xs text-gray-400">
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

{{-- ══ BERITA TERBARU ══ --}}
<section class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-8">
            <div>
                <div class="flex items-center gap-2 mb-2"><div class="w-8 h-0.5 bg-yellow-400"></div><span class="text-yellow-600 text-xs font-bold uppercase tracking-widest">Informasi Terkini</span></div>
                <h2 class="text-2xl font-extrabold text-gray-900">Berita Kota Subang</h2>
            </div>
            <a href="{{ route('berita') }}" class="text-sm font-semibold text-green-700">Lihat Semua →</a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
            @foreach($berita as $b)
            <a href="{{ route('berita.show', $b['slug']) }}"
               class="group bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-md transition-all hover:-translate-y-1">
                {{-- Slot foto berita — ganti div ini dengan <img src="..." class="w-full h-full object-cover"> --}}
                <div class="aspect-video bg-gray-100 flex flex-col items-center justify-center gap-2 overflow-hidden">
                    <span class="text-4xl">{{ $b['icon'] }}</span>
                    <span class="text-xs text-gray-400 font-medium">Foto Berita — 600×338px</span>
                </div>
                <div class="p-4">
                    <span class="text-xs font-bold text-green-700 bg-green-50 px-2 py-0.5 rounded-full">{{ $b['kategori'] }}</span>
                    <h3 class="font-bold text-gray-800 mt-2 text-sm line-clamp-2 leading-snug group-hover:text-green-700 transition-colors">{{ $b['judul'] }}</h3>
                    <p class="text-xs text-gray-400 mt-2">{{ $b['tanggal'] }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

@endsection