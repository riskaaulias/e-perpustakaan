@extends('layouts.app')

@section('title', 'Riwayat Peminjaman - E-Perpustakaan')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">User /</span> Riwayat Peminjaman</h4>

    @if(session('message'))
    <div class="alert alert-{{ session('type') ?? 'success' }} alert-dismissible fade show" role="alert">
        <i class="bx {{ session('type') == 'danger' ? 'bx-error-circle' : 'bx-check-circle' }} me-2"></i>
        {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card shadow-sm">
        <h5 class="card-header">Daftar Buku yang Anda Pinjam</h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th width="50">No</th>
                        <th>Judul Buku</th>
                        <th>Tgl Pinjam</th>
                        <th>Batas Kembali</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($riwayat as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <i class="bx bx-book me-2 text-primary"></i>
                                <span class="fw-semibold">{{ $data->buku?->judul_buku ?? 'Buku Tidak Diketahui' }}</span>
                            </div>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($data->tgl_pinjam)->format('d M Y') }}</td>
                        <td>
                            @if($data->status == 'disetujui' && \Carbon\Carbon::now()->gt($data->tgl_harus_kembali))
                                <span class="text-danger fw-bold" title="Terlambat!">
                                    {{ \Carbon\Carbon::parse($data->tgl_harus_kembali)->format('d M Y') }}
                                    <i class="bx bx-error ms-1"></i>
                                </span>
                            @else
                                <span class="fw-bold">{{ \Carbon\Carbon::parse($data->tgl_harus_kembali)->format('d M Y') }}</span>
                            @endif
                        </td>
                        <td>
                            @php
                                $status_classes = [
                                    'menunggu' => 'bg-label-warning',
                                    'disetujui' => 'bg-label-success',
                                    'ditolak' => 'bg-label-danger',
                                    'kembali' => 'bg-label-primary'
                                ];
                                $label = [
                                    'menunggu' => 'Menunggu Validasi',
                                    'disetujui' => 'Sedang Dipinjam',
                                    'ditolak' => 'Ditolak',
                                    'kembali' => 'Sudah Kembali'
                                ];
                            @endphp
                            <span class="badge {{ $status_classes[$data->status] ?? 'bg-label-secondary' }}">
                                {{ $label[$data->status] ?? $data->status }}
                            </span>
                        </td>
                        <td class="text-center">
                            @if($data->status == 'disetujui')
                                <form action="{{ route('pengembalian.store') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mengembalikan buku ini?')">
                                    @csrf
                                    <input type="hidden" name="peminjaman_id" value="{{ $data->id }}">
                                    <button type="submit" class="btn btn-sm btn-outline-primary">
                                        <i class="bx bx-undo me-1"></i> Kembalikan
                                    </button>
                                </form>
                            @elseif($data->status == 'kembali')
                                <span class="badge badge-center rounded-pill bg-label-secondary" title="Selesai">
                                    <i class="bx bx-check"></i>
                                </span>
                            @elseif($data->status == 'menunggu')
                                <small class="text-muted">Proses Verifikasi</small>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <img src="{{ asset('assets/img/illustrations/empty-box.png') }}" alt="No Data" width="120" class="mb-3 opacity-75">
                            <p class="text-muted">Belum ada riwayat peminjaman.</p>
                            <a href="{{ route('user.katalog') }}" class="btn btn-sm btn-primary">Cari Buku</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection