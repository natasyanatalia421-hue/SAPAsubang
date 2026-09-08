@extends('layouts.app')
@section('title', 'Berita')

@section('content')

{{-- Hero --}}
<section class="relative bg-green-700 py-14 overflow-hidden">
    <div class="absolute inset-0 opacity-20">
        <img src="https://images.unsplash.com/photo-1504711434969-e33886168f5c?w=1400&q=60" class="w-full h-full object-cover">
    </div>
    <div class="absolute inset-0 bg-green-800/60"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <p class="text-green-300 text-sm font-semibold uppercase tracking-widest mb-2">SAPAsubang</p>
        <h1 class="text-3xl font-bold text-white mb-2">Berita Kota Subang</h1>
        <p class="text-green-100/80 text-sm">Informasi dan kabar terkini seputar pembangunan dan lingkungan Kota Subang</p>
    </div>
</section>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    {{-- Featured --}}
    @if(isset($berita[0]))
    <a href="{{ route('berita.show', $berita[0]['slug']) }}"
       class="group block mb-10 rounded-2xl overflow-hidden border border-gray-100 hover:shadow-xl transition-all duration-300 hover:-translate-y-1 bg-white">
        <div class="grid grid-cols-1 lg:grid-cols-2">
            <div class="relative aspect-video lg:aspect-auto min-h-[260px] overflow-hidden">
                <img src="{{ $berita[0]['foto'] }}" alt="{{ $berita[0]['judul'] }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                <div class="absolute inset-0 bg-gradient-to-r from-black/20 to-transparent"></div>
                <span class="absolute top-4 left-4 text-xs font-bold text-white bg-green-600 px-3 py-1.5 rounded-full shadow">
                    {{ $berita[0]['kategori'] }} · Terbaru
                </span>
            </div>
            <div class="p-8 lg:p-10 flex flex-col justify-center">
                <h2 class="text-xl lg:text-2xl font-bold text-gray-900 mb-3 leading-snug group-hover:text-green-700 transition-colors">
                    {{ $berita[0]['judul'] }}
                </h2>
                <p class="text-gray-500 text-sm leading-relaxed mb-5">{{ $berita[0]['ringkasan'] }}</p>
                <div class="flex items-center justify-between">
                    <span class="text-xs text-gray-400">{{ $berita[0]['tanggal'] }}</span>
                    <span class="text-sm text-green-600 font-semibold group-hover:underline">Baca Selengkapnya →</span>
                </div>
            </div>
        </div>
    </a>
    @endif

    {{-- Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach(array_slice($berita, 1) as $b)
        <a href="{{ route('berita.show', $b['slug']) }}"
           class="group bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
            <div class="relative aspect-video overflow-hidden bg-gradient-to-br {{ $b['gradient'] }}">
                <img src="{{ $b['foto'] }}" alt="{{ $b['judul'] }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                <span class="absolute top-3 left-3 text-xs font-semibold text-white bg-green-600 px-2.5 py-1 rounded-full shadow-sm">{{ $b['kategori'] }}</span>
            </div>
            <div class="p-5">
                <h3 class="font-semibold text-gray-800 text-sm leading-snug mb-2 line-clamp-2 group-hover:text-green-700 transition-colors">{{ $b['judul'] }}</h3>
                <p class="text-xs text-gray-500 line-clamp-2 leading-relaxed mb-3">{{ $b['ringkasan'] }}</p>
                <div class="flex items-center justify-between pt-2 border-t border-gray-50">
                    <span class="text-xs text-gray-400">{{ $b['tanggal'] }}</span>
                    <span class="text-xs text-green-600 font-medium">Baca →</span>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</section>

@endsection
