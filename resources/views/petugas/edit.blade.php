@extends('layouts.main')

@section('title', 'Edit Data Petugas | E-perpustakaan')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Edit /</span> Petugas
    </h4>

    <div class="row">
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Edit Data Petugas</h5>
                    <small class="text-muted float-end">Perbarui informasi petugas</small>
                </div>
                <div class="card-body">
                    <form action="{{ route('petugas.update', $petugas->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Nama Petugas</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-user"></i></span>
                                    <input type="text" class="form-control" name="nama_petugas" value="{{ old('nama_petugas', $petugas->nama_petugas) }}" required />
                                </div>
                                @error('nama_petugas') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="alamat_petugas" rows="3" required>{{ old('alamat_petugas', $petugas->alamat_petugas) }}</textarea>
                                @error('alamat_petugas') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">No. Telepon</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-phone"></i></span>
                                    <input type="text" class="form-control" name="telpon_petugas" value="{{ old('telpon_petugas', $petugas->telpon_petugas) }}" required />
                                </div>
                                @error('telpon_petugas') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bx bx-save me-1"></i> Simpan Perubahan
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