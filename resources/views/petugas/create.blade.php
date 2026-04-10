@extends('layouts.main')

@section('title', 'Tambah Data Petugas | E-perpustakaan')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Tambah /</span> Petugas
    </h4>

    <div class="row">
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Form Tambah Petugas</h5>
                    <small class="text-muted float-end">Input data dengan benar</small>
                </div>
                <div class="card-body">
                    <form action="{{ route('petugas.store') }}" method="POST">
                        @csrf
                        
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Nama Petugas</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-user"></i></span>
                                    <input type="text" class="form-control" name="nama_petugas" placeholder="Masukkan nama lengkap" value="{{ old('nama_petugas') }}" required />
                                </div>
                                @error('nama_petugas') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-map"></i></span>
                                    <textarea class="form-control" name="alamat_petugas" placeholder="Alamat lengkap petugas" rows="3" required>{{ old('alamat_petugas') }}</textarea>
                                </div>
                                @error('alamat_petugas') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">No. Telepon</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-phone"></i></span>
                                    <input type="text" class="form-control" name="telpon_petugas" placeholder="08xxxxxxxxxx" value="{{ old('telpon_petugas') }}" required />
                                </div>
                                @error('telpon_petugas') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bx bx-save me-1"></i> Simpan Petugas
                                </button>
                                <a href="{{ route('petugas.index') }}" class="btn btn-outline-secondary ms-2">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection