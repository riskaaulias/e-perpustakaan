@extends('layouts.app') 

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">User /</span> Katalog Buku</h4>

    @if(session('message'))
        <div class="alert alert-{{ session('type') }} alert-dismissible fade show mb-4" role="alert">
            <i class="bx {{ session('type') == 'success' ? 'bx-check-circle' : 'bx-error-circle' }} me-1"></i>
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        @forelse($buku as $item)
        <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="p-2" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#detailBuku{{ $item->id }}">
                    <img class="card-img-top rounded" 
                         src="{{ $item->image_url ?? asset('assets/img/illustrations/no-book.png') }}" 
                         alt="{{ $item->judul_buku }}" 
                         style="height: 280px; object-fit: cover;">
                </div>

                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-primary mb-1">{{ $item->judul_buku }}</h5>
                    <p class="text-muted small mb-3">Penulis: {{ $item->pengarang ?? 'Tidak ada nama' }}</p>
                   <div class="mb-3">
                        <span class="badge bg-label-info text-capitalize">
                            <i class="bx bx-bookmark me-1"></i> 
                            {{ $item->kategori }}
                        </span>
                    </div>
                    <div class="mt-auto">
                        @if($item->stok > 0)
                            <button type="button" class="btn btn-primary w-100 shadow-none" data-bs-toggle="modal" data-bs-target="#modalPinjam{{ $item->id }}">
                                <i class="bx bx-bookmark-plus me-1"></i> Ajukan Pinjam
                            </button>
                        @else
                            <button type="button" class="btn btn-secondary w-100" disabled>Stok Habis</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="detailBuku{{ $item->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Informasi Detail Buku</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-5 mb-3 mb-md-0">
                                <img src="{{ $item->image_url ?? asset('assets/img/illustrations/no-book.png') }}" 
                                     class="img-fluid rounded shadow-sm" alt="Cover">
                            </div>
                            <div class="col-md-7">
                                <h4 class="text-primary mb-3">{{ $item->judul_buku }}</h4>
                                <table class="table table-sm table-borderless">
                                    <tr><td width="30%"><strong>Penulis</strong></td><td>: {{ $item->pengarang ?? '-' }}</td></tr>
                                    <tr><td><strong>Kategori</strong></td><td>: <span class="text-capitalize">{{ $item->kategori ?? '-' }}</span></td></tr>                                    
                                    <tr><td><strong>Penerbit</strong></td><td>: {{ $item->penerbit ?? '-' }}</td></tr>
                                    <tr><td><strong>Tahun Terbit</strong></td><td>: {{ $item->tahun ?? '-' }}</td></tr>
                                    <tr>
                                        <td><strong>Sisa Stok</strong></td>
                                        <td>: <span class="badge bg-label-{{ $item->stok > 0 ? 'success' : 'danger' }}">
                                            {{ $item->stok }} Buku tersedia
                                        </span></td>
                                    </tr>
                                </table>
                                <hr>
                                <h6 class="fw-bold">Sinopsis:</h6>
                                <p class="text-muted small" style="text-align: justify; line-height: 1.6;">
                                    {{ $item->deskripsi ?? 'Sinopsis atau deskripsi buku belum tersedia.' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalPinjam{{ $item->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="{{ route('user.pinjam.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="buku_id" value="{{ $item->id }}">
                        
                        <div class="modal-header">
                            <h5 class="modal-title">Lengkapi Data Peminjaman</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-primary d-flex" role="alert">
                                <span class="badge badge-center rounded-pill bg-primary me-3"><i class="bx bx-info-circle"></i></span>
                                <div class="d-flex flex-column ps-1">
                                    <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">{{ $item->judul_buku }}</h6>
                                    <span>Silakan isi jumlah buku yang ingin dipinjam.</span>
                                </div>
                            </div>

                            <div class="mb-3 mt-4">
                                <label class="form-label fw-bold">Berapa buku yang mau dipinjam?</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-layer"></i></span>
                                    <input type="number" 
                                           name="total_pinjam" 
                                           class="form-control" 
                                           value="1" 
                                           min="1" 
                                           max="{{ $item->stok }}" 
                                           required>
                                </div>
                                <small class="text-muted mt-2 d-block">Maksimal stok tersedia: <strong>{{ $item->stok }}</strong></small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Konfirmasi Pinjam</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @empty
        <div class="col-12 text-center py-5">
            <img src="{{ asset('assets/img/illustrations/empty-state.png') }}" style="width: 200px" class="mb-3">
            <h5 class="text-muted">Duh, rak bukunya masih kosong nih...</h5>
        </div>
        @endforelse
    </div>
</div>
@endsection
