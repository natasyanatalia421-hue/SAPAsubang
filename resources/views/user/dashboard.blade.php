@extends('layouts.app')
@section('title', 'Dashboard Saya')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-6">

    {{-- Flash message --}}
    @if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-700 text-sm px-4 py-3 rounded-xl">
        {{ session('success') }}
    </div>
    @endif

    {{-- Header --}}
    <div class="flex items-center justify-between flex-wrap gap-3">
        <div>
            <h1 class="text-xl font-bold text-gray-800">Halo, {{ auth()->user()->name }} </h1>
            <p class="text-sm text-gray-500 mt-0.5">Berikut ringkasan laporan dan aktivitas Anda.</p>
        </div>
        <a href="{{ route('user.reports.create') }}"
           class="flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2.5 rounded-xl transition-colors text-sm shadow-sm">
            Buat Laporan Baru
        </a>
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        @php
        $cards = [
            ['label'=>'Total Laporan',  'value'=>$stats['total'], 'bg'=>'bg-blue-50',   'text'=>'text-blue-700'],
            ['label'=>'Sedang Proses',  'value'=>$stats['aktif'], 'bg'=>'bg-yellow-50', 'text'=>'text-yellow-700'],
            ['label'=>'Selesai',        'value'=>$stats['selesai'],'bg'=>'bg-green-50',  'text'=>'text-green-700'],
            ['label'=>'Ditolak',        'value'=>$stats['ditolak'], 'bg'=>'bg-red-50',    'text'=>'text-red-700'],
        ];
        @endphp
        @foreach($cards as $c)
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
            <div class="text-2xl font-bold text-gray-800">{{ $c['value'] }}</div>
            <div class="text-xs text-gray-500 mt-0.5">{{ $c['label'] }}</div>
        </div>
        @endforeach
    </div>

    {{-- Laporan saya --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
        <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
            <h3 class="font-semibold text-gray-800">Laporan Saya</h3>
            <span class="text-xs text-gray-400">{{ $reports->total() }} laporan</span>
        </div>

        @if($reports->isEmpty())
        <div class="py-14 text-center text-gray-400">
            <div class="text-4xl mb-3"></div>
            <p class="font-medium text-gray-600">Belum ada laporan.</p>
            <p class="text-sm mt-1">Laporkan masalah fasilitas umum yang Anda temukan.</p>
            <a href="{{ route('user.reports.create') }}" class="inline-block mt-4 bg-green-600 hover:bg-green-700 text-white text-sm font-medium px-5 py-2 rounded-xl transition-colors">
                Buat Laporan Pertama
            </a>
        </div>
        @else
        <div class="divide-y divide-gray-50">
            @foreach($reports as $r)
            <div class="flex items-start gap-4 px-5 py-4 hover:bg-gray-50 transition-colors group">
                <a href="{{ route('user.reports.show', $r->id) }}" class="flex items-start gap-4 flex-1 min-w-0">
                    <div class="text-2xl flex-shrink-0 mt-0.5">{{ $r->category->icon ?? '' }}</div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 flex-wrap">
                            <span class="font-mono text-xs font-semibold text-gray-600">{{ $r->kode_laporan }}</span>
                            @include('components.status-badge', ['status' => $r->status])
                            @if($r->prioritas) @include('components.priority-badge', ['prioritas' => $r->prioritas]) @endif
                        </div>
                        <p class="text-xs text-gray-500 mt-0.5">{{ $r->category->nama_kategori }}</p>
                        <p class="text-xs text-gray-400 mt-0.5 truncate">{{ Str::limit($r->deskripsi, 70) }}</p>
                        <p class="text-xs text-gray-400 mt-1">{{ $r->created_at->diffForHumans() }}</p>
                    </div>
                </a>

                <div class="flex items-center gap-2 flex-shrink-0">
                    @if($r->status === 'menunggu_verifikasi')
                    <a href="{{ route('user.reports.edit', $r->id) }}"
                       class="text-xs font-medium text-blue-600 hover:text-blue-800 px-2 py-1 rounded-lg hover:bg-blue-50">
                        Edit
                    </a>
                    <form action="{{ route('user.reports.destroy', $r->id) }}" method="POST"
                          onsubmit="return confirm('Yakin mau hapus laporan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="text-xs font-medium text-red-600 hover:text-red-800 px-2 py-1 rounded-lg hover:bg-red-50">
                            Hapus
                        </button>
                    </form>
                    @endif
                    <a href="{{ route('user.reports.show', $r->id) }}" class="text-gray-300 group-hover:text-gray-500 text-lg">›</a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="px-5 py-3 border-t border-gray-100">{{ $reports->links() }}</div>
        @endif
    </div>

    {{-- Laporan yang didukung --}}
    @if($supported->isNotEmpty())
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
        <div class="px-5 py-4 border-b border-gray-100">
            <h3 class="font-semibold text-gray-800">Laporan yang Saya Dukung</h3>
        </div>
        <div class="divide-y divide-gray-50">
            @foreach($supported as $r)
            <a href="{{ route('user.reports.show', $r->id) }}"
               class="flex items-center gap-4 px-5 py-4 hover:bg-gray-50 transition-colors group">
                <div class="text-2xl flex-shrink-0">{{ $r->category->icon ?? '' }}</div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2">
                        <span class="font-mono text-xs font-semibold text-gray-600">{{ $r->kode_laporan }}</span>
                        @include('components.status-badge', ['status' => $r->status])
                    </div>
                    <p class="text-xs text-gray-500 mt-0.5">{{ $r->category->nama_kategori }}</p>
                </div>
                <span class="text-gray-300 group-hover:text-gray-500 text-lg">›</span>
            </a>
            @endforeach
        </div>
    </div>
    @endif

</div>
@endsection