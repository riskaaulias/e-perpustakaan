<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('assets/') }}/" data-template="vertical-menu-template-free">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Anggota - E-Perpus</title>
    <link rel="stylesheet" href="{{asset('assets/vendor/css/core.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/css/theme-default.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/fonts/boxicons.css')}}" />
  </head>
  <body>
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        @include('layouts.components.sidebar-user')
        
        <div class="layout-page">
        @include('layouts.components.navbar-user')
        
          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4">Halo, {{ auth()->user()->name }}! 👋</h4>

              <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                  <div class="card h-100">
                    <div class="card-body">
                      <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0"><span class="badge bg-label-primary p-2"><i class="bx bx-book-reader"></i></span></div>
                      </div>
                      <span class="fw-semibold d-block mb-1">Buku Sedang Dipinjam</span>
                      <h3 class="card-title mb-2">2</h3>
                      <small class="text-success fw-semibold">Aktif</small>
                    </div>
                  </div>
                </div>

                <div class="col-lg-8 mb-4">
                  <div class="card h-100">
                    <h5 class="card-header">Riwayat Peminjaman Terakhir</h5>
                    <div class="table-responsive text-nowrap">
                      <table class="table table-hover">
                        <thead><tr><th>Judul Buku</th><th>Tanggal Pinjam</th><th>Status</th></tr></thead>
                        <tbody>
                          <tr>
                            <td><strong>Laskar Pelangi</strong></td>
                            <td>10-03-2026</td>
                            <td><span class="badge bg-label-primary">Dipinjam</span></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>