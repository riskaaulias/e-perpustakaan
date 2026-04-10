@extends('layouts.app')

@section('title', 'Dashboard - E-Perpustakaan')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    
    {{-- Card Welcome (Bentuk & Gambar Tetap) --}}
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Halo, {{ auth()->user()->name }}! 🎉</h5>
                            <p class="mb-4">
                                Kamu punya <span class="fw-bold">{{ $peminjaman->where('status', 'disetujui')->count() }} buku</span> yang harus dikembalikan tepat waktu. Jangan lupa baca ya!
                            </p>
                            <a href="{{ route('user.riwayat') }}" class="btn btn-sm btn-outline-primary">Lihat Riwayat</a>
                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-start">
                        <div class="card-body pb-0 px-0 px-md-4">
                            {{-- Gambar tetap gemes-baca.png --}}
                            <img src="{{ asset('assets/img/illustrations/gemes-baca.png') }}" height="160" alt="View Badge User" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Baris Statistik (Bentuk Tetap) --}}
    <div class="row">
        <div class="col-lg-4 col-md-4 col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <span class="badge bg-label-info p-2"><i class="bx bx-history"></i></span>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Total Pinjam</span>
                    <h3 class="card-title mb-2">{{ $peminjaman->count() }}</h3>
                    <small class="text-primary fw-semibold">Semua peminjaman</small>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <span class="badge bg-label-success p-2"><i class="bx bx-book-open"></i></span>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Aktif Pinjam</span>
                    <h3 class="card-title mb-2">{{ $peminjaman->where('status', 'disetujui')->count() }}</h3>
                    <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> Sedang dibawa</small>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <span class="badge bg-label-danger p-2"><i class="bx bx-error-circle"></i></span>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Ditolak</span>
                    <h3 class="card-title mb-2">{{ $peminjaman->where('status', 'ditolak')->count() }}</h3>
                    <small class="text-danger fw-semibold">Tidak disetujui oleh admin</small>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabel Aktivitas (Bentuk Tetap) --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <h5 class="card-header">Peminjaman Terbaru</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Buku</th>
                                <th>Tgl Pinjam</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse ($peminjaman->take(5) as $data)
                            <tr>
                                <td><strong>{{ $data->buku?->judul_buku ?? 'Buku Tidak Diketahui' }}</strong></td>
                                <td>{{ $data->tgl_pinjam }}</td>
                                <td>
                                    @if($data->status == 'disetujui')
                                        <span class="badge bg-label-success">Dipinjam</span>
                                    @elseif($data->status == 'ditolak')
                                        <span class="badge bg-label-danger">Ditolak</span>
                                    @elseif($data->status == 'kembali')
                                        <span class="badge bg-label-primary">Selesai</span>
                                    @else
                                        <span class="badge bg-label-warning">Proses</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center py-3">Belum ada aktivitas pinjam.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection