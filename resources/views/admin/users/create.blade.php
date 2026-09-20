@extends('layouts.app')
@section('title', 'Tambah Akun')
@section('page-title', 'Tambah Akun')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-6">
    <div class="bg-white rounded-2xl border border-gray-200 p-6">
        <h3 class="font-semibold text-gray-800 mb-5">➕ Tambah Akun</h3>

        <form method="POST" action="{{ route('admin.users.store') }}">
            @include('admin.users._form')

            <div class="flex gap-2 mt-6">
                <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white px-5 py-2 rounded-lg text-sm">
                    Simpan
                </button>
                <a href="{{ route('admin.users.index') }}" class="text-sm text-gray-500 hover:underline px-2 py-2">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection