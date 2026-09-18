<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ], [
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => 'Email atau password salah.',
            ]);
        }

        $request->session()->regenerate();

        // Jika ada intended URL (mis. datang dari halaman laporan), balik ke sana
        // Default: ke dashboard sesuai role
        $default = $this->redirectTo();
        return redirect()->intended($default);
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name'                  => 'required|string|max:100',
            'email'                 => 'required|email|unique:users,email',
            'no_hp'                 => 'nullable|string|max:20',
            'password'              => 'required|min:8|confirmed',
        ], [
            'name.required'      => 'Nama wajib diisi.',
            'email.required'     => 'Email wajib diisi.',
            'email.unique'       => 'Email sudah terdaftar.',
            'password.required'  => 'Password wajib diisi.',
            'password.min'       => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'no_hp'    => $data['no_hp'] ?? null,
            'password' => $data['password'],
            'role'     => 'user',
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('user.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    private function redirectTo(): string
    {
        return match (Auth::user()->role) {
            'admin'   => route('admin.dashboard'),
            'petugas' => route('petugas.dashboard'),
            default   => route('user.dashboard'),
        };
    }

    // ── Lupa Password ─────────────────────────────────────────────────────────

    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email'    => 'Format email tidak valid.',
            'email.exists'   => 'Email tidak terdaftar di sistem.',
        ]);

        try {
            $status = \Illuminate\Support\Facades\Password::sendResetLink(
                $request->only('email')
            );
        } catch (\Exception $e) {
            // Jika SMTP gagal, tetap anggap berhasil (log mode)
            $status = \Illuminate\Support\Facades\Password::RESET_LINK_SENT;
        }

        if ($status === \Illuminate\Support\Facades\Password::RESET_LINK_SENT) {
            return back()->with('status', 'berhasil');
        }

        return back()->withErrors(['email' => 'Gagal mengirim link. Coba lagi.']);
    }

    public function showResetPassword(Request $request, string $token)
    {
        return view('auth.reset-password', ['request' => $request, 'token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token'    => 'required',
            'email'    => 'required|email',
            'password' => 'required|min:8|confirmed',
        ], [
            'password.min'       => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $status = \Illuminate\Support\Facades\Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill(['password' => $password])->save();
                \Illuminate\Support\Facades\Auth::login($user);
            }
        );

        if ($status === \Illuminate\Support\Facades\Password::PASSWORD_RESET) {
            return redirect()->route('user.dashboard')
                ->with('success', 'Password berhasil direset. Selamat datang!');
        }

        return back()->withErrors(['email' => __($status)]);
    }
}
