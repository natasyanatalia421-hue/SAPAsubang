@extends('layouts.app')
@section('title', $berita['judul'])

@section('content')

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    <nav class="flex items-center gap-2 text-xs text-gray-400 mb-6">
        <a href="{{ route('home') }}" class="hover:text-green-600 transition-colors">Home</a>
        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <a href="{{ route('berita') }}" class="hover:text-green-600 transition-colors">Berita</a>
        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="text-gray-600 truncate max-w-[200px]">{{ $berita['judul'] }}</span>
    </nav>

    <article class="bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm">
        {{-- Hero foto --}}
        <div class="relative aspect-video overflow-hidden">
            <img src="{{ $berita['foto'] }}" alt="{{ $berita['judul'] }}" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
            <div class="absolute bottom-4 left-6">
                <span class="text-xs font-bold text-white bg-green-600 px-3 py-1.5 rounded-full">{{ $berita['kategori'] }}</span>
            </div>
        </div>

        <div class="p-8">
            <div class="flex items-center gap-3 mb-5">
                <span class="text-xs text-gray-400 flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    {{ $berita['tanggal'] }}
                </span>
                <span class="text-gray-200">|</span>
                <span class="text-xs text-gray-400">Redaksi SAPAsubang</span>
            </div>

            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 leading-snug mb-6">{{ $berita['judul'] }}</h1>

            <div class="prose prose-sm max-w-none text-gray-600 leading-relaxed space-y-4 border-t border-gray-100 pt-6">
                {!! nl2br(e($berita['isi'])) !!}
            </div>
        </div>
    </article>

    @if(!empty($lainnya))
    <div class="mt-10">
        <h3 class="font-bold text-gray-800 mb-5">Berita Lainnya</h3>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            @foreach($lainnya as $b)
            <a href="{{ route('berita.show', $b['slug']) }}"
               class="group bg-white rounded-xl border border-gray-100 overflow-hidden hover:shadow-md transition-all duration-200 hover:-translate-y-0.5">
                <div class="aspect-video overflow-hidden">
                    <img src="{{ $b['foto'] }}" alt="{{ $b['judul'] }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                <div class="p-3.5">
                    <span class="text-[11px] text-green-600 font-semibold">{{ $b['kategori'] }}</span>
                    <p class="text-xs font-medium text-gray-700 mt-1 line-clamp-2 group-hover:text-green-700">{{ $b['judul'] }}</p>
                    <p class="text-[11px] text-gray-400 mt-1.5">{{ $b['tanggal'] }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif

    <div class="mt-8">
        <a href="{{ route('berita') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-green-600 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Kembali ke Berita
        </a>
    </div>
</div>

@endsection
