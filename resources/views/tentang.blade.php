@extends('layouts.app')
@section('title', 'Sejarah & Budaya')

@section('content')

{{-- ══ HERO ══ --}}
<section class="relative overflow-hidden bg-green-50" style="min-height:360px;">
    {{-- Slot foto hero — ganti div ini dengan: <img src="/images/sejarah-hero.jpg" class="absolute inset-0 w-full h-full object-cover"> --}}
    <div class="absolute inset-0 bg-gradient-to-br from-green-100 to-teal-50 flex items-center justify-end pr-8 pointer-events-none">
        <div class="flex flex-col items-center gap-2 opacity-30 select-none">
            <svg class="w-12 h-12 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            <span class="text-xs text-green-400 font-medium">Foto Hero 1400×360px</span>
        </div>
    </div>
    <div class="absolute inset-0 bg-gradient-to-r from-white/95 via-white/80 to-transparent"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <p class="text-green-700 font-bold text-sm mb-2 italic">Mengenal Lebih Dekat</p>
        <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-900 leading-tight mb-4">
            Sejarah & Budaya<br><span class="text-green-700">Kota Subang</span>
        </h1>
        <p class="text-gray-600 text-sm leading-relaxed max-w-lg mb-8">
            Subang memiliki warisan sejarah yang panjang, mulai dari peninggalan kerajaan, situs bersejarah, hingga budaya lokal yang masih terjaga hingga kini.
        </p>
        <a href="#sejarah" class="inline-flex items-center gap-2 bg-green-700 hover:bg-green-800 text-white font-bold px-6 py-3 rounded-full transition-all shadow-md text-sm">
            Jelajahi Sejarah & Budaya →
        </a>
    </div>

    <div class="absolute bottom-6 right-6 hidden lg:block">
        <div class="bg-white/90 backdrop-blur-sm text-green-800 font-bold text-sm px-5 py-3 rounded-2xl shadow-lg italic border border-green-100">
            Gedung Sanggabuwana<br><span class="text-xs font-normal text-gray-500">Warisan Budaya Kebanggaan Subang</span>
        </div>
    </div>
</section>

{{-- ══ SEJARAH SUBANG ══ --}}
<section id="sejarah" class="bg-white py-10 border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 items-start">
            <div class="lg:col-span-1">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 bg-green-50 border border-green-200 rounded-xl flex items-center justify-center text-2xl">🏛️</div>
                    <h2 class="text-xl font-extrabold text-gray-900">Sejarah Subang</h2>
                </div>
                <p class="text-gray-500 text-sm leading-relaxed mb-4">Telusuri jejak sejarah dan peninggalan bersejarah yang membentuk identitas Kota Subang.</p>
                <a href="#" class="text-green-700 font-semibold text-sm flex items-center gap-1 hover:underline">Lihat Semua →</a>
            </div>

            <div class="lg:col-span-3">
                <div class="flex items-center justify-between mb-4">
                    <div></div>
                    <div class="flex gap-2">
                        <button class="w-8 h-8 rounded-full border border-gray-200 flex items-center justify-center text-gray-500 hover:bg-gray-50">‹</button>
                        <button class="w-8 h-8 rounded-full border border-gray-200 flex items-center justify-center text-gray-500 hover:bg-gray-50">›</button>
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-4">
                    @foreach([
                        ['judul'=>'Masa Kerajaan dan Kolonial',  'desc'=>'Jejak awal terbentuknya wilayah Subang dari masa kerajaan hingga era kolonial.'],
                        ['judul'=>'Perjuangan Rakyat Subang',    'desc'=>'Kisah perjuangan dan semangat masyarakat yang gigih dalam mempertahankan kemerdekaan.'],
                        ['judul'=>'Peninggalan Bersejarah',      'desc'=>'Berbagai situs dan bangunan bersejarah yang masih berdiri hingga masa kini.'],
                    ] as $item)
                    <div class="group cursor-pointer">
                        {{-- Slot foto sejarah — ganti div ini dengan <img src="..." class="w-full h-full object-cover rounded-xl"> --}}
                        <div class="aspect-video rounded-xl overflow-hidden mb-3 bg-gray-100 flex flex-col items-center justify-center gap-1 border border-dashed border-gray-300">
                            <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <span class="text-[10px] text-gray-400">400×225px</span>
                        </div>
                        <h4 class="font-bold text-gray-800 text-sm mb-1 group-hover:text-green-700 transition-colors">{{ $item['judul'] }}</h4>
                        <p class="text-xs text-gray-500 leading-relaxed line-clamp-2">{{ $item['desc'] }}</p>
                        <a href="#" class="text-green-600 text-xs font-semibold mt-1.5 inline-block hover:underline">Baca Selengkapnya →</a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══ BUDAYA SUBANG ══ --}}
<section class="bg-gray-50 py-10 border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 items-start">
            <div class="lg:col-span-1">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 bg-orange-50 border border-orange-200 rounded-xl flex items-center justify-center text-2xl">🌿</div>
                    <h2 class="text-xl font-extrabold text-gray-900">Budaya Subang</h2>
                </div>
                <p class="text-gray-500 text-sm leading-relaxed mb-4">Budaya Subang tumbuh dari kearifan lokal, tradisi yang diwariskan turun-temurun, serta seni yang mencerminkan kehidupan masyarakatnya.</p>
                <a href="#" class="text-green-700 font-semibold text-sm flex items-center gap-1 hover:underline">Lihat Semua Budaya →</a>
            </div>
            <div class="lg:col-span-3">
                <div class="grid grid-cols-4 gap-3">
                    @foreach([
                        ['judul'=>'Tari Jaipongan Subang',     'desc'=>'Tarian khas yang penuh energi dan mendeskripsikan budaya Sunda Subang.'],
                        ['judul'=>'Calung dan Angklung',        'desc'=>'Alat musik tradisional yang menjadi bagian dari warisan Budaya Subang.'],
                        ['judul'=>'Kerajinan Anyaman Bambu',    'desc'=>'Karya tangan masyarakat Subang yang terkenal hingga kini.'],
                        ['judul'=>'Nasi Liwet Subang',          'desc'=>'Kuliner tradisional yang menjadi bagian dari identitas Sunda tinggi.'],
                    ] as $item)
                    <div class="group cursor-pointer">
                        {{-- Slot foto budaya — ganti dengan <img src="..."> --}}
                        <div class="aspect-square rounded-xl overflow-hidden mb-2 bg-gray-100 flex flex-col items-center justify-center gap-1 border border-dashed border-gray-300">
                            <svg class="w-7 h-7 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <span class="text-[10px] text-gray-400">300×300px</span>
                        </div>
                        <h4 class="font-semibold text-gray-800 text-xs group-hover:text-green-700 transition-colors leading-snug">{{ $item['judul'] }}</h4>
                        <p class="text-[11px] text-gray-400 mt-0.5 line-clamp-2 leading-snug">{{ $item['desc'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══ WISATA SUBANG ══ --}}
<section class="bg-white py-10 border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 items-start">
            <div class="lg:col-span-1">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 bg-blue-50 border border-blue-200 rounded-xl flex items-center justify-center text-2xl">🏔️</div>
                    <h2 class="text-xl font-extrabold text-gray-900">Wisata Subang</h2>
                </div>
                <p class="text-gray-500 text-sm leading-relaxed mb-4">Nikmati keindahan alam, wisata alam, dan objek wisata menarik yang ada di Subang.</p>
                <a href="{{ route('wisata') }}" class="text-green-700 font-semibold text-sm flex items-center gap-1 hover:underline">Lihat Semua Wisata →</a>
            </div>
            <div class="lg:col-span-3">
                <div class="grid grid-cols-4 gap-3">
                    @foreach([
                        ['judul'=>'Curug Cijalu',      'cat'=>'Wisata Alam'],
                        ['judul'=>'Taman Anggur',      'cat'=>'Wisata Edukasi'],
                        ['judul'=>'Kawah Ciater',      'cat'=>'Wisata Alam'],
                        ['judul'=>'Sari Ater Hot Spring','cat'=>'Wisata Keluarga'],
                    ] as $item)
                    <div class="group cursor-pointer">
                        {{-- Slot foto wisata — ganti dengan <img src="..."> --}}
                        <div class="relative aspect-square rounded-xl overflow-hidden mb-2 bg-gray-100 flex flex-col items-center justify-center gap-1 border border-dashed border-gray-300">
                            <svg class="w-7 h-7 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <span class="text-[10px] text-gray-400">300×300px</span>
                            <div class="absolute bottom-2 left-2">
                                <span class="text-white text-[10px] font-medium bg-green-600/80 px-2 py-0.5 rounded-full">{{ $item['cat'] }}</span>
                            </div>
                        </div>
                        <h4 class="font-semibold text-gray-800 text-xs group-hover:text-green-700 transition-colors leading-snug">{{ $item['judul'] }}</h4>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══ CTA BANNER ══ --}}
<section class="relative overflow-hidden bg-green-800 py-10">
    {{-- Slot foto background — tidak ada gambar, hanya warna solid --}}
    <div class="absolute left-0 bottom-0 opacity-30 pointer-events-none">
        <svg viewBox="0 0 120 200" class="h-48 w-auto"><ellipse cx="30" cy="150" rx="60" ry="80" fill="#bbf7d0" transform="rotate(-20 30 150)"/><ellipse cx="80" cy="100" rx="40" ry="60" fill="#86efac" transform="rotate(15 80 100)"/></svg>
    </div>
    <div class="absolute right-0 bottom-0 opacity-30 pointer-events-none">
        <svg viewBox="0 0 120 200" class="h-48 w-auto"><ellipse cx="90" cy="150" rx="60" ry="80" fill="#bbf7d0" transform="rotate(20 90 150)"/></svg>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-6">
        <p class="text-white text-xl font-bold italic text-center sm:text-left max-w-xl">
            Jelajahi sejarah, budaya, wisata, dan kuliner Subang<br>
            <span class="text-yellow-300">untuk pengalaman yang tak terlupakan!</span>
        </p>
        <a href="{{ route('home') }}" class="flex-shrink-0 bg-white hover:bg-green-50 text-green-800 font-bold px-8 py-3.5 rounded-full transition-colors shadow-lg text-sm flex items-center gap-2">Lihat Semua →</a>
    </div>
</section>

@endsection
