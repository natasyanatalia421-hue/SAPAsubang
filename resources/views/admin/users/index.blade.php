@extends('layouts.app')
@section('title', 'Pengguna & Petugas')
@section('page-title', 'Pengguna & Petugas')

@section('content')
<div class="space-y-6">

    {{-- Daftar Petugas --}}
    <div class="bg-white rounded-2xl border border-gray-200 p-6" x-data="{ addForm: false }">
        <div class="flex items-center justify-between mb-4">
            <h3 class="font-semibold text-gray-800">👷 Daftar Petugas ({{ $petugas->count() }})</h3>
            <button @click="addForm=!addForm"
                    class="bg-teal-600 hover:bg-teal-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition-colors">
                + Tambah Petugas
            </button>
        </div>

        {{-- Form Tambah Petugas --}}
        <div x-show="addForm" x-cloak class="mb-5 p-5 bg-teal-50 border border-teal-200 rounded-xl">
            <form method="POST" action="{{ route('admin.petugas.store') }}" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Nama *</label>
                        <input type="text" name="name" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Email *</label>
                        <input type="email" name="email" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">No. HP</label>
                        <input type="tel" name="no_hp"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Password *</label>
                        <input type="password" name="password" required minlength="8"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-2">Spesialisasi Kategori</label>
                    <div class="flex flex-wrap gap-2">
                        @foreach(\App\Models\Category::where('aktif', true)->get() as $cat)
                        <label class="flex items-center gap-2 text-sm cursor-pointer">
                            <input type="checkbox" name="spesialisasi_kategori[]" value="{{ $cat->id }}" class="rounded">
                            {{ $cat->icon }} {{ $cat->nama_kategori }}
                        </label>
                        @endforeach
                    </div>
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="bg-teal-600 text-white px-5 py-2 rounded-lg text-sm hover:bg-teal-700">
                        Tambah Petugas
                    </button>
                    <button type="button" @click="addForm=false" class="text-sm text-gray-500 hover:underline px-2">Batal</button>
                </div>
            </form>
        </div>

        {{-- Grid Petugas --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($petugas as $p)
            <div class="border border-gray-200 rounded-xl p-4">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 rounded-full bg-teal-100 flex items-center justify-center text-teal-700 font-bold">
                        {{ strtoupper(substr($p->name, 0, 1)) }}
                    </div>
                    <div>
                        <p class="font-medium text-gray-800 text-sm">{{ $p->name }}</p>
                        <p class="text-xs text-gray-500">{{ $p->email }}</p>
                    </div>
                </div>
                @if($p->officer && $p->officer->spesialisasi_kategori)
                <div class="flex flex-wrap gap-1 mb-3">
                    @foreach(\App\Models\Category::whereIn('id', $p->officer->spesialisasi_kategori)->get() as $cat)
                    <span class="text-xs bg-teal-50 text-teal-700 px-2 py-0.5 rounded-full">{{ $cat->icon }} {{ $cat->nama_kategori }}</span>
                    @endforeach
                </div>
                @endif
                <div class="flex items-center justify-between">
                    <span class="{{ ($p->officer && $p->officer->status_aktif) ? 'text-green-600' : 'text-gray-400' }} text-xs">
                        {{ ($p->officer && $p->officer->status_aktif) ? '● Aktif' : '○ Nonaktif' }}
                    </span>
                    <form method="POST" action="{{ route('admin.petugas.destroy', $p) }}"
                          onsubmit="return confirm('Hapus petugas {{ $p->name }}?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-xs text-red-500 hover:underline">Hapus</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Daftar User --}}
    <div class="bg-white rounded-2xl border border-gray-200 p-6">
        <h3 class="font-semibold text-gray-800 mb-4">👤 Daftar Pengguna ({{ $users->total() }})</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="border-b border-gray-100">
                    <tr class="text-xs text-gray-500 uppercase text-left">
                        <th class="pb-3 pr-4">Nama</th>
                        <th class="pb-3 pr-4">Email</th>
                        <th class="pb-3 pr-4">No HP</th>
                        <th class="pb-3">Bergabung</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($users as $u)
                    <tr>
                        <td class="py-3 pr-4 font-medium text-gray-800">{{ $u->name }}</td>
                        <td class="py-3 pr-4 text-gray-600">{{ $u->email }}</td>
                        <td class="py-3 pr-4 text-gray-500">{{ $u->no_hp ?? '—' }}</td>
                        <td class="py-3 text-gray-400 text-xs">{{ $u->created_at->format('d M Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">{{ $users->links('components.pagination') }}</div>
    </div>

</div>
@endsection
