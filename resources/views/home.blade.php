<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('assets/') }}/" data-template="vertical-menu-template-free">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard - E-Perpus</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('assets/vendor/fonts/boxicons.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/css/core.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/css/theme-default.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/demo.css')}}" />
    <script src="{{asset('assets/vendor/js/helpers.js')}}"></script>
    <script src="{{asset('assets/js/config.js')}}"></script>
  </head>

  <body>
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        @include('layouts.components.sidebar')
        <div class="layout-page">
          @include('layouts.components.navbar')

          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
              
              <div class="row">
                <div class="col-lg-8 mb-4">
                  <div class="card h-100">
                    <div class="d-flex align-items-end row">
                      <div class="col-sm-7">
                        <div class="card-body">
                          <h5 class="card-title text-primary">Selamat Datang Di E-Perpustakaan! 🎉</h5>
                          <p class="mb-4">Sistem berjalan normal. Hari ini ada <span class="fw-bold">{{ $jatuhTempoHariIni }}</span> buku jatuh tempo.</p>
                          <a href="{{ route('peminjaman.index') }}" class="btn btn-sm btn-outline-primary">Lihat Aktivitas</a>
                        </div>
                      </div>
                      <div class="col-sm-5 text-center"><img src="{{ asset('assets/img/illustrations/Gemini_Generated_Image_l6vrnyl6vrnyl6vr-removebg-preview.png') }}" height="150" /></div>
                    </div>
                  </div>
                </div>

                <div class="col-lg-4">
                  <div class="row">
                    <div class="col-6 mb-4">
                      <div class="card h-100">
                        <div class="card-body">
                          <div class="avatar flex-shrink-0 mb-3"><span class="badge bg-label-success p-2"><i class="bx bx-book"></i></span></div>
                          <span class="d-block mb-1">Total Buku</span>
                          <h3 class="card-title mb-0">{{ $totalBuku }}</h3>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 mb-4">
                      <div class="card h-100">
                        <div class="card-body">
                          <div class="avatar flex-shrink-0 mb-3"><span class="badge bg-label-info p-2"><i class="bx bx-user"></i></span></div>
                          <span class="d-block mb-1">Anggota</span>
                          <h3 class="card-title mb-0">{{ $totalAnggota }}</h3>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12 col-lg-8 mb-4">
                  <div class="card h-100">
                    <div class="card-header"><h5 class="m-0">Aktivitas Terbaru</h5></div>
                    <div class="table-responsive text-nowrap">
                      <table class="table table-borderless">
                        <thead><tr><th>Nama Anggota</th><th>Judul Buku</th><th>Status</th></tr></thead>

                        <tbody>
                          @forelse($peminjamanTerbaru as $data)
                          <tr>
                              <td>{{ $data->anggota->nama_anggota ?? 'N/A' }}</td>
                              <td>
                                  @if($data->buku) 
                                      <span class="badge bg-label-secondary">{{ $data->buku->judul_buku }}</span> 
                                  @else 
                                      <span class="badge bg-label-danger">Buku Tidak Ditemukan</span> 
                                  @endif
                              </td>
                              <td>
                                  @if($data->pengembalian && $data->pengembalian->count() > 0)
                                      <span class="badge bg-label-success">Kembali</span>
                                  @else
                                      <span class="badge bg-label-primary">Dipinjam</span>
                                  @endif
                              </td>
                          </tr>
                          @empty
                          <tr><td colspan="3" class="text-center">Belum ada aktivitas.</td></tr>
                          @endforelse
                      </tbody>

                      </table>
                    </div>
                  </div>
                </div>

                <div class="col-md-6 col-lg-4 mb-4">
                  <div class="card h-100">
                    <div class="card-header"><h5 class="m-0">Aksi Cepat</h5></div>
                    <div class="card-body">
                      <ul class="p-0 m-0">
                        <li class="d-flex mb-4">
                          <div class="avatar me-3"><span class="avatar-initial rounded bg-label-primary"><i class="bx bx-plus"></i></span></div>
                          <div class="d-flex w-100 justify-content-between align-items-center">
                            <div><h6 class="mb-0">Peminjaman</h6></div>
                            <a href="{{ route('peminjaman.create') }}" class="btn btn-xs btn-primary">Buka</a>
                          </div>
                        </li>
                        <li class="d-flex">
                          <div class="avatar me-3"><span class="avatar-initial rounded bg-label-info"><i class="bx bx-redo"></i></span></div>
                          <div class="d-flex w-100 justify-content-between align-items-center">
                            <div><h6 class="mb-0">Pengembalian</h6></div>
                            <a href="{{ route('pengembalian.create') }}" class="btn btn-xs btn-info">Buka</a>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="{{asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{asset('assets/vendor/js/bootstrap.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>
  </body>
</html>