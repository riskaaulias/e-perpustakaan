<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Detail Buku | E-perpustakaan</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon/4deb6dda65c141e2fa8d2fa0c6bfc75b-removebg-preview.png') }}" />   

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>
</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include('layouts.components.sidebar')

            <div class="layout-page">
                @include('layouts.components.navbar')

                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Detail /</span> Buku</h4>

                        <div class="row">
                            <div class="col-xxl">
                                <div class="card mb-4">
                                    <div class="card-header d-flex align-items-center justify-content-between">
                                        <h5 class="mb-0">Informasi Lengkap Buku</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row mb-4">
                                            <label class="col-sm-2 col-form-label">Sampul Buku</label>
                                            <div class="col-sm-10">
                                                @if($buku->image)
                                                    <img src="{{ asset('storage/' . $buku->image) }}" 
                                                         alt="Cover {{ $buku->judul_buku }}" 
                                                         class="img-fluid rounded shadow" 
                                                         style="max-width: 200px; border: 3px solid #f5f5f9;">
                                                @else
                                                    <div class="d-flex align-items-center justify-content-center rounded bg-lighter" 
                                                         style="width: 200px; height: 280px; border: 2px dashed #d9dee3;">
                                                        <div class="text-center">
                                                            <i class="bx bx-image-alt fs-1 text-muted"></i>
                                                            <p class="text-muted mb-0">Tidak ada foto</p>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <hr class="my-4">

                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label">Kode Buku</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control-plaintext fw-bold" value="{{ $buku->kode_buku }}" readonly />
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label">Judul Buku</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control-plaintext" value="{{ $buku->judul_buku }}" readonly />
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label">Pengarang</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control-plaintext" value="{{ $buku->pengarang }}" readonly />
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label">Penerbit</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control-plaintext" value="{{ $buku->penerbit }}" readonly />
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label">Tahun</label>
                                            <div class="col-sm-10">
                                                <span class="badge bg-label-secondary">{{ $buku->tahun }}</span>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label">Stok</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control-plaintext" value="{{ $buku->stok }} unit" readonly />
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label">Kategori</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control-plaintext" value="{{ $buku->kategori }}" readonly />
                                            </div>
                                        </div>

                                        <div class="row mb-4">
                                            <label class="col-sm-2 col-form-label">Lokasi Rak</label>
                                            <div class="col-sm-10">
                                                <span class="badge bg-label-primary"><i class="bx bx-map-pin me-1"></i>{{ $buku->lokasi_rak }}</span>
                                            </div>
                                        </div>

                                        <div class="row justify-content-end">
                                            <div class="col-sm-10">
                                                <a href="{{ route('buku.index') }}" class="btn btn-outline-secondary">
                                                    <i class="bx bx-arrow-back me-1"></i> Kembali
                                                </a>
                                                <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-primary">
                                                    <i class="bx bx-edit-alt me-1"></i> Edit Buku
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <footer class="content-footer footer bg-footer-theme">
                        <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                            <div class="mb-2 mb-md-0">
                                © <script>document.write(new Date().getFullYear());</script>, E-Perpustakaan
                            </div>
                        </div>
                    </footer>
                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>

    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>