<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Tambah Data Buku | E-perpustakaan</title>
    
<link rel="icon" type="image/png" href="{{ asset('assets/img/favicon/4deb6dda65c141e2fa8d2fa0c6bfc75b-removebg-preview.png') }}" />   

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="{{asset('assets/vendor/fonts/boxicons.css')}}" />

    <link rel="stylesheet" href="{{asset('assets/vendor/css/core.css')}}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{asset('assets/vendor/css/theme-default.css')}}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{asset('assets/css/demo.css')}}" />

    <link rel="stylesheet" href="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tambah/</span>Buku</h4>

              <div class="row">
                <div class="col-xxl">
                  <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="mb-0">Tambah Data Buku</h5>
                      <small class="text-muted float-end">Pastikan semua data terisi</small>
                    </div>
                    <div class="card-body">
                      <form action="{{route('buku.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label">Kode Buku</label>
                          <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                              <span class="input-group-text"><i class="bx bx-barcode"></i></span>
                              <input type="text" class="form-control" placeholder="BK-001" name="kode_buku" value="{{ old('kode_buku') }}"/>
                            </div>
                            @error('kode_buku') <small class="text-danger">{{ $message }}</small> @enderror
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label">Judul Buku</label>
                          <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                              <span class="input-group-text"><i class="bx bx-book"></i></span>
                              <input type="text" class="form-control" placeholder="Judul Buku" name="judul_buku" value="{{ old('judul_buku') }}"/>
                            </div>
                            @error('judul_buku') <small class="text-danger">{{ $message }}</small> @enderror
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label">Pengarang</label>
                          <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                              <span class="input-group-text"><i class="bx bx-user"></i></span>
                              <input type="text" class="form-control" placeholder="Nama Pengarang" name="pengarang" value="{{ old('pengarang') }}"/>
                            </div>
                            @error('pengarang') <small class="text-danger">{{ $message }}</small> @enderror
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label">Penerbit</label>
                          <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                              <span class="input-group-text"><i class="bx bx-building"></i></span>
                              <input type="text" class="form-control" placeholder="Nama Penerbit" name="penerbit" value="{{ old('penerbit') }}"/>
                            </div>
                            @error('penerbit') <small class="text-danger">{{ $message }}</small> @enderror
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label">Tahun Terbit</label>
                          <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                              <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                              <input type="number" class="form-control" placeholder="Contoh: 2024" name="tahun" value="{{ old('tahun') }}"/>
                            </div>
                            @error('tahun') <small class="text-danger">{{ $message }}</small> @enderror
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label">Stok</label>
                          <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                              <span class="input-group-text"><i class="bx bx-package"></i></span>
                              <input type="number" class="form-control" placeholder="0" name="stok" value="{{ old('stok') }}"/>
                            </div>
                            @error('stok') <small class="text-danger">{{ $message }}</small> @enderror
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label">Kategori</label>
                          <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                              <span class="input-group-text"><i class="bx bx-category"></i></span>
                              <input type="text" class="form-control" placeholder="Contoh: Fiksi, Edukasi" name="kategori" value="{{ old('kategori') }}"/>
                            </div>
                            @error('kategori') <small class="text-danger">{{ $message }}</small> @enderror
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label">Lokasi Rak</label>
                          <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                              <span class="input-group-text"><i class="bx bx-buildings"></i></span>
                              <input type="text" class="form-control" placeholder="Contoh: Rak A1" name="lokasi_rak" value="{{ old('lokasi_rak') }}"/>
                            </div>
                            @error('lokasi_rak') <small class="text-danger">{{ $message }}</small> @enderror
                          </div>
                        </div>

                        <div class="row mb-4">
                          <label class="col-sm-2 col-form-label">Cover Buku</label>
                          <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                              <span class="input-group-text"><i class="bx bx-image-add"></i></span>
                              <input type="file" class="form-control" name="image" accept="image/*" />
                            </div>
                            <small class="text-muted">Format: JPG, PNG, JPEG. Maksimal 2MB.</small>
                            @error('image') <br><small class="text-danger">{{ $message }}</small> @enderror
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label">Deskripsi</label>
                          <div class="col-sm-10">
                              <div class="input-group input-group-merge">
                                  <span class="input-group-text"><i class="bx bx-detail"></i></span>
                                  <textarea 
                                      class="form-control" 
                                      placeholder="Masukkan sinopsis buku di sini..." 
                                      name="deskripsi" 
                                      rows="4">{{ old('deskripsi') }}</textarea>
                              </div>
                              @error('deskripsi') <small class="text-danger">{{ $message }}</small> @enderror
                          </div>
                      </div>

                        <div class="row justify-content-end">
                          <div class="col-sm-10">
                            <a href="{{ route('buku.index') }}" class="btn btn-outline-secondary me-2">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan Buku</button>
                          </div>
                        </div>
                      </form>
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

    <script src="{{asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{asset('assets/vendor/js/bootstrap.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('assets/vendor/js/menu.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>
  </body>
</html>