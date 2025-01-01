@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/perusahaan.css') }}">
@endsection

@section('content')
<div class="container-perusahaan">
    <div class="card-perusahaan">
        <div class="card-header-perusahaan">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Daftar Perusahaan</h3>
                <a href="{{ route('perusahaan.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Perusahaan
                </a>
            </div>
        </div>

        <div class="card-body-perusahaan">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table-perusahaan">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Perusahaan</th>
                            <th>Kode</th>
                            <th>Alamat</th>
                            <th>Telepon</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($perusahaan as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->nama_perusahaan }}</td>
                                <td>{{ $item->kode_perusahaan }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td>{{ $item->nomor_telepon }}</td>
                                <td>{{ $item->email }}</td>
                                <td>
                                    <a href="{{ route('perusahaan.show', $item->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('perusahaan.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('perusahaan.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection