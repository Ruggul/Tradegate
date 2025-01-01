@extends('admin.layouts.app')

@section('title', 'Manajemen Admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Manajemen Admin</h2>
        <a href="{{ route('admin.accounts.create') }}" class="btn btn-primary">
            Tambah Admin
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($admins as $admin)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $admin->name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>{{ $admin->username }}</td>
                            <td>
                                <span class="badge bg-{{ $admin->role === 'super_admin' ? 'danger' : 'primary' }}">
                                    {{ $admin->role }}
                                </span>
                            </td>
                            <td>
                                <form action="{{ route('admin.accounts.toggle-status', $admin) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-{{ $admin->is_active ? 'success' : 'warning' }}">
                                        {{ $admin->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </button>
                                </form>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.accounts.show', $admin) }}" class="btn btn-sm btn-info">
                                        Detail
                                    </a>
                                    <a href="{{ route('admin.accounts.edit', $admin) }}" class="btn btn-sm btn-warning">
                                        Edit
                                    </a>
                                    @if(!$admin->isSuperAdmin())
                                    <form action="{{ route('admin.accounts.destroy', $admin) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                    @endif
                                </div>
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
            
            {{ $admins->links() }}
        </div>
    </div>
</div>
@endsection 