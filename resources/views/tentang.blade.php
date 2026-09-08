@extends('layouts.app')
@section('title', 'Tentang Subang')

@section('content')

{{-- Hero --}}
<section class="relative bg-green-700 py-16 overflow-hidden">
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1596422846543-75c6fc197f07?w=1400&q=70"
             alt="Subang" class="w-full h-full object-cover opacity-20">
    </div>
    <div class="absolute inset-0 bg-green-800/50"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <p class="text-green-300 text-xs font-semibold uppercase tracking-widest mb-3">Profil Daerah</p>
        <h1 class="text-3xl sm:text-4xl font-bold text-white mb-3">Tentang Kota Subang</h1>
        <p class="text-green-100/80 max-w-xl mx-auto text-sm leading-relaxed">
            Mengenal lebih dekat Kabupaten Subang — sejarah, geografi, visi misi, dan semangat membangun bersama.
        </p>
    </div>
</section>

{{-- Profil --}}
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
        <div>
            <p class="text-green-600 text-xs font-semibold uppercase tracking-widest mb-2">Kabupaten Subang</p>
            <h2 class="text-2xl font-bold text-gray-900 mb-5">Profil Wilayah</h2>
            <p class="text-gray-600 text-sm leading-relaxed mb-4">
                Kabupaten Subang adalah salah satu kabupaten di Provinsi Jawa Barat, Indonesia. Berbatasan dengan
                Kabupaten Indramayu di utara, Kabupaten Sumedang di timur, Kabupaten Bandung Barat dan Purwakarta
                di selatan, serta Kabupaten Karawang di barat.
            </p>
            <p class="text-gray-600 text-sm leading-relaxed mb-8">
                Dengan luas wilayah ±2.051 km² dan jumlah penduduk lebih dari 1,6 juta jiwa, Kabupaten Subang
                memiliki potensi besar di sektor pertanian, pariwisata alam, dan industri manufaktur.
            </p>

            <div class="grid grid-cols-2 gap-3">
                @foreach([
                    ['🏛️','Ibu Kota','Subang'],
                    ['📐','Luas Wilayah','2.051 km²'],
                    ['👥','Penduduk','1,6 Juta Jiwa'],
                    ['🗺️','Kecamatan','30 Kecamatan'],
                    ['🌾','Produk Unggulan','Nanas & Padi'],
                    ['🏔️','Ketinggian','0–1.800 mdpl'],
                ] as [$ic,$lbl,$val])
                <div class="bg-gray-50 border border-gray-100 rounded-xl p-4 hover:border-green-200 hover:bg-green-50 transition-colors">
                    <div class="text-xl mb-1.5">{{ $ic }}</div>
                    <div class="font-semibold text-gray-800 text-sm">{{ $val }}</div>
                    <div class="text-xs text-gray-500 mt-0.5">{{ $lbl }}</div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="space-y-4">
            {{-- Peta --}}
            <div class="rounded-2xl overflow-hidden border border-gray-100 shadow-sm">
                <div id="tentang-map" style="height:320px;"></div>
            </div>
            {{-- Foto --}}
            <div class="grid grid-cols-2 gap-3">
                <img src="https://images.unsplash.com/photo-1587474260584-136574528ed5?w=400&q=80"
                     alt="Subang" class="w-full h-36 object-cover rounded-xl">
                <img src="https://images.unsplash.com/photo-1534067783941-51c9c23ecefd?w=400&q=80"
                     alt="Subang" class="w-full h-36 object-cover rounded-xl">
            </div>
        </div>
    </div>
</section>

{{-- Visi Misi --}}
<section class="bg-gray-50 py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <p class="text-green-600 text-xs font-semibold uppercase tracking-widest mb-2">Pemerintah Kabupaten Subang</p>
            <h2 class="text-2xl font-bold text-gray-900">Visi & Misi</h2>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white rounded-2xl p-8 border border-gray-100 shadow-sm">
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mb-5">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                </div>
                <h3 class="font-bold text-gray-900 text-lg mb-3">Visi</h3>
                <p class="text-gray-600 text-sm leading-relaxed italic border-l-3 border-green-400 pl-4 border-l-4">
                    "Terwujudnya Kabupaten Subang yang Mandiri, Maju, dan Sejahtera Berbasis Agribisnis yang Berdaya Saing."
                </p>
            </div>
            <div class="bg-white rounded-2xl p-8 border border-gray-100 shadow-sm">
                <div class="w-12 h-12 bg-teal-100 rounded-xl flex items-center justify-center mb-5">
                    <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                </div>
                <h3 class="font-bold text-gray-900 text-lg mb-4">Misi</h3>
                <ul class="space-y-2.5">
                    @foreach([
                        'Meningkatkan kualitas SDM yang beriman, bertaqwa, dan berbudaya.',
                        'Meningkatkan infrastruktur dan fasilitas pelayanan publik yang merata.',
                        'Mengembangkan ekonomi berbasis agribisnis dan pariwisata.',
                        'Meningkatkan tata kelola pemerintahan yang bersih dan transparan.',
                        'Menjaga kelestarian lingkungan hidup untuk pembangunan berkelanjutan.',
                    ] as $i => $m)
                    <li class="flex gap-3 text-sm text-gray-600">
                        <span class="w-5 h-5 bg-green-100 text-green-700 rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0 mt-0.5">{{ $i+1 }}</span>
                        <span class="leading-relaxed">{{ $m }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- Tentang SAPAsubang --}}
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
    <div class="text-center mb-10">
        <p class="text-green-600 text-xs font-semibold uppercase tracking-widest mb-2">Platform Digital</p>
        <h2 class="text-2xl font-bold text-gray-900">Tentang SAPAsubang</h2>
        <p class="text-gray-500 text-sm mt-2 max-w-xl mx-auto">
            Sistem Aduan & Pelaporan Aspirasi Subang adalah platform digital resmi Kabupaten Subang
            untuk pelaporan dan penanganan masalah fasilitas umum.
        </p>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        @foreach([
            ['icon'=>'<svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>','title'=>'Mudah Digunakan','desc'=>'Cukup foto masalah, sistem otomatis ambil lokasi GPS. Isi kategori dan keterangan, laporan terkirim dalam hitungan menit.'],
            ['icon'=>'<svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>','title'=>'Berbasis Peta','desc'=>'Semua laporan ditampilkan di peta interaktif Kabupaten Subang sehingga mudah dipantau persebarannya.'],
            ['icon'=>'<svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>','title'=>'Notifikasi Langsung','desc'=>'Anda mendapat notifikasi di setiap perubahan status laporan, dari verifikasi hingga selesai ditangani.'],
        ] as $f)
        <div class="bg-white rounded-2xl border border-gray-100 p-7 hover:shadow-md hover:border-green-200 transition-all text-center">
            <div class="w-14 h-14 bg-green-50 rounded-2xl flex items-center justify-center text-green-600 mx-auto mb-4">
                {!! $f['icon'] !!}
            </div>
            <h3 class="font-semibold text-gray-800 mb-2">{{ $f['title'] }}</h3>
            <p class="text-sm text-gray-500 leading-relaxed">{{ $f['desc'] }}</p>
        </div>
        @endforeach
    </div>
</section>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const map = L.map('tentang-map').setView([-6.5744, 107.7599], 10);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {attribution:'© OpenStreetMap'}).addTo(map);
    L.marker([-6.5744, 107.7599]).addTo(map).bindPopup('<b>Kabupaten Subang</b><br>Jawa Barat, Indonesia').openPopup();
});
</script>
@endpush
