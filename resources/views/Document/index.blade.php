<!DOCTYPE html>
<html>
<head>
    <title>Daftar Dokumen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h3>Daftar Dokumen</h3>
                <a href="{{ route('dokumen.create') }}" class="btn btn-primary">Tambah Dokumen</a>
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
                            <th>Perusahaan</th>
                            <th>Nama Dokumen</th>
                            <th>Jenis</th>
                            <th>Tanggal Terbit</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dokumen as $dokumen)
                            <tr>
                                <td>{{ $dokumen->perusahaan->nama_perusahaan }}</td>
                                <td>{{ $dokumen->nama_dokumen }}</td>
                                <td>{{ $dokumen->jenis_dokumen }}</td>
                                <td>{{ $dokumen->tanggal_terbit }}</td>
                                <td>
                                    <a href="{{ route('dokumen.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('dokumen.destroy', $item->id) }}" method="POST" style="display:inline">
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