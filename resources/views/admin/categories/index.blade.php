@extends('layouts.dashboard')
@section('title', 'Kelola Kategori')
@section('page-title', 'Kelola Kategori')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    {{-- Form tambah kategori --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <h3 class="font-semibold text-gray-800 mb-4">➕ Tambah Kategori Baru</h3>
        <form method="POST" action="{{ route('admin.categories.store') }}" class="flex flex-col sm:flex-row gap-3">
            @csrf
            <div class="flex-1">
                <input type="text" name="nama_kategori" placeholder="Nama kategori..." required
                       value="{{ old('nama_kategori') }}"
                       class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('nama_kategori') border-red-400 @enderror">
                @error('nama_kategori')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="w-24">
                <input type="text" name="icon" placeholder="Ikon 📋" maxlength="10"
                       value="{{ old('icon', '📋') }}"
                       class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm text-center focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div class="flex-1">
                <input type="text" name="deskripsi" placeholder="Deskripsi singkat..."
                       value="{{ old('deskripsi') }}"
                       class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-5 py-2.5 rounded-xl transition-colors whitespace-nowrap">
                Tambah
            </button>
        </form>
    </div>

    {{-- Daftar kategori --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
        <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
            <h3 class="font-semibold text-gray-800">Daftar Kategori</h3>
            <span class="text-xs text-gray-400">{{ $categories->count() }} kategori</span>
        </div>

        @if($categories->isEmpty())
            <div class="py-12 text-center text-gray-400">
                <div class="text-4xl mb-2">🏷️</div>
                <p>Belum ada kategori. Tambahkan kategori pertama.</p>
            </div>
        @else
            <div class="divide-y divide-gray-50">
                @foreach($categories as $cat)
                <div class="flex items-center gap-4 px-5 py-4" x-data="{ editing: false }">
                    {{-- Tampil normal --}}
                    <div class="flex-shrink-0 text-2xl">{{ $cat->icon }}</div>
                    <div class="flex-1 min-w-0" x-show="!editing">
                        <div class="flex items-center gap-2 flex-wrap">
                            <span class="font-medium text-gray-800 text-sm">{{ $cat->nama_kategori }}</span>
                            @if(!$cat->aktif)
                                <span class="text-xs bg-gray-100 text-gray-500 px-2 py-0.5 rounded-full">Nonaktif</span>
                            @endif
                        </div>
                        <p class="text-xs text-gray-400 mt-0.5">{{ $cat->deskripsi ?? '—' }}</p>
                        <p class="text-xs text-gray-400 mt-0.5">{{ $cat->reports_count }} laporan</p>
                    </div>

                    {{-- Form edit inline --}}
                    <form method="POST" action="{{ route('admin.categories.update', $cat->id) }}"
                          class="flex-1 flex flex-col sm:flex-row gap-2" x-show="editing" x-cloak>
                        @csrf @method('PUT')
                        <input type="text" name="icon" value="{{ $cat->icon }}" maxlength="10"
                               class="w-16 border border-gray-300 rounded-lg px-2 py-1.5 text-sm text-center focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        <input type="text" name="nama_kategori" value="{{ $cat->nama_kategori }}" required
                               class="flex-1 border border-gray-300 rounded-lg px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        <input type="text" name="deskripsi" value="{{ $cat->deskripsi }}" placeholder="Deskripsi..."
                               class="flex-1 border border-gray-300 rounded-lg px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        <label class="flex items-center gap-1 text-xs text-gray-600">
                            <input type="checkbox" name="aktif" value="1" {{ $cat->aktif ? 'checked' : '' }}> Aktif
                        </label>
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white text-xs font-medium px-3 py-1.5 rounded-lg">Simpan</button>
                        <button type="button" @click="editing = false" class="text-gray-500 hover:text-gray-700 text-xs px-2">Batal</button>
                    </form>

                    {{-- Action buttons --}}
                    <div class="flex items-center gap-2 flex-shrink-0" x-show="!editing">
                        <button @click="editing = true"
                                class="text-xs text-blue-600 hover:text-blue-800 font-medium px-2 py-1 rounded hover:bg-blue-50 transition-colors">
                            Edit
                        </button>
                        @if($cat->reports_count === 0)
                        <form method="POST" action="{{ route('admin.categories.destroy', $cat->id) }}"
                              onsubmit="return confirm('Hapus kategori \'{{ $cat->nama_kategori }}\'?')">
                            @csrf @method('DELETE')
                            <button type="submit"
                                    class="text-xs text-red-500 hover:text-red-700 font-medium px-2 py-1 rounded hover:bg-red-50 transition-colors">
                                Hapus
                            </button>
                        </form>
                        @else
                            <span class="text-xs text-gray-300">Hapus</span>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>

</div>
@endsection
