<!DOCTYPE html>
<html lang="id" x-data="{ mobileMenu: false, searchOpen: false }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Beranda') — Kota Subang</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
                <img src="{{ asset('images/logo-subang.png') }}"
                     alt="Logo Kabupaten Subang"
                     class="w-12 h-12 flex-shrink-0 object-contain drop-shadow-sm">
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

            {{-- Kanan: search + cuaca + auth --}}
            <div class="hidden md:flex items-center gap-3 ml-auto">
                {{-- Search inline --}}
                <div class="relative">
                    <input type="text" placeholder="Cari Informasi di Kota Subang..."
                           class="border border-gray-200 rounded-xl px-4 py-2 text-xs w-52 focus:outline-none focus:ring-2 focus:ring-green-500 pl-9 bg-gray-50">
                    <svg class="w-3.5 h-3.5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                {{-- Cuaca --}}
                <div class="flex items-center gap-1.5 text-xs text-gray-600 bg-yellow-50 border border-yellow-200 px-3 py-1.5 rounded-full">
                    <span class="text-lg">☀️</span>
                    <span class="font-semibold">Subang</span>
                    <span class="text-gray-400">28°C</span>
                </div>

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

        {{-- Search bar dropdown --}}
        <div x-show="searchOpen" x-cloak x-transition class="pb-3">
            <div class="relative">
                <input type="text" placeholder="Cari informasi Kota Subang..."
                       class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 pl-10">
                <svg class="w-4 h-4 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
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
                    <div class="w-12 h-12 rounded-full bg-white flex items-center justify-center flex-shrink-0">
                        <svg viewBox="0 0 40 40" class="w-8 h-8"><circle cx="20" cy="20" r="18" fill="#1a6b2f"/><path d="M20 6 L22 14 L30 14 L24 19 L26 27 L20 22 L14 27 L16 19 L10 14 L18 14 Z" fill="#f5c518"/></svg>
                    </div>
                    <div>
                        <div class="text-white font-extrabold text-sm leading-none">KOTA SUBANG</div>
                        <div class="text-green-300 text-[10px] mt-0.5">Website Resmi Pemerintah Kota Subang</div>
                    </div>
                </div>
                <ul class="space-y-1.5 text-xs text-green-200/80">
                    <li class="flex gap-2">📍 Jl. Otista - Sudirman No.1, RT.002/RW.031, Sukarahayu, Kec. Tarogong, Kota Subang, Banten 1811</li>
                    <li class="flex gap-2">📞 (0260) 411xxxx</li>
                    <li class="flex gap-2">✉ layanan@kotasubang.go.id</li>
                </ul>
            </div>

            {{-- Kolom 2: Kanal media sosial --}}
            <div>
                <h4 class="text-white font-bold mb-4 text-sm">Kanal Informasi Resmi Lainnya</h4>
                <ul class="space-y-2 text-xs text-green-200/80">
                    <li class="flex items-center gap-2">
                        <span class="w-5 h-5 bg-pink-500 rounded flex items-center justify-center text-white text-[10px] font-bold flex-shrink-0">IG</span>
                        @subangkota
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="w-5 h-5 bg-blue-600 rounded flex items-center justify-center text-white text-[10px] font-bold flex-shrink-0">fb</span>
                        Pemerintah Kota Subang
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="w-5 h-5 bg-sky-400 rounded flex items-center justify-center text-white text-[10px] font-bold flex-shrink-0">TW</span>
                        @KotaSubang
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="w-5 h-5 bg-red-500 rounded flex items-center justify-center text-white text-[10px] font-bold flex-shrink-0">▶</span>
                        Kota Subang
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="w-5 h-5 bg-gray-600 rounded flex items-center justify-center text-white text-[10px] font-bold flex-shrink-0">TV</span>
                        Tangerang TV
                    </li>
                </ul>
            </div>

            {{-- Kolom 3: Statistik --}}
            <div>
                <h4 class="text-white font-bold mb-4 text-sm">Pengunjung</h4>
                <ul class="space-y-2 text-xs text-green-200/80">
                    <li class="flex justify-between"><span>Pengunjung hari ini</span><span class="text-white font-semibold">{{ rand(100,999) }}</span></li>
                    <li class="flex justify-between"><span>Pengunjung online</span><span class="text-white font-semibold">{{ rand(10,99) }}</span></li>
                    <li class="flex justify-between"><span>Total pengunjung</span><span class="text-white font-semibold">{{ number_format(rand(8000000,12000000)) }}</span></li>
                </ul>
            </div>

            {{-- Kolom 4: Superapp --}}
            <div>
                <h4 class="text-white font-bold mb-4 text-sm">SAPAsubang</h4>
                <p class="text-xs text-green-200/80 mb-3">Sistem Aduan & Pelaporan Aspirasi Subang</p>
                <div class="flex flex-col gap-2">
                    <a href="#" class="flex items-center gap-2 bg-black/30 hover:bg-black/50 border border-green-700 text-white px-3 py-2 rounded-xl transition-colors">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M17.05 20.28c-.98.95-2.05.8-3.08.35-1.09-.46-2.09-.48-3.24 0-1.44.62-2.2.44-3.06-.35C2.79 15.25 3.51 7.7 9.05 7.42c1.27.07 2.13.73 2.87.75.87-.12 1.7-.8 3.04-.75 2.04.13 3.23 1.03 3.96 2.59-3.5 2.03-2.91 6.53.86 7.75-.18.58-.42 1.17-.73 1.52zM12.03 7.25c-.15-2.23 1.66-4.07 3.74-4.25.29 2.58-2.34 4.5-3.74 4.25z"/></svg>
                        <div><div class="text-[9px] text-green-300">Download di</div><div class="text-xs font-bold">App Store</div></div>
                    </a>
                    <a href="#" class="flex items-center gap-2 bg-black/30 hover:bg-black/50 border border-green-700 text-white px-3 py-2 rounded-xl transition-colors">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M3.18 23.76c.35.2.74.24 1.12.14l12.3-7.1-2.58-2.59-10.84 9.55zM20.48 10.5L17.4 8.7l-2.91 2.9 2.92 2.92 3.1-1.8c.88-.5.88-1.72-.03-2.22zM2.08 1.23C2.03 1.42 2 1.64 2 1.88V22.1c0 .25.04.47.1.67l.11.1 11.19-11.2v-.26L2.19 1.12l-.11.11z"/></svg>
                        <div><div class="text-[9px] text-green-300">Download di</div><div class="text-xs font-bold">Google Play</div></div>
                    </a>
                </div>
            </div>
        </div>
        <div class="pt-5 flex flex-col sm:flex-row items-center justify-between gap-2 text-xs text-green-300/70">
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
