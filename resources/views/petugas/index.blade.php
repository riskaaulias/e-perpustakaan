@extends('layouts.main')

@section('title', 'Tabel Petugas | E-perpustakaan')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tabel /</span> Petugas</h4>
    
    @if (session('message'))
    <div class="alert alert-{{ session('type') }} alert-dismissible fade show" role="alert">
        @if(session('type') == 'success')
            <i class="bx bx-check-circle me-1"></i>
        @elseif(session('type') == 'warning')
            <i class="bx bx-edit-alt me-1"></i>
        @else
            <i class="bx bx-trash me-1"></i>
        @endif
        
        {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="text-end">
        <a href="{{ route('petugas.create') }}" class="btn btn-primary mb-4">
            <i class="bx bx-folder-plus" style="position: relative; bottom: 2px;"></i> Tambah data
        </a>
    </div>

    <div class="card">
        <h5 class="card-header">Tabel Petugas</h5>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama Petugas</th>
                        <th>Alamat Petugas</th>
                        <th>Telpon Petugas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($petugas as $data)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->nama_petugas }}</td>
                        <td>{{ $data->alamat_petugas }}</td>
                        <td>{{ $data->telpon_petugas }}</td>
                        <td>
                            <div class="d-flex justify-content-center align-items-center gap-1">
                                <a href="{{ route('petugas.show', $data->id) }}" class="btn btn-sm btn-info">
                                    <i class="bx bx-show-alt"></i>
                                </a>

                                <a href="{{ route('petugas.edit', $data->id) }}" class="btn btn-sm btn-warning">
                                    <i class="bx bx-edit-alt"></i>
                                </a>

                                <form action="{{ route('petugas.destroy', $data->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin mau hapus data ini?')">
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
    </div>
</div>
@endsection