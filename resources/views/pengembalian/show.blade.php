@extends('layouts.main')

@section('title', 'Detail Pengembalian | E-perpustakaan')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Detail /</span> Pengembalian</h4>

    <div class="row">
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Informasi Riwayat Pengembalian</h5>
                    <small class="text-muted">ID Transaksi: #{{ $pengembalian->id }}</small>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Nama Peminjam</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control-plaintext fw-bold" value="{{ $pengembalian->anggota->nama_anggota }}" readonly />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Nama Petugas</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control-plaintext" value="{{ $pengembalian->petugas->nama_petugas }}" readonly />
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Judul Buku</label>
                        <div class="col-sm-10">
                            <div class="form-control-plaintext">
                                <i class="bx bx-book me-1 text-primary"></i> {{ $pengembalian->buku->judul_buku }} 
                                <span class="text-muted">({{ $pengembalian->buku->kode_buku }})</span>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Jumlah Kembali</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control-plaintext" value="{{ $pengembalian->jumlah_kembali_buku }} Unit" readonly />
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Tanggal Pinjam</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control-plaintext" value="{{ $pengembalian->peminjaman->tgl_pinjam }}" readonly />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Batas Kembali</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control-plaintext" value="{{ $pengembalian->peminjaman->tgl_harus_kembali }}" readonly />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Dikembalikan Pada</label>
                        <div class="col-sm-10">
                            <span class="badge bg-label-primary fs-6">
                                <i class="bx bx-calendar-check me-1"></i> {{ $pengembalian->tgl_kembali }}
                            </span>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-10">
                            <span class="badge bg-success">
                                {{ strtoupper($pengembalian->status) }}
                            </span>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label">Denda</label>
                        <div class="col-sm-10">
                            @if($pengembalian->denda > 0)
                                <span class="text-danger fw-bold fs-5">Rp {{ number_format($pengembalian->denda, 0, ',', '.') }}</span>
                            @else
                                <span class="text-success fw-bold">Tidak ada denda</span>
                            @endif
                        </div>
                    </div>

                    <div class="row justify-content-end mt-4">
                        <div class="col-sm-10 text-end">
                            <a href="{{ route('pengembalian.index') }}" class="btn btn-outline-secondary">
                                <i class="bx bx-arrow-back me-1"></i> Kembali ke Laporan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection