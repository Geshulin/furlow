<?php

namespace App\Services;

use App\Models\Layanan;
use Illuminate\Support\Carbon;

class BookingService
{
    /**
     * Jumlah hari = selisih tanggal keluar dan tanggal masuk, minimal 1.
     * Tanpa tanggal keluar dihitung 1 hari.
     */
    public function jumlahHari($tanggalMasuk, $tanggalKeluar = null): int
    {
        if (! $tanggalKeluar) {
            return 1;
        }

        $masuk = Carbon::parse($tanggalMasuk)->startOfDay();
        $keluar = Carbon::parse($tanggalKeluar)->startOfDay();

        return max(1, (int) $masuk->diffInDays($keluar));
    }

    /**
     * Estimasi total = harga layanan (harga mulai dari) x jumlah hari.
     */
    public function estimasiTotal(Layanan $layanan, $tanggalMasuk, $tanggalKeluar = null): float
    {
        return (float) $layanan->harga * $this->jumlahHari($tanggalMasuk, $tanggalKeluar);
    }
}