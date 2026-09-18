@extends('layouts.dashboard')
@section('title', $report->kode_laporan)
@section('page-title', 'Kelola Laporan')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    {{-- Back + header --}}
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.dashboard') }}" class="text-gray-400 hover:text-gray-600">← Kembali</a>
        <span class="text-gray-300">/</span>
        <span class="font-mono text-sm font-medium text-gray-700">{{ $report->kode_laporan }}</span>
    </div>

    {{-- Info utama --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-start justify-between flex-wrap gap-3">
            <div>
                <div class="flex items-center gap-3">
                    <span class="text-3xl">{{ $report->category->icon }}</span>
                    <div>
                        <h2 class="text-xl font-bold text-gray-800">{{ $report->kode_laporan }}</h2>
                        <p class="text-gray-500 text-sm">{{ $report->category->nama_kategori }}</p>
                    </div>
                </div>
                <p class="text-sm text-gray-600 mt-3">
                    Dilaporkan oleh <strong>{{ $report->user->name }}</strong>
                    ({{ $report->user->email }})
                    — {{ $report->created_at->format('d M Y, H:i') }}
                </p>
            </div>
            <div class="flex flex-col items-end gap-2">
                @include('components.status-badge', ['status' => $report->status])
                @if($report->prioritas) @include('components.priority-badge', ['prioritas' => $report->prioritas]) @endif
                <span class="text-xs text-gray-500">👍 {{ $supportCount }} dukungan</span>
            </div>
        </div>

        {{-- Deskripsi --}}
        <div class="mt-4 bg-gray-50 rounded-xl p-4">
            <p class="text-sm font-medium text-gray-600 mb-1">Deskripsi Masalah</p>
            <p class="text-sm text-gray-800 leading-relaxed">{{ $report->deskripsi }}</p>
        </div>

        @if($report->alasan_ditolak)
        <div class="mt-3 bg-red-50 border border-red-200 rounded-xl p-4">
            <p class="text-sm font-medium text-red-700">Alasan Penolakan: {{ $report->alasan_ditolak }}</p>
        </div>
        @endif

        @if($report->catatan_revisi)
        <div class="mt-3 bg-orange-50 border border-orange-200 rounded-xl p-4">
            <p class="text-sm font-medium text-orange-700">Catatan Revisi: {{ $report->catatan_revisi }}</p>
        </div>
        @endif
    </div>

    {{-- Foto + Peta --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Foto --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
            <h3 class="font-semibold text-gray-800 mb-3">📸 Foto</h3>
            <div class="space-y-3">
                <div>
                    <p class="text-xs text-gray-400 uppercase tracking-wide mb-2">Foto Sebelum</p>
                    <div class="aspect-video bg-gray-100 rounded-xl overflow-hidden">
                        @if(str_starts_with($report->foto_sebelum, 'demo/'))
                            <div class="w-full h-full flex items-center justify-center text-5xl bg-gray-200">{{ $report->category->icon }}</div>
                        @else
                            <img src="{{ Storage::url($report->foto_sebelum) }}" class="w-full h-full object-cover">
                        @endif
                    </div>
                </div>
                @if($report->latestEvidence)
                <div>
                    <p class="text-xs text-gray-400 uppercase tracking-wide mb-2">Foto Sesudah (Bukti)</p>
                    <div class="aspect-video bg-gray-100 rounded-xl overflow-hidden">
                        @if(str_starts_with($report->latestEvidence->foto_sesudah, 'demo/'))
                            <div class="w-full h-full flex items-center justify-center text-5xl bg-green-100">✅</div>
                        @else
                            <img src="{{ Storage::url($report->latestEvidence->foto_sesudah) }}" class="w-full h-full object-cover">
                        @endif
                    </div>
                    <p class="text-xs text-gray-500 mt-2 italic">{{ $report->latestEvidence->keterangan_pekerjaan }}</p>
                    <p class="text-xs text-gray-400 mt-1">Dikirim oleh {{ $report->latestEvidence->petugas->name }} — {{ $report->latestEvidence->created_at->diffForHumans() }}</p>
                </div>
                @endif
            </div>
        </div>

        {{-- Peta --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
            <h3 class="font-semibold text-gray-800 mb-3">📍 Lokasi</h3>
            <div id="detail-map" class="rounded-xl overflow-hidden border border-gray-200" style="height: 280px;"></div>
            <p class="text-xs text-gray-400 mt-2">
                Koordinat: {{ $report->latitude }}, {{ $report->longitude }}
            </p>
        </div>
    </div>

    {{-- Panel Aksi Admin --}}
    @php $status = $report->status; @endphp

    {{-- Verifikasi --}}
    @if($status === 'menunggu_verifikasi')
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6" x-data="{ action: null }">
        <h3 class="font-semibold text-gray-800 mb-4">⚖️ Tindakan Verifikasi</h3>
        <div class="flex gap-3 flex-wrap">
            <button @click="action = 'verify'"
                    class="flex-1 sm:flex-none bg-green-600 hover:bg-green-700 text-white font-medium px-5 py-2.5 rounded-xl transition-colors">
                ✅ Verifikasi & Atur Prioritas
            </button>
            <button @click="action = 'reject'"
                    class="flex-1 sm:flex-none bg-red-50 hover:bg-red-100 text-red-600 border border-red-200 font-medium px-5 py-2.5 rounded-xl transition-colors">
                ❌ Tolak Laporan
            </button>
        </div>

        {{-- Form Verifikasi --}}
        <div x-show="action === 'verify'" x-cloak class="mt-5 border-t border-gray-100 pt-5">
            <form method="POST" action="{{ route('admin.reports.verify', $report->id) }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tingkat Prioritas <span class="text-red-500">*</span></label>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
                        @foreach(['rendah' => ['Rendah','🟢'], 'sedang' => ['Sedang','🟡'], 'tinggi' => ['Tinggi','🟠'], 'darurat' => ['Darurat','🔴']] as $val => [$label, $emoji])
                        <label class="cursor-pointer">
                            <input type="radio" name="prioritas" value="{{ $val }}" class="sr-only peer" required>
                            <div class="peer-checked:ring-2 peer-checked:ring-blue-500 border border-gray-200 rounded-xl p-3 text-center hover:border-blue-300 transition-all">
                                <div class="text-xl">{{ $emoji }}</div>
                                <div class="text-xs font-medium mt-1">{{ $label }}</div>
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Catatan <span class="text-gray-400">(opsional)</span></label>
                    <input type="text" name="catatan" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Catatan untuk log status...">
                </div>
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-medium px-6 py-2.5 rounded-xl">Konfirmasi Verifikasi</button>
            </form>
        </div>

        {{-- Form Tolak --}}
        <div x-show="action === 'reject'" x-cloak class="mt-5 border-t border-gray-100 pt-5">
            <form method="POST" action="{{ route('admin.reports.reject', $report->id) }}" class="space-y-3">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Alasan Penolakan <span class="text-red-500">*</span></label>
                    <textarea name="alasan_ditolak" rows="3" required minlength="10"
                              class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-red-400 resize-none"
                              placeholder="Jelaskan alasan penolakan laporan ini..."></textarea>
                    @error('alasan_ditolak')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-medium px-6 py-2.5 rounded-xl">Kirim Penolakan</button>
            </form>
        </div>
    </div>
    @endif

    {{-- Penugasan Petugas --}}
    @if($status === 'terverifikasi')
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <h3 class="font-semibold text-gray-800 mb-4">👷 Tugaskan Petugas</h3>
        <form method="POST" action="{{ route('admin.reports.assign', $report->id) }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Petugas <span class="text-red-500">*</span></label>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                    @foreach($petugas as $p)
                    <label class="cursor-pointer">
                        <input type="radio" name="petugas_id" value="{{ $p->id }}" class="sr-only peer" required>
                        <div class="peer-checked:ring-2 peer-checked:ring-blue-500 peer-checked:bg-blue-50 border border-gray-200 rounded-xl p-3 hover:border-blue-300 transition-all">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-teal-100 flex items-center justify-center font-bold text-teal-700">
                                    {{ strtoupper(substr($p->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-800">{{ $p->name }}</div>
                                    @if($p->officer && $p->officer->spesialisasi_kategori)
                                    <div class="text-xs text-gray-400">
                                        Spesialis {{ count($p->officer->spesialisasi_kategori) }} kategori
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </label>
                    @endforeach
                </div>
                @error('petugas_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-6 py-2.5 rounded-xl">
                Tugaskan Petugas →
            </button>
        </form>
    </div>
    @endif

    {{-- Konfirmasi Bukti --}}
    @if($status === 'menunggu_konfirmasi' && $report->latestEvidence)
    <div class="bg-white rounded-2xl shadow-sm border border-green-100 p-6" x-data="{ action: null }">
        <h3 class="font-semibold text-gray-800 mb-2">🔍 Periksa Bukti Pekerjaan</h3>
        <p class="text-sm text-gray-500 mb-4">Petugas <strong>{{ $report->latestEvidence->petugas->name }}</strong> telah mengirim bukti penanganan. Silakan bandingkan foto sebelum dan sesudah.</p>

        <div class="flex gap-3 flex-wrap">
            <button @click="action = 'complete'"
                    class="flex-1 sm:flex-none bg-green-600 hover:bg-green-700 text-white font-medium px-5 py-2.5 rounded-xl transition-colors">
                ✅ Konfirmasi Selesai
            </button>
            <button @click="action = 'revisi'"
                    class="flex-1 sm:flex-none bg-orange-50 hover:bg-orange-100 text-orange-600 border border-orange-200 font-medium px-5 py-2.5 rounded-xl transition-colors">
                🔄 Minta Penanganan Ulang
            </button>
        </div>

        <div x-show="action === 'complete'" x-cloak class="mt-5 border-t border-gray-100 pt-5">
            <form method="POST" action="{{ route('admin.reports.complete', $report->id) }}" class="space-y-3">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Catatan <span class="text-gray-400">(opsional)</span></label>
                    <input type="text" name="catatan" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-400" placeholder="Pekerjaan sesuai standar...">
                </div>
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-medium px-6 py-2.5 rounded-xl">
                    ✅ Tandai Selesai & Kirim Notifikasi
                </button>
            </form>
        </div>

        <div x-show="action === 'revisi'" x-cloak class="mt-5 border-t border-gray-100 pt-5">
            <form method="POST" action="{{ route('admin.reports.revision', $report->id) }}" class="space-y-3">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Catatan Revisi <span class="text-red-500">*</span></label>
                    <textarea name="catatan_revisi" rows="3" required minlength="10"
                              class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400 resize-none"
                              placeholder="Jelaskan apa yang perlu diperbaiki..."></textarea>
                    @error('catatan_revisi')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <button type="submit" class="bg-orange-600 hover:bg-orange-700 text-white font-medium px-6 py-2.5 rounded-xl">
                    Kirim Catatan Revisi
                </button>
            </form>
        </div>
    </div>
    @endif

    {{-- Riwayat Status --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <h3 class="font-semibold text-gray-800 mb-4">📋 Riwayat Status</h3>
        <div class="space-y-3">
            @foreach($report->statusLogs as $log)
            <div class="flex gap-3">
                <div class="flex flex-col items-center">
                    <div class="w-3 h-3 rounded-full bg-blue-500 flex-shrink-0 mt-1"></div>
                    @if(!$loop->last)<div class="w-0.5 flex-1 bg-gray-200 mt-1 mb-0"></div>@endif
                </div>
                <div class="pb-3 flex-1">
                    <div class="flex items-center gap-2 flex-wrap text-sm">
                        @include('components.status-badge', ['status' => $log->status_baru])
                        <span class="text-xs text-gray-400">oleh <strong>{{ $log->changedBy->name }}</strong></span>
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

    {{-- Daftar pendukung --}}
    @if($report->supports->isNotEmpty())
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <h3 class="font-semibold text-gray-800 mb-3">👍 {{ $supportCount }} Pendukung</h3>
        <div class="flex flex-wrap gap-2">
            @foreach($report->supports as $s)
            <span class="bg-gray-100 text-gray-700 text-xs px-3 py-1 rounded-full">{{ $s->user->name }}</span>
            @endforeach
        </div>
    </div>
    @endif

</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const lat = {{ $report->latitude }};
    const lng = {{ $report->longitude }};
    const map = L.map('detail-map').setView([lat, lng], 16);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { attribution: '© OpenStreetMap' }).addTo(map);
    L.marker([lat, lng]).addTo(map)
        .bindPopup('<b>{{ $report->kode_laporan }}</b><br>{{ addslashes($report->category->nama_kategori) }}')
        .openPopup();
    setTimeout(() => map.invalidateSize(), 300);
});
</script>
@endpush
