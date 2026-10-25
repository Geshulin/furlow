<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Hewan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $hariIni = Booking::with(['hewan', 'layanan'])
                ->where(function ($q) {
                    $q->whereDate('tanggal_masuk', today())->orWhere('status', 'diproses');
                })
                ->orderBy('tanggal_masuk')
                ->get();

            return view('dashboard.admin', [
                'hariIni'  => $hariIni,
                'menunggu' => Booking::where('status', 'menunggu')->count(),
                'diproses' => Booking::where('status', 'diproses')->count(),
            ]);
        }

        $hewanSaya = Hewan::where('user_id', $user->id)->get();
        $bookingAktif = Booking::whereHas('hewan', fn ($q) => $q->where('user_id', $user->id))
            ->whereIn('status', ['menunggu', 'diterima', 'diproses'])
            ->with(['hewan', 'layanan'])
            ->get();

        return view('dashboard.pemilik', compact('hewanSaya', 'bookingAktif'));
    }
}