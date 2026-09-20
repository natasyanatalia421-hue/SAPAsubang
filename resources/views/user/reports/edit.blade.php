@extends('layouts.app')
@section('title', 'Edit Laporan')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <div class="mb-6">
        <a href="{{ route('user.dashboard') }}" class="text-sm text-gray-500 hover:text-gray-700">‹ Kembali ke Dashboard</a>
        <h1 class="text-xl font-bold text-gray-800 mt-1">Edit Laporan {{ $report->kode_laporan }}</h1>
    </div>

    @if($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-xl mb-4">
        <ul class="list-disc list-inside space-y-1">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('user.reports.update', $report->id) }}" method="POST" enctype="multipart/form-data"
          class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-5">
        @csrf
        @method('PUT')

        {{-- Kategori --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Kategori</label>
            <select name="category_id" required
                    class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500">
                <option value="">Pilih kategori</option>
                @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ old('category_id', $report->category_id) == $cat->id ? 'selected' : '' }}>
                    {{ $cat->icon }} {{ $cat->nama_kategori }}
                </option>
                @endforeach
            </select>
        </div>

        {{-- Keterangan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Keterangan</label>
            <textarea name="deskripsi" rows="4" required minlength="10"
                      class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500"
                      placeholder="Jelaskan masalahnya...">{{ old('deskripsi', $report->deskripsi) }}</textarea>
        </div>

        {{-- Foto lama --}}
        @if($report->foto_sebelum)
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Foto Saat Ini</label>
            <img src="{{ Storage::url($report->foto_sebelum) }}" alt="Foto laporan"
                 class="w-full max-w-xs rounded-xl border border-gray-200">
        </div>
        @endif

        {{-- Ganti foto --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">
                Ganti Foto <span class="text-gray-400 font-normal">(opsional)</span>
            </label>
            <input type="file" name="foto_sebelum" accept="image/*"
                   class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
        </div>

        {{-- Actions --}}
        <div class="flex items-center justify-end gap-3 pt-2">
            <a href="{{ route('user.dashboard') }}"
               class="text-sm font-medium text-gray-600 hover:text-gray-800 px-4 py-2.5">
                Batal
            </a>
            <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white font-semibold px-5 py-2.5 rounded-xl transition-colors text-sm shadow-sm">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection