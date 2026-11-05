<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Hewan;
use App\Models\Layanan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        $budi = User::create([
            'name' => 'Mira',
            'email' => 'mira@furlow.demo',
            'password' => Hash::make('password123'),
            'role' => 'pemilik_hewan',
        ]);
        $sari = User::create([
            'name' => 'Alok',
            'email' => 'alok@furlow.demo',
            'password' => Hash::make('password123'),
            'role' => 'pemilik_hewan',
        ]);

        $kiki = Hewan::create(['user_id' => $budi->id, 'nama' => 'Kiki', 'jenis' => 'Kucing', 'ras' => 'Persia', 'catatan_kesehatan' => 'Alergi ikan laut.']);
        $sisi = Hewan::create(['user_id' => $budi->id, 'nama' => 'Sisi', 'jenis' => 'Anjing', 'ras' => 'Golden Retriever']);
        $milo = Hewan::create(['user_id' => $sari->id, 'nama' => 'Milo', 'jenis' => 'Anjing', 'ras' => 'Pomeranian']);
        $luna = Hewan::create(['user_id' => $sari->id, 'nama' => 'Luna', 'jenis' => 'Kucing', 'ras' => 'Domestik', 'catatan_kesehatan' => 'Takut suara pengering.']);

        $grooming = Layanan::where('nama_layanan', 'Grooming Lengkap')->first();
        $mandi = Layanan::where('nama_layanan', 'Mandi Sehat')->first();
        $kuku = Layanan::where('nama_layanan', 'Potong Kuku & Bersih Telinga')->first();
        $titip = Layanan::where('nama_layanan', 'Penitipan Harian')->first();

        $hariIni = today();

        // menunggu
        Booking::create(['hewan_id' => $kiki->id, 'layanan_id' => $grooming->id, 'tanggal_masuk' => $hariIni->copy()->addDay(), 'status' => 'menunggu']);
        // diterima, masuk lusa (belum bisa diproses)
        Booking::create(['hewan_id' => $sisi->id, 'layanan_id' => $titip->id, 'tanggal_masuk' => $hariIni->copy()->addDays(2), 'tanggal_keluar' => $hariIni->copy()->addDays(5), 'status' => 'diterima']);
        // diterima, masuk hari ini (bisa langsung diproses saat demo)
        Booking::create(['hewan_id' => $luna->id, 'layanan_id' => $mandi->id, 'tanggal_masuk' => $hariIni, 'status' => 'diterima']);
        // diproses
        Booking::create(['hewan_id' => $milo->id, 'layanan_id' => $grooming->id, 'tanggal_masuk' => $hariIni, 'status' => 'diproses', 'estimasi_selesai' => now()->addHours(3)]);
        // selesai (dua riwayat)
        Booking::create(['hewan_id' => $luna->id, 'layanan_id' => $mandi->id, 'tanggal_masuk' => $hariIni->copy()->subDays(7), 'status' => 'selesai']);
        Booking::create(['hewan_id' => $kiki->id, 'layanan_id' => $titip->id, 'tanggal_masuk' => $hariIni->copy()->subDays(14), 'tanggal_keluar' => $hariIni->copy()->subDays(11), 'status' => 'selesai']);
        // ditolak
        Booking::create(['hewan_id' => $sisi->id, 'layanan_id' => $grooming->id, 'tanggal_masuk' => $hariIni->copy()->addDays(3), 'status' => 'ditolak', 'alasan_penolakan' => 'Kandang penuh pada tanggal tersebut. Silakan ajukan tanggal lain.']);
        // dibatalkan
        Booking::create(['hewan_id' => $luna->id, 'layanan_id' => $kuku->id, 'tanggal_masuk' => $hariIni->copy()->addDays(4), 'status' => 'dibatalkan']);
    }
}