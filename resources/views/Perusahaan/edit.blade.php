<!DOCTYPE html>
<html>
<head>
    <title>Edit Perusahaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h3>Edit Perusahaan</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('perusahaan.update', $perusahaan->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label>Nama Perusahaan</label>
                        <input type="text" name="nama_perusahaan" class="form-control" 
                               value="{{ $perusahaan->nama_perusahaan }}" required>
                    </div>

                    <div class="mb-3">
                        <label>Kode Perusahaan</label>
                        <input type="text" name="kode_perusahaan" class="form-control" 
                               value="{{ $perusahaan->kode_perusahaan }}" required>
                    </div>

                    <div class="mb-3">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" required>{{ $perusahaan->alamat }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label>Nomor Telepon</label>
                        <input type="text" name="nomor_telepon" class="form-control" 
                               value="{{ $perusahaan->nomor_telepon }}" required>
                    </div>

                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" 
                               value="{{ $perusahaan->email }}" required>
                    </div>

                    <div>
                        <a href="{{ route('perusahaan.index') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>