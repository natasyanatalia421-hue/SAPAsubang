<a href="{{ route('admin.dashboard') }}"
   class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
    🏠 <span>Dashboard</span>
</a>
<a href="{{ route('admin.reports.index') }}"
   class="sidebar-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
    📋 <span>Semua Laporan</span>
</a>
<a href="{{ route('admin.categories.index') }}"
   class="sidebar-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
    🏷️ <span>Kategori</span>
</a>
<a href="{{ route('admin.users.index') }}"
   class="sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
    👥 <span>Pengguna & Petugas</span>
</a>
