@extends('layouts.dashboard')
@section('title', $report->kode_laporan)
@section('page-title', 'Detail Tugas')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    {{-- Back --}}
    <div class="flex items-center gap-3">
        <a href="{{ route('petugas.dashboard') }}" class="text-gray-400 hover:text-gray-600 text-sm">← Kembali</a>
        <span class="text-gray-300">/</span>
        <span class="font-mono text-sm font-medium text-gray-700">{{ $report->kode_laporan }}</span>
    </div>

    {{-- Info laporan --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-start justify-between flex-wrap gap-3">
            <div class="flex items-center gap-3">
                <span class="text-3xl">{{ $report->category->icon }}</span>
                <div>
                    <h2 class="text-xl font-bold text-gray-800">{{ $report->kode_laporan }}</h2>
                    <p class="text-sm text-gray-500">{{ $report->category->nama_kategori }}</p>
                </div>
            </div>
            <div class="flex flex-col items-end gap-2">
                @include('components.status-badge', ['status' => $report->status])
                @if($report->prioritas)
                    @include('components.priority-badge', ['prioritas' => $report->prioritas])
                @endif
            </div>
        </div>

        <div class="mt-4 bg-gray-50 rounded-xl p-4">
            <p class="text-xs font-medium text-gray-500 mb-1">Deskripsi Masalah</p>
            <p class="text-sm text-gray-800 leading-relaxed">{{ $report->deskripsi }}</p>
        </div>

        <p class="text-xs text-gray-400 mt-3">
            Dilaporkan oleh <strong>{{ $report->user->name }}</strong> — {{ $report->created_at->format('d M Y, H:i') }}
        </p>

        @if($report->catatan_revisi)
        <div class="mt-3 bg-orange-50 border border-orange-200 rounded-xl p-4">
            <p class="text-sm font-semibold text-orange-700">⚠️ Catatan Revisi dari Admin:</p>
            <p class="text-sm text-orange-600 mt-1">{{ $report->catatan_revisi }}</p>
        </div>
        @endif
    </div>

    {{-- Foto + Peta --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
            <h3 class="font-semibold text-gray-800 mb-3">📸 Foto Masalah</h3>
            <div class="bg-gray-100 rounded-xl overflow-hidden flex items-center justify-center" style="max-height: 320px;">
                @if(str_starts_with($report->foto_sebelum, 'demo/'))
                    <div class="w-full aspect-video flex items-center justify-center text-5xl bg-gray-200">{{ $report->category->icon }}</div>
                @else
                    <img src="{{ Storage::url($report->foto_sebelum) }}" class="w-full h-auto max-h-[320px] object-contain" alt="Foto masalah">
                @endif
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
            <h3 class="font-semibold text-gray-800 mb-3">📍 Lokasi</h3>
            <div id="task-map" class="rounded-xl overflow-hidden border border-gray-200" style="height: 200px;"></div>
            <p class="text-xs text-gray-400 mt-2">{{ $report->latitude }}, {{ $report->longitude }}</p>
        </div>
    </div>

    {{-- Panel aksi petugas --}}
    @php $status = $report->status; @endphp

    {{-- Terima Tugas --}}
    @if($status === 'ditugaskan')
    <div class="bg-white rounded-2xl shadow-sm border border-purple-100 p-6 text-center">
        <div class="text-4xl mb-3">📋</div>
        <h3 class="font-semibold text-gray-800 mb-2">Anda mendapat tugas baru</h3>
        <p class="text-sm text-gray-500 mb-5">Tekan tombol di bawah untuk menerima dan menuju lokasi.</p>
        <form method="POST" action="{{ route('petugas.tasks.accept', $report->id) }}">
            @csrf
            <button type="submit"
                    class="bg-purple-600 hover:bg-purple-700 text-white font-semibold px-8 py-3 rounded-xl transition-colors">
                ✅ Terima Tugas & Menuju Lokasi
            </button>
        </form>
    </div>
    @endif

    {{-- Sudah di lokasi --}}
    @if($status === 'menuju_lokasi')
    <div class="bg-white rounded-2xl shadow-sm border border-indigo-100 p-6 text-center">
        <div class="text-4xl mb-3">🚗</div>
        <h3 class="font-semibold text-gray-800 mb-2">Dalam Perjalanan ke Lokasi</h3>
        <p class="text-sm text-gray-500 mb-5">Tekan tombol di bawah setelah Anda tiba di lokasi dan mulai bekerja.</p>
        <form method="POST" action="{{ route('petugas.tasks.start', $report->id) }}">
            @csrf
            <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-8 py-3 rounded-xl transition-colors">
                🔧 Saya Sudah di Lokasi — Mulai Menangani
            </button>
        </form>
    </div>
    @endif

    {{-- Kirim bukti --}}
    @if($status === 'sedang_ditangani')
    <div class="bg-white rounded-2xl shadow-sm border border-orange-100 p-6">
        <h3 class="font-semibold text-gray-800 mb-1">📤 Kirim Bukti Penanganan</h3>
        <p class="text-sm text-gray-500 mb-5">Ambil foto kondisi sesudah penanganan dan isi keterangan pekerjaan.</p>

        <form method="POST" action="{{ route('petugas.tasks.evidence', $report->id) }}"
              enctype="multipart/form-data" class="space-y-4" x-data="{ preview: null }">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Foto Sesudah <span class="text-red-500">*</span>
                </label>

                {{-- Preview: ukuran mengikuti bentuk asli foto (object-contain), tidak dipaksa 16:9
                     supaya foto portrait dari kamera HP tidak terpotong --}}
                <div x-show="preview" class="mb-3 bg-gray-100 rounded-xl overflow-hidden relative flex items-center justify-center" style="max-height: 400px;">
                    <img :src="preview" class="w-full h-auto max-h-[400px] object-contain">
                    <button type="button"
                            @click="preview = null; $refs.evidenceFile.value = ''; $refs.uploadFile.value = ''"
                            class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-7 h-7 flex items-center justify-center text-xs shadow">✕</button>
                </div>

                <div x-show="!preview" class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center space-y-3">
                    <div class="text-3xl">📷</div>
                    <div class="flex flex-col sm:flex-row gap-2 justify-center">
                        <label class="cursor-pointer bg-teal-600 hover:bg-teal-700 text-white text-sm font-medium px-4 py-2 rounded-lg">
                            📷 Buka Kamera
                            <input type="file" name="foto_sesudah" accept="image/*" capture="environment"
                                   class="hidden" x-ref="evidenceFile"
                                   @change="preview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : null">
                        </label>
                        <label class="cursor-pointer bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium px-4 py-2 rounded-lg">
                            🖼️ Upload Foto
                            <input type="file" name="foto_sesudah" accept="image/*" class="hidden"
                                   x-ref="uploadFile"
                                   @change="preview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : null">
                        </label>
                    </div>
                    <p class="text-xs text-gray-400">
                        "Buka Kamera" akan langsung mengaktifkan kamera di HP. Di laptop/desktop tanpa kamera intent, tombol ini akan membuka jendela pilih file biasa — itu wajar.
                    </p>
                </div>
                @error('foto_sesudah')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Keterangan Pekerjaan <span class="text-red-500">*</span>
                </label>
                <textarea name="keterangan_pekerjaan" rows="4" required minlength="10"
                          class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 resize-none @error('keterangan_pekerjaan') border-red-400 @enderror"
                          placeholder="Jelaskan apa yang sudah Anda kerjakan...">{{ old('keterangan_pekerjaan') }}</textarea>
                @error('keterangan_pekerjaan')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <button type="submit"
                    class="w-full bg-teal-600 hover:bg-teal-700 text-white font-semibold py-3 rounded-xl transition-colors">
                📤 Kirim Bukti ke Admin
            </button>
        </form>
    </div>
    @endif

    {{-- Menunggu konfirmasi --}}
    @if($status === 'menunggu_konfirmasi')
    <div class="bg-cyan-50 border border-cyan-200 rounded-2xl p-6 text-center">
        <div class="text-4xl mb-3">⏳</div>
        <h3 class="font-semibold text-cyan-800">Bukti Terkirim — Menunggu Konfirmasi Admin</h3>
        <p class="text-sm text-cyan-600 mt-2">Admin sedang memeriksa foto bukti pekerjaan Anda.</p>
        @if($report->latestEvidence)
        <div class="mt-4 text-left bg-white rounded-xl p-4">
            <p class="text-xs font-medium text-gray-500 mb-1">Bukti yang dikirim:</p>
            <p class="text-sm text-gray-700">{{ $report->latestEvidence->keterangan_pekerjaan }}</p>
            <p class="text-xs text-gray-400 mt-1">{{ $report->latestEvidence->created_at->diffForHumans() }}</p>
        </div>
        @endif
    </div>
    @endif

    {{-- Selesai --}}
    @if($status === 'selesai')
    <div class="bg-green-50 border border-green-200 rounded-2xl p-6 text-center">
        <div class="text-4xl mb-3">✅</div>
        <h3 class="font-semibold text-green-800">Laporan Selesai Ditangani</h3>
        <p class="text-sm text-green-600 mt-1">Admin telah mengkonfirmasi penyelesaian laporan ini.</p>
    </div>
    @endif

    {{-- Riwayat status --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <h3 class="font-semibold text-gray-800 mb-4">📋 Riwayat Status</h3>
        <div class="space-y-3">
            @foreach($report->statusLogs as $log)
            <div class="flex gap-3">
                <div class="flex flex-col items-center">
                    <div class="w-3 h-3 rounded-full bg-teal-500 flex-shrink-0 mt-1"></div>
                    @if(!$loop->last)<div class="w-0.5 flex-1 bg-gray-200 mt-1"></div>@endif
                </div>
                <div class="pb-3 flex-1">
                    <div class="flex items-center gap-2 flex-wrap text-sm">
                        @include('components.status-badge', ['status' => $log->status_baru])
                        <span class="text-xs text-gray-400">{{ $log->changedBy->name }}</span>
                    </div>
                    @if($log->catatan)
                        <p class="text-xs text-gray-500 mt-1 italic">{{ $log->catatan }}</p>
                    @endif
                    <p class="text-xs text-gray-400 mt-1">{{ $log->created_at->format('d M Y, H:i') }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const lat = {{ $report->latitude }};
    const lng = {{ $report->longitude }};
    const map = L.map('task-map').setView([lat, lng], 16);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { attribution: '© OpenStreetMap' }).addTo(map);
    L.marker([lat, lng]).addTo(map)
        .bindPopup('<b>{{ $report->kode_laporan }}</b><br>{{ addslashes($report->category->nama_kategori) }}')
        .openPopup();
});
</script>
@endpush