<!DOCTYPE html>
<html>
<head>
    <title>Edit Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h3>Edit Karyawan</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('karyawan.update', $karyawan->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label>Nama Karyawan</label>
                        <input type="text" name="nama_karyawan" class="form-control @error('nama_karyawan') is-invalid @enderror" 
                               value="{{ old('nama_karyawan', $karyawan->nama_karyawan) }}" required>
                        @error('nama_karyawan')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label>Nomor Karyawan</label>
                        <input type="text" name="nomor_karyawan" class="form-control @error('nomor_karyawan') is-invalid @enderror" 
                               value="{{ old('nomor_karyawan', $karyawan->nomor_karyawan) }}" required>
                        @error('nomor_karyawan')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label>Jabatan</label>
                        <input type="text" name="jabatan" class="form-control @error('jabatan') is-invalid @enderror" 
                               value="{{ old('jabatan', $karyawan->jabatan) }}" required>
                        @error('jabatan')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label>Tanggal Bergabung</label>
                        <input type="date" name="tanggal_bergabung" class="form-control @error('tanggal_bergabung') is-invalid @enderror" 
                               value="{{ old('tanggal_bergabung', $karyawan->tanggal_bergabung) }}" required>
                        @error('tanggal_bergabung')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <a href="{{ route('karyawan.index') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>