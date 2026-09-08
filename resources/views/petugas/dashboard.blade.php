@extends('layouts.dashboard')
@section('title', 'Dashboard Petugas')
@section('page-title', 'Dashboard Petugas')

@section('content')
<div class="space-y-6">

    {{-- Stat cards --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        @php
        $cards = [
            ['label' => 'Ditugaskan',          'value' => $stats['ditugaskan'],          'icon' => '📋', 'color' => 'bg-purple-50 border-purple-200'],
            ['label' => 'Dalam Proses',         'value' => $stats['dalam_proses'],        'icon' => '🔧', 'color' => 'bg-orange-50 border-orange-200'],
            ['label' => 'Menunggu Konfirmasi',  'value' => $stats['menunggu_konfirmasi'], 'icon' => '⏳', 'color' => 'bg-cyan-50 border-cyan-200'],
            ['label' => 'Selesai',              'value' => $stats['selesai'],             'icon' => '✅', 'color' => 'bg-green-50 border-green-200'],
        ];
        @endphp
        @foreach($cards as $c)
        <div class="rounded-xl border {{ $c['color'] }} p-5 shadow-sm">
            <div class="text-2xl mb-1">{{ $c['icon'] }}</div>
            <div class="text-2xl font-bold text-gray-800">{{ $c['value'] }}</div>
            <div class="text-xs text-gray-500 mt-0.5">{{ $c['label'] }}</div>
        </div>
        @endforeach
    </div>

    {{-- Tugas aktif --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
        <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
            <h3 class="font-semibold text-gray-800">🗂️ Tugas Aktif</h3>
            <span class="text-xs text-gray-400">{{ $activeTasks->count() }} tugas</span>
        </div>

        @if($activeTasks->isEmpty())
            <div class="py-12 text-center text-gray-400">
                <div class="text-4xl mb-3">🎉</div>
                <p class="font-medium text-gray-600">Tidak ada tugas aktif saat ini.</p>
                <p class="text-sm mt-1">Tunggu penugasan baru dari admin.</p>
            </div>
        @else
            <div class="divide-y divide-gray-50">
                @foreach($activeTasks as $r)
                <a href="{{ route('petugas.tasks.show', $r->id) }}"
                   class="flex items-start gap-4 px-5 py-4 hover:bg-gray-50 transition-colors group">

                    {{-- Ikon kategori --}}
                    <div class="text-2xl flex-shrink-0 mt-0.5">{{ $r->category->icon }}</div>

                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 flex-wrap">
                            <span class="font-medium text-sm text-gray-800">{{ $r->kode_laporan }}</span>
                            @include('components.status-badge', ['status' => $r->status])
                            @if($r->prioritas)
                                @include('components.priority-badge', ['prioritas' => $r->prioritas])
                            @endif
                        </div>
                        <p class="text-xs text-gray-500 mt-0.5">
                            {{ $r->category->nama_kategori }} — {{ $r->user->name }}
                        </p>
                        <p class="text-xs text-gray-400 mt-0.5 truncate">
                            📍 {{ number_format($r->latitude, 4) }}, {{ number_format($r->longitude, 4) }}
                        </p>
                        <p class="text-xs text-gray-400 mt-1">Diperbarui {{ $r->updated_at->diffForHumans() }}</p>
                    </div>

                    {{-- Aksi cepat --}}
                    <div class="flex-shrink-0 flex flex-col items-end gap-2">
                        @if($r->status === 'ditugaskan')
                            <span class="text-xs bg-purple-100 text-purple-700 px-2 py-1 rounded-full font-medium">Terima →</span>
                        @elseif($r->status === 'menuju_lokasi')
                            <span class="text-xs bg-indigo-100 text-indigo-700 px-2 py-1 rounded-full font-medium">Mulai →</span>
                        @elseif($r->status === 'sedang_ditangani')
                            <span class="text-xs bg-orange-100 text-orange-700 px-2 py-1 rounded-full font-medium">Kirim Bukti →</span>
                        @elseif($r->status === 'menunggu_konfirmasi')
                            <span class="text-xs bg-cyan-100 text-cyan-700 px-2 py-1 rounded-full font-medium">Menunggu Admin</span>
                        @endif
                        <span class="text-gray-300 group-hover:text-gray-400 text-lg">›</span>
                    </div>
                </a>
                @endforeach
            </div>
        @endif
    </div>

    {{-- Peta tugas aktif --}}
    @if($activeTasks->isNotEmpty())
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
        <h3 class="font-semibold text-gray-800 mb-3">🗺️ Peta Lokasi Tugas</h3>
        <div id="petugas-map" class="rounded-xl overflow-hidden border border-gray-200" style="height: 300px;"></div>
    </div>
    @endif

    {{-- Riwayat selesai --}}
    @if($history->isNotEmpty())
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
        <div class="px-5 py-4 border-b border-gray-100">
            <h3 class="font-semibold text-gray-800">✅ Riwayat Tugas Selesai</h3>
        </div>
        <div class="divide-y divide-gray-50">
            @foreach($history as $r)
            <div class="flex items-center gap-4 px-5 py-3">
                <div class="text-xl flex-shrink-0">{{ $r->category->icon }}</div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2">
                        <span class="font-mono text-xs font-medium text-gray-600">{{ $r->kode_laporan }}</span>
                        @include('components.status-badge', ['status' => $r->status])
                    </div>
                    <p class="text-xs text-gray-400 mt-0.5">{{ $r->category->nama_kategori }} — {{ $r->updated_at->format('d M Y') }}</p>
                </div>
            </div>
            @endforeach
        </div>
        <div class="px-5 py-3 border-t border-gray-100">
            {{ $history->links() }}
        </div>
    </div>
    @endif

</div>
@endsection

@push('scripts')
@if($activeTasks->isNotEmpty())
<script>
document.addEventListener('DOMContentLoaded', function () {
    const tasks = @json($mapTasks);

    if (!tasks.length) return;

    const first = tasks[0];
    const map = L.map('petugas-map').setView([first.lat, first.lng], 14);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { attribution: '© OpenStreetMap' }).addTo(map);

    tasks.forEach(t => {
        L.marker([t.lat, t.lng]).addTo(map)
            .bindPopup(`<b>${t.kode}</b><br>${t.kat}<br><a href="${t.url}" style="color:#0d9488">Lihat Detail →</a>`);
    });

    if (tasks.length > 1) {
        const bounds = tasks.map(t => [t.lat, t.lng]);
        map.fitBounds(bounds, { padding: [30, 30] });
    }
});
</script>
@endif
@endpush
