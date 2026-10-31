<?php

use Illuminate\Support\Carbon;

if (! function_exists('rupiah')) {
    function rupiah(float|int|string|null $angka): string
    {
        return 'Rp ' . number_format((float) $angka, 0, ',', '.');
    }
}

if (! function_exists('tanggal')) {
    function tanggal($tanggal, string $format = 'd M Y'): string
    {
        return $tanggal ? Carbon::parse($tanggal)->translatedFormat($format) : '-';
    }
}