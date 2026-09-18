<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password — SAPAsubang</title>
    @vite(['resources/css/app.css'])
</head>
<body class="min-h-screen font-sans antialiased bg-gray-50 flex items-center justify-center p-4">

<div class="w-full max-w-md">

    <div class="text-center mb-8">
        <a href="{{ route('home') }}" class="inline-flex flex-col items-center gap-2">
            <div class="w-14 h-14 bg-green-700 rounded-2xl flex items-center justify-center shadow-lg">
                <img src="{{ asset('images/logo-subang.png') }}" alt="Logo" class="w-10 h-10 object-contain"
                     onerror="this.parentElement.innerHTML='<svg viewBox=\'0 0 40 40\' class=\'w-10 h-10\'><circle cx=\'20\' cy=\'20\' r=\'18\' fill=\'white\'/><path d=\'M20 6 L22 14 L30 14 L24 19 L26 27 L20 22 L14 27 L16 19 L10 14 L18 14 Z\' fill=\'#16a34a\'/></svg>'">
            </div>
            <div>
                <div class="font-extrabold text-green-800 text-lg">SAPAsubang</div>
            </div>
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        <div class="text-center mb-6">
            <h1 class="text-xl font-bold text-gray-900">Reset Password</h1>
            <p class="text-gray-500 text-sm mt-2">Buat password baru untuk akun Anda.</p>
        </div>

        <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                <input type="email" name="email" value="{{ old('email', $request->email) }}"
                       required autocomplete="username"
                       class="w-full border rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all
                              {{ $errors->has('email') ? 'border-red-400 bg-red-50' : 'border-gray-200' }}">
                @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Password Baru</label>
                <input type="password" name="password" required autocomplete="new-password"
                       placeholder="Minimal 8 karakter"
                       class="w-full border rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all placeholder-gray-300
                              {{ $errors->has('password') ? 'border-red-400 bg-red-50' : 'border-gray-200' }}">
                @error('password')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required autocomplete="new-password"
                       placeholder="Ulangi password baru"
                       class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all placeholder-gray-300">
            </div>

            <button type="submit"
                    class="w-full bg-green-700 hover:bg-green-800 text-white font-semibold py-3 rounded-xl transition-colors shadow-sm text-sm">
                Reset Password
            </button>
        </form>
    </div>
</div>

@vite(['resources/js/app.js'])
</body>
</html>
