@extends('layouts.main')

@section('title', 'Detail Data Petugas | E-perpustakaan')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Detail /</span> Petugas
    </h4>

    <div class="row">
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Informasi Lengkap Petugas</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Nama Petugas</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <input type="text" class="form-control" value="{{ $petugas->nama_petugas }}" disabled />
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Alamat Petugas</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="5" disabled>{{ $petugas->alamat_petugas }}</textarea>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label">Telpon Petugas</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <input type="text" class="form-control" value="{{ $petugas->telpon_petugas }}" disabled />
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <a href="{{ route('petugas.index') }}" class="btn btn-secondary">
                                <i class="bx bx-arrow-back me-1"></i> Kembali
                            </a>
                            <a href="{{ route('petugas.edit', $petugas->id) }}" class="btn btn-primary">
                                <i class="bx bx-edit-alt me-1"></i> Edit Data
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection