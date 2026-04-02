<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('assets/') }}/" data-template="vertical-menu-template-free">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Laporan Pengembalian - Admin</title>
    <link rel="stylesheet" href="{{asset('assets/vendor/css/core.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/css/theme-default.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/fonts/boxicons.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/demo.css')}}" />
</head>
<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            {{-- Sidebar Admin --}}
            @include('layouts.components.sidebar')

            <div class="layout-page">
                {{-- Navbar Admin --}}
                @include('layouts.components.navbar')

                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin /</span> Laporan Pengembalian</h4>

                        {{-- Alert --}}
                        @if(session('message'))
                        <div class="alert alert-{{ session('type') ?? 'success' }} alert-dismissible" role="alert">
                            {{ session('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Riwayat Buku Masuk & Denda</h5>
                                <small class="text-muted float-end">Total: {{ $pengembalian->count() }} Data</small>
                            </div>
                            <div class="table-responsive text-nowrap">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Peminjam</th>
                                            <th>Buku</th>
                                            <th>Tgl Kembali</th>
                                            <th>Denda</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @forelse ($pengembalian as $index => $data)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <div class="d-flex flex-column">
                                                    <span class="fw-bold">{{ $data->anggota?->nama_anggota ?? 'Guest' }}</span>
                                                    <small class="text-muted">ID: {{ $data->id_anggota }}</small>
                                                </div>
                                            </td>
                                            <td>{{ $data->buku?->judul_buku }}</td>
                                            <td>{{ $data->tgl_kembali }}</td>
                                            <td>
                                                @if($data->denda > 0)
                                                    <span class="text-danger fw-bold">Rp {{ number_format($data->denda) }}</span>
                                                @else
                                                    <span class="text-success">Rp 0</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge bg-label-primary">Selesai</span>
                                            </td>
                                            <td>
                                                {{-- Tombol Hapus Riwayat jika diperlukan --}}
                                                <form action="{{ route('pengembalian.destroy', $data->id) }}" method="POST" onsubmit="return confirm('Hapus riwayat ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-icon btn-outline-danger">
                                                        <i class="bx bx-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="7" class="text-center py-4">Belum ada buku yang dikembalikan.</td>
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
</body>
</html>