@extends('layouts.main')

@section('title', 'Edit Data Buku | E-perpustakaan')

@section('content')
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Edit /</span> Buku</h4>

    @include('buku._form', [
      'buku' => $buku,
      'action' => $action,
      'isEdit' => true,
    ])
  </div>
<<<<<<< HEAD
@endsection
=======
@endsection
>>>>>>> 93ddcaad7d199c78d83d6c6eb9a7a0b47450af81
