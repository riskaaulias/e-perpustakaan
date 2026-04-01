@extends('layouts.main')

@section('title', 'Buku | E-perpustakaan')

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
        <h4 class="fw-bold mb-1"><span class="text-muted fw-light">Tabel /</span> Buku</h4>
        <p class="mb-0 text-muted">Daftar Buku.</p>
      </div>
      <a href="{{ route('buku.create') }}" class="btn btn-primary">
        <i class="bx bx-folder-plus me-1"></i> Tambah data
      </a>
    </div>


    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Tabel Buku</h5>
        <small class="text-muted">{{ $buku->count() }} data</small>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-hover mb-0 buku-table">
            <thead>
              <tr class="text-center">
                <th class="col-no">No</th>
                <th>Judul Buku</th>
                <th>Pengarang</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Rak</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              @forelse ($buku as $index => $data)
                <tr>
                  <td class="text-center">{{ $index + 1 }}</td>
                  <td class="text-wrap-cell">
                    <div class="fw-semibold">{{ $data->judul_buku }}</div>
                    <small class="text-muted">{{ $data->kode_buku }}</small>
                  </td>
                  <td class="text-wrap-cell">{{ $data->pengarang }}</td>
                  <td class="text-wrap-cell">{{ $data->kategori }}</td>
                  <td class="text-center">{{ $data->stok }}</td>
                  <td class="text-center">{{ $data->lokasi_rak }}</td>
                  <td>
                    <div class="d-flex justify-content-center align-items-center gap-1">
                      <a href="{{ route('buku.show', $data->id) }}" class="btn btn-sm btn-info" title="Detail">
                        <i class="bx bx-show-alt"></i>
                      </a>
                      <a href="{{ route('buku.edit', $data->id) }}" class="btn btn-sm btn-warning" title="Edit">
                        <i class="bx bx-edit-alt"></i>
                      </a>
                      <form action="{{ route('buku.destroy', $data->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button
                          type="submit"
                          class="btn btn-sm btn-danger"
                          title="Hapus"
                          onclick="return confirm('Yakin mau hapus data ini?')"
                        >
                          <i class="bx bx-trash"></i>
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="7" class="text-center">Belum ada data buku.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection