@extends('layouts.dashboard')
@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard Admin')

@section('content')
<div class="space-y-6">

    {{-- Stat cards --}}
    <div class="grid grid-cols-2 lg:grid-cols-5 gap-4">
        @php
        $cards = [
            ['label' => 'Total Laporan',    'value' => $stats['total'],               'icon' => '📋', 'color' => 'bg-gray-50 border-gray-200'],
            ['label' => 'Menunggu',         'value' => $stats['menunggu_verifikasi'], 'icon' => '⏳', 'color' => 'bg-yellow-50 border-yellow-200'],
            ['label' => 'Sedang Proses',    'value' => $stats['sedang_proses'],       'icon' => '🔧', 'color' => 'bg-blue-50 border-blue-200'],
            ['label' => 'Selesai',          'value' => $stats['selesai'],             'icon' => '✅', 'color' => 'bg-green-50 border-green-200'],
            ['label' => 'Ditolak',          'value' => $stats['ditolak'],             'icon' => '❌', 'color' => 'bg-red-50 border-red-200'],
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

    {{-- Peta semua laporan aktif --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
        <h3 class="font-semibold text-gray-800 mb-3">🗺️ Peta Laporan Aktif</h3>
        <div id="admin-map" class="rounded-xl overflow-hidden border border-gray-200" style="height: 380px;"></div>
    </div>

    {{-- Menunggu verifikasi --}}
    @if($pending->isNotEmpty())
    <div class="bg-white rounded-2xl border border-yellow-200 shadow-sm">
        <div class="px-5 py-4 border-b border-yellow-100 bg-yellow-50 rounded-t-2xl flex items-center gap-2">
            <span>⏳</span>
            <h3 class="font-semibold text-yellow-800">Perlu Verifikasi Segera ({{ $pending->count() }})</h3>
        </div>
        <div class="divide-y divide-gray-50">
            @foreach($pending as $r)
            <a href="{{ route('admin.reports.show', $r->id) }}"
               class="flex items-start gap-4 px-5 py-4 hover:bg-gray-50 transition-colors group">
                <div class="text-2xl flex-shrink-0">{{ $r->category->icon }}</div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2 flex-wrap">
                        <span class="font-medium text-sm text-gray-800">{{ $r->kode_laporan }}</span>
                        <span class="text-xs bg-yellow-100 text-yellow-700 px-2 py-0.5 rounded-full">
                            👍 {{ $r->supports_count }} dukungan
                        </span>
                    </div>
                    <p class="text-xs text-gray-500 mt-0.5">{{ $r->category->nama_kategori }} — {{ $r->user->name }}</p>
                    <p class="text-xs text-gray-400 mt-0.5">{{ Str::limit($r->deskripsi, 70) }}</p>
                </div>
                <div class="text-xs text-gray-400 flex-shrink-0">{{ $r->created_at->diffForHumans() }}</div>
            </a>
            @endforeach
        </div>
    </div>
    @endif

{{-- Semua laporan --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm">
    <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between flex-wrap gap-3">
        <h3 class="font-semibold text-gray-800">Semua Laporan</h3>
        <div class="flex items-center gap-3">
            <span class="text-xs text-gray-400">{{ $reports->total() }} total</span>
            <a href="{{ route('admin.reports.export.pdf') }}"
               class="flex items-center gap-1.5 text-xs font-medium text-red-600 hover:text-red-800 px-3 py-1.5 rounded-lg border border-red-200 hover:bg-red-50 transition-colors">
                📄 Export PDF
            </a>
            <a href="{{ route('admin.reports.export.excel') }}"
               class="flex items-center gap-1.5 text-xs font-medium text-green-600 hover:text-green-800 px-3 py-1.5 rounded-lg border border-green-200 hover:bg-green-50 transition-colors">
                📊 Export Excel
            </a>
        </div>
    </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr class="text-left text-xs text-gray-500 uppercase tracking-wide">
                        <th class="px-4 py-3">Kode</th>
                        <th class="px-4 py-3">Kategori</th>
                        <th class="px-4 py-3">Pelapor</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Prioritas</th>
                        <th class="px-4 py-3">Dukungan</th>
                        <th class="px-4 py-3">Petugas</th>
                        <th class="px-4 py-3">Waktu</th>
                        <th class="px-4 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($reports as $r)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-4 py-3 font-mono text-xs font-medium text-gray-700">{{ $r->kode_laporan }}</td>
                        <td class="px-4 py-3">
                            <span class="flex items-center gap-1.5">
                                <span>{{ $r->category->icon }}</span>
                                <span class="text-gray-700">{{ $r->category->nama_kategori }}</span>
                            </span>
                        </td>
                        <td class="px-4 py-3 text-gray-600">{{ $r->user->name }}</td>
                        <td class="px-4 py-3">@include('components.status-badge', ['status' => $r->status])</td>
                        <td class="px-4 py-3">
                            @if($r->prioritas)
                                @include('components.priority-badge', ['prioritas' => $r->prioritas])
                            @else
                                <span class="text-gray-300">—</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-center">
                            <span class="text-gray-600">👍 {{ $r->supports_count }}</span>
                        </td>
                        <td class="px-4 py-3 text-gray-500 text-xs">
                            {{ $r->petugas?->name ?? '—' }}
                        </td>
                        <td class="px-4 py-3 text-gray-400 text-xs whitespace-nowrap">
                            {{ $r->created_at->format('d/m/y H:i') }}
                        </td>
                        <td class="px-4 py-3">
                            <a href="{{ route('admin.reports.show', $r->id) }}"
                               class="text-blue-600 hover:text-blue-800 font-medium text-xs whitespace-nowrap">
                                Kelola →
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="px-5 py-3 border-t border-gray-100">
            {{ $reports->links() }}
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const map = L.map('admin-map').setView([-6.5744, 107.7599], 11);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { attribution: '© OpenStreetMap' }).addTo(map);

    const statusColors = {
        menunggu_verifikasi: '#EAB308',
        ditolak:             '#EF4444',
        terverifikasi:       '#3B82F6',
        ditugaskan:          '#8B5CF6',
        menuju_lokasi:       '#6366F1',
        sedang_ditangani:    '#F97316',
        menunggu_konfirmasi: '#06B6D4',
        selesai:             '#22C55E',
    };

    // Data laporan untuk peta (disiapkan dari controller via $mapReports)
    const reports = @json($mapReports);

    reports.forEach(r => {
        const color = statusColors[r.status] || '#6B7280';
        const icon = L.divIcon({
            className: '',
            html: `<div style="background:${color};width:14px;height:14px;border-radius:50%;border:2px solid white;box-shadow:0 1px 4px rgba(0,0,0,.3)"></div>`,
            iconSize: [14, 14],
            iconAnchor: [7, 7],
        });
        L.marker([r.lat, r.lng], { icon })
            .addTo(map)
            .bindPopup(`<b>${r.kode}</b><br>${r.kategori}<br><a href="${r.url}" style="color:#3B82F6">Kelola →</a>`);
    });
});
</script>
@endpush
