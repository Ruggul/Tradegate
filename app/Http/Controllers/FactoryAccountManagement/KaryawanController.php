<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    // Menampilkan daftar karyawan
    public function index()
    {
        $karyawan = Karyawan::with('user')->latest()->get();
        return view('karyawan.index', compact('karyawan'));
    }

    // Menampilkan form tambah
    public function create()
    {
        $users = User::all();
        return view('karyawan.create', compact('users'));
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_karyawan' => 'required',
            'nomor_karyawan' => 'required|unique:karyawan',
            'jabatan' => 'required',
            'tanggal_bergabung' => 'required|date'
        ]);

        Karyawan::create($request->all());

        return redirect()->route('karyawan.index')
            ->with('success', 'Data karyawan berhasil ditambahkan');
    }

    // Menampilkan detail karyawan
    public function show($id)
    {
        $karyawan = Karyawan::with('user')->findOrFail($id);
        return view('karyawan.show', compact('karyawan'));
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $users = User::all();
        return view('karyawan.edit', compact('karyawan', 'users'));
    }

    // Mengupdate data
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_karyawan' => 'required',
            'nomor_karyawan' => 'required|unique:karyawan,nomor_karyawan,'.$id,
            'jabatan' => 'required',
            'tanggal_bergabung' => 'required|date'
        ]);

        $karyawan = Karyawan::findOrFail($id);
        $karyawan->update($request->all());

        return redirect()->route('karyawan.index')
            ->with('success', 'Data karyawan berhasil diupdate');
    }

    // Menghapus data
    public function destroy($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $karyawan->delete();

        return redirect()->route('karyawan.index')
            ->with('success', 'Data karyawan berhasil dihapus');
    }
}