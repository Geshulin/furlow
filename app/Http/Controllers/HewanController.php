<?php

namespace App\Http\Controllers;

use App\Models\Hewan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HewanController extends Controller
{
    public function index()
    {
        $hewan = Hewan::where('user_id', Auth::id())->get();
        return view('hewan.index', compact('hewan'));
    }

    public function create()
    {
        return view('hewan.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'ras' => 'nullable|string|max:255',
            'catatan_kesehatan' => 'nullable|string',
            'foto' => 'nullable|image|max:2048',
        ]);
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('hewan', 'public');
        }
        $data['user_id'] = Auth::id();
        Hewan::create($data);
        return redirect()->route('hewan.index')->with('success', 'Hewan ditambahkan.');
    }

    public function show(Hewan $hewan)
    {
    abort_if($hewan->user_id !== Auth::id(), 403);

    $riwayat = $hewan->booking()->with('layanan')->latest()->take(5)->get();

    return view('hewan.show', compact('hewan', 'riwayat'));
    }

    public function edit(Hewan $hewan)
    {
        abort_if($hewan->user_id !== Auth::id(), 403);
        return view('hewan.edit', compact('hewan'));
    }

    public function update(Request $request, Hewan $hewan)
    {
        abort_if($hewan->user_id !== Auth::id(), 403);
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'ras' => 'nullable|string|max:255',
            'catatan_kesehatan' => 'nullable|string',
            'foto' => 'nullable|image|max:2048',
        ]);
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('hewan', 'public');
        }
        $hewan->update($data);
        return redirect()->route('hewan.index')->with('success', 'Data hewan diperbarui.');
    }

    public function destroy(Hewan $hewan)
    {
        abort_if($hewan->user_id !== Auth::id(), 403);
        $hewan->delete();
        return redirect()->route('hewan.index')->with('success', 'Hewan dihapus.');
    }
}