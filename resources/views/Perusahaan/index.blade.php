<!DOCTYPE html>
<html>
<head>
    <title>Daftar Perusahaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h3>Daftar Perusahaan</h3>
                <a href="{{ route('perusahaan.create') }}" class="btn btn-primary">Tambah Perusahaan</a>
            </div>

            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Perusahaan</th>
                            <th>Kode Perusahaan</th>
                            <th>Alamat</th>
                            <th>Telepon</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($perusahaan as $perusahaan)
                            <tr>
                                <td>{{ $perusahaan->nama_perusahaan }}</td>
                                <td>{{ $perusahaan->kode_perusahaan }}</td>
                                <td>{{ $perusahaan->alamat }}</td>
                                <td>{{ $perusahaan->nomor_telepon }}</td>
                                <td>{{ $perusahaan->email }}</td>
                                <td>
                                    <a href="{{ route('perusahaan.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('perusahaan.destroy', $item->id) }}" method="POST" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>