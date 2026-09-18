<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk — SAPAsubang</title>
    @vite(['resources/css/app.css'])
    <style>[x-cloak]{display:none!important}</style>
</head>
<body class="min-h-screen font-sans antialiased">

<div class="min-h-screen grid grid-cols-1 lg:grid-cols-2">

    {{-- Kiri — foto & branding --}}
    <div class="hidden lg:block relative overflow-hidden bg-gradient-to-br from-green-800 to-green-600">
        {{-- Slot foto login — ganti div ini dengan: <img src="/images/login-bg.jpg" class="absolute inset-0 w-full h-full object-cover"> --}}
        <div class="absolute inset-0 flex items-center justify-center pointer-events-none opacity-10">
            <svg class="w-32 h-32 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="0.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        </div>
        <div class="absolute inset-0 bg-gradient-to-br from-green-900/80 to-green-700/60"></div>
        <div class="absolute inset-0 flex flex-col justify-between p-12">
            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3 w-fit">
                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-md">
                    <svg viewBox="0 0 24 24" class="w-5 h-5 fill-green-700">
                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                    </svg>
                </div>
                <div>
                    <div class="text-white font-bold text-lg leading-none">SAPAsubang</div>
                    <div class="text-green-300 text-xs leading-none mt-0.5">Kabupaten Subang</div>
                </div>
            </a>

            {{-- Tagline --}}
            <div>
                <h2 class="text-3xl font-bold text-white leading-snug mb-4">
                    Bersama menjaga Subang<br>lebih bersih & nyaman.
                </h2>
                <p class="text-green-100/80 text-sm leading-relaxed max-w-sm mb-8">
                    Laporkan masalah fasilitas umum dan bantu pemerintah merespons lebih cepat.
                </p>
                {{-- Benefit list --}}
                <div class="space-y-2.5">
                    @foreach(['Laporkan masalah dalam hitungan menit','Pantau status laporan secara real-time','Dapat notifikasi saat laporan selesai ditangani'] as $item)
                    <div class="flex items-center gap-3">
                        <div class="w-5 h-5 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <span class="text-green-100 text-sm">{{ $item }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- Kanan — form login --}}
    <div class="flex items-center justify-center bg-white px-6 py-12">
        <div class="w-full max-w-sm">

            {{-- Logo mobile --}}
            <a href="{{ route('home') }}" class="lg:hidden flex items-center gap-2 mb-8">
                <div class="w-9 h-9 bg-green-600 rounded-xl flex items-center justify-center">
                    <svg viewBox="0 0 24 24" class="w-5 h-5 fill-white">
                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                    </svg>
                </div>
                <span class="font-bold text-gray-900">SAPAsubang</span>
            </a>

            <div class="mb-8">
                <h1 class="text-2xl font-bold text-gray-900">Masuk ke Akun</h1>
                <p class="text-gray-500 text-sm mt-1.5">
                    Masuk untuk mulai melaporkan masalah di sekitar Anda.
                </p>
            </div>

            {{-- Error umum --}}
            @if($errors->any() && !$errors->has('email') && !$errors->has('password'))
            <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-xl text-sm text-red-600">
                {{ $errors->first() }}
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           autofocus required autocomplete="email"
                           placeholder="email@example.com"
                           class="w-full border rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all placeholder-gray-300
                                  {{ $errors->has('email') ? 'border-red-400 bg-red-50' : 'border-gray-200 hover:border-gray-300' }}">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                            <svg class="w-3 h-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Password</label>
                    <input type="password" name="password"
                           required autocomplete="current-password"
                           placeholder="••••••••"
                           class="w-full border rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all placeholder-gray-300
                                  {{ $errors->has('password') ? 'border-red-400 bg-red-50' : 'border-gray-200 hover:border-gray-300' }}">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                            <svg class="w-3 h-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 cursor-pointer select-none">
                        <input type="checkbox" name="remember"
                               class="w-4 h-4 rounded border-gray-300 text-green-600 focus:ring-green-500 cursor-pointer">
                        <span class="text-sm text-gray-600">Ingat saya</span>
                    </label>
                    <a href="{{ route('password.request') }}" class="text-sm text-green-600 hover:text-green-700 hover:underline font-medium">
                        Lupa password?
                    </a>
                </div>

                <button type="submit"
                        class="w-full bg-green-600 hover:bg-green-700 active:bg-green-800 text-white font-semibold py-3 rounded-xl transition-colors shadow-sm text-sm mt-2">
                    Masuk
                </button>
            </form>

            {{-- Divider --}}
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-100"></div>
                </div>
                <div class="relative flex justify-center">
                    <span class="px-3 bg-white text-xs text-gray-400">atau masuk dengan</span>
                </div>
            </div>

            {{-- Tombol Google --}}
            <a href="{{ route('auth.google') }}"
               class="w-full flex items-center justify-center gap-3 border border-gray-200 hover:border-gray-300 hover:bg-gray-50 text-gray-700 font-semibold py-3 rounded-xl transition-all text-sm">
                {{-- Logo Google --}}
                <svg class="w-5 h-5" viewBox="0 0 24 24">
                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"/>
                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                </svg>
                Masuk dengan Google
            </a>

            {{-- Divider daftar --}}
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-100"></div>
                </div>
                <div class="relative flex justify-center">
                    <span class="px-3 bg-white text-xs text-gray-400">Belum punya akun?</span>
                </div>
            </div>

            {{-- Tombol daftar --}}
            <a href="{{ route('register') }}"
               class="w-full flex items-center justify-center gap-2 border border-gray-200 hover:border-green-400 hover:bg-green-50 text-gray-700 hover:text-green-700 font-semibold py-3 rounded-xl transition-all text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                </svg>
                Daftar Akun Baru — Gratis
            </a>

            <p class="text-center text-xs text-gray-400 mt-6">
                Dengan masuk, Anda menyetujui
                <a href="#" class="underline hover:text-gray-600">syarat layanan</a>
                SAPAsubang.
            </p>

        </div>
    </div>
</div>

@vite(['resources/js/app.js'])
</body>
</html>
