@extends('layouts.main')

@section('title', 'Peminjaman | E-perpustakaan')

@section('content')
  <div class="container-xxl flex-grow-1 container-p-y">
    @if (session('message'))
      <div class="alert alert-{{ session('type') }} alert-dismissible fade show" role="alert">
        @if (session('type') == 'success')
          <i class="bx bx-check-circle me-1"></i>
        @elseif(session('type') == 'warning')
          <i class="bx bx-edit-alt me-1"></i>
        @else
          <i class="bx bx-trash me-1"></i>
        @endif

        {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
      <div>
        <h4 class="fw-bold mb-1"><span class="text-muted fw-light">Tabel /</span> Peminjaman</h4>
        <p class="mb-0 text-muted">Daftar Transaksi Peminjaman Buku.</p>
      </div>
     
    </div>

    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Tabel Peminjaman</h5>
        <small class="text-muted">{{ $peminjaman->count() }} data</small>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-hover mb-0">
            <thead>
              <tr class="text-center">
                <th style="width: 50px;">No</th>
                <th>Informasi Peminjam</th>
                <th>Status / Petugas</th>
                <th>Tanggal Pinjam</th>
                <th>Batas Kembali</th>
                <th>Jumlah Pinjam</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              @forelse ($peminjaman as $index => $data)
                <tr class="text-center">
                  <td class="text-center">{{ $index + 1 }}</td>
                  <td>
                    <div class="fw-semibold">{{ $data->anggota?->nama_anggota }}</div>
                    <small class="text-muted"><i class="bx bx-book-open me-1"></i>{{ $data->buku?->judul_buku }}</small>
                  </td>
                  <td class="text-center">
                    @if($data->id_petugas)
                      <span class="badge {{ $data->status == 'ditolak' ? 'bg-label-danger' : 'bg-label-success' }}">
                        {{ $data->petugas?->nama_petugas }}
                      </span>
                    @else
                      <span class="badge bg-label-warning text-uppercase" style="font-size: 0.7rem;">Menunggu</span>
                    @endif
                  </td>
                  <td class="text-center">{{ $data->tgl_pinjam }}</td>
                  <td class="text-center text-danger fw-semibold">{{ $data->tgl_harus_kembali }}</td>
                  <td class="text-center">{{ $data->total_pinjam }}</td>
                  <td>
                    <div class="d-flex justify-content-center align-items-center gap-1">
                      @if(!$data->id_petugas)
                        <form action="{{ route('peminjaman.setujui', $data->id) }}" method="POST" class="d-inline">
                          @csrf
                          <button type="submit" class="btn btn-sm btn-success" title="Setujui"><i class="bx bx-check"></i></button>
                        </form>
                        <form action="{{ route('peminjaman.tolak', $data->id) }}" method="POST" class="d-inline">
                          @csrf
                          <button type="submit" class="btn btn-sm btn-danger" title="Tolak" onclick="return confirm('Tolak?')"><i class="bx bx-x"></i></button>
                        </form>
                      @endif

                      <a href="{{ route('peminjaman.show', $data->id) }}" class="btn btn-sm btn-info" title="Detail">
                        <i class="bx bx-show-alt"></i>
                      </a>
                      <a href="{{ route('peminjaman.edit', $data->id) }}" class="btn btn-sm btn-warning" title="Edit">
                        <i class="bx bx-edit-alt"></i>
                      </a>
                      <form action="{{ route('peminjaman.destroy', $data->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus" onclick="return confirm('Yakin mau hapus?')">
                          <i class="bx bx-trash"></i>
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="7" class="text-center py-4">Belum ada data peminjaman.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection