@php
$navItems = [
    ['route' => 'petugas.dashboard',   'icon' => '🏠', 'label' => 'Dashboard'],
    ['route' => 'petugas.tasks.index', 'icon' => '🔧', 'label' => 'Daftar Tugas'],
    ['route' => 'notifications.index', 'icon' => '🔔', 'label' => 'Notifikasi'],
];
@endphp
@foreach($navItems as $item)
<a href="{{ route($item['route']) }}"
   class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm transition
          {{ request()->routeIs($item['route']) ? 'bg-blue-600 text-white font-medium' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
    <span>{{ $item['icon'] }}</span>
    {{ $item['label'] }}
</a>
@endforeach
