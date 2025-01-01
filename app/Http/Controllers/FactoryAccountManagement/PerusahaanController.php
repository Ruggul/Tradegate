<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use Illuminate\Http\Request;

class PerusahaanController extends Controller
{
    // Menampilkan daftar perusahaan
    public function index()
    {
        $perusahaan = Perusahaan::latest()->get();
        return view('perusahaan.index', compact('perusahaan'));
    }

    // Menampilkan form tambah
    public function create()
    {
        return view('perusahaan.create');
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_perusahaan' => 'required',
            'kode_perusahaan' => 'required|unique:perusahaan',
            'alamat' => 'required',
            'nomor_telepon' => 'required',
            'email' => 'required|email'
        ]);

        Perusahaan::create($request->all());

        return redirect()->route('perusahaan.index')
            ->with('success', 'Data berhasil ditambahkan');
    }

    // Menampilkan detail perusahaan
    public function show($id)
    {
        $perusahaan = Perusahaan::findOrFail($id);
        return view('perusahaan.show', compact('perusahaan'));
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $perusahaan = Perusahaan::findOrFail($id);
        return view('perusahaan.edit', compact('perusahaan'));
    }

    // Mengupdate data
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_perusahaan' => 'required',
            'kode_perusahaan' => 'required',
            'alamat' => 'required',
            'nomor_telepon' => 'required',
            'email' => 'required|email'
        ]);

        $perusahaan = Perusahaan::findOrFail($id);
        $perusahaan->update($request->all());

        return redirect()->route('perusahaan.index')
            ->with('success', 'Data berhasil diupdate');
    }

    // Menghapus data
    public function destroy($id)
    {
        $perusahaan = Perusahaan::findOrFail($id);
        $perusahaan->delete();

        return redirect()->route('perusahaan.index')
            ->with('success', 'Data berhasil dihapus');
    }
}