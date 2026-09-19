@extends('layouts.app')
@section('title', 'Sejarah & Budaya')

@section('content')

<div x-data="{ detailOpen: false, selected: null }" x-effect="document.body.style.overflow = detailOpen ? 'hidden' : ''">

{{-- ══ HERO ══ --}}
<section class="relative overflow-hidden bg-green-50" style="min-height:360px;">
    <img src="{{ asset('images/sejarah.jpeg') }}" alt="Sejarah Kota Subang" class="absolute inset-0 w-full h-full object-cover">
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
                        ['judul'=>'5 April Sebagai Hari Lahir Kabupaten Subang', 'cat'=>'Sejarah Kabupaten', 'desc'=>'Sejarah penetapan tanggal 5 April sebagai hari lahir Kabupaten Subang.', 'detail'=>'Pada 5 April 1948, rapat di Cimanggu, Desa Cimenteng, menetapkan perubahan wilayah Karawang Timur. Momentum tersebut kemudian menjadi dasar sejarah hari jadi Kabupaten Subang, yang ditetapkan melalui Keputusan DPRD Nomor 01/SK/DPRD/1977.', 'alamat'=>'Cimanggu, Desa Cimenteng, Kabupaten Subang', 'tahun'=>'5 April 1948', 'jenis'=>'Peristiwa sejarah', 'gambar'=>'5april.jpeg', 'maps'=>'https://www.google.com/maps/search/?api=1&query=Cimanggu+Cimenteng+Subang'],
                        ['judul'=>'Peristiwa Kalijati dan Pendudukan Jepang', 'cat'=>'Sejarah Kabupaten', 'desc'=>'Salah satu peristiwa penting dalam sejarah Subang terjadi pada 1 Maret 1942.', 'detail'=>'Pada 8 Maret 1942, Perjanjian Kalijati ditandatangani di Kalijati, Subang. Perjanjian ini menandai menyerahnya Hindia Belanda kepada Jepang dan menjadi titik penting dalam sejarah pendudukan Jepang di Indonesia.', 'alamat'=>'Kalijati, Kabupaten Subang', 'tahun'=>'8 Maret 1942', 'jenis'=>'Peristiwa sejarah', 'gambar'=>'kalijatijpeg.jpeg', 'maps'=>'https://www.google.com/maps/search/?api=1&query=Museum+Rumah+Sejarah+Perjanjian+Kalijati+Subang'],
                        ['judul'=>'Masa Kolonial Belanda', 'cat'=>'Sejarah Kabupaten', 'desc'=>'Pada awal abad ke-19, wilayah Subang berkembang menjadi kawasan perkebunan.', 'detail'=>'Sejak 1812, wilayah Subang berkembang sebagai kawasan perkebunan di bawah penguasaan perusahaan Pamanoekan en Tjiasemlanden. Jejak masa kolonial masih dapat dikenali melalui bangunan dan kawasan bersejarah di Subang.', 'alamat'=>'Wisma Karya, Kabupaten Subang', 'tahun'=>'Sejak 1812', 'jenis'=>'Warisan kolonial', 'gambar'=>'kolonial.jpeg', 'maps'=>'https://www.google.com/maps/search/?api=1&query=Wisma+Karya+Subang'],
                    ] as $item)
                    <div class="group cursor-pointer" role="button" tabindex="0" @click="selected = @js($item); detailOpen = true" @keydown.enter="selected = @js($item); detailOpen = true">
                        @if(isset($item['gambar']))
                        <div class="aspect-video rounded-xl overflow-hidden mb-3 bg-gray-100">
                            <img src="{{ asset('images/'.$item['gambar']) }}" alt="{{ $item['judul'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        </div>
                        @else
                        <div class="aspect-video rounded-xl overflow-hidden mb-3 bg-gray-100 flex flex-col items-center justify-center gap-1 border border-dashed border-gray-300">
                            <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <span class="text-[10px] text-gray-400">400×225px</span>
                        </div>
                        @endif
                        <h4 class="font-bold text-gray-800 text-sm mb-1 group-hover:text-green-700 transition-colors">{{ $item['judul'] }}</h4>
                        <p class="text-xs text-gray-500 leading-relaxed line-clamp-2">{{ $item['desc'] }}</p>
                        <button type="button" class="text-green-600 text-xs font-semibold mt-1.5 inline-block hover:underline">Baca Selengkapnya →</button>
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
                        ['judul'=>'Tari Jaipongan Subang', 'cat'=>'Budaya Subang', 'desc'=>'Tarian khas yang penuh energi dan mendeskripsikan budaya Sunda Subang.', 'detail'=>'Jaipongan adalah seni pertunjukan khas Jawa Barat yang lahir dari kreativitas Gugum Gumbira. Di Subang, berkembang gaya Jaipongan kaleran yang dikenal ceria, spontan, humoris, dan dekat dengan tradisi masyarakat.', 'alamat'=>'Sanggar seni di Kabupaten Subang', 'tahun'=>'Berkembang sejak 1970-an', 'jenis'=>'Seni pertunjukan', 'gambar'=>'jaipong.jpeg', 'maps'=>'https://www.google.com/maps/search/?api=1&query=Sanggar+Tari+Jaipongan+Subang'],
                        ['judul'=>'Sisingaan', 'cat'=>'Budaya Subang', 'desc'=>'Sisingaan merupakan salah satu kesenian yang sangat terkenal dari Subang.', 'detail'=>'Sisingaan atau Gotong Singa adalah kesenian khas Subang yang menampilkan boneka singa yang diusung, diiringi musik dan tarian. Kesenian ini sering hadir dalam acara syukuran, khitanan, dan perayaan masyarakat.', 'alamat'=>'Kabupaten Subang, Jawa Barat', 'tahun'=>'Warisan budaya masyarakat', 'jenis'=>'Kesenian tradisional', 'gambar'=>'sisingan.jpeg', 'maps'=>'https://www.google.com/maps/search/?api=1&query=Sisingaan+Subang'],
                        ['judul'=>'Ruwatan Bumi', 'cat'=>'Budaya Subang', 'desc'=>'Ruwatan Bumi merupakan tradisi masyarakat agraris sebagai bentuk rasa syukur atas hasil bumi.', 'detail'=>'Ruwatan Bumi merupakan tradisi syukuran masyarakat agraris Subang atas hasil panen dan keselamatan kampung. Pelaksanaannya dapat disertai doa, arak-arakan, pertunjukan seni, dan kegiatan kebersamaan warga.', 'alamat'=>'Desa-desa di Kabupaten Subang', 'tahun'=>'Tradisi tahunan masyarakat', 'jenis'=>'Tradisi masyarakat', 'gambar'=>'ruwatan.jpeg', 'maps'=>'https://www.google.com/maps/search/?api=1&query=Ruwatan+Bumi+Subang'],
                        ['judul'=>'Gembyung', 'cat'=>'Budaya Subang', 'desc'=>'Gembyung merupakan kesenian tradisional yang menggunakan alat musik terbang atau rebana.', 'detail'=>'Gembyung adalah kesenian musik tradisional yang menggunakan waditra terbang atau rebana. Pertunjukannya berkembang dalam kegiatan masyarakat dan menjadi bagian dari kekayaan seni tradisional Kabupaten Subang.', 'alamat'=>'Kabupaten Subang, Jawa Barat', 'tahun'=>'Warisan budaya Sunda', 'jenis'=>'Seni musik tradisional', 'gambar'=>'gembyung.jpeg', 'maps'=>'https://www.google.com/maps/search/?api=1&query=Gembyung+Subang'],
                    ] as $item)
                    <div class="group cursor-pointer" role="button" tabindex="0" @click="selected = @js($item); detailOpen = true" @keydown.enter="selected = @js($item); detailOpen = true">
                        @if(isset($item['gambar']))
                        <div class="aspect-square rounded-xl overflow-hidden mb-2 bg-gray-100">
                            <img src="{{ asset('images/'.$item['gambar']) }}" alt="{{ $item['judul'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        </div>
                        @else
                        <div class="aspect-square rounded-xl overflow-hidden mb-2 bg-gray-100 flex flex-col items-center justify-center gap-1 border border-dashed border-gray-300">
                            <svg class="w-7 h-7 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <span class="text-[10px] text-gray-400">300×300px</span>
                        </div>
                        @endif
                        <h4 class="font-semibold text-gray-800 text-xs group-hover:text-green-700 transition-colors leading-snug">{{ $item['judul'] }}</h4>
                        <p class="text-[11px] text-gray-400 mt-0.5 line-clamp-2 leading-snug">{{ $item['desc'] }}</p>
                        <button type="button" class="text-green-600 text-[11px] font-semibold mt-1 inline-block hover:underline">Baca Selengkapnya →</button>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<div x-show="detailOpen" x-cloak x-transition.opacity class="fixed inset-0 z-[70] flex items-center justify-center bg-gray-900/60 p-2 backdrop-blur-sm" style="overscroll-behavior: contain;" @keydown.escape.window="detailOpen = false" @click.self="detailOpen = false">
    <article x-show="selected" x-transition class="relative w-full overflow-y-auto overscroll-contain rounded-2xl bg-white shadow-2xl" style="max-width:520px; max-height:70vh; scrollbar-gutter:stable;" @wheel.stop>
        <div class="relative overflow-hidden bg-gray-100" style="height:160px;">
            <template x-if="selected?.gambar">
                <img :src="`{{ asset('images') }}/${selected.gambar}`" :alt="selected.judul" class="h-full w-full object-cover">
            </template>
            <button type="button" @click="detailOpen = false" aria-label="Tutup detail" class="absolute right-4 top-4 flex h-10 w-10 items-center justify-center rounded-full bg-white/90 text-2xl text-gray-600 shadow hover:bg-white">&times;</button>
            <span class="absolute bottom-4 left-4 rounded-full bg-green-600/90 px-3 py-1 text-xs font-bold text-white" x-text="selected?.cat"></span>
        </div>
        <div class="p-4 sm:p-5">
            <h2 class="text-2xl font-extrabold leading-tight text-gray-900" x-text="selected?.judul"></h2>
            <p class="mt-4 text-base leading-7 text-gray-600" x-text="selected?.detail"></p>

            <div class="mt-6 grid grid-cols-1 gap-3 sm:grid-cols-3">
                <div class="rounded-2xl bg-gray-50 p-4">
                    <p class="text-xs font-bold uppercase tracking-wide text-gray-400">Lokasi</p>
                    <p class="mt-2 text-sm leading-5 text-gray-600" x-text="selected?.alamat"></p>
                </div>
                <div class="rounded-2xl bg-gray-50 p-4">
                    <p class="text-xs font-bold uppercase tracking-wide text-gray-400">Periode</p>
                    <p class="mt-2 text-sm leading-5 text-gray-600" x-text="selected?.tahun"></p>
                </div>
                <div class="rounded-2xl bg-gray-50 p-4">
                    <p class="text-xs font-bold uppercase tracking-wide text-gray-400">Jenis</p>
                    <p class="mt-2 text-sm leading-5 text-gray-600" x-text="selected?.jenis"></p>
                </div>
            </div>

            <p class="mt-7 text-xs font-bold uppercase tracking-wide text-gray-400">Keterangan</p>
            <div class="mt-3 flex flex-wrap gap-2">
                <span class="rounded-full bg-green-50 px-4 py-2 text-sm font-medium text-green-700">Warisan Subang</span>
                <span class="rounded-full bg-green-50 px-4 py-2 text-sm font-medium text-green-700">Sejarah & budaya</span>
                <span class="rounded-full bg-green-50 px-4 py-2 text-sm font-medium text-green-700">Informasi publik</span>
            </div>

            <div class="mt-7 flex flex-wrap gap-3">
                <a :href="selected?.maps" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 rounded-full bg-green-700 px-6 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-green-800">
                    <span>📍</span> Buka di Google Maps
                </a>
                <button type="button" @click="detailOpen = false" class="rounded-full bg-gray-100 px-6 py-3 text-sm font-semibold text-gray-700 transition hover:bg-gray-200">Tutup</button>
            </div>
        </div>
    </article>
</div>
</div>

@endsection
