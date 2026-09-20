<?php

namespace App\Exports;

use App\Models\Report;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ReportsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection(): Collection
    {
        return Report::with(['category', 'user', 'petugas'])->latest()->get();
    }

    public function headings(): array
    {
        return [
            'Kode Laporan',
            'Kategori',
            'Pelapor',
            'Status',
            'Prioritas',
            'Petugas',
            'Deskripsi',
            'Waktu Lapor',
        ];
    }

    public function map($report): array
    {
        return [
            $report->kode_laporan,
            $report->category->nama_kategori ?? '-',
            $report->user->name ?? '-',
            $report->status,
            $report->prioritas ?? '-',
            $report->petugas->name ?? '-',
            $report->deskripsi,
            $report->created_at->format('d-m-Y H:i'),
        ];
    }
}