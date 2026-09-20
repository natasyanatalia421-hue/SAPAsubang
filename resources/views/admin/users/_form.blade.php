@php
    $selectedCats = array_map('intval', old(
        'spesialisasi_kategori',
        $user->exists ? ($user->officer?->spesialisasi_kategori ?? []) : []
    ));
    $inputClass = 'w-full px-3 py-2 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500';
@endphp

@csrf

<div class="space-y-4" x-data="{ role: '{{ old('role', $user->role) }}' }">
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Nama *</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="{{ $inputClass }}">
            @error('name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Email *</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="{{ $inputClass }}">
            @error('email') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">No. HP</label>
            <input type="tel" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}" class="{{ $inputClass }}">
            @error('no_hp') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Role *</label>
            <select name="role" x-model="role" required class="{{ $inputClass }}">
                @foreach($roles as $value => $label)
                    <option value="{{ $value }}">{{ $label }}</option>
                @endforeach
            </select>
            @error('role') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        @unless($user->exists)
            <div>
                <label class="block text-xs font-medium text-gray-700 mb-1">Password *</label>
                <input type="password" name="password" required minlength="8" class="{{ $inputClass }}">
                @error('password') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-700 mb-1">Konfirmasi Password *</label>
                <input type="password" name="password_confirmation" required minlength="8" class="{{ $inputClass }}">
            </div>
        @endunless
    </div>

    {{-- Spesialisasi: hanya untuk petugas --}}
    <div x-show="role === 'petugas'" x-cloak>
        <label class="block text-xs font-medium text-gray-700 mb-2">Spesialisasi Kategori</label>
        <div class="flex flex-wrap gap-3">
            @foreach($categories as $cat)
                <label class="flex items-center gap-2 text-sm cursor-pointer">
                    <input type="checkbox" name="spesialisasi_kategori[]" value="{{ $cat->id }}"
                           class="rounded" @checked(in_array($cat->id, $selectedCats))>
                    {{ $cat->icon }} {{ $cat->nama_kategori }}
                </label>
            @endforeach
        </div>
    </div>
</div>