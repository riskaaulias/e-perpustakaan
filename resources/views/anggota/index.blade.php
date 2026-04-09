@extends('layouts.main')

@section('title', 'Data Anggota | E-perpustakaan')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">
            <span class="text-muted fw-light">Manajemen /</span> Daftar Anggota
        </h4>
    </div>

    @if (session('message'))
    <div class="alert alert-{{ session('type') }} alert-dismissible fade show" role="alert">
        {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card">
        <div class="card-header border-bottom">
            <h5 class="card-title mb-0">List Anggota Terdaftar</h5>
        </div>
        
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr class="text-center">
                        <th style="width: 50px;">No</th>
                        <th class="text-start">Anggota</th>
                        <th>NIM / ID</th>
                        <th>No. Telpon</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($anggota as $data)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>
                            <div class="d-flex justify-content-start align-items-center">
                                <div class="avatar-wrapper me-3">
                                    <div class="avatar avatar-sm">
                                        <span class="avatar-initial rounded-circle bg-label-primary">
                                            {{ strtoupper(substr($data->nama_anggota, 0, 1)) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <span class="fw-bold text-dark">{{ $data->nama_anggota }}</span>
                                    <small class="text-muted">{{ $data->alamat }}</small>
                                </div>
                            </div>
                        </td>
                        <td class="text-center"><code>{{ $data->NIM }}</code></td>
                        <td class="text-center">{{ $data->telpon }}</td>
                        <td class="text-center">
                            @if($data->status == 'aktif')
                                <span class="badge bg-label-success">Aktif</span>
                            @else
                                <span class="badge bg-label-danger">Non-Aktif</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('anggota.show', $data->id) }}" class="btn btn-sm btn-icon btn-info" title="Lihat Profil">
                                    <i class="bx bx-show-alt"></i>
                                </a>

                                <a href="{{ route('anggota.edit', $data->id) }}" class="btn btn-sm btn-icon btn-warning" title="Edit Data">
                                    <i class="bx bx-edit-alt"></i>
                                </a>

                                <form action="{{ route('anggota.destroy', $data->id) }}" method="POST" onsubmit="return confirm('Hapus anggota ini? Tindakan ini tidak bisa dibatalkan.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-icon btn-danger" title="Hapus Anggota">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="card-footer">
            <small class="text-muted">Total Anggota: {{ count($anggota) }} orang</small>
        </div>
    </div>
</div>
@endsection