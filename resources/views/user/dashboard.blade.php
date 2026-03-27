<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('assets/') }}/" data-template="vertical-menu-template-free">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard - E-Perpustakaan</title>
    
    <link rel="stylesheet" href="{{asset('assets/vendor/fonts/boxicons.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/css/core.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/css/theme-default.css')}}" />
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
                          <img src="{{ asset('assets/img/illustrations/gemes-baca.png') }}" height="160" alt="View Badge User" />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

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
                            <td><strong>{{ $data->buku?->judul_buku ?? $data->buku?->judul }}</strong></td>
                            <td>{{ $data->tgl_pinjam }}</td>
                            <td>
                                @if($data->status == 'disetujui')
                                    <span class="badge bg-label-success">Dipinjam</span>
                                @elseif($data->status == 'ditolak')
                                    <span class="badge bg-label-danger">Ditolak</span>
                                @else
                                    <span class="badge bg-label-warning">Proses</span>
                                @endif
                            </td>
                          </tr>
                          @empty
                          <tr>
                            <td colspan="3" class="text-center">Belum ada aktivitas pinjam.</td>
                          </tr>
                          @endforelse
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

            </div>
            
            <footer class="content-footer footer bg-footer-theme text-center py-3">
               <div class="container-xxl">© 2026 E-Perpustakaan</div>
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