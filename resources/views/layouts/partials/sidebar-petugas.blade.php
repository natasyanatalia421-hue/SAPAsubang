<a href="{{ route('petugas.dashboard') }}"
   class="sidebar-link {{ request()->routeIs('petugas.dashboard') ? 'active' : '' }}">
    🏠 <span>Dashboard</span>
</a>
<a href="{{ route('petugas.reports.history') }}"
   class="sidebar-link {{ request()->routeIs('petugas.reports.history') ? 'active' : '' }}">
    📖 <span>Riwayat Tugas</span>
</a>
