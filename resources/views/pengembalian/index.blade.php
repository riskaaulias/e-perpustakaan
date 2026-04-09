@extends('layouts.main')

@section('title', 'Laporan Pengembalian | E-perpustakaan')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
        <div>
            <h4 class="fw-bold mb-1"><span class="text-muted fw-light">Admin /</span> Laporan Pengembalian</h4>
            <p class="mb-0 text-muted">Riwayat buku masuk dan catatan denda anggota.</p>
        </div>
    </div>

    @if(session('message'))
    <div class="alert alert-{{ session('type') ?? 'success' }} alert-dismissible fade show" role="alert">
        <i class="bx {{ session('type') == 'danger' ? 'bx-trash' : 'bx-check-circle' }} me-1"></i>
        {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Riwayat Pengembalian</h5>
            <span class="badge bg-label-secondary">{{ $pengembalian->count() }} Data Terdaftar</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr class="text-center">
                            <th style="width: 50px;">No</th>
                            <th class="text-start">Informasi Peminjam</th>
                            <th class="text-start">Judul Buku</th>
                            <th>Tgl Kembali</th>
                            <th>Denda</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($pengembalian as $index => $data)
                        <tr class="align-middle text-center">
                            <td>{{ $index + 1 }}</td>
                            <td class="text-start">
                                <div class="d-flex flex-column">
                                    <span class="fw-bold text-dark">{{ $data->anggota?->nama_anggota ?? 'Guest' }}</span>
                                    <small class="text-muted">ID: {{ $data->id_anggota }}</small>
                                </div>
                            </td>
                            <td class="text-start">
                                <span class="text-wrap-cell">{{ $data->buku?->judul_buku }}</span>
                            </td>
                            <td>{{ $data->tgl_kembali }}</td>
                            <td>
                                @if($data->denda > 0)
                                    <span class="badge bg-label-danger fw-bold">Rp {{ number_format($data->denda, 0, ',', '.') }}</span>
                                @else
                                    <span class="badge bg-label-success">Tidak Ada</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-success">SELESAI</span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('pengembalian.show', $data->id) }}" class="btn btn-sm btn-icon btn-info" title="Detail">
                                        <i class="bx bx-show-alt"></i>
                                    </a>

                                    <form action="{{ route('pengembalian.destroy', $data->id) }}" method="POST" onsubmit="return confirm('Hapus riwayat ini secara permanen?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-icon btn-danger" title="Hapus Riwayat">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="bx bx-info-circle fs-2 d-block mb-2"></i>
                                Belum ada riwayat pengembalian buku.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection