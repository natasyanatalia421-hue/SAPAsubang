<a href="{{ route('user.dashboard') }}"
   class="sidebar-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
    🏠 <span>Dashboard</span>
</a>
<a href="{{ route('user.reports.create') }}"
   class="sidebar-link {{ request()->routeIs('user.reports.create') ? 'active' : '' }}">
    📝 <span>Buat Laporan</span>
</a>
<a href="{{ route('user.notifications') }}"
   class="sidebar-link {{ request()->routeIs('user.notifications') ? 'active' : '' }}">
    🔔 <span>Notifikasi</span>
</a>
