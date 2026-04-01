@extends('layouts.main')

@section('title', 'Detail Buku | E-perpustakaan')

@section('content')
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Detail /</span> Buku</h4>

    <div class="row">
      <div class="col-xxl">
        <div class="card mb-4">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Informasi Lengkap Buku</h5>
          </div>
          <div class="card-body">
            <div class="row mb-4">
              <label class="col-sm-2 col-form-label">Sampul Buku</label>
              <div class="col-sm-10">
                @if($buku->image)
                  <img
                    src="{{ $buku->image_url }}"
                    alt="Cover {{ $buku->judul_buku }}"
                    class="img-fluid rounded shadow"
                    style="max-width: 200px; border: 3px solid #f5f5f9;"
                  >
                @else
                  <div
                    class="d-flex align-items-center justify-content-center rounded bg-lighter"
                    style="width: 200px; height: 280px; border: 2px dashed #d9dee3;"
                  >
                    <div class="text-center">
                      <i class="bx bx-image-alt fs-1 text-muted"></i>
                      <p class="text-muted mb-0">Tidak ada foto</p>
                    </div>
                  </div>
                @endif
              </div>
            </div>

            <hr class="my-4">

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Kode Buku</label>
              <div class="col-sm-10">
                <input type="text" class="form-control-plaintext fw-bold" value="{{ $buku->kode_buku }}" readonly />
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Judul Buku</label>
              <div class="col-sm-10">
                <input type="text" class="form-control-plaintext" value="{{ $buku->judul_buku }}" readonly />
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Pengarang</label>
              <div class="col-sm-10">
                <input type="text" class="form-control-plaintext" value="{{ $buku->pengarang }}" readonly />
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Penerbit</label>
              <div class="col-sm-10">
                <input type="text" class="form-control-plaintext" value="{{ $buku->penerbit }}" readonly />
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Tahun</label>
              <div class="col-sm-10">
                <span class="badge bg-label-secondary">{{ $buku->tahun }}</span>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Stok</label>
              <div class="col-sm-10">
                <input type="text" class="form-control-plaintext" value="{{ $buku->stok }} unit" readonly />
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Kategori</label>
              <div class="col-sm-10">
                <input type="text" class="form-control-plaintext" value="{{ $buku->kategori }}" readonly />
              </div>
            </div>

            <div class="row mb-4">
              <label class="col-sm-2 col-form-label">Lokasi Rak</label>
              <div class="col-sm-10">
                <span class="badge bg-label-primary"><i class="bx bx-map-pin me-1"></i>{{ $buku->lokasi_rak }}</span>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Deskripsi</label>
              <div class="col-sm-10">
                <div class="form-control-plaintext" style="text-align: justify;">
                  {{ $buku->deskripsi ?? 'Tidak ada deskripsi.' }}
                </div>
              </div>
            </div>

            <div class="row justify-content-end">
              <div class="col-sm-10">
                <a href="{{ route('buku.index') }}" class="btn btn-outline-secondary">
                  <i class="bx bx-arrow-back me-1"></i> Kembali
                </a>
                <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-primary">
                  <i class="bx bx-edit-alt me-1"></i> Edit Buku
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection