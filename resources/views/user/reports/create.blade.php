@extends('layouts.dashboard')
@section('title', 'Buat Laporan')
@section('page-title', 'Buat Laporan Baru')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden"
         x-data="reportForm()">

        {{-- Progress steps --}}
        <div class="bg-gray-50 border-b border-gray-100 px-6 py-4">
            <div class="flex items-center gap-2 text-sm">
                <div :class="step >= 1 ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-500'"
                     class="w-7 h-7 rounded-full flex items-center justify-center font-semibold text-xs transition-colors">1</div>
                <div class="flex-1 h-0.5" :class="step >= 2 ? 'bg-blue-600' : 'bg-gray-200'"></div>
                <div :class="step >= 2 ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-500'"
                     class="w-7 h-7 rounded-full flex items-center justify-center font-semibold text-xs transition-colors">2</div>
                <div class="flex-1 h-0.5" :class="step >= 3 ? 'bg-blue-600' : 'bg-gray-200'"></div>
                <div :class="step >= 3 ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-500'"
                     class="w-7 h-7 rounded-full flex items-center justify-center font-semibold text-xs transition-colors">3</div>
            </div>
            <div class="flex justify-between mt-1 text-xs text-gray-500">
                <span>Foto</span><span>Lokasi & Kategori</span><span>Deskripsi</span>
            </div>
        </div>

        <form method="POST" action="{{ route('user.reports.store') }}" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf

            {{-- STEP 1: Foto --}}
            <div x-show="step === 1" x-transition>
                <h2 class="text-lg font-semibold text-gray-800 mb-4">📸 Ambil Foto Masalah</h2>

                {{-- Area kamera / upload --}}
                <div class="space-y-4">
                    {{-- Preview --}}
                    <div x-show="photoPreview" class="relative rounded-xl overflow-hidden bg-gray-100 aspect-video">
                        <img :src="photoPreview" class="w-full h-full object-cover">
                        <button type="button" @click="clearPhoto()"
                                class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-8 h-8 flex items-center justify-center text-xs hover:bg-red-600">✕</button>
                    </div>

                    <div x-show="!photoPreview" class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center space-y-4">
                        <div class="text-4xl">📷</div>
                        <p class="text-gray-500 text-sm">Ambil foto atau upload gambar masalah</p>

                        {{-- Kamera (mobile) --}}
                        <div class="flex flex-col sm:flex-row gap-3 justify-center">
                            <label class="cursor-pointer bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2.5 rounded-lg transition-colors flex items-center gap-2 justify-center">
                                📷 Buka Kamera
                                <input type="file" name="foto_sebelum" accept="image/*" capture="environment"
                                       class="hidden" @change="onPhotoChange($event)" x-ref="cameraInput">
                            </label>
                            <label class="cursor-pointer bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium px-4 py-2.5 rounded-lg transition-colors flex items-center gap-2 justify-center">
                                🖼️ Upload Foto
                                <input type="file" name="foto_sebelum" accept="image/*"
                                       class="hidden" @change="onPhotoChange($event)" x-ref="fileInput">
                            </label>
                        </div>
                    </div>
                </div>

                @error('foto_sebelum')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror

                <div class="mt-6 flex justify-end">
                    <button type="button" @click="nextStep()" :disabled="!photoPreview"
                            class="bg-blue-600 hover:bg-blue-700 disabled:opacity-40 disabled:cursor-not-allowed text-white font-medium px-6 py-2.5 rounded-lg transition-colors">
                        Lanjut →
                    </button>
                </div>
            </div>

            {{-- STEP 2: Lokasi & Kategori --}}
            <div x-show="step === 2" x-transition>
                <h2 class="text-lg font-semibold text-gray-800 mb-4">📍 Lokasi & Kategori</h2>

                {{-- GPS --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Lokasi GPS</label>
                    <div class="flex gap-2">
                        <button type="button" @click="getLocation()"
                                :disabled="locLoading"
                                class="flex items-center gap-2 bg-green-600 hover:bg-green-700 disabled:opacity-50 text-white text-sm font-medium px-4 py-2 rounded-lg transition-colors">
                            <span x-show="!locLoading">📍 Ambil Lokasi Saya</span>
                            <span x-show="locLoading" class="flex items-center gap-2">
                                <svg class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                                </svg>
                                Mengambil lokasi...
                            </span>
                        </button>
                    </div>

                    <div x-show="latitude" class="mt-2 text-sm text-green-600 font-medium">
                        ✅ Lokasi berhasil diambil: <span x-text="latitude"></span>, <span x-text="longitude"></span>
                    </div>
                    <div x-show="locError" class="mt-2 text-sm text-red-500" x-text="locError"></div>

                    {{-- Mini map preview --}}
                    <div x-show="latitude" class="mt-3 rounded-xl overflow-hidden border border-gray-200" style="height:200px" id="mini-map"></div>

                    <input type="hidden" name="latitude" :value="latitude">
                    <input type="hidden" name="longitude" :value="longitude">
                </div>

                @error('latitude')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
                @error('longitude')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror

                {{-- Kategori --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kategori Masalah</label>
                    <div class="grid grid-cols-2 gap-2">
                        @foreach($categories as $cat)
                        <label class="cursor-pointer">
                            <input type="radio" name="category_id" value="{{ $cat->id }}" class="sr-only peer"
                                   @change="selectedCategory = {{ $cat->id }}" x-model="selectedCategory">
                            <div class="peer-checked:border-blue-500 peer-checked:bg-blue-50 peer-checked:text-blue-700
                                        border border-gray-200 rounded-xl p-3 flex items-center gap-3 hover:border-blue-300 transition-colors">
                                <span class="text-xl">{{ $cat->icon }}</span>
                                <span class="text-sm font-medium leading-tight">{{ $cat->nama_kategori }}</span>
                            </div>
                        </label>
                        @endforeach
                    </div>
                    @error('category_id')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="mt-6 flex justify-between">
                    <button type="button" @click="step = 1"
                            class="text-gray-600 hover:text-gray-800 font-medium px-4 py-2.5 rounded-lg hover:bg-gray-100 transition-colors">
                        ← Kembali
                    </button>
                    <button type="button" @click="nextStep()" :disabled="!latitude || !selectedCategory"
                            class="bg-blue-600 hover:bg-blue-700 disabled:opacity-40 disabled:cursor-not-allowed text-white font-medium px-6 py-2.5 rounded-lg transition-colors">
                        Lanjut →
                    </button>
                </div>
            </div>

            {{-- STEP 3: Deskripsi & Submit --}}
            <div x-show="step === 3" x-transition>
                <h2 class="text-lg font-semibold text-gray-800 mb-4">📝 Deskripsi Masalah</h2>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Jelaskan masalah secara singkat <span class="text-red-500">*</span>
                    </label>
                    <textarea name="deskripsi" rows="5" required
                              class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none @error('deskripsi') border-red-400 @enderror"
                              placeholder="Contoh: Terdapat lubang besar di tengah jalan berukuran sekitar 50cm, sudah terjadi lebih dari 2 minggu dan berbahaya bagi pengendara..."
                              maxlength="1000">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                {{-- Ringkasan --}}
                <div class="mt-4 bg-gray-50 rounded-xl p-4 space-y-2 text-sm">
                    <h4 class="font-medium text-gray-700">Ringkasan Laporan</h4>
                    <div class="flex gap-2 text-gray-600">
                        <span>📍</span>
                        <span x-text="latitude ? `${parseFloat(latitude).toFixed(5)}, ${parseFloat(longitude).toFixed(5)}` : '-'"></span>
                    </div>
                    <div class="flex gap-2 text-gray-600">
                        <span>🏷️</span>
                        <span x-text="selectedCategory ? 'Kategori dipilih' : '-'"></span>
                    </div>
                    <div class="flex gap-2 text-gray-600">
                        <span>📸</span>
                        <span x-text="photoPreview ? 'Foto siap' : 'Belum ada foto'"></span>
                    </div>
                </div>

                <div class="mt-6 flex justify-between">
                    <button type="button" @click="step = 2"
                            class="text-gray-600 hover:text-gray-800 font-medium px-4 py-2.5 rounded-lg hover:bg-gray-100 transition-colors">
                        ← Kembali
                    </button>
                    <button type="submit" id="submit-btn"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-2.5 rounded-lg transition-colors flex items-center gap-2">
                        🚀 Kirim Laporan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
function reportForm() {
    return {
        step: 1,
        photoPreview: null,
        photoFile: null,
        latitude: '{{ old('latitude') }}',
        longitude: '{{ old('longitude') }}',
        locLoading: false,
        locError: null,
        selectedCategory: '{{ old('category_id') }}',
        miniMap: null,
        miniMarker: null,

        onPhotoChange(event) {
            const file = event.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = (e) => { this.photoPreview = e.target.result; };
            reader.readAsDataURL(file);
        },

        clearPhoto() {
            this.photoPreview = null;
            if (this.$refs.cameraInput) this.$refs.cameraInput.value = '';
            if (this.$refs.fileInput) this.$refs.fileInput.value = '';
        },

        nextStep() {
            this.step++;
            if (this.step === 2 && this.latitude) {
                this.$nextTick(() => this.initMiniMap());
            }
        },

        getLocation() {
            this.locLoading = true;
            this.locError = null;
            if (!navigator.geolocation) {
                this.locError = 'Browser tidak mendukung GPS. Masukkan koordinat manual.';
                this.locLoading = false;
                return;
            }
            navigator.geolocation.getCurrentPosition(
                (pos) => {
                    this.latitude = pos.coords.latitude.toFixed(7);
                    this.longitude = pos.coords.longitude.toFixed(7);
                    this.locLoading = false;
                    this.$nextTick(() => this.initMiniMap());
                },
                (err) => {
                    this.locError = 'Gagal mengambil lokasi: ' + err.message + '. Pastikan GPS aktif dan izin diberikan.';
                    this.locLoading = false;
                },
                { enableHighAccuracy: true, timeout: 10000 }
            );
        },

        initMiniMap() {
            const el = document.getElementById('mini-map');
            if (!el || !this.latitude) return;

            const lat = parseFloat(this.latitude);
            const lng = parseFloat(this.longitude);

            if (!this.miniMap) {
                this.miniMap = L.map('mini-map').setView([lat, lng], 16);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap'
                }).addTo(this.miniMap);
                this.miniMarker = L.marker([lat, lng]).addTo(this.miniMap).bindPopup('Lokasi masalah').openPopup();
            } else {
                this.miniMap.setView([lat, lng], 16);
                this.miniMarker.setLatLng([lat, lng]);
            }
        }
    }
}
</script>
@endpush
