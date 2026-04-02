@extends('layouts.main')

@section('title', 'Tambah Data Buku | E-perpustakaan')

@section('content')
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tambah /</span> Buku</h4>

    @include('buku._form', [
      'buku' => $buku,
      'action' => $action,
      'isEdit' => false,
    ])
  </div>
@endsection