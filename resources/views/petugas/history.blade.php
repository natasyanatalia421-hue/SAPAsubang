@extends('layouts.app')
@section('title', 'Riwayat Tugas')
@section('page-title', 'Riwayat Tugas Saya')

@section('content')
<div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr class="text-xs text-gray-500 uppercase text-left">
                    <th class="px-4 py-3">Kode</th>
                    <th class="px-4 py-3">Kategori</th>
                    <th class="px-4 py-3">Pelapor</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Terakhir Update</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($reports as $report)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 font-mono text-xs text-teal-700 font-medium">{{ $report->kode_laporan }}</td>
                    <td class="px-4 py-3 text-gray-700">{{ $report->category->icon }} {{ $report->category->nama_kategori }}</td>
                    <td class="px-4 py-3 text-gray-600">{{ $report->user->name }}</td>
                    <td class="px-4 py-3">@include('components.status-badge', ['status' => $report->status])</td>
                    <td class="px-4 py-3 text-gray-400 text-xs">{{ $report->updated_at->format('d M Y, H:i') }}</td>
                    <td class="px-4 py-3">
                        <a href="{{ route('petugas.reports.show', $report) }}"
                           class="bg-teal-50 hover:bg-teal-100 text-teal-700 text-xs font-medium px-3 py-1.5 rounded-lg">
                            Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-12 text-gray-400">Belum ada riwayat tugas.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-4 py-3 border-t border-gray-100">
        {{ $reports->links('components.pagination') }}
    </div>
</div>
@endsection
