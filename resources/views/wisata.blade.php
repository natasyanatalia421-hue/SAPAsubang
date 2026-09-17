@extends('layouts.app')
@section('title', 'Wisata')

@section('content')

{{-- Hero --}}
<section class="relative overflow-hidden" style="min-height:300px;">
    {{-- Slot foto hero — ganti div ini dengan: <img src="/images/wisata-hero.jpg" class="absolute inset-0 w-full h-full object-cover"> --}}
    <div class="absolute inset-0 bg-gradient-to-br from-teal-100 via-green-50 to-emerald-100 flex items-center justify-end pr-12 pointer-events-none">
        <div class="flex flex-col items-center gap-2 opacity-30 select-none">
            <svg class="w-12 h-12 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            <span class="text-xs text-green-400 font-medium">Foto Hero 1400×300px</span>
        </div>
    </div>
    <div class="absolute inset-0 bg-gradient-to-r from-white/95 via-white/80 to-transparent"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
        <p class="text-green-700 font-bold text-sm mb-1 italic">Jelajahi Keindahan</p>
        <h1 class="text-4xl font-extrabold text-gray-900 mb-4">Wisata Kota Subang</h1>
        <p class="text-gray-600 text-sm max-w-md mb-7">Nikmati pesona alam, wisata edukasi, dan destinasi menarik di Kabupaten Subang.</p>
        <a href="{{ route('tentang') }}" class="inline-flex items-center gap-2 bg-green-700 hover:bg-green-800 text-white font-bold px-6 py-3 rounded-full text-sm transition-all">Lihat Sejarah & Budaya →</a>
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
            @foreach([
                ['nama'=>'Curug Cijalu',       'cat'=>'Wisata Alam',    'desc'=>'Air terjun alami yang memukau di tengah hutan Subang.'],
                ['nama'=>'Kebun Teh Ciater',   'cat'=>'Agrowisata',     'desc'=>'Hamparan kebun teh hijau yang menyejukkan mata.'],
                ['nama'=>'Pantai Pondok Bali', 'cat'=>'Wisata Pantai',  'desc'=>'Pantai dengan pemandangan laut yang indah di utara Subang.'],
                ['nama'=>'Kawah Ciater',        'cat'=>'Wisata Alam',    'desc'=>'Pemandian air panas alami dari sumber belerang.'],
                ['nama'=>'Taman Anggur',        'cat'=>'Wisata Edukasi', 'desc'=>'Perkebunan anggur sebagai destinasi edukasi keluarga.'],
                ['nama'=>'Sari Ater Resort',    'cat'=>'Wisata Keluarga','desc'=>'Resort pemandian air panas keluarga paling populer.'],
                ['nama'=>'Museum Subang',       'cat'=>'Wisata Sejarah', 'desc'=>'Menyimpan koleksi sejarah perjuangan rakyat Subang.'],
                ['nama'=>'Hutan Pinus Cikole',  'cat'=>'Wisata Alam',    'desc'=>'Hutan pinus yang sejuk cocok untuk berkemah dan piknik.'],
            ] as $w)
            <div class="group bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-lg transition-all hover:-translate-y-0.5">
                {{-- Slot foto wisata — ganti div ini dengan <img src="/images/wisata/xxx.jpg" class="w-full h-full object-cover"> --}}
                <div class="relative aspect-video bg-gray-100 flex flex-col items-center justify-center gap-1 border-b border-dashed border-gray-200">
                    <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span class="text-[10px] text-gray-400">400×225px</span>
                    <div class="absolute bottom-2 left-2">
                        <span class="text-[10px] font-bold text-white bg-green-600/90 px-2 py-0.5 rounded-full">{{ $w['cat'] }}</span>
                    </div>
                </div>
                <div class="p-4">
                    <h3 class="font-bold text-gray-800 text-sm mb-1 group-hover:text-green-700 transition-colors">{{ $w['nama'] }}</h3>
                    <p class="text-xs text-gray-500 leading-snug">{{ $w['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
