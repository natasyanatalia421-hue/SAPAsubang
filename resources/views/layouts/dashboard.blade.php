<!DOCTYPE html>
<html lang="id" x-data="{ sidebarOpen: false }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') — SAPAsubang</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>[x-cloak]{display:none!important}</style>
</head>
<body class="bg-gray-50 font-sans antialiased">

@if(session('success'))
<div x-data="{show:true}" x-show="show" x-init="setTimeout(()=>show=false,4000)" x-transition
     class="fixed top-4 right-4 z-50 bg-green-500 text-white px-5 py-3 rounded-xl shadow-lg flex items-center gap-2 max-w-sm text-sm">
    ✅ <span>{{ session('success') }}</span><button @click="show=false" class="ml-auto opacity-70">✕</button>
</div>
@endif
@if(session('error'))
<div x-data="{show:true}" x-show="show" x-init="setTimeout(()=>show=false,5000)" x-transition
     class="fixed top-4 right-4 z-50 bg-red-500 text-white px-5 py-3 rounded-xl shadow-lg flex items-center gap-2 max-w-sm text-sm">
    ❌ <span>{{ session('error') }}</span><button @click="show=false" class="ml-auto opacity-70">✕</button>
</div>
@endif
@if(session('info'))
<div x-data="{show:true}" x-show="show" x-init="setTimeout(()=>show=false,4000)" x-transition
     class="fixed top-4 right-4 z-50 bg-blue-500 text-white px-5 py-3 rounded-xl shadow-lg flex items-center gap-2 max-w-sm text-sm">
    ℹ️ <span>{{ session('info') }}</span><button @click="show=false" class="ml-auto opacity-70">✕</button>
</div>
@endif

<div class="flex h-screen overflow-hidden">

    {{-- Sidebar overlay mobile --}}
    <div x-show="sidebarOpen" x-cloak @click="sidebarOpen=false"
         class="fixed inset-0 z-20 bg-black/50 lg:hidden"></div>

    {{-- Sidebar --}}
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
           class="fixed inset-y-0 left-0 z-30 w-64 transform transition-transform duration-200 lg:static lg:translate-x-0 flex flex-col
                  @auth
                    @if(auth()->user()->role === 'admin') bg-indigo-900
                    @elseif(auth()->user()->role === 'petugas') bg-teal-800
                    @else bg-green-700 @endif
                  @endauth text-white">

        {{-- Logo --}}
        <div class="flex items-center gap-3 px-5 py-4 border-b border-white/20">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <div class="w-9 h-9 bg-white rounded-xl flex items-center justify-center shadow-sm flex-shrink-0">
                    <svg viewBox="0 0 24 24" class="w-5 h-5
                        @auth @if(auth()->user()->role==='admin') fill-indigo-700 @elseif(auth()->user()->role==='petugas') fill-teal-700 @else fill-green-700 @endif @endauth">
                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                    </svg>
                </div>
                <div>
                    <div class="font-bold text-base leading-none">SAPAsubang</div>
                    <div class="text-xs text-white/50 mt-0.5">
                        @auth @if(auth()->user()->role==='admin') Admin Panel
                        @elseif(auth()->user()->role==='petugas') Petugas
                        @else Dashboard @endif @endauth
                    </div>
                </div>
            </a>
        </div>

        {{-- Nav --}}
        <nav class="flex-1 px-3 py-4 space-y-0.5 overflow-y-auto">
            @auth
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-white/20 text-white' : 'text-white/75 hover:bg-white/10 hover:text-white' }}">
                    📊 <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.categories.*') ? 'bg-white/20 text-white' : 'text-white/75 hover:bg-white/10 hover:text-white' }}">
                    🏷️ <span>Kelola Kategori</span>
                </a>
                <a href="{{ route('notifications.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('notifications.*') ? 'bg-white/20 text-white' : 'text-white/75 hover:bg-white/10 hover:text-white' }}">
                    🔔 <span>Notifikasi</span>
                    <span id="notif-badge" class="ml-auto bg-red-500 text-white text-xs rounded-full px-1.5 py-0.5 hidden text-[10px]"></span>
                </a>
                <div class="pt-3 pb-1 px-4 text-xs text-white/40 uppercase tracking-widest">Publik</div>
                <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium text-white/75 hover:bg-white/10 hover:text-white transition-colors">
                    🌐 <span>Lihat Website</span>
                </a>

            @elseif(auth()->user()->role === 'petugas')
                <a href="{{ route('petugas.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('petugas.dashboard') ? 'bg-white/20 text-white' : 'text-white/75 hover:bg-white/10 hover:text-white' }}">
                    🗺️ <span>Dashboard</span>
                </a>
                <a href="{{ route('notifications.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('notifications.*') ? 'bg-white/20 text-white' : 'text-white/75 hover:bg-white/10 hover:text-white' }}">
                    🔔 <span>Notifikasi</span>
                    <span id="notif-badge" class="ml-auto bg-red-500 text-white text-xs rounded-full px-1.5 py-0.5 hidden text-[10px]"></span>
                </a>
                <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium text-white/75 hover:bg-white/10 hover:text-white transition-colors">
                    🌐 <span>Lihat Website</span>
                </a>
            @endif
            @endauth
        </nav>

        {{-- User info --}}
        @auth
        <div class="px-3 py-4 border-t border-white/20">
            <div class="flex items-center gap-3 px-3 py-2 rounded-xl bg-white/10 mb-2">
                <div class="w-8 h-8 bg-white/25 rounded-full flex items-center justify-center font-bold text-sm flex-shrink-0">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <div class="text-sm font-medium truncate">{{ auth()->user()->name }}</div>
                    <div class="text-xs text-white/50 truncate">{{ auth()->user()->email }}</div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-2 rounded-lg text-sm text-white/70 hover:text-white hover:bg-white/10 transition-colors">
                    🚪 <span>Keluar</span>
                </button>
            </form>
        </div>
        @endauth
    </aside>

    {{-- Main content --}}
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
        {{-- Topbar --}}
        <header class="bg-white border-b border-gray-200 px-4 lg:px-6 py-3 flex items-center gap-3 flex-shrink-0">
            <button @click="sidebarOpen=!sidebarOpen" class="lg:hidden p-2 rounded-lg hover:bg-gray-100">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <h1 class="text-base font-semibold text-gray-800">@yield('page-title', 'Dashboard')</h1>

            <div class="ml-auto flex items-center gap-2">
                {{-- Nama user --}}
                <span class="text-sm text-gray-400 hidden sm:block">
                    Halo, <strong class="text-gray-600">{{ auth()->user()->name ?? '' }}</strong>
                </span>

                {{-- Link ke website publik --}}
                <a href="{{ route('home') }}"
                   class="hidden sm:flex items-center gap-1.5 text-xs font-medium text-gray-500 hover:text-green-700 border border-gray-200 hover:border-green-300 px-3 py-1.5 rounded-lg transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Website
                </a>

                {{-- Tombol Keluar --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="flex items-center gap-1.5 text-xs font-semibold text-red-600 hover:text-white hover:bg-red-600 border border-red-200 hover:border-red-600 px-3 py-1.5 rounded-lg transition-all">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        Keluar
                    </button>
                </form>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-4 lg:p-6">
            @yield('content')
        </main>
    </div>
</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

@auth
<script>
async function refreshBadge() {
    try {
        const r = await fetch('{{ route('notifications.unread') }}');
        const d = await r.json();
        const badge = document.getElementById('notif-badge');
        if (badge) {
            if (d.count > 0) { badge.textContent = d.count > 9 ? '9+' : d.count; badge.classList.remove('hidden'); }
            else badge.classList.add('hidden');
        }
    } catch {}
}
refreshBadge();
setInterval(refreshBadge, 30000);
</script>
@endauth

@stack('scripts')
</body>
</html>
