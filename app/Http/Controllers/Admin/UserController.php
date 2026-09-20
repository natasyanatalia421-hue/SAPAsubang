<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Officer;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class UserController extends Controller
{
    public const ROLES = [
        'admin'   => 'Admin',
        'petugas' => 'Petugas',
        'user'    => 'Pelapor',
    ];

    public function index(Request $request): View
    {
        $users = User::query()
            ->with('officer')
            ->when($request->filled('q'), function ($query) use ($request) {
                $keyword = $request->q;

                $query->where(function ($sub) use ($keyword) {
                    $sub->where('name', 'like', "%{$keyword}%")
                        ->orWhere('email', 'like', "%{$keyword}%");
                });
            })
            ->when($request->filled('role'), fn ($query) => $query->where('role', $request->role))
            ->when($request->filled('status'), fn ($query) => $query->where('is_active', $request->status === 'aktif'))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.users.index', [
            'users' => $users,
            'roles' => self::ROLES,
        ]);
    }

    public function create(): View
    {
        return view('admin.users.create', [
            'user'       => new User(['role' => 'petugas']),
            'roles'      => $this->availableRoles(),
            'categories' => Category::orderBy('nama_kategori')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name'                    => ['required', 'string', 'max:255'],
            'email'                   => ['required', 'email', 'max:255', 'unique:users,email'],
            'role'                    => ['required', Rule::in(array_keys(self::ROLES))],
            'no_hp'                   => ['nullable', 'string', 'max:20'],
            'password'                => ['required', 'confirmed', Password::min(8)],
            'spesialisasi_kategori'   => ['nullable', 'array'],
            'spesialisasi_kategori.*' => ['exists:categories,id'],
        ]);

        if ($data['role'] === 'admin' && ! auth()->user()->isSuperAdmin()) {
            return back()->withInput()->with('error', 'Hanya super admin yang dapat membuat akun admin.');
        }

        $user = DB::transaction(function () use ($data) {
            $user = new User();
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->role = $data['role'];
            $user->no_hp = $data['no_hp'] ?? null;
            $user->password = Hash::make($data['password']);
            $user->is_active = true;
            $user->email_verified_at = now();
            $user->save();

            if ($user->role === 'petugas') {
                Officer::create([
                    'user_id'               => $user->id,
                    'spesialisasi_kategori' => $data['spesialisasi_kategori'] ?? [],
                    'status_aktif'          => true,
                ]);
            }

            return $user;
        });

        return redirect()
            ->route('admin.users.index')
            ->with('success', "Akun {$user->name} berhasil dibuat.");
    }

    public function edit(User $user): View|RedirectResponse
    {
        if ($denied = $this->denyUnlessAllowed($user)) {
            return $denied;
        }

        return view('admin.users.edit', [
            'user'       => $user->load('officer'),
            'roles'      => $this->availableRoles($user->role),
            'categories' => Category::orderBy('nama_kategori')->get(),
        ]);
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        if ($denied = $this->denyUnlessAllowed($user)) {
            return $denied;
        }

        $data = $request->validate([
            'name'                    => ['required', 'string', 'max:255'],
            'email'                   => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'role'                    => ['required', Rule::in(array_keys(self::ROLES))],
            'no_hp'                   => ['nullable', 'string', 'max:20'],
            'spesialisasi_kategori'   => ['nullable', 'array'],
            'spesialisasi_kategori.*' => ['exists:categories,id'],
        ]);

        $roleChanged = $data['role'] !== $user->role;

        if ($roleChanged && $user->id === auth()->id()) {
            return back()->withInput()->with('error', 'Kamu tidak bisa mengubah role akunmu sendiri.');
        }

        if ($roleChanged && $data['role'] === 'admin' && ! auth()->user()->isSuperAdmin()) {
            return back()->withInput()->with('error', 'Hanya super admin yang dapat menjadikan seseorang admin.');
        }

        if ($roleChanged && $user->role === 'admin' && $this->isLastActiveAdmin($user)) {
            return back()->withInput()->with('error', 'Tidak bisa mengubah role admin terakhir.');
        }

        if ($roleChanged && $this->isLastActiveSuperAdmin($user)) {
            return back()->withInput()->with('error', 'Tidak bisa mengubah role super admin terakhir.');
        }

        if ($roleChanged && $user->role === 'petugas' && $this->hasActiveReports($user)) {
            return back()->withInput()->with('error', 'Petugas masih memiliki laporan aktif, role belum bisa diubah.');
        }

        DB::transaction(function () use ($user, $data, $roleChanged) {
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->role = $data['role'];
            $user->no_hp = $data['no_hp'] ?? null;

            // Status super admin hanya berlaku selama role-nya admin.
            if ($roleChanged && $user->role !== 'admin') {
                $user->is_super_admin = false;
            }

            $user->save();

            if ($user->role === 'petugas') {
                Officer::updateOrCreate(
                    ['user_id' => $user->id],
                    [
                        'spesialisasi_kategori' => $data['spesialisasi_kategori'] ?? [],
                        'status_aktif'          => $user->is_active,
                    ]
                );
            } else {
                $user->officer?->update(['status_aktif' => false]);
            }
        });

        return redirect()
            ->route('admin.users.index')
            ->with('success', "Akun {$user->name} berhasil diperbarui.");
    }

    public function resetPassword(Request $request, User $user): RedirectResponse
    {
        if ($denied = $this->denyUnlessAllowed($user)) {
            return $denied;
        }

        $request->validateWithBag('resetPassword', [
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user->password = Hash::make($request->password);
        $user->setRememberToken(Str::random(60));
        $user->save();

        return back()->with('success', "Password {$user->name} berhasil direset.");
    }

    public function toggleStatus(User $user): RedirectResponse
    {
        if ($denied = $this->denyUnlessAllowed($user)) {
            return $denied;
        }

        if ($user->id === auth()->id()) {
            return back()->with('error', 'Kamu tidak bisa menonaktifkan akunmu sendiri.');
        }

        if ($user->is_active && $user->role === 'admin' && $this->isLastActiveAdmin($user)) {
            return back()->with('error', 'Tidak bisa menonaktifkan admin aktif terakhir.');
        }

        if ($user->is_active && $this->isLastActiveSuperAdmin($user)) {
            return back()->with('error', 'Tidak bisa menonaktifkan super admin aktif terakhir.');
        }

        DB::transaction(function () use ($user) {
            $user->is_active = ! $user->is_active;
            $user->save();

            if ($user->role === 'petugas') {
                $user->officer?->update(['status_aktif' => $user->is_active]);
            }
        });

        $status = $user->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return back()->with('success', "Akun {$user->name} berhasil {$status}.");
    }

    public function destroy(User $user): RedirectResponse
    {
        if ($denied = $this->denyUnlessAllowed($user)) {
            return $denied;
        }

        if ($user->id === auth()->id()) {
            return back()->with('error', 'Kamu tidak bisa menghapus akunmu sendiri.');
        }

        if ($user->role === 'admin' && $this->isLastActiveAdmin($user)) {
            return back()->with('error', 'Tidak bisa menghapus admin terakhir.');
        }

        if ($this->isLastActiveSuperAdmin($user)) {
            return back()->with('error', 'Tidak bisa menghapus super admin terakhir.');
        }

        if ($this->hasActiveReports($user)) {
            return back()->with('error', 'Petugas masih memiliki laporan aktif.');
        }

        DB::transaction(function () use ($user) {
            $user->officer?->update(['status_aktif' => false]);
            $user->delete();
        });

        return redirect()
            ->route('admin.users.index')
            ->with('success', "Akun {$user->name} berhasil dihapus.");
    }

    /**
     * Akun admin hanya boleh dikelola super admin (atau pemilik akun itu sendiri).
     * Mengembalikan redirect berisi pesan error jika tidak diizinkan.
     */
    private function denyUnlessAllowed(User $target): ?RedirectResponse
    {
        $actor = auth()->user();

        if ($target->role === 'admin' && ! $actor->isSuperAdmin() && $target->id !== $actor->id) {
            return redirect()
                ->route('admin.users.index')
                ->with('error', 'Hanya super admin yang dapat mengelola akun admin.');
        }

        return null;
    }

    /**
     * Role yang boleh dipilih di form. Admin biasa tidak boleh memilih role admin.
     */
    private function availableRoles(?string $current = null): array
    {
        if (auth()->user()->isSuperAdmin()) {
            return self::ROLES;
        }

        $roles = self::ROLES;
        unset($roles['admin']);

        // Admin biasa yang membuka akunnya sendiri tetap perlu melihat role-nya.
        if ($current === 'admin') {
            $roles = ['admin' => self::ROLES['admin']] + $roles;
        }

        return $roles;
    }

    private function isLastActiveAdmin(User $user): bool
    {
        return User::where('role', 'admin')
            ->where('is_active', true)
            ->where('id', '!=', $user->id)
            ->doesntExist();
    }

    private function isLastActiveSuperAdmin(User $user): bool
    {
        if (! $user->is_super_admin) {
            return false;
        }

        return User::where('is_super_admin', true)
            ->where('is_active', true)
            ->where('id', '!=', $user->id)
            ->doesntExist();
    }

    private function hasActiveReports(User $user): bool
    {
        return $user->assignedReports()
            ->whereNotIn('status', ['selesai', 'ditolak'])
            ->exists();
    }
}