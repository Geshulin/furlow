@props(['status'])

@php
    $warna = [
        'menunggu'   => 'bg-furlow-blob text-furlow-accent-ink',
        'diterima'   => 'bg-sky-100 text-sky-800',
        'diproses'   => 'bg-indigo-100 text-indigo-800',
        'selesai'    => 'bg-green-100 text-green-800',
        'ditolak'    => 'bg-red-100 text-red-800',
        'dibatalkan' => 'bg-gray-200 text-gray-700',
    ];
@endphp

<span {{ $attributes->merge(['class' => 'inline-block rounded-full px-3 py-1 text-xs font-semibold ' . ($warna[$status] ?? 'bg-gray-100 text-gray-800')]) }}>
    {{ ucfirst($status) }}
</span>

