@php
$colors = [
    'menunggu_verifikasi' => 'bg-yellow-100 text-yellow-800',
    'ditolak'             => 'bg-red-100 text-red-700',
    'terverifikasi'       => 'bg-blue-100 text-blue-700',
    'ditugaskan'          => 'bg-purple-100 text-purple-700',
    'menuju_lokasi'       => 'bg-indigo-100 text-indigo-700',
    'sedang_ditangani'    => 'bg-orange-100 text-orange-700',
    'menunggu_konfirmasi' => 'bg-cyan-100 text-cyan-700',
    'selesai'             => 'bg-green-100 text-green-700',
];
$labels = \App\Models\Report::$statusLabels;
$cls = $colors[$status] ?? 'bg-gray-100 text-gray-600';
$lbl = $labels[$status] ?? $status;
@endphp
<span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $cls }}">
    {{ $lbl }}
</span>
