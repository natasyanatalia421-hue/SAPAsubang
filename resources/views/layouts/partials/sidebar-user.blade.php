<a href="{{ route('user.dashboard') }}"
   class="sidebar-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
    <i class="bi bi-house-door-fill"></i> <span>Dashboard</span>
</a>
<a href="{{ route('user.reports.create') }}"
   class="sidebar-link {{ request()->routeIs('user.reports.create') ? 'active' : '' }}">
    <i class="bi bi-pencil-square"></i> <span>Buat Laporan</span>
</a>
<a href="{{ route('user.notifications') }}"
   class="sidebar-link {{ request()->routeIs('user.notifications') ? 'active' : '' }}">
    <i class="bi bi-bell-fill"></i> <span>Notifikasi</span>
</a>