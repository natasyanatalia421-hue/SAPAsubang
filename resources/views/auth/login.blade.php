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

    {{-- Kiri — foto --}}
    <div class="hidden lg:block relative overflow-hidden">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRbnqCa7wi61HMph2rcSACR5iC8BKwrt2xbNgtOtPcAGQ&s=10"
             alt="Subang" class="absolute inset-0 w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-br from-green-900/80 to-green-700/60"></div>
        <div class="absolute inset-0 flex flex-col justify-between p-12">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center">
                    <svg viewBox="0 0 24 24" class="w-5 h-5 fill-green-700"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                </div>
                <div>
                    <div class="text-white font-bold text-lg leading-none">SAPAsubang</div>
                    <div class="text-green-300 text-xs leading-none mt-0.5">Kabupaten Subang</div>
                </div>
            </a>
            <div>
                <h2 class="text-3xl font-bold text-white mb-3">Bersama menjaga Subang<br>lebih bersih & nyaman.</h2>
                <p class="text-green-100/80 text-sm leading-relaxed max-w-sm">
                    Laporkan masalah fasilitas umum dan bantu pemerintah merespons lebih cepat melalui SAPAsubang.
                </p>
            </div>
        </div>
    </div>

    {{-- Kanan — form --}}
    <div class="flex items-center justify-center bg-white p-8">
        <div class="w-full max-w-md">

            {{-- Logo mobile --}}
            <a href="{{ route('home') }}" class="lg:hidden flex items-center gap-2 mb-8">
                <div class="w-9 h-9 bg-green-600 rounded-xl flex items-center justify-center">
                    <svg viewBox="0 0 24 24" class="w-5 h-5 fill-white"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                </div>
                <span class="font-bold text-gray-900">SAPAsubang</span>
            </a>

            <div class="mb-8">
                <h1 class="text-2xl font-bold text-gray-900">Login ke Akun Anda</h1>
                <p class="text-gray-500 text-sm mt-1">Silakan login untuk membuat laporan</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" autofocus required
                           placeholder="email@example.com"
                           class="w-full border {{ $errors->has('email') ? 'border-red-400 bg-red-50' : 'border-gray-200' }} rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all placeholder-gray-400">
                    @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Password</label>
                    <input type="password" name="password" required
                           placeholder="••••••••"
                           class="w-full border {{ $errors->has('password') ? 'border-red-400 bg-red-50' : 'border-gray-200' }} rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all placeholder-gray-400">
                    @error('password')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded border-gray-300 text-green-600 focus:ring-green-500">
                        Ingat saya
                    </label>
                </div>

                <button type="submit"
                        class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-xl transition-colors shadow-sm hover:shadow-md text-sm">
                    Masuk
                </button>
            </form>

            <p class="text-center text-sm text-gray-500 mt-6">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-green-600 font-semibold hover:underline">Daftar di sini</a>
            </p>

            {{-- Demo accounts --}}
            <div class="mt-8 p-4 bg-gray-50 rounded-xl border border-gray-100">
                <p class="text-xs font-semibold text-gray-600 mb-2.5 flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
                    Akun Demo
                </p>
                <div class="space-y-1.5 text-xs text-gray-500">
                    <div class="flex justify-between"><span class="font-medium text-indigo-600">Admin</span><span>admin@laporin.id / password</span></div>
                    <div class="flex justify-between"><span class="font-medium text-teal-600">Petugas</span><span>budi@laporin.id / password</span></div>
                    <div class="flex justify-between"><span class="font-medium text-green-600">User</span><span>ahmad@example.com / password</span></div>
                </div>
            </div>
        </div>
    </div>
</div>

@vite(['resources/js/app.js'])
</body>
</html>
