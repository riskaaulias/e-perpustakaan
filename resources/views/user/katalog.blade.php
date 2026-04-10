@extends('layouts.app') 

@section('content')
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <form action="{{ route('user.katalog') }}" method="GET">
                <div class="row align-items-end">
                    <div class="col-md-9 mb-3 mb-md-0">
                        <label class="form-label fw-bold">Cari Koleksi Buku</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-search"></i></span>
                            <input type="text" name="search" class="form-control" 
                                   placeholder="Ketik judul buku, nama pengarang, atau kategori..." 
                                   value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bx bx-filter-alt me-1"></i> Cari
                            </button>
                            @if(request('search'))
                                <a href="{{ route('user.katalog') }}" class="btn btn-outline-secondary">
                                    <i class="bx bx-refresh"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

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
            <div class="card h-100 shadow-sm border-0 overflow-hidden">
                <div class="p-2 position-relative" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#detailBuku{{ $item->id }}">
                    <img class="card-img-top rounded" 
                         src="{{ $item->image_url ?? asset('assets/img/illustrations/no-book.png') }}" 
                         alt="{{ $item->judul_buku }}" 
                         style="height: 320px; object-fit: cover;">
                    @if($item->stok <= 0)
                        <div class="position-absolute top-50 start-50 translate-middle w-100 text-center bg-dark bg-opacity-75 py-2 text-white fw-bold">
                            STOK HABIS
                        </div>
                    @endif
                </div>

                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-primary mb-1 text-truncate" title="{{ $item->judul_buku }}">
                        {{ $item->judul_buku }}
                    </h5>
                    <p class="text-muted small mb-3">Oleh: {{ $item->pengarang ?? 'Anonim' }}</p>
                    
                    <div class="mb-3">
                        <span class="badge bg-label-info text-capitalize">
                            <i class="bx bx-bookmark me-1"></i> 
                            {{ $item->kategori ?? 'Umum' }}
                        </span>
                    </div>

                    <div class="mt-auto">
                        @if($item->stok > 0)
                            <button type="button" class="btn btn-primary w-100 shadow-none" data-bs-toggle="modal" data-bs-target="#modalPinjam{{ $item->id }}">
                                <i class="bx bx-bookmark-plus me-1"></i> Ajukan Pinjam
                            </button>
                        @else
                            <button type="button" class="btn btn-secondary w-100" disabled>Tidak Tersedia</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="detailBuku{{ $item->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content border-0 shadow-lg">
                    <div class="modal-header border-bottom">
                        <h5 class="modal-title">Informasi Detail Buku</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-5 mb-3 mb-md-0 text-center">
                                <img src="{{ $item->image_url ?? asset('assets/img/illustrations/no-book.png') }}" 
                                     class="img-fluid rounded shadow" alt="Cover" style="max-height: 400px;">
                            </div>
                            <div class="col-md-7">
                                <h4 class="text-primary mb-3">{{ $item->judul_buku }}</h4>
                                <table class="table table-sm table-borderless">
                                    <tr><td width="35%"><strong>Penulis</strong></td><td>: {{ $item->pengarang ?? '-' }}</td></tr>
                                    <tr><td><strong>Kategori</strong></td><td>: <span class="text-capitalize">{{ $item->kategori ?? '-' }}</span></td></tr>                                    
                                    <tr><td><strong>Penerbit</strong></td><td>: {{ $item->penerbit ?? '-' }}</td></tr>
                                    <tr><td><strong>Tahun Terbit</strong></td><td>: {{ $item->tahun ?? '-' }}</td></tr>
                                    <tr>
                                        <td><strong>Status Stok</strong></td>
                                        <td>: <span class="badge bg-label-{{ $item->stok > 0 ? 'success' : 'danger' }}">
                                            {{ $item->stok > 0 ? $item->stok . ' Buku tersedia' : 'Stok Habis' }}
                                        </span></td>
                                    </tr>
                                </table>
                                <hr class="my-3">
                                <h6 class="fw-bold"><i class="bx bx-align-left me-1"></i> Sinopsis:</h6>
                                <p class="text-muted" style="text-align: justify; line-height: 1.6; font-size: 0.9rem;">
                                    {{ $item->deskripsi ?? 'Sinopsis atau deskripsi buku belum tersedia untuk koleksi ini.' }}
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
                            <h5 class="modal-title">Konfirmasi Peminjaman</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-primary d-flex mb-0" role="alert">
                                <span class="badge badge-center rounded-pill bg-primary me-3"><i class="bx bx-info-circle"></i></span>
                                <div class="d-flex flex-column">
                                    <h6 class="alert-heading fw-bold mb-1">{{ $item->judul_buku }}</h6>
                                    <span>Batas waktu peminjaman standar adalah 7 hari.</span>
                                </div>
                            </div>

                            <div class="mb-3 mt-4">
                                <label class="form-label fw-bold">Jumlah Buku</label>
                                <div class="input-group input-group-merge border rounded">
                                    <span class="input-group-text border-0"><i class="bx bx-layer"></i></span>
                                    <input type="number" name="total_pinjam" class="form-control border-0 px-2" 
                                           value="1" min="1" max="{{ $item->stok }}" required>
                                </div>
                                <small class="text-muted mt-2 d-block">Tersedia: <strong>{{ $item->stok }} eksemplar</strong></small>
                            </div>
                        </div>
                        <div class="modal-footer border-top">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary px-4">Konfirmasi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @empty
        <div class="col-12 text-center py-5">
            <div class="misc-wrapper">
                <h2 class="mb-2 mx-2">Buku tidak ditemukan :(</h2>
                <p class="mb-4 mx-2">Maaf, kami tidak bisa menemukan buku dengan kata kunci "{{ request('search') }}"</p>
                <a href="{{ route('user.katalog') }}" class="btn btn-primary">Lihat Semua Buku</a>
                <div class="mt-3">
                    <img src="{{ asset('assets/img/illustrations/page-misc-error-light.png') }}" 
                         alt="page-misc-error-light" width="350" class="img-fluid">
                </div>
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection