@extends('layouts.app')
@section('title', 'Wisata')

@php
    // Foto hero halaman — ganti dengan URL milikmu
    $fotoHero = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRJ8cdmNqGj9tiNGJJ14ro6Pjritsl99vF9Be4TSQaWAw&s=10';

    // Data destinasi — tambah/ubah di sini saja, kartu & modal ikut otomatis.
    // 'foto'  : URL gambar (boleh link luar, boleh asset('images/wisata/xxx.jpg'))
    // 'maps'  : nama tempat, atau koordinat "-6.7123,107.6543" (lebih akurat)
    $wisata = [
        [
            'slug'  => 'curug-cijalu',
            'nama'  => 'Curug Cijalu',
            'cat'   => 'Wisata Alam',
            'foto'  => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRwdYyBZ8K3vOWUGiLz6FCNDlvDiC-xi975Aeer4Kz1Ow&s=10',
            'desc'  => 'Air terjun alami yang memukau di tengah hutan Subang.',
            'detail'=> 'Curug Cijalu merupakan air terjun setinggi kurang lebih 70 meter yang berada di kawasan hutan lindung Gunung Sunda. Udara sejuk, jalur trekking yang rindang, dan area perkemahan membuatnya populer bagi pecinta alam.',
            'alamat'=> 'Desa Cipancar, Kec. Serangpanjang, Kab. Subang',
            'jam'   => '07.00 - 17.00 WIB',
            'tiket' => 'Rp 15.000 / orang',
            'fasilitas' => ['Area parkir', 'Toilet', 'Camping ground', 'Warung makan'],
            'maps'  => 'Curug Cijalu Subang',
        ],
        [
            'slug'  => 'kebun-teh-ciater',
            'nama'  => 'Kebun Teh Ciater',
            'cat'   => 'Agrowisata',
            'foto'  => 'https://cdn-jpr.jawapos.com/images/43/2026/05/09/wisata-kebun-teh-ciater-subang-viral-karena-hidden-gem-gratis-cafe-instagramable-camping-murah-dan-panorama-alam-memukau-pinterestcom-q9cxe.webp',
            'desc'  => 'Hamparan kebun teh hijau yang menyejukkan mata.',
            'detail'=> 'Hamparan kebun teh di lereng Gunung Tangkuban Perahu dengan jalan setapak di antara barisan tanaman teh. Waktu terbaik berkunjung adalah pagi hari saat kabut masih turun.',
            'alamat'=> 'Ciater, Kec. Ciater, Kab. Subang',
            'jam'   => '06.00 - 18.00 WIB',
            'tiket' => 'Gratis / sukarela',
            'fasilitas' => ['Spot foto', 'Area parkir', 'Warung teh'],
            'maps'  => 'Kebun Teh Ciater Subang',
        ],
        [
            'slug'  => 'pantai-pondok-bali',
            'nama'  => 'Pantai Pondok Bali',
            'cat'   => 'Wisata Pantai',
            'foto'  => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR1MAoPDC-jSvku6mBRTvkxTaFABiyDmc3uhqIGfG5OYg&s=10',
            'desc'  => 'Pantai dengan pemandangan laut yang indah di utara Subang.',
            'detail'=> 'Pantai di pesisir utara Subang dengan garis pantai landai dan perahu nelayan yang bersandar. Cocok untuk menikmati matahari terbenam dan kuliner hasil laut segar.',
            'alamat'=> 'Desa Mayangan, Kec. Legonkulon, Kab. Subang',
            'jam'   => '24 jam',
            'tiket' => 'Rp 10.000 / orang',
            'fasilitas' => ['Saung', 'Toilet', 'Kuliner seafood', 'Area parkir'],
            'maps'  => 'Pantai Pondok Bali Subang',
        ],
        [
            'slug'  => 'kawah-domas',
            'nama'  => 'Kawah DomasTangkuban Perahu',
            'cat'   => 'Wisata Alam',
            'foto'  => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR5COzDB5S-0IL1iQiTHKbMPqZw9fgFqnPmmAdX7pXSQA&s=10',
            'desc'  => 'Pemandian air panas alami dari sumber belerang.',
            'detail'=> 'Sumber air panas belerang yang mengalir dari kawah Gunung Tangkuban Perahu. Air hangatnya dipercaya membantu meredakan pegal dan menyehatkan kulit.',
            'alamat'=> 'Ciater, Kec. Ciater, Kab. Subang',
            'jam'   => '08.00 - 17.00 WIB',
            'tiket' => 'Mulai Rp 25.000 / orang',
            'fasilitas' => ['Kolam air panas', 'Ruang bilas', 'Musala', 'Area parkir'],
            'maps'  => '6JQG+C98, Ciater, Kec. Ciater, Kabupaten Subang, Jawa Barat 41281',
        ],
        [
            'slug'  => 'bukit-strawberry',
            'nama'  => 'Bukit Strawberry',
            'cat'   => 'Wisata Edukasi',
            'foto'  => 'https://assets-a1.kompasiana.com/items/album/2017/01/31/bukit-kebun-wisata-strawberry-malang-indonesia-www-selamethariadi-com-2-588fe211a3afbd36048b4569.jpg',
            'desc'  => 'Perkebunan strawberry sebagai destinasi edukasi keluarga.',
            'detail'=> 'Kebun strawberry yang dibuka untuk umum dengan program edukasi penanaman, perawatan, hingga panen buah. Pengunjung bisa memetik strawberry langsung dari tanamannya.',
            'alamat'=> 'Kab. Subang, Jawa Barat',
            'jam'   => '07.00 - 18.00 WIB',
            'tiket' => 'Rp 20.000 / orang',
            'fasilitas' => ['Petik buah', 'Pemandu edukasi', 'Spot foto', 'Toilet'],
            'maps'  => 'Jl. Raya Tangkuban Parahu No.109, Cibogo, Kec. Lembang, Kabupaten Bandung Barat, Jawa Barat 40391',
        ],
        [
            'slug'  => 'sari-ater-resort',
            'nama'  => 'Sari Ater Resort',
            'cat'   => 'Wisata Keluarga',
            'foto'  => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTloeVToSpHRfLgScECKtXBGx2anqljv8WNJMEqgJ5r7A&s=10',
            'desc'  => 'Resort pemandian air panas keluarga paling populer.',
            'detail'=> 'Kawasan wisata terpadu dengan kolam air panas, penginapan, wahana outbound, dan area bermain anak. Salah satu destinasi paling ramai di Subang saat akhir pekan.',
            'alamat'=> 'Jl. Raya Ciater, Kec. Ciater, Kab. Subang',
            'jam'   => '08.00 - 22.00 WIB',
            'tiket' => 'Mulai Rp 35.000 / orang',
            'fasilitas' => ['Kolam air panas', 'Penginapan', 'Outbound', 'Restoran', 'Area parkir luas'],
            'maps'  => 'Sari Ater Hot Spring Resort Subang',
        ],
        [
            'slug'  => 'museum-subang',
            'nama'  => 'Museum Subang',
            'cat'   => 'Wisata Sejarah',
            'foto'  => 'https://lh3.googleusercontent.com/grass-cs/ACvplmNFtQRydI8Pq6V39AmsJCo8FljXsWYmkHjoZQFgQwU5rXF19ARcQaJhsikZuji1v3NCjAujaim73wD70D2MIzJoEXhUX9-k7xJTW45yZfM18emUQhf6IbVoo3qAtyqCH4cGT-fj2A=w326-h312-n-k-no',
            'desc'  => 'Menyimpan koleksi sejarah perjuangan rakyat Subang.',
            'detail'=> 'Museum daerah yang menyimpan koleksi benda bersejarah, dokumentasi masa kolonial, serta jejak perjuangan rakyat Subang. Cocok untuk kunjungan sekolah dan penelitian.',
            'alamat'=> 'Jl. Kapten Hanafiah, Kec. Subang, Kab. Subang',
            'jam'   => 'Senin - Jumat, 08.00 - 15.00 WIB',
            'tiket' => 'Gratis',
            'fasilitas' => ['Ruang pameran', 'Pemandu', 'Perpustakaan mini', 'Toilet'],
            'maps'  => 'Museum Subang',
        ],
        [
            'slug'  => 'hutan-pinus-cikole',
            'nama'  => 'Hutan Pinus Cikole',
            'cat'   => 'Wisata Alam',
            'foto'  => 'https://lh3.googleusercontent.com/grass-cs/ACvplmOpoCF-bKiPyv-DcsmYxvv-OYF_gO9A_OpqGygCT_vcgbiQ9Gw2zotgW1Vw4jelEpgqgCEyt6iN-LPsBaTgmGL4Z03XEuDCKZvdqAG3-x23uZxTppr4ZLzBwwCvQ52ZtkLZR2IX=w326-h312-n-k-no',
            'desc'  => 'Hutan pinus yang sejuk cocok untuk berkemah dan piknik.',
            'detail'=> 'Kawasan hutan pinus dengan udara dingin dan barisan pohon tinggi yang rapi. Tersedia area berkemah, jalur jalan kaki, dan beragam spot foto di antara pepohonan.',
            'alamat'=> 'Cikole, Lembang - perbatasan Subang',
            'jam'   => '07.00 - 17.00 WIB',
            'tiket' => 'Rp 15.000 / orang',
            'fasilitas' => ['Camping ground', 'Spot foto', 'Warung', 'Toilet'],
            'maps'  => 'Hutan Pinus Cikole',
        ],
    ];

    // Gambar cadangan kalau link foto mati / kosong
    $fotoFallback = 'https://placehold.co/800x450/e5e7eb/9ca3af?text=Foto+Tidak+Tersedia';
@endphp

@section('content')

{{-- Hero --}}
<section class="relative overflow-hidden" style="min-height:300px;">
    <img src="{{ $fotoHero }}" alt="Wisata Kota Subang"
         class="absolute inset-0 w-full h-full object-cover"
         onerror="this.src='{{ $fotoFallback }}'">
    <div class="absolute inset-0 bg-gradient-to-r from-white/95 via-white/80 to-transparent"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
        <p class="text-green-700 font-bold text-sm mb-1 italic">Jelajahi Keindahan</p>
        <h1 class="text-4xl font-extrabold text-gray-900 mb-4">Wisata Kota Subang</h1>
        <p class="text-gray-600 text-sm max-w-md mb-7">Nikmati pesona alam, wisata edukasi, dan destinasi menarik di Kabupaten Subang.</p>
        <a href="{{ route('tentang') }}" class="inline-flex items-center gap-2 bg-green-700 hover:bg-green-800 text-white font-bold px-6 py-3 rounded-full text-sm transition-all">Lihat Sejarah &amp; Budaya &rarr;</a>
    </div>
</section>

{{-- Grid wisata --}}
<section class="bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-2 mb-6">
            <div class="w-8 h-0.5 bg-yellow-400"></div>
            <span class="text-yellow-600 text-xs font-bold uppercase tracking-widest">Destinasi Pilihan</span>
        </div>
        <h2 class="text-2xl font-extrabold text-gray-900 mb-8">Destinasi Wisata Unggulan</h2>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-5">
            @foreach($wisata as $w)
            <button type="button"
                    onclick="bukaDetailWisata('{{ $w['slug'] }}')"
                    class="group text-left bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-lg transition-all hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2">
                <div class="relative aspect-video bg-gray-100 overflow-hidden">
                    <img src="{{ $w['foto'] ?: $fotoFallback }}" alt="{{ $w['nama'] }}" loading="lazy"
                         class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                         onerror="this.src='{{ $fotoFallback }}'">
                    <div class="absolute bottom-2 left-2">
                        <span class="text-[10px] font-bold text-white bg-green-600/90 px-2 py-0.5 rounded-full">{{ $w['cat'] }}</span>
                    </div>
                </div>
                <div class="p-4">
                    <h3 class="font-bold text-gray-800 text-sm mb-1 group-hover:text-green-700 transition-colors">{{ $w['nama'] }}</h3>
                    <p class="text-xs text-gray-500 leading-snug mb-3">{{ $w['desc'] }}</p>
                    <span class="inline-flex items-center gap-1 text-[11px] font-bold text-green-700">
                        Lihat detail
                        <svg class="w-3 h-3 transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                    </span>
                </div>
            </button>
            @endforeach
        </div>
    </div>
</section>

{{-- Modal detail --}}
<div id="modalWisata"
     class="fixed inset-0 z-50 hidden items-center justify-center p-4"
     role="dialog" aria-modal="true" aria-labelledby="mwNama">

    <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm" onclick="tutupDetailWisata()"></div>

    <div class="relative bg-white w-full max-w-2xl max-h-[90vh] overflow-y-auto rounded-2xl shadow-2xl">

        <div class="relative h-56 bg-gray-100">
            <img id="mwFoto" src="" alt="" class="w-full h-full object-cover">
            <div class="absolute inset-x-0 bottom-0 h-20 bg-gradient-to-t from-black/50 to-transparent"></div>

            <button type="button" onclick="tutupDetailWisata()" aria-label="Tutup"
                    class="absolute top-3 right-3 w-9 h-9 rounded-full bg-white/90 hover:bg-white text-gray-600 shadow flex items-center justify-center transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>

            <span id="mwCat" class="absolute bottom-3 left-5 text-[11px] font-bold text-white bg-green-600/90 px-3 py-1 rounded-full"></span>
        </div>

        <div class="p-6">
            <h3 id="mwNama" class="text-2xl font-extrabold text-gray-900 mb-2"></h3>
            <p id="mwDetail" class="text-sm text-gray-600 leading-relaxed mb-6"></p>

            <div class="grid sm:grid-cols-3 gap-3 mb-6">
                <div class="bg-gray-50 rounded-xl p-3">
                    <p class="text-[10px] uppercase tracking-wider text-gray-400 font-bold mb-1">Lokasi</p>
                    <p id="mwAlamat" class="text-xs text-gray-700 leading-snug"></p>
                </div>
                <div class="bg-gray-50 rounded-xl p-3">
                    <p class="text-[10px] uppercase tracking-wider text-gray-400 font-bold mb-1">Jam Buka</p>
                    <p id="mwJam" class="text-xs text-gray-700 leading-snug"></p>
                </div>
                <div class="bg-gray-50 rounded-xl p-3">
                    <p class="text-[10px] uppercase tracking-wider text-gray-400 font-bold mb-1">Tiket Masuk</p>
                    <p id="mwTiket" class="text-xs text-gray-700 leading-snug"></p>
                </div>
            </div>

            <p class="text-[10px] uppercase tracking-wider text-gray-400 font-bold mb-2">Fasilitas</p>
            <div id="mwFasilitas" class="flex flex-wrap gap-2 mb-7"></div>

            <a id="mwMaps" href="#" target="_blank" rel="noopener"
               class="inline-flex items-center justify-center gap-2 w-full sm:w-auto bg-green-700 hover:bg-green-800 text-white font-bold px-6 py-3 rounded-full text-sm transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Buka di Google Maps
            </a>
        </div>
    </div>
</div>

@push('scripts')
<script>
    const dataWisata  = @json(collect($wisata)->keyBy('slug'));
    const fotoCadangan = @json($fotoFallback);

    function bukaDetailWisata(slug) {
        const w = dataWisata[slug];
        if (!w) return;

        const foto = document.getElementById('mwFoto');
        foto.src     = w.foto || fotoCadangan;
        foto.alt     = w.nama;
        foto.onerror = function () { this.onerror = null; this.src = fotoCadangan; };

        document.getElementById('mwNama').textContent   = w.nama;
        document.getElementById('mwCat').textContent    = w.cat;
        document.getElementById('mwDetail').textContent = w.detail;
        document.getElementById('mwAlamat').textContent = w.alamat;
        document.getElementById('mwJam').textContent    = w.jam;
        document.getElementById('mwTiket').textContent  = w.tiket;

        document.getElementById('mwFasilitas').innerHTML = (w.fasilitas || [])
            .map(f => '<span class="text-[11px] bg-green-50 text-green-700 font-medium px-3 py-1 rounded-full">' + f + '</span>')
            .join('');

        document.getElementById('mwMaps').href =
            'https://www.google.com/maps/search/?api=1&query=' + encodeURIComponent(w.maps);

        const modal = document.getElementById('modalWisata');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function tutupDetailWisata() {
        const modal = document.getElementById('modalWisata');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = '';
    }

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') tutupDetailWisata();
    });
</script>
@endpush

@endsection