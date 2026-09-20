@extends('layouts.app')
@section('title', 'Manajemen Akun')
@section('page-title', 'Manajemen Akun')

@section('content')
@php $catMap = \App\Models\Category::pluck('nama_kategori', 'id'); @endphp

<div class="space-y-6">
    <div class="bg-white rounded-2xl border border-gray-200 p-6">

        {{-- Header --}}
        <div class="flex flex-wrap items-center justify-between gap-3 mb-5">
            <h3 class="font-semibold text-gray-800">👥 Daftar Akun ({{ $users->total() }})</h3>
            <a href="{{ route('admin.users.create') }}"
               class="bg-teal-600 hover:bg-teal-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition-colors">
                + Tambah Akun
            </a>
        </div>

        {{-- Cari & filter --}}
        <form method="GET" action="{{ route('admin.users.index') }}"
              class="grid grid-cols-1 sm:grid-cols-4 gap-3 mb-5">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama atau email..."
                   class="sm:col-span-2 px-3 py-2 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">

            <select name="role"
                    class="px-3 py-2 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
                <option value="">Semua role</option>
                @foreach($roles as $value => $label)
                    <option value="{{ $value }}" @selected(request('role') === $value)>{{ $label }}</option>
                @endforeach
            </select>

            <select name="status"
                    class="px-3 py-2 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
                <option value="">Semua status</option>
                <option value="aktif" @selected(request('status') === 'aktif')>Aktif</option>
                <option value="nonaktif" @selected(request('status') === 'nonaktif')>Nonaktif</option>
            </select>

            <div class="sm:col-span-4 flex gap-2">
                <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white px-5 py-2 rounded-lg text-sm">
                    Terapkan
                </button>
                <a href="{{ route('admin.users.index') }}"
                   class="text-sm text-gray-500 hover:underline px-2 py-2">Reset</a>
            </div>
        </form>

        {{-- Tabel --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="border-b border-gray-100">
                    <tr class="text-xs text-gray-500 uppercase text-left">
                        <th class="pb-3 pr-4">Nama</th>
                        <th class="pb-3 pr-4">Kontak</th>
                        <th class="pb-3 pr-4">Role</th>
                        <th class="pb-3 pr-4">Status</th>
                        <th class="pb-3 pr-4">Bergabung</th>
                        <th class="pb-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($users as $u)
                        @php
                            $roleClass = match($u->role) {
                                'admin'   => 'bg-purple-100 text-purple-700',
                                'petugas' => 'bg-teal-100 text-teal-700',
                                default   => 'bg-gray-100 text-gray-600',
                            };
                            $spesialisasi = ($u->role === 'petugas' && $u->officer)
                                ? ($u->officer->spesialisasi_kategori ?? [])
                                : [];

                            // Samakan dengan UserController::denyUnlessAllowed()
                            $canManage = auth()->user()->isSuperAdmin()
                                || $u->id === auth()->id()
                                || $u->role !== 'admin';
                        @endphp
                        <tr>
                            <td class="py-3 pr-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full bg-teal-100 flex items-center justify-center text-teal-700 font-bold shrink-0">
                                        {{ strtoupper(substr($u->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-800">
                                            {{ $u->name }}
                                            @if($u->id === auth()->id())
                                                <span class="text-xs text-gray-400">(kamu)</span>
                                            @endif
                                        </p>
                                        @if(count($spesialisasi))
                                            <div class="flex flex-wrap gap-1 mt-1">
                                                @foreach($spesialisasi as $catId)
                                                    @if(isset($catMap[$catId]))
                                                        <span class="text-xs bg-teal-50 text-teal-700 px-2 py-0.5 rounded-full">{{ $catMap[$catId] }}</span>
                                                    @endif
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 pr-4">
                                <p class="text-gray-600">{{ $u->email }}</p>
                                <p class="text-xs text-gray-400">{{ $u->no_hp ?? '—' }}</p>
                            </td>
                            <td class="py-3 pr-4">
                                <span class="text-xs font-medium px-2.5 py-1 rounded-full {{ $roleClass }}">
                                    {{ $roles[$u->role] ?? ucfirst($u->role) }}
                                </span>
                                @if($u->role === 'admin' && $u->is_super_admin)
                                    <span class="text-xs font-medium px-2 py-0.5 rounded-full bg-amber-100 text-amber-700 ml-1">Super</span>
                                @endif
                            </td>
                            <td class="py-3 pr-4">
                                <span class="text-xs {{ $u->is_active ? 'text-green-600' : 'text-gray-400' }}">
                                    {{ $u->is_active ? '● Aktif' : '○ Nonaktif' }}
                                </span>
                            </td>
                            <td class="py-3 pr-4 text-gray-400 text-xs">{{ $u->created_at->format('d M Y') }}</td>
                            <td class="py-3">
                                <div class="flex items-center justify-end gap-3">
                                    @if($canManage)
                                        <a href="{{ route('admin.users.edit', $u) }}"
                                           class="text-xs text-teal-600 hover:underline">Edit</a>
                                    @else
                                        <span class="text-xs text-gray-300 cursor-not-allowed" title="Hanya super admin yang bisa mengelola akun admin">Edit</span>
                                    @endif

                                    @if($u->id !== auth()->id() && $canManage)
                                        <form method="POST" action="{{ route('admin.users.toggle-status', $u) }}">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="text-xs text-yellow-600 hover:underline">
                                                {{ $u->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                            </button>
                                        </form>

                                        <form method="POST" action="{{ route('admin.users.destroy', $u) }}"
                                              onsubmit="return confirm('Hapus akun {{ e($u->name) }}? Riwayat laporannya tetap tersimpan.')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-xs text-red-500 hover:underline">Hapus</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-gray-400">Tidak ada akun yang ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $users->links('components.pagination') }}</div>
    </div>
</div>
@endsection