<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Officer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users   = User::where('role', 'user')->orderBy('name')->paginate(15);
        $petugas = User::where('role', 'petugas')->with('officer')->orderBy('name')->get();

        return view('admin.users.index', compact('users', 'petugas'));
    }

    public function storePetugas(Request $request)
    {
        $data = $request->validate([
            'name'                   => ['required', 'string', 'max:100'],
            'email'                  => ['required', 'email', 'unique:users'],
            'password'               => ['required', 'min:8'],
            'no_hp'                  => ['nullable', 'string', 'max:20'],
            'spesialisasi_kategori'  => ['nullable', 'array'],
            'spesialisasi_kategori.*'=> ['exists:categories,id'],
        ]);

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'role'     => 'petugas',
            'no_hp'    => $data['no_hp'] ?? null,
        ]);

        Officer::create([
            'user_id'               => $user->id,
            'spesialisasi_kategori' => $data['spesialisasi_kategori'] ?? [],
            'status_aktif'          => true,
        ]);

        return back()->with('success', "Petugas {$user->name} berhasil ditambahkan.");
    }

    public function destroyPetugas(User $user)
    {
        if ($user->role !== 'petugas') {
            return back()->with('error', 'User bukan petugas.');
        }

        if ($user->assignedReports()->whereNotIn('status', ['selesai', 'ditolak'])->exists()) {
            return back()->with('error', 'Petugas masih memiliki laporan aktif.');
        }

        $user->delete();
        return back()->with('success', 'Petugas berhasil dihapus.');
    }
}
