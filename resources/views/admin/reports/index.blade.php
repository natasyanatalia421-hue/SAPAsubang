@extends('layouts.app')
@section('title', 'Semua Laporan')
@section('page-title', 'Manajemen Laporan')

@section('content')
<div class="space-y-4">

    {{-- Filter --}}
    <div class="bg-white rounded-xl border border-gray-200 p-4">
        <form method="GET" action="{{ route('admin.reports.index') }}" class="flex flex-wrap gap-3 items-end">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Cari</label>
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Kode / deskripsi..."
                       class="px-3 py-2 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Status</label>
                <select name="status" class="px-3 py-2 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="">Semua Status</option>
                    @foreach(\App\Models\Report::$statusLabels as $val => $label)
                    <option value="{{ $val }}" {{ request('status') == $val ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Kategori</label>
                <select name="category_id" class="px-3 py-2 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->nama_kategori }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Prioritas</label>
                <select name="prioritas" class="px-3 py-2 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="">Semua</option>
                    @foreach(\App\Models\Report::$prioritasLabels as $val => $label)
                    <option value="{{ $val }}" {{ request('prioritas') == $val ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm px-4 py-2 rounded-lg transition-colors">
                Filter
            </button>
            @if(request()->anyFilled(['q','status','category_id','prioritas']))
            <a href="{{ route('admin.reports.index') }}" class="text-sm text-gray-500 hover:underline py-2">Reset</a>
            @endif
        </form>
    </div>

    {{-- Tabel --}}
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr class="text-left text-xs text-gray-500 uppercase tracking-wide">
                        <th class="px-4 py-3">Kode</th>
                        <th class="px-4 py-3">Foto</th>
                        <th class="px-4 py-3">Kategori</th>
                        <th class="px-4 py-3">Pelapor</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Prioritas</th>
                        <th class="px-4 py-3">Pendukung</th>
                        <th class="px-4 py-3">Waktu</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($reports as $report)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-4 py-3 font-mono text-xs text-indigo-700 font-medium whitespace-nowrap">
                            {{ $report->kode_laporan }}
                        </td>
                        <td class="px-4 py-3">
                            <img src="{{ Storage::url($report->foto_sebelum) }}"
                                 onerror="this.src='https://placehold.co/48x48?text=foto'"
                                 class="w-12 h-12 object-cover rounded-lg">
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            {{ $report->category->icon }} {{ $report->category->nama_kategori }}
                        </td>
                        <td class="px-4 py-3 text-gray-700">{{ $report->user->name }}</td>
                        <td class="px-4 py-3">
                            @include('components.status-badge', ['status' => $report->status])
                        </td>
                        <td class="px-4 py-3">
                            @if($report->prioritas)
                                @include('components.prioritas-badge', ['prioritas' => $report->prioritas])
                            @else
                                <span class="text-gray-400 text-xs">—</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-gray-600 text-center">{{ $report->supports_count ?? 0 }}</td>
                        <td class="px-4 py-3 text-gray-400 text-xs whitespace-nowrap">
                            {{ $report->created_at->format('d M Y') }}
                        </td>
                        <td class="px-4 py-3">
                            <a href="{{ route('admin.reports.show', $report) }}"
                               class="bg-indigo-50 hover:bg-indigo-100 text-indigo-700 text-xs font-medium px-3 py-1.5 rounded-lg transition-colors">
                                Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center py-12 text-gray-400">
                            <div class="text-4xl mb-2">📭</div>
                            Tidak ada laporan ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-4 py-3 border-t border-gray-100">
            {{ $reports->links('components.pagination') }}
        </div>
    </div>

</div>
@endsection
