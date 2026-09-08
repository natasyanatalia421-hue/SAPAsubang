<!DOCTYPE html>
<html lang="id" x-data="{ mobileMenu: false }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SAPAsubang') — Kabupaten Subang</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        [x-cloak]{display:none!important}
        .nav-link{@apply relative px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors;}
        .nav-link.active{@apply text-green-700 font-semibold;}
        .nav-link.active::after{content:'';@apply absolute bottom-0 left-3 right-3 h-0.5 bg-green-600 rounded-full;}
        .line-clamp-2{display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;}
        .line-clamp-3{display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;}
    </style>
</head>
<body class="bg-white font-sans antialiased min-h-screen flex flex-col text-gray-900">

{{-- Toast --}}
@if(session('success'))
<div x-data="{s:true}" x-show="s" x-init="setTimeout(()=>s=false,4000)" x-transition
     class="fixed top-5 right-5 z-[60] bg-green-600 text-white text-sm px-4 py-3 rounded-xl shadow-xl flex items-center gap-3 max-w-xs">
    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
    <span>{{ session('success') }}</span>
    <button @click="s=false" class="ml-auto text-white/70 hover:text-white">✕</button>
</div>
@endif
@if(session('error'))
<div x-data="{s:true}" x-show="s" x-init="setTimeout(()=>s=false,5000)" x-transition
     class="fixed top-5 right-5 z-[60] bg-red-600 text-white text-sm px-4 py-3 rounded-xl shadow-xl flex items-center gap-3 max-w-xs">
    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
    <span>{{ session('error') }}</span>
    <button @click="s=false" class="ml-auto text-white/70 hover:text-white">✕</button>
</div>
@endif
@if(session('info'))
<div x-data="{s:true}" x-show="s" x-init="setTimeout(()=>s=false,4000)" x-transition
     class="fixed top-5 right-5 z-[60] bg-blue-600 text-white text-sm px-4 py-3 rounded-xl shadow-xl flex items-center gap-3 max-w-xs">
    <span>{{ session('info') }}</span>
    <button @click="s=false" class="ml-auto text-white/70 hover:text-white">✕</button>
</div>
@endif

{{-- TOP ANNOUNCE BAR --}}
<div class="bg-green-700 text-white/90 text-xs py-2 px-4 hidden sm:block">
    <div class="max-w-7xl mx-auto flex items-center justify-between gap-4">
        <span>Kabupaten Subang, Jawa Barat</span>
        <span class="flex items-center gap-4">
            <span>(0260) 411xxxx</span>
            <span>·</span>
            <span>info@sapasubang.go.id</span>
        </span>
    </div>
</div>

