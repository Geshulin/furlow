<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Hewan;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

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
    // find() otomatis mengabaikan layanan yang sudah di-soft-delete
    $layanan = Layanan::find($request->layanan_id);

    $data = $request->validate([
        'hewan_id' => [
            'required',
            Rule::exists('hewan', 'id')
                ->where('user_id', Auth::id())
                ->whereNull('deleted_at'),
        ],
        'layanan_id' => [
            'required',
            Rule::exists('layanan', 'id')->whereNull('deleted_at'),
        ],
        'tanggal_masuk' => ['required', 'date', 'after_or_equal:today'],
        'tanggal_keluar' => [
            Rule::requiredIf($layanan?->butuh_tanggal_keluar ?? false),
            'nullable',
            'date',
            'after_or_equal:tanggal_masuk',
        ],
    ], [
        'hewan_id.required' => 'Pilih hewan terlebih dahulu.',
        'hewan_id.exists' => 'Hewan tidak ditemukan atau sudah dihapus.',
        'layanan_id.required' => 'Pilih layanan terlebih dahulu.',
        'layanan_id.exists' => 'Layanan ini sudah tidak tersedia.',
        'tanggal_masuk.required' => 'Tanggal masuk wajib diisi.',
        'tanggal_masuk.date' => 'Tanggal masuk tidak valid.',
        'tanggal_masuk.after_or_equal' => 'Tanggal masuk tidak boleh sebelum hari ini.',
        'tanggal_keluar.required' => 'Tanggal keluar wajib diisi untuk layanan penitipan.',
        'tanggal_keluar.date' => 'Tanggal keluar tidak valid.',
        'tanggal_keluar.after_or_equal' => 'Tanggal keluar tidak boleh sebelum tanggal masuk.',
    ]);

    Booking::create($data); // status otomatis 'menunggu'

    return redirect()->route('booking.index')
        ->with('success', 'Booking diajukan, menunggu konfirmasi petshop.');
    }

    public function indexAdmin()
    {
    $semuaBooking = Booking::with(['hewan.user', 'layanan'])->latest()->get();
    return view('booking.admin-index', compact('semuaBooking'));
    }

    public function updateStatus(Request $request, Booking $booking)
    {
    // Alur yang diizinkan. Status final (ditolak, selesai, dibatalkan) tidak punya tujuan.
    $alur = [
        'menunggu' => ['diterima', 'ditolak'],
        'diterima' => ['diproses'],
        'diproses' => ['selesai'],
    ];

    $request->validate([
        'status' => ['required', Rule::in(['diterima', 'ditolak', 'diproses', 'selesai'])],
        'alasan_penolakan' => ['required_if:status,ditolak', 'nullable', 'string', 'max:200'],
        'estimasi_selesai' => ['nullable', 'date', 'after_or_equal:' . $booking->tanggal_masuk->toDateString()],
    ], [
        'status.required' => 'Status tujuan wajib dipilih.',
        'status.in' => 'Status tidak valid.',
        'alasan_penolakan.required_if' => 'Alasan penolakan wajib diisi saat menolak booking.',
        'alasan_penolakan.max' => 'Alasan penolakan maksimal 200 karakter.',
        'estimasi_selesai.date' => 'Estimasi selesai tidak valid.',
        'estimasi_selesai.after_or_equal' => 'Estimasi selesai tidak boleh sebelum tanggal masuk.',
    ]);

    $tujuan = $request->status;

    if (! in_array($tujuan, $alur[$booking->status] ?? [], true)) {
        return back()->withErrors([
            'status' => "Booking berstatus {$booking->status} tidak bisa diubah ke {$tujuan}.",
        ]);
    }

    // Diproses baru boleh mulai hari H. Diterima boleh kapan saja.
    if ($tujuan === 'diproses' && $booking->tanggal_masuk->gt(today())) {
        return back()->withErrors([
            'status' => 'Booking baru bisa diproses mulai ' . tanggal($booking->tanggal_masuk) . '.',
        ]);
    }

    $data = ['status' => $tujuan];

    if ($tujuan === 'ditolak') {
        $data['alasan_penolakan'] = $request->alasan_penolakan;
    }
    if ($tujuan === 'diproses') {
        $data['estimasi_selesai'] = $request->estimasi_selesai;
    }

    $booking->update($data);

    return back()->with('success', 'Status booking diperbarui.');
    }

    public function batal(Booking $booking)
    {
        abort_if($booking->hewan->user_id !== Auth::id(), 403);
        abort_if($booking->status !== 'menunggu', 403, 'Hanya booking yang masih menunggu yang bisa dibatalkan.');

        $booking->update(['status' => 'dibatalkan']);
        return redirect()->route('booking.index')->with('success', 'Booking dibatalkan.');
    }

    public function uploadFoto(Request $request, Booking $booking)
    {
    if ($booking->status !== 'diproses') {
        return back()->withErrors(['foto' => 'Foto hanya bisa diunggah saat booking berstatus diproses.']);
    }

    $request->validate([
        'foto_before' => 'nullable|image|max:4096',
        'foto_after'  => 'nullable|image|max:4096',
    ]);

    foreach (['foto_before', 'foto_after'] as $kolom) {
        if ($request->hasFile($kolom)) {
            if ($booking->$kolom) {
                Storage::disk('public')->delete($booking->$kolom); // hapus foto lama
            }
            $booking->$kolom = $request->file($kolom)->store('booking', 'public');
        }
    }
    $booking->save();

    return back()->with('success', 'Foto disimpan.');
    }
}