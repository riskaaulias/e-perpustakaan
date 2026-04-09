@extends('layouts.main')

@section('title', 'Detail Peminjaman | E-perpustakaan')

@section('content')
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Detail /</span> Peminjaman</h4>

    <div class="row">
      <div class="col-xxl">
        <div class="card mb-4">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Informasi Lengkap Transaksi</h5>
            <small class="text-muted">ID Pinjam: #{{ $peminjaman->id }}</small>
          </div>
          <div class="card-body">
            
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Nama Peminjam</label>
              <div class="col-sm-10">
                <input type="text" class="form-control-plaintext fw-bold" value="{{ $peminjaman->anggota->nama_anggota }}" readonly />
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Buku yang Dipinjam</label>
              <div class="col-sm-10">
                <div class="form-control-plaintext">
                  <i class="bx bx-book me-1 text-primary"></i> {{ $peminjaman->buku->judul_buku }}
                </div>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Petugas Verifikasi</label>
              <div class="col-sm-10">
                <input type="text" class="form-control-plaintext" value="{{ $peminjaman->petugas->nama_petugas ?? 'Belum diverifikasi' }}" readonly />
              </div>
            </div>

            <hr class="my-4">

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Tanggal Pinjam</label>
              <div class="col-sm-10">
                <span class="badge bg-label-info"><i class="bx bx-calendar me-1"></i>{{ $peminjaman->tgl_pinjam }}</span>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Batas Kembali</label>
              <div class="col-sm-10">
                <span class="badge bg-label-danger"><i class="bx bx-timer me-1"></i>{{ $peminjaman->tgl_harus_kembali }}</span>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Jumlah Buku</label>
              <div class="col-sm-10">
                <input type="text" class="form-control-plaintext" value="{{ $peminjaman->total_pinjam }} Unit" readonly />
              </div>
            </div>

            <div class="row mb-4">
              <label class="col-sm-2 col-form-label">Status Saat Ini</label>
              <div class="col-sm-10">
                @if($peminjaman->status == 'pinjam')
                  <span class="badge bg-warning">SEDANG DIPINJAM</span>
                @elseif($peminjaman->status == 'kembali')
                  <span class="badge bg-success">SUDAH DIKEMBALIKAN</span>
                @else
                  <span class="badge bg-secondary">{{ strtoupper($peminjaman->status) }}</span>
                @endif
              </div>
            </div>

            <div class="row justify-content-end mt-2">
              <div class="col-sm-10">
                <a href="{{ route('peminjaman.index') }}" class="btn btn-outline-secondary">
                  <i class="bx bx-arrow-back me-1"></i> Kembali
                </a>
                <a href="{{ route('peminjaman.edit', $peminjaman->id) }}" class="btn btn-primary">
                  <i class="bx bx-edit-alt me-1"></i> Edit Transaksi
                </a>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
@endsection