<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password — SAPAsubang</title>
    @vite(['resources/css/app.css'])
</head>
<body class="min-h-screen font-sans antialiased bg-gray-50 flex items-center justify-center p-4">

<div class="w-full max-w-md">

    {{-- Logo --}}
    <div class="text-center mb-8">
        <a href="{{ route('home') }}" class="inline-flex flex-col items-center gap-2">
            <div class="w-14 h-14 bg-green-700 rounded-2xl flex items-center justify-center shadow-lg">
                <img src="{{ asset('images/logo-subang.png') }}" alt="Logo" class="w-10 h-10 object-contain"
                     onerror="this.parentElement.innerHTML='<svg viewBox=\'0 0 40 40\' class=\'w-10 h-10\'><circle cx=\'20\' cy=\'20\' r=\'18\' fill=\'white\'/><path d=\'M20 6 L22 14 L30 14 L24 19 L26 27 L20 22 L14 27 L16 19 L10 14 L18 14 Z\' fill=\'#16a34a\'/></svg>'">
            </div>
            <div>
                <div class="font-extrabold text-green-800 text-lg leading-none">SAPAsubang</div>
                <div class="text-xs text-gray-400 mt-0.5">Kabupaten Subang</div>
            </div>
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        <div class="text-center mb-6">
            <div class="w-14 h-14 bg-yellow-50 border-2 border-yellow-200 rounded-2xl flex items-center justify-center text-3xl mx-auto mb-4">🔑</div>
            <h1 class="text-xl font-bold text-gray-900">Lupa Password?</h1>
            <p class="text-gray-500 text-sm mt-2 leading-relaxed">
                Masukkan email yang terdaftar. Kami akan mengirim instruksi reset password ke email Anda.
            </p>
        </div>

        {{-- Status pesan --}}
        @if (session('status'))
        <div class="mb-5 bg-green-50 border border-green-200 text-green-700 text-sm px-4 py-4 rounded-xl space-y-2">
            <div class="flex items-center gap-2 font-semibold">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                Email berhasil dikirim!
            </div>
            <p class="text-xs leading-relaxed text-green-600">
                Link reset password telah dikirim ke email Anda. Silakan cek inbox atau folder <strong>spam/junk</strong>.
                Link berlaku selama <strong>60 menit</strong>.
            </p>
            @if(config('app.env') === 'local')
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3 mt-2">
                <p class="text-xs text-yellow-700 font-semibold mb-1">⚠️ Mode Development</p>
                <p class="text-xs text-yellow-600 leading-relaxed">
                    Email dikirim melalui Mailtrap. Buka
                    <a href="https://mailtrap.io" target="_blank" class="underline font-semibold">mailtrap.io</a>
                    untuk melihat email yang masuk.
                    Atau cek <code class="bg-yellow-100 px-1 rounded">storage/logs/laravel.log</code> untuk link reset.
                </p>
            </div>
            @endif
        </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                       required autofocus autocomplete="email"
                       placeholder="email@example.com"
                       class="w-full border rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all placeholder-gray-300
                              {{ $errors->has('email') ? 'border-red-400 bg-red-50' : 'border-gray-200 hover:border-gray-300' }}">
                @error('email')
                    <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                    class="w-full bg-green-700 hover:bg-green-800 text-white font-semibold py-3 rounded-xl transition-colors shadow-sm text-sm">
                Kirim Link Reset Password
            </button>
        </form>

        <div class="text-center mt-5">
            <a href="{{ route('login') }}" class="text-sm text-gray-500 hover:text-green-700 flex items-center justify-center gap-1.5 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Kembali ke halaman login
            </a>
        </div>
    </div>
</div>

@vite(['resources/js/app.js'])
</body>
</html>
