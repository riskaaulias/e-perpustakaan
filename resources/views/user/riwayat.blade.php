<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('assets/') }}/" data-template="vertical-menu-template-free">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Riwayat Peminjaman - E-Perpustakaan</title>
    
    <link rel="stylesheet" href="{{asset('assets/vendor/css/core.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/css/theme-default.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/fonts/boxicons.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/demo.css')}}" />
  </head>

  <body>
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        
        {{-- Sidebar Khusus User --}}
        @include('layouts.components.sidebar-user')
        
        <div class="layout-page">
          
          {{-- Navbar Khusus User --}}
          @include('layouts.components.navbar-user')
        
          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">User /</span> Riwayat Peminjaman</h4>

              {{-- Notifikasi Berhasil/Gagal --}}
              @if(session('message'))
              <div class="alert alert-{{ session('type') ?? 'success' }} alert-dismissible" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @endif

              <div class="card">
                <h5 class="card-header">Daftar Buku yang Anda Pinjam</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table table-hover table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Judul Buku</th>
                        <th>Tgl Pinjam</th>
                        <th>Batas Kembali</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      @forelse ($riwayat as $index => $data)
                      <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                          <div class="d-flex align-items-center">
                            <i class="bx bx-book me-2 text-primary"></i>
                            <strong>{{ $data->buku?->judul_buku ?? 'Buku Tidak Diketahui' }}</strong>
                          </div>
                        </td>
                        <td>{{ $data->tgl_pinjam }}</td>
                        <td>
                          <span class="text-danger fw-bold">{{ $data->tgl_harus_kembali }}</span>
                        </td>
                        <td>
                          @if($data->status == 'disetujui')
                            <span class="badge bg-label-success">Sedang Dipinjam</span>
                          @elseif($data->status == 'ditolak')
                            <span class="badge bg-label-danger">Ditolak</span>
                          @elseif($data->status == 'kembali')
                            <span class="badge bg-label-primary">Sudah Kembali</span>
                          @else
                            <span class="badge bg-label-warning">Menunggu Validasi</span>
                          @endif
                        </td>
                        <td>

                          @if($data->status == 'disetujui')
                            <form action="{{ route('pengembalian.store') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mengembalikan buku ini?')">
                                @csrf
                                <input type="hidden" name="peminjaman_id" value="{{ $data->id }}">
                                <button type="submit" class="btn btn-sm btn-primary">
                                  <i class="bx bx-undo me-1"></i> Kembalikan
                                </button>
                            </form>
                          @elseif($data->status == 'kembali')
                            <span class="text-muted small"><i class="bx bx-check-circle"></i> Selesai</span>
                          @else
                            <span class="text-muted">-</span>
                          @endif
                        </td>
                      </tr>
                      @empty
                      <tr>
                        <td colspan="6" class="text-center py-5">
                          <img src="{{ asset('assets/img/illustrations/empty-box.png') }}" alt="No Data" width="100" class="mb-3">
                          <p class="text-muted">Anda belum pernah meminjam buku apapun.</p>
                        </td>
                      </tr>
                      @endforelse
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            
            <footer class="content-footer footer bg-footer-theme text-center py-3">
                <div class="container-xxl">© {{ date('Y') }} E-Perpustakaan</div>
            </footer>
          </div>
        </div>
      </div>
    </div>

    <script src="{{asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{asset('assets/vendor/js/bootstrap.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>
  </body>
</html>