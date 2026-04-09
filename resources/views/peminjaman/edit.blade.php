@extends('layouts.main')

@section('title', 'Edit Peminjaman | E-perpustakaan')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Transaksi /</span> Edit Peminjaman</h4>

    <div class="row">
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Form Perubahan Data Peminjaman</h5>
                    <small class="text-muted">ID: #{{ $peminjaman->id }}</small>
                </div>
                <div class="card-body">
                    <form action="{{ route('peminjaman.update', $peminjaman->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Nama Anggota</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-user-circle"></i></span>
                                    <select class="form-select" name="id_anggota">
                                        @foreach($anggota as $data)
                                            <option value="{{ $data->id }}" {{ $data->id == $peminjaman->id_anggota ? 'selected' : '' }}>
                                                {{ $data->nama_anggota }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Petugas</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-user"></i></span>
                                    <select class="form-select" name="id_petugas">
                                        @foreach($petugas as $data)
                                            <option value="{{ $data->id }}" {{ $data->id == $peminjaman->id_petugas ? 'selected' : '' }}>
                                                {{ $data->nama_petugas }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Tanggal Pinjam</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                                    <input type="date" class="form-control" name="tgl_pinjam" value="{{ $peminjaman->tgl_pinjam }}" />
                                </div>
                                @error('tgl_pinjam') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Batas Kembali</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-calendar-event"></i></span>
                                    <input type="date" class="form-control" name="tgl_harus_kembali" value="{{ $peminjaman->tgl_harus_kembali }}" />
                                </div>
                                @error('tgl_harus_kembali') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Total Pinjam</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-collection"></i></span>
                                    <input type="number" class="form-control" name="total_pinjam" value="{{ $peminjaman->total_pinjam }}" />
                                </div>
                                @error('total_pinjam') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <a href="{{ route('peminjaman.index') }}" class="btn btn-outline-secondary me-2">Batal</a>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection