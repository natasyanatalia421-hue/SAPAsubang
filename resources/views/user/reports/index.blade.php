@extends('layouts.app')
@section('title', 'Laporan Saya')
@section('page-title', 'Laporan Saya')

@section('content')
<div class="space-y-4">
    <div class="flex items-center justify-between">
        <p class="text-sm text-gray-500">Total: {{ $reports->total() }} laporan</p>
        <a href="{{ route('user.reports.create') }}"
           class="bg-blue-600 text-white text-sm px-4 py-2 rounded-lg hover:bg-blue-700 transition flex items-center gap-2">
            📝 Buat Laporan
        </a>
    </div>

    @forelse($reports as $report)
    <a href="{{ route('user.reports.show', $report) }}"
       class="block bg-white rounded-xl shadow-sm border border-gray-100 p-4 hover:shadow-md transition">
        <div class="flex items-start justify-between gap-3">
            <div class="flex items-start gap-3 flex-1 min-w-0">
                <span class="text-2xl shrink-0 mt-0.5">{{ $report->category->icon ?? '📋' }}</span>
                <div class="min-w-0">
                    <p class="font-semibold text-gray-800 truncate">{{ $report->category->nama_kategori }}</p>
                    <p class="text-xs text-gray-400 mt-0.5">{{ $report->kode_laporan }} · {{ $report->created_at->format('d M Y') }}</p>
                    <p class="text-sm text-gray-600 mt-1 line-clamp-2">{{ $report->deskripsi }}</p>
                </div>
            </div>
            <div class="shrink-0">
                <span class="text-xs px-2 py-1 rounded-full font-medium {{ $report->status_color }}">
                    {{ $report->status_label }}
                </span>
            </div>
        </div>
    </a>
    @empty
    <div class="bg-white rounded-xl p-12 text-center border border-gray-100">
        <div class="text-5xl mb-3">📋</div>
        <p class="text-gray-500 mb-4">Anda belum memiliki laporan.</p>
        <a href="{{ route('user.reports.create') }}"
           class="inline-block bg-blue-600 text-white text-sm px-5 py-2 rounded-lg hover:bg-blue-700 transition">
            Buat Laporan Pertama
        </a>
    </div>
    @endforelse

    {{ $reports->links() }}
</div>
@endsection
