<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Models\Perusahaan;
use Illuminate\Http\Request;

class DokumenController extends Controller
{
    // Menampilkan daftar dokumen
    public function index()
    {
        $dokumen = Dokumen::with('perusahaan')->latest()->get();
        return view('dokumen.index', compact('dokumen'));
    }

    // Menampilkan form tambah
    public function create()
    {
        $perusahaan = Perusahaan::all();
        return view('dokumen.create', compact('perusahaan'));
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'id_perusahaan' => 'required',
            'nama_dokumen' => 'required',
            'jenis_dokumen' => 'required',
            'tanggal_terbit' => 'required|date'
        ]);

        Dokumen::create($request->all());

        return redirect()->route('dokumen.index')
            ->with('success', 'Dokumen berhasil ditambahkan');
    }

    // Menampilkan detail dokumen
    public function show($id)
    {
        $dokumen = Dokumen::with('perusahaan')->findOrFail($id);
        return view('dokumen.show', compact('dokumen'));
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        $perusahaan = Perusahaan::all();
        return view('dokumen.edit', compact('dokumen', 'perusahaan'));
    }

    // Mengupdate data
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_perusahaan' => 'required',
            'nama_dokumen' => 'required',
            'jenis_dokumen' => 'required',
            'tanggal_terbit' => 'required|date'
        ]);

        $dokumen = Dokumen::findOrFail($id);
        $dokumen->update($request->all());

        return redirect()->route('dokumen.index')
            ->with('success', 'Dokumen berhasil diupdate');
    }

    // Menghapus data
    public function destroy($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        $dokumen->delete();

        return redirect()->route('dokumen.index')
            ->with('success', 'Dokumen berhasil dihapus');
    }
}