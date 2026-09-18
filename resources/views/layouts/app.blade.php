<!DOCTYPE html>
<html lang="id" x-data="{ mobileMenu: false, searchOpen: false }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Beranda') — Kota Subang</title>
    @vite(['resources/css/app.css'  , 'resources/js/app.js'])
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        [x-cloak]{display:none!important}
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .line-clamp-2{display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
        .line-clamp-3{display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden}
    </style>
</head>
<body class="bg-white text-gray-800 antialiased">

{{-- Toast --}}
@if(session('success'))
<div x-data="{s:true}" x-show="s" x-init="setTimeout(()=>s=false,4000)" x-transition
     class="fixed top-5 right-5 z-[60] bg-green-600 text-white text-sm px-4 py-3 rounded-xl shadow-xl flex items-center gap-3 max-w-xs">
    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
    <span>{{ session('success') }}</span>
    <button @click="s=false" class="ml-auto">✕</button>
</div>
@endif
@if(session('error'))
<div x-data="{s:true}" x-show="s" x-init="setTimeout(()=>s=false,5000)" x-transition
     class="fixed top-5 right-5 z-[60] bg-red-600 text-white text-sm px-4 py-3 rounded-xl shadow-xl flex items-center gap-3 max-w-xs">
    <span>{{ session('error') }}</span>
    <button @click="s=false" class="ml-auto">✕</button>
</div>
@endif

{{-- HEADER --}}
<header class="bg-white shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center h-16 gap-4">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3 flex-shrink-0">
                {{-- Logo resmi Kabupaten Subang --}}
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQI0C7APY1RPu0BH5O4dpR3vVgHiZuHWxEYmLiaDN4HXQ&s=10"
                     alt="Logo Kabupaten Subang"
                     class="w-12 h-12 flex-shrink-0 object-contain drop-shadow-sm"
                     onerror="this.src='https://ui-avatars.com/api/?name=Subang&background=15803d&color=fff&bold=true'">
                <div class="leading-tight">
                    <div class="font-extrabold text-green-800 text-base leading-none tracking-wide">KOTA SUBANG</div>
                    <div class="text-[10px] text-gray-500 leading-none mt-0.5">Website Resmi Pemerintah Kota Subang</div>
                </div>
            </a>

            {{-- Nav Desktop --}}
            <nav class="hidden md:flex items-center gap-0 flex-1 justify-center">
                <a href="{{ route('home') }}"
                   class="flex items-center gap-1.5 px-3 py-2 text-sm font-semibold transition-colors
                          {{ request()->routeIs('home') ? 'text-green-700 border-b-2 border-yellow-400' : 'text-gray-600 hover:text-green-700' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Beranda
                </a>
                <a href="{{ route('tentang') }}"
                   class="flex items-center gap-1.5 px-3 py-2 text-sm font-semibold transition-colors
                          {{ request()->routeIs('tentang') ? 'text-green-700 border-b-2 border-yellow-400' : 'text-gray-600 hover:text-green-700' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    Sejarah & Budaya
                </a>
                <a href="{{ route('wisata') }}"
                   class="flex items-center gap-1.5 px-3 py-2 text-sm font-semibold transition-colors
                          {{ request()->routeIs('wisata') ? 'text-green-700 border-b-2 border-yellow-400' : 'text-gray-600 hover:text-green-700' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/></svg>
                    Wisata
                </a>
                <a href="{{ route('berita') }}"
                   class="flex items-center gap-1.5 px-3 py-2 text-sm font-semibold transition-colors
                          {{ request()->routeIs('berita*') ? 'text-green-700 border-b-2 border-yellow-400' : 'text-gray-600 hover:text-green-700' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    Berita
                </a>
                <a href="{{ route('laporan.publik') }}"
                   class="flex items-center gap-1.5 px-3 py-2 text-sm font-semibold transition-colors
                          {{ request()->routeIs('laporan.publik') ? 'text-green-700 border-b-2 border-yellow-400' : 'text-gray-600 hover:text-green-700' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    Laporan
                </a>
            </nav>

            {{-- Kanan: auth saja (search & cuaca dihapus) --}}
            <div class="hidden md:flex items-center gap-2 ml-auto">
                @auth
                <div x-data="{open:false}" class="relative">
                    <button @click="open=!open" class="flex items-center gap-2 px-3 py-1.5 rounded-xl border border-gray-200 hover:border-green-300 hover:bg-green-50 transition-all text-sm">
                        <div class="w-6 h-6 rounded-full bg-green-700 text-white flex items-center justify-center font-bold text-xs">{{ strtoupper(substr(auth()->user()->name,0,1)) }}</div>
                        <span class="text-gray-700 font-medium max-w-[80px] truncate">{{ auth()->user()->name }}</span>
                        <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="open" @click.outside="open=false" x-cloak
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="opacity-0 translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="absolute right-0 top-full mt-2 w-52 bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden z-50 py-1">
                        <div class="px-4 py-3 bg-green-50 border-b border-green-100">
                            <p class="text-xs font-semibold text-gray-800 truncate">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-500 truncate mt-0.5">{{ auth()->user()->email }}</p>
                        </div>
                        <div class="py-1">
                            @if(auth()->user()->role==='admin')
                            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50">📊 Dashboard Admin</a>
                            @elseif(auth()->user()->role==='petugas')
                            <a href="{{ route('petugas.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50">🗺️ Dashboard Petugas</a>
                            @else
                            <a href="{{ route('user.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50">🏠 Dashboard Saya</a>
                            <a href="{{ route('user.reports.create') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50">📝 Buat Laporan</a>
                            @endif
                            <a href="{{ route('notifications.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50">
                                🔔 Notifikasi
                                <span id="notif-badge" class="ml-auto bg-red-500 text-white text-[10px] rounded-full px-1.5 py-0.5 hidden"></span>
                            </a>
                        </div>
                        <div class="border-t border-gray-100">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50">🚪 Keluar</button>
                            </form>
                        </div>
                    </div>
                </div>
                @else
                <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-semibold text-green-700 border border-green-200 hover:bg-green-50 rounded-xl transition-colors">Masuk</a>
                <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-semibold text-white bg-green-700 hover:bg-green-800 rounded-xl transition-colors shadow-sm">Daftar</a>
                @endauth
            </div>

            {{-- Mobile toggle --}}
            <button @click="mobileMenu=!mobileMenu" class="md:hidden ml-auto p-2 rounded-lg text-gray-600 hover:bg-gray-100">
                <svg x-show="!mobileMenu" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                <svg x-show="mobileMenu" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

    </div>

    {{-- Mobile menu --}}
    <div x-show="mobileMenu" x-cloak x-transition class="md:hidden border-t border-gray-100 bg-white px-4 py-3 space-y-1">
        <a href="{{ route('home') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-green-50 hover:text-green-700">🏠 Beranda</a>
        <a href="{{ route('tentang') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-green-50 hover:text-green-700">📖 Sejarah & Budaya</a>
        <a href="{{ route('berita') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-green-50 hover:text-green-700">📰 Berita</a>
        <a href="{{ route('laporan.publik') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-green-50 hover:text-green-700">📋 Laporan</a>
        <div class="pt-2 border-t border-gray-100 flex gap-2">
            @auth
            <a href="{{ route('user.dashboard') }}" class="flex-1 text-center py-2 text-sm border border-gray-200 rounded-xl text-gray-700">Dashboard</a>
            <form method="POST" action="{{ route('logout') }}" class="flex-1">@csrf<button class="w-full py-2 text-sm text-red-600 border border-red-100 rounded-xl">Keluar</button></form>
            @else
            <a href="{{ route('login') }}" class="flex-1 text-center py-2 text-sm border border-green-200 rounded-xl text-green-700 font-medium">Masuk</a>
            <a href="{{ route('register') }}" class="flex-1 text-center py-2 text-sm bg-green-700 text-white rounded-xl font-medium">Daftar</a>
            @endauth
        </div>
    </div>
</header>

<main>@yield('content')</main>

{{-- FOOTER --}}
<footer class="bg-green-900 text-green-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 pb-8 border-b border-green-800">

            {{-- Kolom 1: Logo + alamat --}}
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 rounded-full bg-white flex items-center justify-center flex-shrink-0 overflow-hidden">
                        <img src="{{ asset('images/logo-subang.png') }}" alt="Logo" class="w-10 h-10 object-contain"
                             onerror="this.parentElement.innerHTML='<svg viewBox=\'0 0 40 40\' class=\'w-8 h-8\'><circle cx=\'20\' cy=\'20\' r=\'18\' fill=\'#1a6b2f\'/><path d=\'M20 6 L22 14 L30 14 L24 19 L26 27 L20 22 L14 27 L16 19 L10 14 L18 14 Z\' fill=\'#f5c518\'/></svg>'">
                    </div>
                    <div>
                        <div class="text-white font-extrabold text-sm leading-none">KOTA SUBANG</div>
                        <div class="text-green-300 text-[10px] mt-0.5">Website Resmi Pemerintah Kota Subang</div>
                    </div>
                </div>
                <ul class="space-y-1.5 text-xs text-green-200/80">
                    <li class="flex gap-2 items-start"><span class="flex-shrink-0">📍</span> Kabupaten Subang, Jawa Barat</li>
                    <li class="flex gap-2 items-start"><span class="flex-shrink-0">📞</span> (0260) 411xxxx</li>
                    <li class="flex gap-2 items-start"><span class="flex-shrink-0">✉</span> layanan@kotasubang.go.id</li>
                </ul>
            </div>

            {{-- Kolom 2: Sosial media resmi (link nyata) --}}
            <div>
                <h4 class="text-white font-bold mb-4 text-sm">Kanal Informasi Resmi</h4>
                <ul class="space-y-2.5 text-xs">

                    <li>
                        <a href="https://www.instagram.com/kotasubang/" target="_blank" rel="noopener"
                           class="flex items-center gap-2.5 text-green-200/80 hover:text-white transition-colors group">
                            <span class="w-6 h-6 rounded-lg flex items-center justify-center flex-shrink-0 shadow-sm group-hover:scale-110 transition-transform"
                                  style="background:linear-gradient(45deg,#f09433,#e6683c,#dc2743,#cc2366,#bc1888)">
                                <svg class="w-3.5 h-3.5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                            </span>
                            @kotasubang
                        </a>
                    </li>

                    <li>
                        <a href="https://www.facebook.com/ForumSubang/" target="_blank" rel="noopener"
                           class="flex items-center gap-2.5 text-green-200/80 hover:text-white transition-colors group">
                            <span class="w-6 h-6 bg-blue-600 rounded-lg flex items-center justify-center flex-shrink-0 shadow-sm group-hover:scale-110 transition-transform">
                                <svg class="w-3.5 h-3.5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            </span>
                            Pemerintah Kota Subang
                        </a>
                    </li>

                    <li>
                        <a href="https://www.youtube.com/@kota_subang" target="_blank" rel="noopener"
                           class="flex items-center gap-2.5 text-green-200/80 hover:text-white transition-colors group">
                            <span class="w-6 h-6 bg-red-600 rounded-lg flex items-center justify-center flex-shrink-0 shadow-sm group-hover:scale-110 transition-transform">
                                <svg class="w-3.5 h-3.5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                            </span>
                            Kota Subang
                        </a>
                    </li>

                    <li>
                        <a href="https://www.tiktok.com/@kota_subang" target="_blank" rel="noopener"
                           class="flex items-center gap-2.5 text-green-200/80 hover:text-white transition-colors group">
                            <span class="w-6 h-6 bg-gray-900 border border-gray-600 rounded-lg flex items-center justify-center flex-shrink-0 shadow-sm group-hover:scale-110 transition-transform">
                                <svg class="w-3.5 h-3.5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg>
                            </span>
                            @kota_subang
                        </a>
                    </li>

                </ul>
            </div>

            {{-- Kolom 4: Tentang SAPAsubang --}}
            <div>
                <h4 class="text-white font-bold mb-4 text-sm">SAPAsubang</h4>
                <p class="text-xs text-green-200/70 leading-relaxed">Sistem Aduan & Pelaporan Aspirasi Subang. Laporkan masalah fasilitas umum Kota Subang dengan mudah dan cepat.</p>
                <div class="mt-4 space-y-1.5 text-xs text-green-200/70">
                    <a href="{{ route('laporan.publik') }}" class="flex items-center gap-2 hover:text-white transition-colors">→ Buat Laporan</a>
                    <a href="{{ route('panduan') }}" class="flex items-center gap-2 hover:text-white transition-colors">→ Panduan Pelaporan</a>
                    <a href="{{ route('berita') }}" class="flex items-center gap-2 hover:text-white transition-colors">→ Berita Terkini</a>
                </div>
            </div>

        </div>

        {{-- Bottom bar --}}
        <div class="pt-5 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-green-300/70">
            <span>© {{ date('Y') }} Pemerintah Kabupaten Subang. All rights reserved.</span>
            <span>SAPAsubang — Sistem Aduan & Pelaporan Aspirasi Subang</span>
        </div>
    </div>
</footer>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
@auth
<script>
async function refreshBadge(){
    try{
        const d=await(await fetch('{{ route('notifications.unread') }}')).json();
        const b=document.getElementById('notif-badge');
        if(b){d.count>0?b.classList.remove('hidden'):b.classList.add('hidden');}
    }catch{}
}
refreshBadge();setInterval(refreshBadge,30000);
</script>
@endauth
@stack('scripts')
</body>
</html>
