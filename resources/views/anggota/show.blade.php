@extends('layouts.main')

@section('title', 'Detail Anggota | E-perpustakaan')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Detail /</span> Anggota
    </h4>

    <div class="row">
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Informasi Lengkap Anggota</h5>
                    <small class="text-muted">ID: #{{ $anggota->id }}</small>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label fw-bold">Nama Anggota</label>
                        <div class="col-sm-10">
                            <div class="form-control-plaintext border-bottom">{{ $anggota->nama_anggota }}</div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label fw-bold">Alamat</label>
                        <div class="col-sm-10">
                            <div class="form-control-plaintext border-bottom text-wrap">{{ $anggota->alamat }}</div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label fw-bold">Telpon</label>
                        <div class="col-sm-10">
                            <div class="form-control-plaintext border-bottom">{{ $anggota->telpon }}</div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label fw-bold">NIM</label>
                        <div class="col-sm-10">
                            <div class="form-control-plaintext border-bottom"><code>{{ $anggota->NIM }}</code></div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label fw-bold">Status</label>
                        <div class="col-sm-10">
                            <span class="badge {{ $anggota->status == 'aktif' ? 'bg-label-success' : 'bg-label-danger' }}">
                                {{ $anggota->status }}
                            </span>
                        </div>
                    </div>

                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <a href="{{ route('anggota.index') }}" class="btn btn-outline-secondary me-2">
                                <i class="bx bx-arrow-back me-1"></i> Kembali
                            </a>
                            <a href="{{ route('anggota.edit', $anggota->id) }}" class="btn btn-primary">
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