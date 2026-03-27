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
        {{-- Sidebar User --}}
        @include('layouts.components.sidebar-user')
        
        <div class="layout-page">
          {{-- Navbar User --}}
          @include('layouts.components.navbar-user')
        
          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">User /</span> Riwayat Peminjaman</h4>

              <div class="card">
                <h5 class="card-header">Semua Daftar Peminjaman Kamu</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table table-striped table-hover">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Buku</th>
                        <th>Tgl Pinjam</th>
                        <th>Batas Kembali</th>
                        <th>Status</th>
                        <th>Petugas</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      @forelse ($riwayat as $index => $data)
                      <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                          <div class="d-flex align-items-center">
                            <i class="bx bx-book-alt me-2 text-primary"></i>
                            <strong>{{ $data->buku?->judul ?? $data->buku?->judul_buku }}</strong>
                          </div>
                        </td>
                        <td><span class="text-muted">{{ $data->tgl_pinjam }}</span></td>
                        <td><span class="text-danger fw-bold">{{ $data->tgl_harus_kembali }}</span></td>
                        <td>
                          @if($data->status == 'disetujui')
                            <span class="badge bg-label-success">Sedang Dipinjam</span>
                          @elseif($data->status == 'ditolak')
                            <span class="badge bg-label-danger">Ditolak</span>
                          @elseif($data->status == 'kembali')
                            <span class="badge bg-label-primary">Sudah Dikembalikan</span>
                          @else
                            <span class="badge bg-label-warning">Menunggu Konfirmasi</span>
                          @endif
                        </td>
                        <td>
                          <small>{{ $data->petugas?->nama_petugas ?? '-' }}</small>
                        </td>
                        <td>
                          <a href="{{ route('peminjaman.show', $data->id) }}" class="btn btn-icon btn-sm btn-outline-info">
                            <i class="bx bx-info-circle"></i>
                          </a>
                        </td>
                      </tr>
                      @empty
                      <tr>
                        <td colspan="7" class="text-center py-5">
                          <p class="text-muted">Kamu belum memiliki riwayat peminjaman.</p>
                        </td>
                      </tr>
                      @endforelse
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            
            <footer class="content-footer footer bg-footer-theme text-center py-3">
               <div class="container-xxl">© {{ date('year') }} E-Perpustakaan</div>
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