<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar — SAPAsubang</title>
    @vite(['resources/css/app.css'])
</head>
<body class="min-h-screen font-sans antialiased">

<div class="min-h-screen grid grid-cols-1 lg:grid-cols-2">

    {{-- Kiri --}}
    <div class="hidden lg:block relative overflow-hidden">
        <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=1200&q=80"
             alt="Subang" class="absolute inset-0 w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-br from-green-900/80 to-teal-700/60"></div>
        <div class="absolute inset-0 flex flex-col justify-between p-12">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center">
                    <svg viewBox="0 0 24 24" class="w-5 h-5 fill-green-700"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                </div>
                <div>
                    <div class="text-white font-bold text-lg">SAPAsubang</div>
                    <div class="text-green-300 text-xs">Kabupaten Subang</div>
                </div>
            </a>
            <div>
                <h2 class="text-3xl font-bold text-white mb-3">Bergabung bersama ribuan<br>pelapor aktif Subang.</h2>
                <p class="text-green-100/80 text-sm leading-relaxed max-w-sm">
                    Daftar sekarang dan mulai berkontribusi untuk kota yang lebih baik.
                </p>
            </div>
        </div>
    </div>

    {{-- Kanan --}}
    <div class="flex items-center justify-center bg-white p-8">
        <div class="w-full max-w-md">

            <a href="{{ route('home') }}" class="lg:hidden flex items-center gap-2 mb-8">
                <div class="w-9 h-9 bg-green-600 rounded-xl flex items-center justify-center">
                    <svg viewBox="0 0 24 24" class="w-5 h-5 fill-white"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                </div>
                <span class="font-bold text-gray-900">SAPAsubang</span>
            </a>

            <div class="mb-8">
                <h1 class="text-2xl font-bold text-gray-900">Buat Akun Baru</h1>
                <p class="text-gray-500 text-sm mt-1">Daftar sebagai pelapor masyarakat</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                           placeholder="Nama lengkap Anda"
                           class="w-full border {{ $errors->has('name') ? 'border-red-400 bg-red-50' : 'border-gray-200' }} rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all placeholder-gray-400">
                    @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                           placeholder="email@example.com"
                           class="w-full border {{ $errors->has('email') ? 'border-red-400 bg-red-50' : 'border-gray-200' }} rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all placeholder-gray-400">
                    @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">No. HP <span class="text-gray-400 font-normal">(opsional)</span></label>
                    <input type="tel" name="no_hp" value="{{ old('no_hp') }}"
                           placeholder="0812xxxxxxxx"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all placeholder-gray-400">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Password</label>
                        <input type="password" name="password" required
                               placeholder="Min. 8 karakter"
                               class="w-full border {{ $errors->has('password') ? 'border-red-400 bg-red-50' : 'border-gray-200' }} rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all placeholder-gray-400">
                        @error('password')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Konfirmasi</label>
                        <input type="password" name="password_confirmation" required
                               placeholder="Ulangi password"
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all placeholder-gray-400">
                    </div>
                </div>

                <button type="submit"
                        class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-xl transition-colors shadow-sm hover:shadow-md text-sm mt-2">
                    Daftar Sekarang
                </button>
            </form>

            <p class="text-center text-sm text-gray-500 mt-6">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-green-600 font-semibold hover:underline">Masuk di sini</a>
            </p>

            <p class="text-center text-xs text-gray-400 mt-4">
                Dengan mendaftar, Anda menyetujui ketentuan penggunaan platform SAPAsubang.
            </p>
        </div>
    </div>
</div>

@vite(['resources/js/app.js'])
</body>
</html>
