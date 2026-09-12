@extends('layouts.app')
@section('title', 'Beranda')

@section('content')

{{-- ══════════════════════════════════════════════
     HERO
══════════════════════════════════════════════ --}}
<section class="bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">

            {{-- Kiri: teks --}}
            <div class="max-w-xl">
                <div class="inline-flex items-center gap-2 bg-green-50 border border-green-200 text-green-700 text-xs font-semibold px-3 py-1.5 rounded-full mb-6">
                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></span>
                    Layanan aduan resmi Kabupaten Subang
                </div>

                <h1 class="text-4xl sm:text-[2.75rem] font-bold text-gray-900 leading-[1.15] tracking-tight mb-5">
                    Subang yang lebih baik, dimulai dari laporan Anda
                </h1>

                <p class="text-gray-500 text-lg leading-relaxed mb-8">
                    Temukan jalan rusak, lampu mati, atau sampah menumpuk? Laporkan dalam hitungan menit, dan pantau langsung sampai petugas menindaklanjuti.
                </p>

                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('laporan.publik') }}"
                       class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-xl transition-colors shadow-sm text-sm">
                        Buat laporan
                    </a>
                    <a href="{{ route('laporan.publik') }}"
                       class="inline-flex items-center gap-2 bg-white hover:bg-gray-50 text-gray-700 font-semibold px-6 py-3 rounded-xl border border-gray-200 hover:border-gray-300 transition-colors text-sm">
                        Lihat semua laporan
                    </a>
                </div>

                <div class="mt-8 flex items-center gap-3">
                    <div class="flex -space-x-2">
                        @foreach(['#16a34a','#15803d','#166534','#14532d'] as $clr)
                        <div class="w-8 h-8 rounded-full border-2 border-white flex items-center justify-center text-white text-xs font-bold shadow-sm"
                             style="background:{{ $clr }}">W</div>
                        @endforeach
                    </div>
                    <p class="text-sm text-gray-500">
                        Sudah dipakai oleh
                        <span class="font-semibold text-gray-900">{{ number_format($stats['pelapor']) }} lebih</span>
                        warga Subang
                    </p>
                </div>
            </div>

            {{-- Kanan: browser mockup --}}
            <div class="relative">
                {{-- Shadow decorative --}}
                <div class="absolute inset-0 bg-gradient-to-br from-green-100/50 to-teal-50/50 rounded-3xl transform rotate-1 scale-[1.02]"></div>

                <div class="relative bg-white rounded-2xl border border-gray-200 shadow-2xl overflow-hidden">
                    {{-- Browser chrome --}}
                    <div class="bg-gray-50 border-b border-gray-200 px-4 py-3 flex items-center gap-3">
                        <div class="flex gap-1.5">
                            <div class="w-3 h-3 rounded-full bg-red-400"></div>
                            <div class="w-3 h-3 rounded-full bg-yellow-400"></div>
                            <div class="w-3 h-3 rounded-full bg-green-400"></div>
                        </div>
                        <div class="flex-1 bg-white border border-gray-200 rounded-lg px-3 py-1.5 text-xs text-gray-400 font-mono">
                            sapasubang.go.id
                        </div>
                    </div>

                    {{-- Peta dalam browser --}}
                    <div class="relative" style="height:260px;">
                        <div id="hero-map" class="w-full h-full"></div>

                        {{-- Floating notification card --}}
                        <div class="absolute bottom-4 left-4 right-4 pointer-events-none">
                            <div class="bg-white rounded-xl shadow-lg border border-gray-100 px-4 py-3 flex items-center gap-3">
                                <div class="w-9 h-9 bg-green-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs font-semibold text-gray-800">Laporan #142 selesai</p>
                                    <p class="text-xs text-gray-500">Jalan Kalijati diperbaiki hari ini</p>
                                </div>
                                <span class="text-[10px] bg-green-100 text-green-700 font-semibold px-2 py-0.5 rounded-full flex-shrink-0">Selesai</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Floating stat cards --}}
                <div class="absolute -top-5 -right-5 bg-white rounded-2xl shadow-lg border border-gray-100 px-4 py-3 hidden lg:block">
                    <div class="text-2xl font-bold text-gray-900">{{ number_format($stats['total']) }}</div>
                    <div class="text-xs text-gray-500 mt-0.5">Total laporan</div>
                </div>
                <div class="absolute -bottom-5 -left-5 bg-white rounded-2xl shadow-lg border border-gray-100 px-4 py-3 hidden lg:block">
                    <div class="flex items-center gap-2">
                        <div class="w-2.5 h-2.5 bg-green-500 rounded-full"></div>
                        <span class="text-sm font-semibold text-gray-900">{{ number_format($stats['selesai']) }} selesai</span>
                    </div>
                    <div class="text-xs text-gray-400 mt-0.5">Ditangani petugas</div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════
     STATS BAR
