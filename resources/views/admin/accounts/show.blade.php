@extends('admin.layouts.app')

@section('title', 'Detail Admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Detail Admin</div>

                <div class="card-body">
                    <div class="text-center mb-4">
                        <img src="{{ $admin->profile_picture_url }}" alt="Profile Picture" 
                             class="img-thumbnail rounded-circle" width="150">
                    </div>

                    <table class="table">
                        <tr>
                            <th width="200">Nama</th>
                            <td>{{ $admin->name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $admin->email }}</td>
                        </tr>
                        <tr>
                            <th>Username</th>
                            <td>{{ $admin->username }}</td>
                        </tr>
                        <tr>
                            <th>No. Telepon</th>
                            <td>{{ $admin->phone_number ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>{{ $admin->address ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <td>
                                <span class="badge bg-{{ $admin->role === 'super_admin' ? 'danger' : 'primary' }}">
                                    {{ $admin->role }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge bg-{{ $admin->is_active ? 'success' : 'warning' }}">
                                    {{ $admin->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Tanggal Dibuat</th>
                            <td>{{ $admin->created_at->format('d F Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Terakhir Diupdate</th>
                            <td>{{ $admin->updated_at->format('d F Y H:i') }}</td>
                        </tr>
                    </table>

                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.accounts.edit', $admin) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ route('admin.accounts.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 