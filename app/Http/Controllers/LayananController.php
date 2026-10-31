<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $layanan = Layanan::all();
        return view('layanan.index', compact('layanan'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('layanan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $data = $request->validate($this->aturan());
    $data['butuh_tanggal_keluar'] = $request->boolean('butuh_tanggal_keluar');
    Layanan::create($data);

    return redirect()->route('layanan.index')->with('success', 'Layanan ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Layanan $layanan)
    {
        return view('layanan.edit', compact('layanan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Layanan $layanan)
    {
    $data = $request->validate($this->aturan());
    $data['butuh_tanggal_keluar'] = $request->boolean('butuh_tanggal_keluar');
    $layanan->update($data);

    return redirect()->route('layanan.index')->with('success', 'Layanan diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Layanan $layanan)
    {
        $layanan->delete();
        return redirect()->route('layanan.index')->with('success', 'layanan dihapus');
    }

    private function aturan(): array
    {
    return [
        'nama_layanan' => 'required|string|max:255',
        'harga' => 'required|numeric|min:0',
        'deskripsi' => 'nullable|string',
        'butuh_tanggal_keluar' => 'nullable|boolean',
    ];
    }
}