══════════════════════════════════════════════ --}}
<section class="border-y border-gray-100 bg-gray-50/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-2 sm:grid-cols-4 divide-x divide-gray-100 text-center gap-0">
            @foreach([
                [$stats['total'],   'Total laporan'],
                [$stats['selesai'], 'Selesai ditangani'],
                [$stats['proses'],  'Sedang diproses'],
                [$stats['pelapor'], 'Warga terdaftar'],
            ] as [$val,$lbl])
            <div class="px-6 py-2">
                <div class="text-3xl font-bold text-gray-900">{{ number_format($val) }}</div>
                <div class="text-xs text-gray-500 mt-1">{{ $lbl }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════
     MENGENAL SUBANG
     (dirombak: layout lebih rapi, ikon SVG konsisten
     — bukan emoji, dan konten lebih lengkap)
══════════════════════════════════════════════ --}}
<section class="bg-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
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

        {{-- Galeri foto --}}
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

        {{-- Kartu info --}}
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

{{-- ══════════════════════════════════════════════
     PETA LAPORAN + DAFTAR
══════════════════════════════════════════════ --}}
<section class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Section header --}}
        <div class="flex items-start justify-between mb-8 flex-wrap gap-3">
            <div>
                <div class="flex items-center gap-2 mb-1.5">
                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                    </svg>
                    <span class="text-green-600 text-xs font-bold uppercase tracking-widest">Peta laporan</span>
                </div>
                <h2 class="text-2xl font-bold text-gray-900">Semua laporan warga Subang</h2>
            </div>
            <a href="{{ route('laporan.publik') }}"
               class="text-sm font-semibold text-green-600 hover:text-green-700 flex items-center gap-1">
                Lihat semua →
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

            {{-- Peta 2/3 --}}
            <div class="lg:col-span-2 bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm">
                <div id="home-map" style="height:420px;"></div>
            </div>

            {{-- Sidebar 1/3 --}}
            <div class="flex flex-col gap-4">

                {{-- Legend --}}
                <div class="bg-white rounded-2xl border border-gray-200 p-5 shadow-sm">
                    <h4 class="text-sm font-semibold text-gray-800 mb-4">Status laporan di peta</h4>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2.5">
                                <div class="w-3 h-3 rounded-full bg-green-500 flex-shrink-0"></div>
                                <span class="text-sm text-gray-600">Selesai ditangani</span>
                            </div>
                            <span class="text-sm font-bold text-gray-800">{{ number_format($stats['selesai']) }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2.5">
                                <div class="w-3 h-3 rounded-full bg-orange-400 flex-shrink-0"></div>
                                <span class="text-sm text-gray-600">Sedang diproses</span>
                            </div>
                            <span class="text-sm font-bold text-gray-800">{{ number_format($stats['proses']) }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2.5">
                                <div class="w-3 h-3 rounded-full bg-yellow-400 flex-shrink-0"></div>
                                <span class="text-sm text-gray-600">Menunggu verifikasi</span>
                            </div>
                            <span class="text-sm font-bold text-gray-800">{{ number_format(max(0, $stats['total'] - $stats['selesai'] - $stats['proses'])) }}</span>
                        </div>
                    </div>
                    <a href="{{ route('laporan.publik') }}"
                       class="mt-5 w-full flex items-center justify-center gap-1.5 text-sm text-gray-600 border border-gray-200 rounded-xl py-2.5 hover:bg-gray-50 hover:border-gray-300 transition-colors">
                        Buka peta penuh
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    </a>
                </div>

                {{-- Laporan terbaru --}}
                @foreach($laporanTerbaru->take(3) as $r)
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm hover:border-green-100 hover:shadow transition-all">
                    <div class="flex gap-3 p-4">
                        <div class="w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center text-xl flex-shrink-0">
                            {{ $r->category->icon ?? '📋' }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="mb-1.5">
                                @include('components.status-badge', ['status' => $r->status])
                            </div>
                            <p class="text-xs font-medium text-gray-700 line-clamp-2 leading-snug">{{ $r->deskripsi }}</p>
                            <div class="flex items-center justify-between mt-2">
                                <span class="text-[11px] text-gray-400">{{ $r->category->nama_kategori }}</span>
                                <span class="text-[11px] text-gray-400">▲ {{ $r->supports_count }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════
     CARA KERJA
══════════════════════════════════════════════ --}}
<section class="bg-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <p class="text-green-600 text-xs font-bold uppercase tracking-widest mb-2">Mudah & cepat</p>
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">Cara kerja SAPAsubang</h2>
            <p class="text-gray-500 text-sm mt-3 max-w-lg mx-auto leading-relaxed">
                Proses sederhana dari laporan hingga penyelesaian masalah.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">
            @foreach([
                ['01','<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>','Foto & laporkan','Foto masalah, GPS otomatis ambil lokasi, pilih kategori dan isi keterangan.'],
                ['02','<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>','Verifikasi admin','Admin memeriksa dan memvalidasi laporan, menentukan prioritas penanganan.'],
                ['03','<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>','Petugas ditugaskan','Petugas terdekat ditugaskan dan menuju lokasi masalah dengan rute tercepat.'],
                ['04','<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>','Selesai & notifikasi','Petugas kirim bukti, admin konfirmasi, Anda dapat notifikasi laporan selesai.'],
            ] as [$n,$ico,$t,$d])
            <div class="text-center">
                <div class="w-16 h-16 bg-green-50 border border-green-100 rounded-2xl flex items-center justify-center text-green-600 mx-auto mb-5 shadow-sm">
                    {!! $ico !!}
                </div>
                <div class="text-xs font-bold text-green-500 mb-2 tracking-widest">{{ $n }}</div>
                <h3 class="font-semibold text-gray-800 mb-2 text-sm">{{ $t }}</h3>
                <p class="text-xs text-gray-500 leading-relaxed">{{ $d }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════
     TENTANG SAPASUBANG
══════════════════════════════════════════════ --}}
<section class="bg-gray-50 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <p class="text-green-600 text-xs font-bold uppercase tracking-widest mb-2">Platform digital</p>
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">Tentang SAPAsubang</h2>
            <p class="text-gray-500 text-sm mt-3 max-w-xl mx-auto leading-relaxed">
                Sistem Aduan & Pelaporan Aspirasi Subang adalah platform digital resmi Kabupaten Subang
                untuk pelaporan dan penanganan masalah fasilitas umum.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            @foreach([
                ['<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>','Mudah digunakan','Cukup foto masalah, sistem otomatis ambil lokasi GPS, isi kategori dan keterangan, laporan terkirim dalam hitungan menit.'],
                ['<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>','Berbasis peta','Semua laporan ditampilkan di peta interaktif Kabupaten Subang sehingga mudah dipantau persebarannya.'],
                ['<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>','Notifikasi langsung','Anda mendapat notifikasi di setiap perubahan status laporan, dari verifikasi hingga selesai ditangani.'],
            ] as [$ico,$t,$d])
            <div class="bg-white rounded-2xl border border-gray-100 p-8 hover:shadow-md hover:border-green-100 transition-all">
                <div class="w-12 h-12 bg-green-50 border border-green-100 rounded-xl flex items-center justify-center text-green-600 mb-5">
                    {!! $ico !!}
                </div>
                <h3 class="font-semibold text-gray-800 mb-2 text-sm">{{ $t }}</h3>
                <p class="text-sm text-gray-500 leading-relaxed">{{ $d }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════
     CTA BANNER
══════════════════════════════════════════════ --}}
<section class="bg-green-700">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
        <h2 class="text-2xl sm:text-3xl font-bold text-white mb-4">
            Punya masalah di lingkungan Anda?
        </h2>
        <p class="text-green-100 leading-relaxed mb-8 max-w-xl mx-auto text-sm">
            Jangan tunggu sampai membesar. Laporkan sekarang, gratis dan tidak perlu ke kantor kelurahan.
        </p>
        <a href="{{ route('laporan.publik') }}"
           class="inline-flex items-center gap-2 bg-white hover:bg-green-50 text-green-700 font-bold px-8 py-3.5 rounded-xl transition-colors shadow-lg text-sm">
            Buat laporan sekarang
        </a>
    </div>
