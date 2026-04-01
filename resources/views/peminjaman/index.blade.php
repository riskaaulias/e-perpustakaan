<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Peminjaman | E-perpustakaan</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon/4deb6dda65c141e2fa8d2fa0c6bfc75b-removebg-preview.png') }}" />   

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{asset('assets/vendor/fonts/boxicons.css')}}" />

    <!-- Core '}} -->
    <link rel="stylesheet" href="{{asset('assets/vendor/css/core.css')}}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{asset('assets/vendor/css/theme-default.css')}}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{asset('assets/css/demo.css')}}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />

    <link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{asset('assets/vendor/js/helpers.js')}}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{asset('assets/js/config.js')}}"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
      @include('layouts.components.sidebar')
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->
        @include('layouts.components.navbar')
          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">

            <!-- Content -->
           <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tabel /</span>Peminjaman</h4>
               @if (session('message'))
    <div class="alert alert-{{ session('type') }} alert-dismissible fade show" role="alert">
        @if(session('type') == 'success')
            <i class="bx bx-check-circle me-1"></i>
        @elseif(session('type') == 'warning')
            <i class="bx bx-edit-alt me-1"></i>
        @elseif(session('type') == 'danger')
            <i class="bx bx-x-circle me-1"></i>
        @endif
        
        {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
                <div class="text-end">
                    <a href="{{route('buku.create')}}" class="btn btn-primary mb-4">
                        <i class="bx bx-folder-plus" style="position: relative; bottom: 2px;"></i> Tambah data
                    </a>
                </div>
         <div class="card">
                <h5 class="card-header">Tabel Peminjaman</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr class="text-center">
                        <th>No</th>
                        <th>Nama</th>
                        <th>Nama Petugas</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Harus Kembali</th>
                        <th>Total Pinjam</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @php $no = 1; @endphp
                        @foreach ($peminjaman as $data)
                        <tr class="text-center">
                            <td>{{ $no++ }}</td>
                            <td>
                                <div class="fw-bold">{{ $data->anggota?->nama_anggota }}</div>
                                <small class="text-muted">{{ $data->buku?->judul_buku }}</small>
                            </td>
                            <td>
                                @if($data->id_petugas)
                                    <span class="badge {{ $data->status == 'ditolak' ? 'bg-label-danger' : 'bg-label-success' }}">
                                        <i class="bx {{ $data->status == 'ditolak' ? 'bx-x-circle' : 'bx-check-circle' }} me-1"></i>
                                        {{ $data->petugas?->nama_petugas }}
                                    </span>
                                @else
                                    <span class="badge bg-label-warning">Menunggu Persetujuan</span>
                                @endif
                            </td>
                            <td>{{ $data->tgl_pinjam }}</td>
                            <td>{{ $data->tgl_harus_kembali }}</td>
                            <td>{{ $data->total_pinjam }}</td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center gap-1">
                                    @if(!$data->id_petugas)
                                        <form action="{{ route('peminjaman.setujui', $data->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success" title="Setujui">
                                                <i class="bx bx-check"></i>
                                            </button>
                                        </form>

                                        <form action="{{ route('peminjaman.tolak', $data->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger" title="Tolak" onclick="return confirm('Tolak peminjaman ini?')">
                                                <i class="bx bx-x"></i>
                                            </button>
                                        </form>
                                    @endif

                                    <a href="{{ route('peminjaman.show', $data->id) }}" class="btn btn-sm btn-info" title="Detail">
                                        <i class="bx bx-show-alt"></i>
                                    </a>
                                    
                                    <a href="{{ route('peminjaman.edit', $data->id) }}" class="btn btn-sm btn-warning">
                                        <i class="bx bx-edit-alt"></i>
                                    </a>
                                    <form action="{{ route('peminjaman.destroy', $data->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin mau hapus data ini?')">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              </div>
            <!-- / Content -->

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  , made with ❤️ by
                  <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">ThemeSelection</a>
                </div>
                <div>
                  <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
                  <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More Themes</a>

                  <a
                    href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/"
                    target="_blank"
                    class="footer-link me-4"
                    >Documentation</a
                  >

                  <a
                    href="https://github.com/themeselection/sneat-html-admin-template-free/issues"
                    target="_blank"
                    class="footer-link me-4"
                    >Support</a
                  >
                </div>
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{asset('assets/vendor/js/bootstrap.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>

    <script src="{{asset('assets/vendor/js/menu.js')}}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>

    <!-- Main JS -->
    <script src="{{asset('assets/js/main.js')}}"></script>

    <!-- Page JS -->
    <script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>