@php
$colors = [
    'rendah'  => 'bg-green-100 text-green-700',
    'sedang'  => 'bg-yellow-100 text-yellow-700',
    'tinggi'  => 'bg-orange-100 text-orange-700',
    'darurat' => 'bg-red-100 text-red-700',
];
$labels = \App\Models\Report::$prioritasLabels;
$color = $colors[$prioritas] ?? 'bg-gray-100 text-gray-500';
$label = $labels[$prioritas] ?? $prioritas;
@endphp
@if($prioritas)
<span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $color }}">
    {{ $label }}
</span>
@endif
