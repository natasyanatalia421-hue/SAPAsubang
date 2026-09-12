@extends('layouts.app')
@section('title', 'Buat Laporan')
@section('page-title', 'Laporkan Masalah')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-2xl border border-gray-200 p-6"
         x-data="reportForm()">

        @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6 text-sm">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('user.reports.store') }}" enctype="multipart/form-data"
              @submit.prevent="submitForm($event)" class="space-y-5">
            @csrf

            {{-- ── Step 1: Foto ────────────────────────────────────────────── --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                     Foto Masalah <span class="text-red-500">*</span>
                </label>

                {{-- Kamera / Upload --}}
                <div class="relative border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-indigo-400 transition-colors"
                     :class="photoPreview ? 'border-green-400 bg-green-50' : ''">

                    <input type="file" name="foto_sebelum" id="foto_sebelum" accept="image/*"
                           capture="environment"
                           class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                           @change="handlePhoto($event)" required>

                    <template x-if="!photoPreview">
                        <div>
                            <div class="text-4xl mb-2">📸</div>
                            <p class="text-sm text-gray-600 font-medium">Ambil foto atau pilih dari galeri</p>
                            <p class="text-xs text-gray-400 mt-1">JPG, PNG, WebP — maks 5MB</p>
                        </div>
                    </template>
                    <template x-if="photoPreview">
                        <div>
                            <img :src="photoPreview" class="max-h-48 mx-auto rounded-lg object-cover">
                            <p class="text-xs text-green-600 mt-2 font-medium">Foto siap dikirim — klik untuk ganti</p>
                        </div>
                    </template>
                </div>
            </div>

            {{-- ── Step 2: Lokasi GPS ──────────────────────────────────────── --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    📍 Lokasi Masalah <span class="text-red-500">*</span>
                </label>

                <div class="flex gap-2 mb-3">
                    <button type="button" @click="getLocation()"
                            class="flex-1 bg-sky-50 hover:bg-sky-100 border border-sky-200 text-sky-700 text-sm font-medium py-2.5 px-4 rounded-lg transition-colors flex items-center justify-center gap-2">
                        <span x-show="!locating">Ambil Lokasi Saya</span>
                        <span x-show="locating" x-cloak>⏳ Mengambil lokasi...</span>
                    </button>
                </div>

                {{-- Peta Leaflet --}}
                <div id="map" class="w-full h-52 rounded-xl border border-gray-200 z-0"></div>
                <p x-show="lat && lon" class="text-xs text-green-600 mt-1.5 font-medium">
                    Koordinat: <span x-text="lat.toFixed(6)"></span>, <span x-text="lon.toFixed(6)"></span>
                </p>
                <p x-show="!lat && !locating" class="text-xs text-gray-400 mt-1.5">
                    Klik "Ambil Lokasi Saya" atau klik pada peta untuk menentukan lokasi.
                </p>

                <input type="hidden" name="latitude"  :value="lat">
                <input type="hidden" name="longitude" :value="lon">
            </div>

            {{-- ── Step 3: Kategori ────────────────────────────────────────── --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Kategori Masalah <span class="text-red-500">*</span>
                </label>
                <div class="grid grid-cols-2 gap-2 sm:grid-cols-3">
                    @foreach($categories as $cat)
                    <label class="cursor-pointer">
                        <input type="radio" name="category_id" value="{{ $cat->id }}" class="sr-only peer"
                               {{ old('category_id') == $cat->id ? 'checked' : '' }} required>
                        <div class="border-2 border-gray-200 peer-checked:border-indigo-500 peer-checked:bg-indigo-50
                                    rounded-xl p-3 text-center transition-all hover:border-indigo-300">
                            <div class="text-2xl">{{ $cat->icon }}</div>
                            <div class="text-xs font-medium text-gray-700 mt-1">{{ $cat->nama_kategori }}</div>
                        </div>
                    </label>
                    @endforeach
                </div>
            </div>

            {{-- ── Step 4: Deskripsi ───────────────────────────────────────── --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Keterangan / Deskripsi <span class="text-red-500">*</span>
                </label>
                <textarea name="deskripsi" rows="4" required minlength="10" maxlength="1000"
                          class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none transition resize-none"
                          placeholder="Jelaskan detail masalah yang Anda lihat...">{{ old('deskripsi') }}</textarea>
                <p class="text-xs text-gray-400 mt-1">Minimal 10 karakter, maks 1000 karakter.</p>
            </div>

            {{-- Submit --}}
            <div class="pt-2">
                <button type="submit" :disabled="submitting || !lat"
                        class="w-full bg-indigo-600 hover:bg-indigo-700 disabled:opacity-50 disabled:cursor-not-allowed
                               text-white font-semibold py-3 rounded-xl transition-colors flex items-center justify-center gap-2">
                    <span x-show="!submitting">🚀 Kirim Laporan</span>
                    <span x-show="submitting" x-cloak>⏳ Mengirim...</span>
                </button>
                <p x-show="!lat" class="text-xs text-center text-orange-500 mt-2">
                    ⚠️ Harap ambil lokasi terlebih dahulu sebelum mengirim.
                </p>
            </div>

        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
function reportForm() {
    return {
        photoPreview: null,
        lat: {{ old('latitude') ?: 'null' }},
        lon: {{ old('longitude') ?: 'null' }},
        locating: false,
        submitting: false,
        map: null,
        marker: null,

        init() {
            this.$nextTick(() => this.initMap());
        },

        initMap() {
            // Pusat peta di Indonesia jika belum ada koordinat
            const center = this.lat && this.lon
                ? [this.lat, this.lon]
                : [-6.9175, 107.6191]; // default: Bandung

            this.map = L.map('map').setView(center, this.lat ? 16 : 12);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap'
            }).addTo(this.map);

            // Jika sudah ada koordinat (dari old input), pasang marker
            if (this.lat && this.lon) {
                this.placeMarker(this.lat, this.lon);
            }

            // Klik peta untuk pilih lokasi manual
            this.map.on('click', (e) => {
                this.lat = e.latlng.lat;
                this.lon = e.latlng.lng;
                this.placeMarker(this.lat, this.lon);
            });
        },

        placeMarker(lat, lon) {
            if (this.marker) this.marker.remove();
            this.marker = L.marker([lat, lon], {
                icon: L.divIcon({
                    html: '<div style="font-size:28px;margin-top:-14px;margin-left:-14px;">📍</div>',
                    iconSize: [28, 28], iconAnchor: [14, 28]
                })
            }).addTo(this.map);
            this.map.setView([lat, lon], 17);
        },

        handlePhoto(event) {
            const file = event.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = (e) => { this.photoPreview = e.target.result; };
            reader.readAsDataURL(file);
        },

        getLocation() {
            if (!navigator.geolocation) {
                alert('Browser Anda tidak mendukung GPS. Klik peta untuk memilih lokasi manual.');
                return;
            }
            this.locating = true;
            navigator.geolocation.getCurrentPosition(
                (pos) => {
                    this.lat = pos.coords.latitude;
                    this.lon = pos.coords.longitude;
                    this.placeMarker(this.lat, this.lon);
                    this.locating = false;
                },
                (err) => {
                    this.locating = false;
                    alert('Gagal mengambil lokasi: ' + err.message + '. Silakan klik peta untuk memilih lokasi.');
                },
                { enableHighAccuracy: true, timeout: 10000 }
            );
        },

        submitForm(event) {
            if (!this.lat || !this.lon) {
                alert('Harap ambil lokasi terlebih dahulu!');
                return;
            }
            this.submitting = true;
            event.target.submit();
        },
    }
}
</script>
@endpush
