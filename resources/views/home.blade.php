<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('assets/') }}/" data-template="vertical-menu-template-free">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Admin - E-Perpus</title>
<link rel="icon" type="image/png" href="{{ asset('assets/img/favicon/4deb6dda65c141e2fa8d2fa0c6bfc75b-removebg-preview.png') }}" />   
 <link rel="stylesheet" href="{{asset('assets/vendor/fonts/boxicons.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/css/core.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/css/theme-default.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/demo.css')}}" />
    <script src="{{asset('assets/vendor/js/helpers.js')}}"></script>
    <script src="{{asset('assets/js/config.js')}}"></script>
    <style>
      .chart-container { position: relative; height: 300px; width: 100%; }
    </style>
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
                  <div class="card">
                    <div class="d-flex align-items-end row">
                      <div class="col-sm-7">
                        <div class="card-body">
                          <h5 class="card-title text-primary">Selamat Datang Di E-Perpustakaan! 🎉</h5>
                          <p class="mb-4">Sistem berjalan normal. Hari ini ada <span class="fw-bold">{{ $jatuhTempoHariIni }}</span> buku jatuh tempo.</p>
                          <a href="{{ route('peminjaman.index') }}" class="btn btn-sm btn-outline-primary">Lihat Aktivitas</a>
                        </div>
                      </div>
                      <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                          <img src="{{ asset('assets/img/illustrations/Gemini_Generated_Image_l6vrnyl6vrnyl6vr-removebg-preview.png') }}" height="140" alt="View Badge User" />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-4">
                  <div class="row">
                    <div class="col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0"><span class="badge bg-label-success p-2"><i class="bx bx-book"></i></span></div>
                          </div>
                          <span class="fw-semibold d-block mb-1">Total Buku</span>
                          <h3 class="card-title mb-2">{{ $totalBuku }}</h3>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0"><span class="badge bg-label-info p-2"><i class="bx bx-user"></i></span></div>
                          </div>
                          <span class="fw-semibold d-block mb-1">Anggota</span>
                          <h3 class="card-title mb-2">{{ $totalAnggota }}</h3>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-12 col-lg-8 mb-4">
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="card-title m-0 me-2">Statistik Literasi (6 Bulan Terakhir)</h5>
                    </div>
                    <div class="card-body">
                      <div class="chart-container">
                        <canvas id="barChart"></canvas>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-md-8 col-lg-4 mb-4">
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="card-title m-0 me-2">Status Buku</h5>
                    </div>
                    <div class="card-body">
                      <div class="chart-container" style="height: 250px;">
                        <canvas id="donutChart"></canvas>
                      </div>
                      <div class="d-flex justify-content-center pt-4 gap-2">
                        <div class="flex-shrink-0"><span class="badge bg-label-primary">Dipinjam</span></div>
                        <div class="flex-shrink-0"><span class="badge bg-label-success">Kembali</span></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12 col-lg-8 mb-4">
                  <div class="card">
                    <h5 class="card-header">Aktivitas Terbaru</h5>
                    <div class="table-responsive text-nowrap">
                      <table class="table table-hover">
                        <thead><tr><th>Anggota</th><th>Buku</th><th>Status</th></tr></thead>
                        <tbody class="table-border-bottom-0">
                          @forelse($peminjamanTerbaru as $data)
                          <tr>
                            <td><strong>{{ $data->anggota->nama_anggota ?? 'N/A' }}</strong></td>
                            <td>{{ $data->buku->judul_buku ?? 'Buku Tidak Ada' }}</td>
                            <td>
                              @if($data->pengembalian)
                                <span class="badge bg-label-success me-1">Kembali</span>
                              @else
                                <span class="badge bg-label-primary me-1">Dipinjam</span>
                              @endif
                            </td>
                          </tr>
                          @empty
                          <tr><td colspan="3" class="text-center">Kosong</td></tr>
                          @endforelse
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                  <div class="card h-100">
                    <div class="card-header"><h5>Aksi Cepat</h5></div>
                    <div class="card-body">
                      <div class="d-grid gap-2">
                        <a href="{{ route('peminjaman.create') }}" class="btn btn-primary btn-md">
                          <i class="bx bx-plus me-1"></i> Input Peminjaman
                        </a>
                        <a href="{{ route('pengembalian.create') }}" class="btn btn-info btn-md">
                          <i class="bx bx-redo me-1"></i> Input Pengembalian
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>
            <div class="content-backdrop fade"></div>
          </div>
        </div>
      </div>
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>

    <script src="{{asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{asset('assets/vendor/js/bootstrap.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
      const barCtx = document.getElementById('barChart');
      if (barCtx) {
        new Chart(barCtx, {
          type: 'bar',
          data: {
            labels: {!! json_encode($labels) !!},
            datasets: [
              { label: 'Pinjam', data: {!! json_encode($dataPinjam) !!}, backgroundColor: '#696cff', borderRadius: 4 },
              { label: 'Kembali', data: {!! json_encode($dataKembali) !!}, backgroundColor: '#71dd37', borderRadius: 4 }
            ]
          },
          options: { responsive: true, maintainAspectRatio: false }
        });
      }

      const donutCtx = document.getElementById('donutChart');
      if (donutCtx) {
        new Chart(donutCtx, {
          type: 'doughnut',
          data: {
            labels: ['Dipinjam', 'Kembali'],
            datasets: [{
              data: [{{ $dipinjam }}, {{ $kembali }}],
              backgroundColor: ['#696cff', '#71dd37'],
              borderWidth: 0
            }]
          },
          options: { responsive: true, maintainAspectRatio: false, cutout: '70%' }
        });
      }
    </script>
  </body>
</html>