</section>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Koordinat Kabupaten Subang yang benar: -6.5744, 107.7599
    var SUBANG = [-6.5744, 107.7599];

    // Hero map — non-interaktif
    var heroMap = L.map('hero-map', {
        zoomControl: false, scrollWheelZoom: false,
        dragging: false, touchZoom: false, doubleClickZoom: false
    }).setView(SUBANG, 11);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: false
    }).addTo(heroMap);

    // Home map — interaktif
    var homeMap = L.map('home-map').setView(SUBANG, 11);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(homeMap);

    var statusColors = {
        menunggu_verifikasi: '#EAB308', ditolak: '#EF4444',
        terverifikasi: '#3B82F6',       ditugaskan: '#8B5CF6',
        menuju_lokasi: '#6366F1',       sedang_ditangani: '#F97316',
        menunggu_konfirmasi: '#06B6D4', selesai: '#22C55E'
    };

    var points = @json($mapPoints);
    var coords = [];

    points.forEach(function(p) {
        var c = statusColors[p.status] || '#6B7280';
        var icon = L.divIcon({
            className: '',
            html: '<div style="width:12px;height:12px;border-radius:50%;background:' + c + ';border:2px solid white;box-shadow:0 1px 4px rgba(0,0,0,.25)"></div>',
            iconSize: [12, 12], iconAnchor: [6, 6]
        });
        L.marker([p.lat, p.lng], {icon: icon}).addTo(homeMap)
            .bindPopup(
                '<div style="font-family:system-ui,sans-serif;min-width:150px">' +
                '<div style="font-weight:700;font-size:11px;color:#111">' + p.kode + '</div>' +
                '<div style="font-size:11px;color:#666;margin-top:2px">' + p.kategori + '</div>' +
                '<div style="font-size:10px;background:#f3f4f6;color:#555;padding:2px 7px;border-radius:99px;display:inline-block;margin-top:4px">' + p.status_label + '</div>' +
                '</div>'
            );

        // Tambahkan ke hero map juga
        L.marker([p.lat, p.lng], {icon: icon}).addTo(heroMap);

        coords.push([p.lat, p.lng]);
    });

    // Fit bounds home map ke wilayah Subang
    if (coords.length > 1) {
        try {
            homeMap.fitBounds(coords, {padding: [40, 40], maxZoom: 14});
        } catch(e) {
            homeMap.setView(SUBANG, 11);
        }
    }
});
</script>
@endpush