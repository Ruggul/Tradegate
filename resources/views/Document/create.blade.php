<!DOCTYPE html>
<html>
<head>
    <title>Tambah Dokumen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h3>Tambah Dokumen</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('dokumen.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label>Nama Perusahaan</label>
                        <input type="text" name="nama_perusahaan" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Nama Dokumen</label>
                        <input type="text" name="nama_dokumen" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Jenis Dokumen</label>
                        <input type="text" name="jenis_dokumen" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Tanggal Terbit</label>
                        <input type="date" name="tanggal_terbit" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Status</label>
                        <select name="status_aktif" class="form-control">
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                    </div>

                    <div>
                        <a href="{{ route('dokumen.index') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>