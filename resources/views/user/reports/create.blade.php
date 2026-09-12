@extends('layouts.dashboard')
@section('title', 'Buat Laporan')
@section('page-title', 'Buat Laporan Baru')

@section('content')
<div class="max-w-2xl mx-auto" x-data="reportForm()" x-init="init()">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

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
                <span>Foto</span><span>Lokasi &amp; Kategori</span><span>Deskripsi</span>
            </div>
        </div>

        <form method="POST" action="{{ route('user.reports.store') }}" enctype="multipart/form-data" class="p-6 space-y-6" @submit="onSubmit">
            @csrf

            {{-- STEP 1: Foto --}}
            <div x-show="step === 1" x-transition>
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Ambil Foto Masalah</h2>

                <div class="space-y-4">
                    {{-- Preview: rasio ngikutin foto asli, ga di-crop --}}
                    <div x-show="photoPreview" class="relative rounded-xl overflow-hidden bg-gray-100"
                         :style="`aspect-ratio: ${photoAspect || 16/9}; max-height: 60vh`">
                        <img :src="photoPreview" class="w-full h-full object-contain">
                        <button type="button" @click="clearPhoto()"
                                class="absolute top-2 right-2 bg-gray-900/70 hover:bg-red-600 text-white rounded-full w-8 h-8 flex items-center justify-center transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div x-show="!photoPreview" class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center space-y-4">
                        <svg class="w-10 h-10 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-4.646 0 2.192 2.192 0 00-1.736 1.039l-.822 1.316z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0z" />
                        </svg>
                        <p class="text-gray-500 text-sm">Ambil foto atau unggah gambar masalah</p>

                        <div class="flex flex-col sm:flex-row gap-3 justify-center">
                            <button type="button" @click="openCamera()"
                                    class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2.5 rounded-lg transition-colors flex items-center gap-2 justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-4.646 0 2.192 2.192 0 00-1.736 1.039l-.822 1.316z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0z" />
                                </svg>
                                Buka Kamera
                            </button>
                            <label class="cursor-pointer bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium px-4 py-2.5 rounded-lg transition-colors flex items-center gap-2 justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                </svg>
                                Unggah Foto
                                <input type="file" accept="image/*"
                                       class="hidden" @change="onPhotoChange($event)" x-ref="fileInput">
                            </label>
                        </div>
                    </div>

                    {{-- Hidden input tunggal yang benar-benar dikirim ke server --}}
                    <input type="file" name="foto_sebelum" accept="image/*" class="hidden" x-ref="finalFileInput">
                </div>

                @error('foto_sebelum')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror

                <div class="mt-6 flex justify-end">
                    <button type="button" @click="nextStep()" :disabled="!photoPreview"
                            class="bg-blue-600 hover:bg-blue-700 disabled:opacity-40 disabled:cursor-not-allowed text-white font-medium px-6 py-2.5 rounded-lg transition-colors">
                        Lanjut
                    </button>
                </div>
            </div>

            {{-- STEP 2: Lokasi & Kategori --}}
            <div x-show="step === 2" x-transition>
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Lokasi &amp; Kategori</h2>

                {{-- GPS --}}
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Lokasi GPS</label>
                    <button type="button" @click="getLocation()"
                            :disabled="locLoading"
                            class="flex items-center gap-2 bg-green-600 hover:bg-green-700 disabled:opacity-50 text-white text-sm font-medium px-4 py-2 rounded-lg transition-colors">
                        <span x-show="!locLoading" class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                            </svg>
                            Ambil Lokasi Saya
                        </span>
                        <span x-show="locLoading" class="flex items-center gap-2">
                            <svg class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                            </svg>
                            Mengambil lokasi...
                        </span>
                    </button>

                    <div x-show="latitude" class="mt-2 text-sm text-green-600 font-medium">
                        Lokasi berhasil diambil: <span x-text="latitude"></span>, <span x-text="longitude"></span>
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
                                   x-model="selectedCategory">
                            <div class="peer-checked:border-blue-500 peer-checked:bg-blue-50 peer-checked:text-blue-700
                                        border border-gray-200 rounded-xl p-3 flex items-center gap-3 hover:border-blue-300 transition-colors">
                                <span class="text-lg leading-none">{{ $cat->icon }}</span>
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
                        Kembali
                    </button>
                    <button type="button" @click="nextStep()" :disabled="!latitude || !selectedCategory"
                            class="bg-blue-600 hover:bg-blue-700 disabled:opacity-40 disabled:cursor-not-allowed text-white font-medium px-6 py-2.5 rounded-lg transition-colors">
                        Lanjut
                    </button>
                </div>
            </div>

            {{-- STEP 3: Deskripsi & Submit --}}
            <div x-show="step === 3" x-transition>
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Deskripsi Masalah</h2>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Jelaskan masalah secara singkat <span class="text-red-500">*</span>
                    </label>
                    <textarea name="deskripsi" rows="5" required
                              class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none @error('deskripsi') border-red-400 @enderror"
                              placeholder="Contoh: Terdapat lubang besar di tengah jalan berukuran sekitar 50cm, sudah terjadi lebih dari 2 minggu dan berbahaya bagi pengendara."
                              maxlength="1000">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                {{-- Ringkasan --}}
                <div class="mt-4 bg-gray-50 rounded-xl p-4 space-y-2 text-sm">
                    <h4 class="font-medium text-gray-700 mb-1">Ringkasan Laporan</h4>
                    <div class="flex justify-between text-gray-600">
                        <span>Lokasi</span>
                        <span x-text="latitude ? `${parseFloat(latitude).toFixed(5)}, ${parseFloat(longitude).toFixed(5)}` : '-'"></span>
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span>Kategori</span>
                        <span x-text="selectedCategory ? 'Sudah dipilih' : '-'"></span>
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span>Foto</span>
                        <span x-text="photoPreview ? 'Siap dikirim' : 'Belum ada'"></span>
                    </div>
                </div>

                <div class="mt-6 flex justify-between">
                    <button type="button" @click="step = 2"
                            class="text-gray-600 hover:text-gray-800 font-medium px-4 py-2.5 rounded-lg hover:bg-gray-100 transition-colors">
                        Kembali
                    </button>
                    <button type="submit" id="submit-btn"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-2.5 rounded-lg transition-colors">
                        Kirim Laporan
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- Modal kamera --}}
    <div x-show="cameraOpen" x-cloak
         class="fixed inset-0 bg-black z-50 flex flex-col items-center justify-center gap-4 p-4 overflow-y-auto">
        <video x-ref="video" autoplay playsinline muted
               :class="isFrontCamera ? '[transform:scaleX(-1)]' : ''"
               class="max-h-[60vh] w-full max-w-xl rounded-xl object-cover shrink-0"></video>
        <canvas x-ref="canvas" class="hidden"></canvas>
        <div class="flex items-center gap-6 shrink-0">
            <button type="button" @click="closeCamera()"
                    class="text-white text-sm font-medium px-4 py-2 rounded-lg hover:bg-white/10 transition-colors">
                Batal
            </button>
            <button type="button" @click="capturePhoto()"
                    class="bg-white rounded-full w-16 h-16 border-4 border-gray-300 hover:border-blue-400 transition-colors"
                    aria-label="Ambil foto">
            </button>
            <div class="w-16"></div>
        </div>
        <p x-show="cameraError" x-text="cameraError" class="text-red-400 text-sm text-center max-w-xs shrink-0"></p>
    </div>
</div>
@endsection

@push('scripts')
<style>[x-cloak]{display:none!important}</style>
<script>
function reportForm() {
    return {
        step: 1,
        photoPreview: null,
        photoAspect: null,
        latitude: '{{ old('latitude') }}',
        longitude: '{{ old('longitude') }}',
        locLoading: false,
        locError: null,
        selectedCategory: '{{ old('category_id') }}',
        miniMap: null,
        miniMarker: null,

        cameraOpen: false,
        cameraStream: null,
        cameraError: null,
        isFrontCamera: false,

        init() {
            // pastikan input file "sumber" tunggal yang benar-benar dikirim ke server
        },

        // ----- Upload dari galeri -----
        onPhotoChange(event) {
            const file = event.target.files[0];
            if (!file) return;
            this.setFinalFile(file);
        },

        setFinalFile(file) {
            const dt = new DataTransfer();
            dt.items.add(file);
            this.$refs.finalFileInput.files = dt.files;

            const reader = new FileReader();
            reader.onload = (e) => {
                this.photoPreview = e.target.result;
                const img = new Image();
                img.onload = () => {
                    this.photoAspect = img.naturalWidth / img.naturalHeight;
                };
                img.src = e.target.result;
            };
            reader.readAsDataURL(file);
        },

        clearPhoto() {
            this.photoPreview = null;
            this.photoAspect = null;
            this.$refs.finalFileInput.value = '';
            if (this.$refs.fileInput) this.$refs.fileInput.value = '';
        },

        // ----- Kamera langsung (getUserMedia) -----
        async openCamera() {
            this.cameraError = null;
            this.isFrontCamera = false;

            if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                // Browser tidak mendukung getUserMedia, fallback ke input file dengan capture
                this.fallbackCameraInput();
                return;
            }

            try {
                // Coba paksa kamera belakang dulu (exact), baru longgar ke ideal kalau gagal
                try {
                    this.cameraStream = await navigator.mediaDevices.getUserMedia({
                        video: { facingMode: { exact: 'environment' } },
                        audio: false
                    });
                } catch (exactErr) {
                    this.cameraStream = await navigator.mediaDevices.getUserMedia({
                        video: { facingMode: { ideal: 'environment' } },
                        audio: false
                    });
                }

                this.cameraOpen = true;

                // Cek beneran kamera yang kepasang itu depan atau belakang,
                // biar cuma di-mirror kalau memang kamera depan (front-facing)
                const track = this.cameraStream.getVideoTracks()[0];
                const settings = track.getSettings ? track.getSettings() : {};
                this.isFrontCamera = settings.facingMode === 'user' || !settings.facingMode;

                this.$nextTick(() => {
                    this.$refs.video.srcObject = this.cameraStream;
                });
            } catch (err) {
                this.cameraError = 'Tidak bisa mengakses kamera: ' + err.message;
                this.fallbackCameraInput();
            }
        },

        fallbackCameraInput() {
            // Fallback terakhir jika getUserMedia gagal atau tidak tersedia
            const input = document.createElement('input');
            input.type = 'file';
            input.accept = 'image/*';
            input.capture = 'environment';
            input.onchange = (e) => {
                const file = e.target.files[0];
                if (file) this.setFinalFile(file);
            };
            input.click();
        },

        closeCamera() {
            if (this.cameraStream) {
                this.cameraStream.getTracks().forEach(track => track.stop());
                this.cameraStream = null;
            }
            this.cameraOpen = false;
        },

        capturePhoto() {
            const video = this.$refs.video;
            const canvas = this.$refs.canvas;
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            const ctx = canvas.getContext('2d');

            // Catatan: hasil foto yang disimpan TIDAK ikut kebalik walau
            // preview di layar di-mirror pakai CSS (transform di <video>),
            // karena kita gambar langsung dari frame video aslinya di sini.
            ctx.drawImage(video, 0, 0);

            canvas.toBlob((blob) => {
                const file = new File([blob], `foto-${Date.now()}.jpg`, { type: 'image/jpeg' });
                this.setFinalFile(file);
                this.closeCamera();
            }, 'image/jpeg', 0.9);
        },

        // ----- Lokasi -----
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
                    attribution: '&copy; OpenStreetMap'
                }).addTo(this.miniMap);
                this.miniMarker = L.marker([lat, lng]).addTo(this.miniMap).bindPopup('Lokasi masalah').openPopup();
            } else {
                this.miniMap.setView([lat, lng], 16);
                this.miniMarker.setLatLng([lat, lng]);
            }
        },

        onSubmit(event) {
            if (!this.$refs.finalFileInput.files.length) {
                event.preventDefault();
                alert('Silakan ambil atau unggah foto terlebih dahulu.');
                this.step = 1;
            }
        }
    }
}
</script>
@endpush