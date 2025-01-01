<!DOCTYPE html>
<html>
<head>
    <title>Edit Dokumen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h3>Edit Dokumen</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('dokumen.update', $dokumen->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label>Nama Perusahaan</label>
                        <input type="text" name="nama_perusahaan" class="form-control" 
                               value="{{ $dokumen->nama_perusahaan }}" required>
                    </div>

                    <div class="mb-3">
                        <label>Nama Dokumen</label>
                        <input type="text" name="nama_dokumen" class="form-control" 
                               value="{{ $dokumen->nama_dokumen }}" required>
                    </div>

                    <div class="mb-3">
                        <label>Jenis Dokumen</label>
                        <input type="text" name="jenis_dokumen" class="form-control" 
                               value="{{ $dokumen->jenis_dokumen }}" required>
                    </div>

                    <div class="mb-3">
                        <label>Tanggal Terbit</label>
                        <input type="date" name="tanggal_terbit" class="form-control" 
                               value="{{ $dokumen->tanggal_terbit->format('Y-m-d') }}" required>
                    </div>

                    <div class="mb-3">
                        <label>Status</label>
                        <select name="status_aktif" class="form-control">
                            <option value="1" {{ $dokumen->status_aktif ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ !$dokumen->status_aktif ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                    </div>

                    <div>
                        <a href="{{ route('dokumen.index') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>