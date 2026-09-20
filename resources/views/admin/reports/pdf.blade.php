<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: sans-serif; font-size: 11px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 6px 8px; text-align: left; }
        th { background: #f3f4f6; }
        h2 { margin-bottom: 4px; }
        p { margin-top: 0; color: #666; }
    </style>
</head>
<body>
    <h2>Laporan Masalah — EcoCity</h2>
    <p>Dicetak pada {{ now()->format('d M Y, H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>Kode</th>
                <th>Kategori</th>
                <th>Pelapor</th>
                <th>Status</th>
                <th>Prioritas</th>
                <th>Petugas</th>
                <th>Waktu</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reports as $r)
            <tr>
                <td>{{ $r->kode_laporan }}</td>
                <td>{{ $r->category->nama_kategori ?? '-' }}</td>
                <td>{{ $r->user->name ?? '-' }}</td>
                <td>{{ $r->status }}</td>
                <td>{{ $r->prioritas ?? '-' }}</td>
                <td>{{ $r->petugas->name ?? '-' }}</td>
                <td>{{ $r->created_at->format('d-m-Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>