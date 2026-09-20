@extends('layouts.app')
@section('title', 'Panduan SAPAsubang')

@section('content')

{{-- ══ HEADER POSTER ══ --}}
<section class="bg-gradient-to-r from-green-700 via-green-600 to-green-500 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
            {{-- Kiri: Logo + tagline --}}
            <div class="flex items-center gap-4">
                <div class="flex-shrink-0">
                    <div class="flex items-center gap-2">
                        <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center">
                            <img src="{{ asset('images/logo-subang.png') }}" alt="Logo" class="w-8 h-8 object-contain"
                                 onerror="this.parentElement.innerHTML='<svg viewBox=\'0 0 40 40\' class=\'w-8 h-8\'><circle cx=\'20\' cy=\'20\' r=\'18\' fill=\'#1a6b2f\'/><path d=\'M20 6 L22 14 L30 14 L24 19 L26 27 L20 22 L14 27 L16 19 L10 14 L18 14 Z\' fill=\'#f5c518\'/></svg>'">
                        </div>
                        <div>
                            <div class="font-black text-xl leading-none">SAPA<span class="font-light">subang</span></div>
                            <div class="text-green-200 text-xs">Lapor · Peduli · Subang Maju</div>
                        </div>
                    </div>
                </div>
                <div class="hidden sm:block border-l border-white/30 pl-4">
                    <p class="font-bold text-sm">Satu Platform, Banyak Perubahan</p>
                    <p class="text-green-100 text-xs">Laporkan masalah di Kota Subang, untuk kota yang lebih baik dan berkelanjutan.</p>
                </div>
            </div>
            {{-- Kanan: Logo Kota Subang --}}
            <div class="flex items-center gap-3 bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl px-4 py-3">
                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center">
                    <img src="{{ asset('images/logo-subang.png') }}" alt="Kota Subang" class="w-8 h-8 object-contain"
                         onerror="this.parentElement.innerHTML='<svg viewBox=\'0 0 40 40\' class=\'w-8 h-8\'><circle cx=\'20\' cy=\'20\' r=\'18\' fill=\'#1a6b2f\'/><path d=\'M20 6 L22 14 L30 14 L24 19 L26 27 L20 22 L14 27 L16 19 L10 14 L18 14 Z\' fill=\'#f5c518\'/></svg>'">
                </div>
                <div>
                    <div class="font-black text-sm leading-none">KOTA SUBANG</div>
                    <div class="text-green-200 text-xs">Menuju Kota Berkelanjutan</div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══ ALUR UTAMA: LANGKAH 1–5 ══ --}}
<section class="bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-5 gap-4">
            @php
            $langkah15 = [
                [
                    'no'=>1,'title'=>'Buka Website SAPAsubang',
                    'desc'=>'Buka website SAPAsubang melalui browser pada perangkat Anda. Tampilan beranda yang jelas dan mudah dipahami.',
                    'content'=>'website',
                ],
                [
                    'no'=>2,'title'=>'Halaman Laporan',
                    'desc'=>'Masuk ke menu Laporan untuk melihat semua laporan yang telah masuk.',
                    'content'=>'laporan',
                ],
                [
                    'no'=>3,'title'=>'Pilih Lokasi di Peta',
                    'desc'=>'Pilih lokasi kejadian pada peta Kota Subang. Pastikan lokasi sesuai dengan titik masalah yang akan dilaporkan.',
                    'content'=>'peta',
                ],
                [
                    'no'=>4,'title'=>'Klik "Buat Laporan"',
                    'desc'=>'Setelah menemukan titik lokasi, klik tombol "Buat Laporan" untuk memulai proses pelaporan.',
                    'content'=>'buat',
                ],
                [
                    'no'=>5,'title'=>'Halaman Login',
                    'desc'=>'User diarahkan ke halaman login. Jika belum punya akun, silakan registrasi terlebih dahulu.',
                    'content'=>'login',
                ],
            ];
            @endphp

            @foreach($langkah15 as $i => $l)
            <div class="relative">
                {{-- Panah penghubung --}}
                @if($i < 4)
                <div class="hidden sm:flex absolute -right-2 top-16 z-10 w-4 h-4 items-center justify-center">
                    <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
                </div>
                @endif

                <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm h-full">
                    {{-- Nomor step --}}
                    <div class="bg-green-700 text-white px-4 py-2 flex items-center gap-2">
                        <div class="w-6 h-6 bg-white text-green-700 rounded-full flex items-center justify-center text-xs font-black">{{ $l['no'] }}</div>
                        <span class="text-xs font-bold">{{ $l['title'] }}</span>
                    </div>

                    {{-- Mock screenshot --}}
                    <div class="bg-gray-100 mx-3 mt-3 rounded-xl overflow-hidden border border-dashed border-gray-300" style="height:140px;">
                        @if($l['content'] === 'website')
                        <div class="h-full flex flex-col">
                            <div class="bg-green-700 px-2 py-1 flex items-center gap-1">
                                <div class="w-1.5 h-1.5 bg-red-400 rounded-full"></div>
                                <div class="w-1.5 h-1.5 bg-yellow-400 rounded-full"></div>
                                <div class="w-1.5 h-1.5 bg-green-400 rounded-full"></div>
                                <div class="flex-1 bg-white/20 rounded mx-2 px-2 text-[8px] text-white/70">sapasubang.go.id</div>
                            </div>
                            <div class="flex-1 bg-gradient-to-br from-green-600 to-green-400 p-2 flex flex-col justify-between">
                                <div class="text-white font-bold text-xs">Lapor Masalah<br>Kota Subang</div>
                                <div>
                                    <div class="bg-yellow-400 text-yellow-900 text-[8px] font-bold px-2 py-1 rounded-full w-fit mb-1">+ Buat Laporan Sekarang</div>
                                    <div class="flex gap-2 text-[7px] text-white/80">
                                        <span>1.246</span><span>892</span><span>213</span><span>143</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @elseif($l['content'] === 'laporan')
                        <div class="h-full flex flex-col p-2 gap-1.5">
                            <div class="text-[9px] font-bold text-gray-700">Laporan & Pengaduan</div>
                            @foreach([
                                ['bi-cone-striped','Jalan Rusak di Jl. Raya Subang'],
                                ['bi-trash3-fill','Tumpukan Sampah di Pasar'],
                                ['bi-lightbulb-fill','Lampu Jalan Mati di Perumahan'],
                            ] as [$ic, $item])
                            <div class="flex items-center gap-1.5 bg-gray-50 rounded-lg p-1.5 border border-gray-200">
                                <div class="w-8 h-6 bg-gray-200 rounded flex-shrink-0 flex items-center justify-center text-[11px] text-gray-600">
                                    <i class="bi {{ $ic }}"></i>
                                </div>
                                <div>
                                    <div class="text-[7px] font-semibold text-gray-700 leading-tight">{{ $item }}</div>
                                    <div class="text-[6px] text-green-600">Dalam Proses</div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @elseif($l['content'] === 'peta')
                        <div class="h-full bg-green-50 flex flex-col items-center justify-center gap-1 p-2">
                            <div class="text-[9px] font-bold text-gray-700 mb-1">Peta Sebaran Laporan</div>
                            <div class="w-full flex-1 bg-green-100 rounded-lg border border-green-200 flex items-center justify-center">
                                <svg class="w-8 h-8 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
                            </div>
                        </div>
                        @elseif($l['content'] === 'buat')
                        <div class="h-full flex flex-col items-center justify-center gap-2 p-3">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                            </div>
                            <div class="text-[9px] text-gray-600 text-center">Lokasi telah dipilih<br><span class="font-mono text-green-700">-6.580123, 107.760887</span></div>
                            <div class="bg-green-600 text-white text-[9px] font-bold px-3 py-1.5 rounded-full">+ Buat Laporan</div>
                        </div>
                        @else
                        <div class="h-full flex flex-col p-2">
                            <div class="text-[9px] font-bold text-gray-700 mb-2">Login ke Akun Anda</div>
                            <div class="space-y-1.5">
                                <div class="bg-gray-100 rounded border border-gray-200 px-2 py-1 text-[8px] text-gray-400">Email atau Nomor HP</div>
                                <div class="bg-gray-100 rounded border border-gray-200 px-2 py-1 text-[8px] text-gray-400">Password</div>
                                <div class="bg-green-600 text-white text-center text-[8px] font-bold py-1.5 rounded">Login</div>
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="p-3 pb-4">
                        <p class="text-[11px] text-gray-500 leading-relaxed">{{ $l['desc'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══ ALUR PELAPORAN: LANGKAH 6–10 ══ --}}
<section class="bg-white py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-5 gap-4">
            @php
            $langkah610 = [
                ['no'=>6,'title'=>'Ambil Foto Masalah','desc'=>'Setelah login, kamera terbuka otomatis untuk memfoto masalah yang ditemukan di lokasi tersebut.','icon'=>'bi-camera-fill','bg'=>'bg-gray-800','color'=>'text-white'],
                ['no'=>7,'title'=>'Lokasi Otomatis','desc'=>'Sistem secara otomatis mengambil lokasi GPS saat foto diambil.','icon'=>'bi-geo-alt-fill','bg'=>'bg-blue-50','color'=>'text-blue-600'],
                ['no'=>8,'title'=>'Pilih Kategori & Keterangan','desc'=>'Pilih kategori masalah dan tambahkan keterangan (opsional), lalu kirim laporan.','icon'=>'bi-tag-fill','bg'=>'bg-gray-50','color'=>'text-gray-600'],
                ['no'=>9,'title'=>'Cek Laporan Serupa','desc'=>'Jika tidak ada laporan serupa, sistem akan langsung membuat laporan baru.','icon'=>'bi-search','bg'=>'bg-amber-50','color'=>'text-amber-600'],
                ['no'=>10,'title'=>'Laporan Masuk ke Admin','desc'=>'Laporan akan diterima admin untuk diverifikasi. Anda dapat memantau statusnya melalui menu Laporan.','icon'=>'bi-check-circle-fill','bg'=>'bg-green-50','color'=>'text-green-600'],
            ];
            @endphp
            @foreach($langkah610 as $i => $l)
            <div class="relative">
                @if($i < 4)
                <div class="hidden sm:flex absolute -right-2 top-16 z-10">
                    <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
                </div>
                @endif
                <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm h-full">
                    <div class="bg-green-700 text-white px-4 py-2 flex items-center gap-2">
                        <div class="w-6 h-6 bg-white text-green-700 rounded-full flex items-center justify-center text-xs font-black">{{ $l['no'] }}</div>
                        <span class="text-xs font-bold">{{ $l['title'] }}</span>
                    </div>
                    <div class="{{ $l['bg'] }} mx-3 mt-3 rounded-xl flex flex-col items-center justify-center gap-2 border border-dashed border-gray-300" style="height:140px;">
                        <i class="bi {{ $l['icon'] }} text-4xl {{ $l['color'] }}"></i>
                        <span class="text-xs text-gray-400 font-medium">Langkah {{ $l['no'] }}</span>
                    </div>
                    <div class="p-3 pb-4">
                        <p class="text-[11px] text-gray-500 leading-relaxed">{{ $l['desc'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══ ALUR PENANGANAN: LANGKAH 11–16 ══ --}}
<section class="bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-6 gap-4">
            @php
            $langkah1116 = [
                ['no'=>11,'title'=>'Tentukan Prioritas','desc'=>'Tentukan tingkat prioritas laporan ini berdasarkan kondisi dan dampaknya.','icon'=>'bi-bullseye'],
                ['no'=>12,'title'=>'Pilih Petugas Terdekat','desc'=>'Sistem menampilkan petugas terdekat berdasarkan lokasi. Admin menugaskan petugas yang tersedia.','icon'=>'bi-person-badge-fill'],
                ['no'=>13,'title'=>'Petugas Terima Tugas','desc'=>'Petugas menerima tugas dan menuju lokasi.','icon'=>'bi-car-front-fill'],
                ['no'=>14,'title'=>'Tangani Masalah','desc'=>'Petugas menyelesaikan masalah dan mengirim bukti foto.','icon'=>'bi-wrench-adjustable'],
                ['no'=>15,'title'=>'Admin Periksa & Konfirmasi','desc'=>'Admin memeriksa bukti, jika sesuai, konfirmasi laporan selesai.','icon'=>'bi-patch-check-fill'],
                ['no'=>16,'title'=>'Laporan Selesai & Notifikasi','desc'=>'Pelapor dan pendukung mendapat notifikasi. User dapat melihat detail penyelesaian.','icon'=>'bi-bell-fill'],
            ];
            @endphp
            @foreach($langkah1116 as $i => $l)
            <div class="relative">
                @if($i < 5)
                <div class="hidden sm:flex absolute -right-2 top-16 z-10">
                    <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
                </div>
                @endif
                <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm h-full">
                    <div class="bg-green-700 text-white px-3 py-2 flex items-center gap-2">
                        <div class="w-6 h-6 bg-white text-green-700 rounded-full flex items-center justify-center text-xs font-black flex-shrink-0">{{ $l['no'] }}</div>
                        <span class="text-[11px] font-bold leading-tight">{{ $l['title'] }}</span>
                    </div>
                    <div class="bg-gray-50 mx-3 mt-3 rounded-xl flex flex-col items-center justify-center gap-2 border border-dashed border-gray-300" style="height:130px;">
                        <i class="bi {{ $l['icon'] }} text-4xl text-green-600"></i>
                        <span class="text-[10px] text-gray-400 font-medium">Langkah {{ $l['no'] }}</span>
                    </div>
                    <div class="p-3 pb-4">
                        <p class="text-[11px] text-gray-500 leading-relaxed">{{ $l['desc'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══ FOOTER POSTER ══ --}}
<section class="bg-green-800 text-white py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-4 gap-6 items-center">
            {{-- Logo --}}
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center flex-shrink-0">
                    <img src="{{ asset('images/logo-subang.png') }}" alt="Logo" class="w-8 h-8 object-contain"
                         onerror="this.parentElement.innerHTML='<svg viewBox=\'0 0 40 40\' class=\'w-8 h-8\'><circle cx=\'20\' cy=\'20\' r=\'18\' fill=\'#1a6b2f\'/><path d=\'M20 6 L22 14 L30 14 L24 19 L26 27 L20 22 L14 27 L16 19 L10 14 L18 14 Z\' fill=\'#f5c518\'/></svg>'">
                </div>
                <div>
                    <div class="font-black text-lg leading-none">SAPA<span class="font-light">subang</span></div>
                    <div class="text-green-300 text-[11px]">Lapor · Peduli · Subang Maju</div>
                </div>
            </div>
            {{-- Tagline --}}
            <div class="flex items-center gap-2 text-sm font-semibold">
                <i class="bi bi-geo-alt-fill text-xl text-yellow-300"></i> Ayo Laporkan Masalah di Kota Subang
            </div>
            <div class="flex items-center gap-2 text-sm font-semibold">
                <i class="bi bi-people-fill text-xl text-yellow-300"></i> Bersama Kita Wujudkan Subang yang Lebih Baik
            </div>
        </div>
    </div>
</section>

@endsection