{{-- NAVBAR --}}
<header class="bg-white border-b border-gray-200 sticky top-0 z-50 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center h-16 gap-8">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-2.5 flex-shrink-0">
                <div class="w-9 h-9 bg-green-600 rounded-xl flex items-center justify-center shadow-sm">
                    <svg viewBox="0 0 24 24" class="w-5 h-5 fill-white">
                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                    </svg>
                </div>
                <div class="leading-tight">
                    <div class="font-bold text-gray-900 text-[15px] leading-none">SAPAsubang</div>
                    <div class="text-[10px] text-gray-400 leading-none mt-0.5">Kabupaten Subang</div>
                </div>
            </a>

            {{-- Nav desktop --}}
            <nav class="hidden md:flex items-center gap-0 flex-1 h-16">
                <a href="{{ route('home') }}"        class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
                <a href="{{ route('tentang') }}"     class="nav-link {{ request()->routeIs('tentang') ? 'active' : '' }}">Tentang Subang</a>
                <a href="{{ route('berita') }}"      class="nav-link {{ request()->routeIs('berita*') ? 'active' : '' }}">Berita</a>
                <a href="{{ route('laporan.publik') }}" class="nav-link {{ request()->routeIs('laporan.publik') ? 'active' : '' }}">Laporan</a>
            </nav>

            {{-- Auth desktop --}}
            <div class="hidden md:flex items-center gap-2 ml-auto">
                @auth
                <a href="{{ route('notifications.index') }}" class="relative p-2 text-gray-500 hover:text-gray-700 rounded-lg hover:bg-gray-100 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                    <span id="notif-badge" class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full hidden"></span>
                </a>
                <div x-data="{open:false}" class="relative">
                    <button @click="open=!open"
                            class="flex items-center gap-2 px-3 py-1.5 rounded-xl border border-gray-200 hover:border-gray-300 hover:bg-gray-50 transition-all text-sm">
                        <div class="w-6 h-6 rounded-lg bg-green-600 text-white flex items-center justify-center font-semibold text-xs flex-shrink-0">
                            {{ strtoupper(substr(auth()->user()->name,0,1)) }}
                        </div>
                        <span class="text-gray-700 font-medium max-w-[100px] truncate text-sm">{{ auth()->user()->name }}</span>
                        <svg class="w-3.5 h-3.5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="open" @click.outside="open=false" x-cloak
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="absolute right-0 top-full mt-2 w-56 bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden z-50">
                        <div class="px-4 py-3 bg-gray-50 border-b border-gray-100">
                            <p class="text-xs font-semibold text-gray-800 truncate">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-500 truncate mt-0.5">{{ auth()->user()->email }}</p>
                            <span class="mt-1.5 inline-block text-[11px] px-2 py-0.5 rounded-full font-medium
                                @if(auth()->user()->role==='admin') bg-indigo-100 text-indigo-700
                                @elseif(auth()->user()->role==='petugas') bg-teal-100 text-teal-700
                                @else bg-green-100 text-green-700 @endif">
                                {{ ucfirst(auth()->user()->role) }}
                            </span>
                        </div>
                        <div class="py-1">
                            @if(auth()->user()->role==='admin')
                            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                                Dashboard Admin
                            </a>
                            @elseif(auth()->user()->role==='petugas')
                            <a href="{{ route('petugas.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                Dashboard Petugas
                            </a>
                            @else
                            <a href="{{ route('user.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                Dashboard Saya
                            </a>
                            @endif
                            <a href="{{ route('notifications.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                                Notifikasi
                            </a>
                        </div>
                        <div class="border-t border-gray-100">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @else
                <a href="{{ route('login') }}"    class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 rounded-lg hover:bg-gray-100 transition-colors">Masuk</a>
                <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-semibold text-white bg-green-600 hover:bg-green-700 rounded-xl transition-colors shadow-sm">Daftar</a>
                @endauth
            </div>

            {{-- Mobile toggle --}}
            <button @click="mobileMenu=!mobileMenu" class="md:hidden ml-auto p-2 rounded-lg text-gray-600 hover:bg-gray-100">
                <svg x-show="!mobileMenu" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                <svg x-show="mobileMenu" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
    </div>

    {{-- Mobile menu --}}
    <div x-show="mobileMenu" x-cloak
         x-transition:enter="transition duration-200 ease-out"
         x-transition:enter-start="opacity-0 -translate-y-1"
         x-transition:enter-end="opacity-100 translate-y-0"
         class="md:hidden border-t border-gray-100 bg-white px-4 py-3">
        <div class="space-y-0.5 mb-3">
            <a href="{{ route('home') }}"           class="block px-3 py-2 rounded-lg text-sm text-gray-700 hover:bg-gray-100 hover:text-green-700 {{ request()->routeIs('home') ? 'bg-green-50 text-green-700 font-medium' : '' }}">Beranda</a>
            <a href="{{ route('tentang') }}"         class="block px-3 py-2 rounded-lg text-sm text-gray-700 hover:bg-gray-100 hover:text-green-700">Tentang Subang</a>
            <a href="{{ route('berita') }}"           class="block px-3 py-2 rounded-lg text-sm text-gray-700 hover:bg-gray-100 hover:text-green-700">Berita</a>
            <a href="{{ route('laporan.publik') }}"   class="block px-3 py-2 rounded-lg text-sm text-gray-700 hover:bg-gray-100 hover:text-green-700">Laporan</a>
        </div>
        <div class="border-t border-gray-100 pt-3 flex gap-2">
            @auth
            <a href="{{ route('user.dashboard') }}" class="flex-1 text-center py-2 text-sm border border-gray-200 rounded-xl text-gray-700 hover:bg-gray-50">Dashboard</a>
            <form method="POST" action="{{ route('logout') }}" class="flex-1">@csrf<button class="w-full py-2 text-sm text-red-600 border border-red-100 rounded-xl">Keluar</button></form>
            @else
            <a href="{{ route('login') }}"    class="flex-1 text-center py-2 text-sm border border-gray-200 rounded-xl text-gray-700">Masuk</a>
            <a href="{{ route('register') }}" class="flex-1 text-center py-2 text-sm bg-green-600 text-white rounded-xl font-medium">Daftar</a>
            @endauth
        </div>
    </div>
</header>

<main class="flex-1">@yield('content')</main>

{{-- FOOTER --}}
<footer class="bg-gray-950 text-gray-400 border-t border-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 pb-8 border-b border-gray-800">
            <div class="lg:col-span-1">
                <div class="flex items-center gap-2.5 mb-4">
                    <div class="w-9 h-9 rounded-xl bg-green-600 flex items-center justify-center flex-shrink-0">
                        <svg viewBox="0 0 24 24" class="w-5 h-5 fill-white"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                    </div>
                    <span class="text-white font-bold">SAPAsubang</span>
                </div>
                <p class="text-sm leading-relaxed text-gray-500">Sistem aduan dan pelaporan masyarakat Kabupaten Subang, untuk lingkungan yang lebih bersih, aman, dan nyaman.</p>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-4 text-sm">Layanan</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('laporan.publik') }}" class="hover:text-green-400 transition-colors">Buat laporan</a></li>
                    <li><a href="{{ route('laporan.publik') }}" class="hover:text-green-400 transition-colors">Lacak status</a></li>
                    <li><a href="{{ route('laporan.publik') }}" class="hover:text-green-400 transition-colors">Kategori aduan</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-4 text-sm">Tentang</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('tentang') }}" class="hover:text-green-400 transition-colors">Profil Subang</a></li>
                    <li><a href="{{ route('berita') }}"  class="hover:text-green-400 transition-colors">Berita</a></li>
                    <li><a href="{{ route('tentang') }}" class="hover:text-green-400 transition-colors">Kontak</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-4 text-sm">Kontak</h4>
                <ul class="space-y-2 text-sm">
                    <li class="flex items-start gap-2"><span class="text-green-500 flex-shrink-0 mt-0.5">📞</span>(0260) 411xxxx</li>
                    <li class="flex items-start gap-2"><span class="text-green-500 flex-shrink-0 mt-0.5">✉</span>info@sapasubang.go.id</li>
                    <li class="flex items-start gap-2"><span class="text-green-500 flex-shrink-0 mt-0.5">📍</span>Jl. Otista No. 1, Subang</li>
                </ul>
            </div>
        </div>
        <div class="pt-6 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-gray-600">
            <span>© {{ date('Y') }} Pemerintah Kabupaten Subang</span>
            <span class="flex gap-4">
                <a href="#" class="hover:text-gray-400">Kebijakan privasi</a>
                <span>·</span>
                <a href="#" class="hover:text-gray-400">Syarat layanan</a>
            </span>
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
