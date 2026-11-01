<?php

namespace Database\Seeders;

use App\Models\Layanan;
use Illuminate\Database\Seeder;

class LayananSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['Grooming Lengkap', 85000, 'Mandi, potong bulu, dan perawatan kuku.', false],
            ['Mandi Sehat', 55000, 'Mandi dengan sampo sesuai jenis kulit dan pengeringan.', false],
            ['Potong Kuku & Bersih Telinga', 30000, 'Perawatan singkat kuku dan telinga.', false],
            ['Penitipan Harian', 45000, 'Kandang nyaman dan jadwal makan sesuai kebiasaan, per hari.', true],
        ];

        foreach ($data as [$nama, $harga, $deskripsi, $penitipan]) {
            Layanan::create([
                'nama_layanan' => $nama,
                'harga' => $harga,
                'deskripsi' => $deskripsi,
                'butuh_tanggal_keluar' => $penitipan,
            ]);
        }
    }
}