@php
$colors = [
    'rendah'  => 'bg-green-100 text-green-700',
    'sedang'  => 'bg-yellow-100 text-yellow-700',
    'tinggi'  => 'bg-orange-100 text-orange-700',
    'darurat' => 'bg-red-100 text-red-700',
];
$icons = [
    'rendah'  => '🟢',
    'sedang'  => '🟡',
    'tinggi'  => '🟠',
    'darurat' => '🔴',
];
$labels = \App\Models\Report::$prioritasLabels;
$cls  = $colors[$prioritas] ?? 'bg-gray-100 text-gray-600';
$lbl  = $labels[$prioritas] ?? $prioritas;
$icon = $icons[$prioritas] ?? '';
@endphp
<span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium {{ $cls }}">
    {{ $icon }} {{ $lbl }}
</span>
