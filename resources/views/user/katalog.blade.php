@extends('layouts.app') 

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">User /</span> Katalog Buku</h4>

    <div class="row">
        @forelse($buku as $item)
        <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="p-2" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#detailBuku{{ $item->id }}">
                    @if($item->image)
                        <img class="card-img-top rounded" src="{{ asset('storage/' . $item->image) }}" 
                             alt="{{ $item->judul_buku }}" 
                             style="height: 280px; object-fit: cover;">
                    @else
                        <img class="card-img-top rounded" src="{{ asset('assets/img/illustrations/no-book.png') }}" 
                             alt="No Image" style="height: 280px; object-fit: cover;">
                    @endif
                </div>

                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-primary mb-1">{{ $item->judul_buku }}</h5>
                    <p class="text-muted small mb-3">Penulis: {{ $item->pengarang ?? 'Tidak ada nama' }}</p>
                    
                    <div class="mt-auto">
                        <button type="button" class="btn btn-outline-info btn-sm w-100 mb-2" data-bs-toggle="modal" data-bs-target="#detailBuku{{ $item->id }}">
                            <i class="bx bx-info-circle me-1"></i> Lihat Detail
                        </button>

                        <form action="{{ route('user.pinjam.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id_buku" value="{{ $item->id }}">
                            
                            @if($item->stok > 0)
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bx bx-bookmark-plus me-1"></i> Ajukan Pinjam
                                </button>
                            @else
                                <button type="button" class="btn btn-secondary w-100" disabled>Kosong</button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="detailBuku{{ $item->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detail Buku</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-5">
                                <img src="{{ $item->image ? asset('storage/' . $item->image) : asset('assets/img/illustrations/no-book.png') }}" 
                                     class="img-fluid rounded" alt="Cover">
                            </div>
                            <div class="col-md-7">
                                <h4 class="text-primary">{{ $item->judul_buku }}</h4>
                                <table class="table table-sm table-borderless mt-2">
                                    <tr>
                                        <td><strong>Penulis</strong></td>
                                        <td>: {{ $item->pengarang }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Penerbit</strong></td>
                                        <td>: {{ $item->penerbit ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Tahun</strong></td>
                                        <td>: {{ $item->tahun ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Stok</strong></td>
                                        <td>: <span class="badge bg-label-success">{{ $item->stok }} tersedia</span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <h6>Sinopsis:</h6>
                        <p class="text-muted small" style="text-align: justify">
                            {{ $item->deskripsi ?? 'Deskripsi tidak tersedia untuk buku ini.' }}
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center">
            <h2 class="mb-2">Buku belum tersedia :(</h2>
        </div>
        @endforelse
    </div>
</div>
@endsection