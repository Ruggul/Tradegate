<!DOCTYPE html>
<html>
<head>
    <title>Daftar Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h3>Daftar Karyawan</h3>
                <a href="{{ route('karyawan.create') }}" class="btn btn-primary">Tambah Karyawan</a>
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
                            <th>Nama</th>
                            <th>Nomor Karyawan</th>
                            <th>Jabatan</th>
                            <th>Tanggal Bergabung</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($karyawan as $index => $item)
                            <tr>
                                <td>{{ $karyawan->nama_karyawan }}</td>
                                <td>{{ $karyawan->nomor_karyawan }}</td>
                                <td>{{ $karyawan->jabatan }}</td>
                                <td>{{ $karyawan->tanggal_bergabung }}</td>
                                <td>
                                    <a href="{{ route('karyawan.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('karyawan.destroy', $item->id) }}" method="POST" style="display:inline">
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