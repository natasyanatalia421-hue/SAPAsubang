@extends('layouts.app')
@section('title', 'Edit Akun')
@section('page-title', 'Edit Akun')

@section('content')
<div class="max-w-2xl space-y-6">

    {{-- Data akun --}}
    <div class="bg-white rounded-2xl border border-gray-200 p-6">
        <form method="POST" action="{{ route('admin.users.update', $user) }}">
            @method('PUT')
            @include('admin.users._form')

            <div class="flex gap-2 mt-6">
                <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white px-5 py-2 rounded-lg text-sm">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.users.index') }}" class="text-sm text-gray-500 hover:underline px-2 py-2">Kembali</a>
            </div>
        </form>
    </div>

    {{-- Reset password oleh admin --}}
    <div class="bg-white rounded-2xl border border-gray-200 p-6">
        <h3 class="font-semibold text-gray-800 mb-1">🔑 Reset Password</h3>
        <p class="text-sm text-gray-500 mb-4">
            Atur password baru untuk {{ $user->name }}, lalu sampaikan langsung ke yang bersangkutan.
        </p>

        <form method="POST" action="{{ route('admin.users.reset-password', $user) }}" class="space-y-4">
            @csrf @method('PATCH')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Password Baru *</label>
                    <input type="password" name="password" required minlength="8"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
                    @if($errors->resetPassword->has('password'))
                        <p class="mt-1 text-xs text-red-600">{{ $errors->resetPassword->first('password') }}</p>
                    @endif
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Konfirmasi Password *</label>
                    <input type="password" name="password_confirmation" required minlength="8"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
                </div>
            </div>

            <button type="submit" class="bg-gray-800 hover:bg-gray-900 text-white px-5 py-2 rounded-lg text-sm">
                Reset Password
            </button>
        </form>
    </div>
</div>
@endsection