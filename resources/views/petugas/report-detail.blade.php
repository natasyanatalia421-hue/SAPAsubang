@extends('layouts.app')
@section('title', $report->kode_laporan)
@section('page-title', 'Detail Tugas — ' . $report->kode_laporan)

@section('content')
<div class="max-w-2xl mx-auto space-y-6">

    {{-- Info laporan --}}
    <div class="bg-white rounded-2xl border border-gray-200 p-6">
        <div class="flex items-start justify-between gap-3">
            <div>
                <div class="flex items-center gap-2 flex-wrap">
                    <span class="text-2xl">{{ $report->category->icon }}</span>
                    <span class="font-bold text-gray-800 text-lg">{{ $report->kode_laporan }}</span>
                    @include('components.status-badge', ['status' => $report->status])
                    @include('components.prioritas-badge', ['prioritas' => $report->prioritas])
                </div>
                <p class="text-gray-500 text-sm mt-1">{{ $report->category->nama_kategori }}</p>
                <p class="text-gray-400 text-xs mt-0.5">
                    Dilaporkan oleh {{ $report->user->name }} — {{ $report->created_at->format('d M Y, H:i') }}
                </p>
            </div>
        </div>

        {{-- Catatan revisi dari admin --}}
        @if($report->catatan_revisi && in_array($report->status, ['sedang_ditangani']))
        <div class="mt-4 bg-orange-50 border border-orange-200 rounded-xl p-4">
            <p class="text-sm font-semibold text-orange-700">⚠️ Catatan Revisi dari Admin:</p>
            <p class="text-sm text-orange-600 mt-1">{{ $report->catatan_revisi }}</p>
        </div>
        @endif

        {{-- ── Aksi Petugas berdasarkan status ── --}}
        <div class="mt-5 pt-5 border-t border-gray-100 space-y-3">

            @if($report->status === 'ditugaskan')
            <form method="POST" action="{{ route('petugas.reports.status', $report) }}">
                @csrf
                <input type="hidden" name="status" value="menuju_lokasi">
                <button type="submit"
                        onclick="return confirm('Konfirmasi Anda sedang menuju lokasi?')"
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-xl transition-colors">
                    🚗 Terima Tugas & Menuju Lokasi
                </button>
            </form>
            @endif

            @if($report->status === 'menuju_lokasi')
            <form method="POST" action="{{ route('petugas.reports.status', $report) }}">
                @csrf
                <input type="hidden" name="status" value="sedang_ditangani">
                <button type="submit"
                        onclick="return confirm('Konfirmasi Anda sudah di lokasi dan mulai menangani?')"
                        class="w-full bg-teal-600 hover:bg-teal-700 text-white font-semibold py-3 rounded-xl transition-colors">
                    🔨 Sudah di Lokasi — Mulai Tangani
                </button>
            </form>
            @endif

            @if($report->status === 'sedang_ditangani')
            {{-- Form kirim bukti --}}
            <div x-data="evidenceForm()">
                <button @click="open=!open"
                        class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-xl transition-colors">
                    📸 Kirim Bukti Penanganan
                </button>

                <div x-show="open" x-cloak class="mt-4 bg-green-50 border border-green-200 rounded-xl p-5 space-y-4">
                    <form method="POST" action="{{ route('petugas.reports.evidence', $report) }}"
                          enctype="multipart/form-data" @submit.prevent="submit($event)">
                        @csrf

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                📷 Foto Sesudah Penanganan <span class="text-red-500">*</span>
                            </label>
                            <div class="relative border-2 border-dashed border-gray-300 rounded-xl p-5 text-center hover:border-green-400 transition-colors"
                                 :class="preview ? 'border-green-400 bg-green-50' : ''">
                                <input type="file" name="foto_sesudah" accept="image/*" capture="environment"
                                       class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                       @change="handlePhoto($event)" required>
                                <template x-if="!preview">
                                    <div>
                                        <div class="text-3xl mb-1">📸</div>
                                        <p class="text-sm text-gray-500">Ambil foto atau pilih dari galeri</p>
                                    </div>
                                </template>
                                <template x-if="preview">
                                    <img :src="preview" class="max-h-40 mx-auto rounded-lg object-cover">
                                </template>
                            </div>
                        </div>

                        <div class="mt-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                📝 Keterangan Pekerjaan <span class="text-red-500">*</span>
                            </label>
                            <textarea name="keterangan_pekerjaan" rows="4" required minlength="10"
                                      class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm outline-none focus:ring-2 focus:ring-green-500 resize-none"
                                      placeholder="Jelaskan apa yang sudah Anda kerjakan..."></textarea>
                        </div>

                        <button type="submit" :disabled="submitting"
                                class="w-full bg-green-600 hover:bg-green-700 disabled:opacity-50 text-white font-semibold py-3 rounded-xl transition-colors mt-2">
                            <span x-show="!submitting">🚀 Kirim Bukti ke Admin</span>
                            <span x-show="submitting" x-cloak>⏳ Mengirim...</span>
                        </button>
                    </form>
                </div>
            </div>
            @endif

            @if($report->status === 'menunggu_konfirmasi')
            <div class="bg-teal-50 border border-teal-200 rounded-xl p-4 text-center">
                <p class="text-teal-700 font-medium">⏳ Menunggu Konfirmasi Admin</p>
                <p class="text-teal-600 text-sm mt-1">Bukti telah dikirim. Tunggu admin memeriksa pekerjaan Anda.</p>
            </div>
            @endif

            @if($report->status === 'selesai')
            <div class="bg-green-50 border border-green-200 rounded-xl p-4 text-center">
                <p class="text-green-700 font-semibold text-lg">✅ Laporan Selesai!</p>
                <p class="text-green-600 text-sm mt-1">Pekerjaan Anda telah dikonfirmasi oleh admin.</p>
            </div>
            @endif
        </div>
    </div>

    {{-- Foto sebelum --}}
    <div class="bg-white rounded-2xl border border-gray-200 p-5">
        <p class="text-sm font-semibold text-gray-700 mb-3">📷 Foto Kondisi Masalah</p>
        <img src="{{ Storage::url($report->foto_sebelum) }}"
             onerror="this.src='https://placehold.co/600x300?text=Foto+Masalah'"
             class="w-full h-52 object-cover rounded-xl">
    </div>

    {{-- Deskripsi --}}
    <div class="bg-white rounded-2xl border border-gray-200 p-5">
        <p class="text-sm font-semibold text-gray-700 mb-2">📝 Deskripsi Masalah</p>
        <p class="text-gray-600 text-sm leading-relaxed">{{ $report->deskripsi }}</p>
    </div>

    {{-- Peta --}}
    <div class="bg-white rounded-2xl border border-gray-200 p-5">
        <p class="text-sm font-semibold text-gray-700 mb-3">📍 Lokasi — Klik untuk buka Maps</p>
        <a href="https://www.google.com/maps?q={{ $report->latitude }},{{ $report->longitude }}"
           target="_blank">
            <div id="map-petugas" class="w-full h-52 rounded-xl border border-gray-200"></div>
        </a>
        <p class="text-xs text-gray-400 mt-1">
            {{ number_format($report->latitude, 6) }}, {{ number_format($report->longitude, 6) }}
        </p>
    </div>

    {{-- Timeline --}}
    <div class="bg-white rounded-2xl border border-gray-200 p-5">
        <p class="text-sm font-semibold text-gray-700 mb-4">🕐 Riwayat Status</p>
        <div class="relative">
            <div class="absolute left-3.5 top-0 bottom-0 w-0.5 bg-gray-200"></div>
            <div class="space-y-3">
                @foreach($report->statusLogs as $log)
                <div class="flex gap-4">
                    <div class="w-7 h-7 rounded-full bg-teal-100 border-2 border-teal-500 flex items-center justify-center shrink-0 z-10">
                        <div class="w-2 h-2 rounded-full bg-teal-500"></div>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-800">{{ \App\Models\Report::$statusLabels[$log->status_baru] ?? $log->status_baru }}</p>
                        @if($log->catatan)<p class="text-xs text-gray-500">{{ $log->catatan }}</p>@endif
                        <p class="text-xs text-gray-400">{{ $log->created_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const map = L.map('map-petugas').setView([{{ $report->latitude }}, {{ $report->longitude }}], 16);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { attribution: '© OpenStreetMap' }).addTo(map);
    L.marker([{{ $report->latitude }}, {{ $report->longitude }}], {
        icon: L.divIcon({ html: '<div style="font-size:28px;margin-top:-14px;margin-left:-14px;">📍</div>', iconSize:[28,28], iconAnchor:[14,28] })
    }).addTo(map).bindPopup('{{ $report->kode_laporan }}').openPopup();
});

function evidenceForm() {
    return {
        open: false,
        preview: null,
        submitting: false,
        handlePhoto(e) {
            const file = e.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = (ev) => { this.preview = ev.target.result; };
            reader.readAsDataURL(file);
        },
        submit(e) {
            this.submitting = true;
            e.target.submit();
        }
    }
}
</script>
@endpush
