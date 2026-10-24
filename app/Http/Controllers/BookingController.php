<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Hewan;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function indexPemilik()
    {
        $bookingSaya = Booking::whereHas('hewan', fn($q) => $q->where('user_id', Auth::id()))
            ->with(['hewan', 'layanan'])
            ->latest()
            ->get();
        return view('booking.index', compact('bookingSaya'));
    }

    public function create()
    {
    return view('booking.create', [
        'hewan'   => Hewan::where('user_id', Auth::id())->get(),
        'layanan' => Layanan::all(),
    ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'hewan_id' => 'required|exists:hewan,id',
            'layanan_id' => 'required|exists:layanan,id',
            'tanggal_masuk' => 'required|date|after_or_equal:today',
            'tanggal_keluar' => 'nullable|date|after_or_equal:tanggal_masuk',
        ]);

        // pastikan hewan_id beneran punya user yang login
        Hewan::where('id', $data['hewan_id'])
            ->where('user_id', Auth::id())
            ->firstOrFail();

        Booking::create($data); // status otomatis 'menunggu' (default dari migration)
        return redirect()->route('booking.index')->with('success', 'Booking diajukan, menunggu konfirmasi admin.');
    }

    public function indexAdmin()
    {
    $semuaBooking = Booking::with(['hewan.user', 'layanan'])->latest()->get();
    return view('booking.admin-index', compact('semuaBooking'));
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $data = $request->validate([
        'status' => 'required|in:menunggu,diterima,ditolak,diproses,selesai',
        'alasan_penolakan' => 'nullable|string',
        'estimasi_selesai' => 'nullable|date',
    ]);

        $alur = [
            'menunggu'   => ['diterima', 'ditolak'],
            'diterima'   => ['diproses'],
            'diproses'   => ['selesai'],
            'ditolak'    => [],
            'selesai'    => [],
            'dibatalkan' => [],
    ];

        if ($data['status'] !== $booking->status
            && ! in_array($data['status'], $alur[$booking->status] ?? [])) {
            return redirect()->back()->withErrors([
                'status' => 'Status tidak bisa diubah dari ' . $booking->status . ' ke ' . $data['status'] . '.',
            ]);
    }

        $booking->update($data);
        return redirect()->back()->with('success', 'Status booking diperbarui.');
    }

    public function batal(Booking $booking)
    {
        abort_if($booking->hewan->user_id !== Auth::id(), 403);
        abort_if($booking->status !== 'menunggu', 403, 'Hanya booking yang masih menunggu yang bisa dibatalkan.');

        $booking->update(['status' => 'dibatalkan']);
        return redirect()->route('booking.index')->with('success', 'Booking dibatalkan.');
    }
}