<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
  @csrf
  @if ($isEdit)
    @method('PUT')
  @endif

  <div class="card mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0">{{ $isEdit ? 'Edit Data Buku' : 'Tambah Data Buku' }}</h5>
      <small class="text-muted float-end">Pastikan data utama terisi dengan benar</small>
    </div>

    <div class="card-body">
      @if ($errors->any())
        <div class="alert alert-danger">
          <strong>Silakan perbaiki data berikut:</strong>
          <ul class="mb-0 mt-2 ps-3">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <div class="row mb-3">
        <label class="col-sm-2 col-form-label">Kode Buku</label>
        <div class="col-sm-10">
          <div class="input-group input-group-merge">
            <span class="input-group-text"><i class="bx bx-barcode"></i></span>
            <input
              type="text"
              class="form-control @error('kode_buku') is-invalid @enderror"
              placeholder="BK-001"
              name="kode_buku"
              value="{{ old('kode_buku', $buku->kode_buku) }}"
            />
          </div>
        </div>
      </div>

      <div class="row mb-3">
        <label class="col-sm-2 col-form-label">Judul Buku</label>
        <div class="col-sm-10">
          <div class="input-group input-group-merge">
            <span class="input-group-text"><i class="bx bx-book"></i></span>
            <input
              type="text"
              class="form-control @error('judul_buku') is-invalid @enderror"
              placeholder="Judul Buku"
              name="judul_buku"
              value="{{ old('judul_buku', $buku->judul_buku) }}"
            />
          </div>
        </div>
      </div>

      <div class="row mb-3">
        <label class="col-sm-2 col-form-label">Pengarang</label>
        <div class="col-sm-10">
          <div class="input-group input-group-merge">
            <span class="input-group-text"><i class="bx bx-user"></i></span>
            <input
              type="text"
              class="form-control @error('pengarang') is-invalid @enderror"
              placeholder="Nama Pengarang"
              name="pengarang"
              value="{{ old('pengarang', $buku->pengarang) }}"
            />
          </div>
        </div>
      </div>

      <div class="row mb-3">
        <label class="col-sm-2 col-form-label">Penerbit</label>
        <div class="col-sm-10">
          <div class="input-group input-group-merge">
            <span class="input-group-text"><i class="bx bx-building"></i></span>
            <input
              type="text"
              class="form-control @error('penerbit') is-invalid @enderror"
              placeholder="Nama Penerbit"
              name="penerbit"
              value="{{ old('penerbit', $buku->penerbit) }}"
            />
          </div>
        </div>
      </div>

      <div class="row mb-3">
        <label class="col-sm-2 col-form-label">Tahun Terbit</label>
        <div class="col-sm-10">
          <div class="input-group input-group-merge">
            <span class="input-group-text"><i class="bx bx-calendar"></i></span>
            <input
              type="number"
              class="form-control @error('tahun') is-invalid @enderror"
              placeholder="Contoh: 2024"
              name="tahun"
              value="{{ old('tahun', $buku->tahun) }}"
            />
          </div>
        </div>
      </div>

      <div class="row mb-3">
        <label class="col-sm-2 col-form-label">Stok</label>
        <div class="col-sm-10">
          <div class="input-group input-group-merge">
            <span class="input-group-text"><i class="bx bx-package"></i></span>
            <input
              type="number"
              class="form-control @error('stok') is-invalid @enderror"
              placeholder="0"
              name="stok"
              value="{{ old('stok', $buku->stok) }}"
            />
          </div>
        </div>
      </div>

      <div class="row mb-3">
        <label class="col-sm-2 col-form-label">Kategori</label>
        <div class="col-sm-10">
          <div class="input-group input-group-merge">
            <span class="input-group-text"><i class="bx bx-category"></i></span>
            <input
              type="text"
              class="form-control @error('kategori') is-invalid @enderror"
              placeholder="Contoh: Fiksi, Edukasi"
              name="kategori"
              value="{{ old('kategori', $buku->kategori) }}"
            />
          </div>
        </div>
      </div>

      <div class="row mb-3">
        <label class="col-sm-2 col-form-label">Lokasi Rak</label>
        <div class="col-sm-10">
          <div class="input-group input-group-merge">
            <span class="input-group-text"><i class="bx bx-buildings"></i></span>
            <input
              type="text"
              class="form-control @error('lokasi_rak') is-invalid @enderror"
              placeholder="Contoh: Rak A1"
              name="lokasi_rak"
              value="{{ old('lokasi_rak', $buku->lokasi_rak) }}"
            />
          </div>
        </div>
      </div>

      <div class="row mb-4">
        <label class="col-sm-2 col-form-label">Cover Buku</label>
        <div class="col-sm-10">
          @if ($isEdit && $buku->image)
            <div class="mb-2">
              <img src="{{ $buku->image_url }}" alt="Cover" width="100" class="rounded shadow-sm">
              <p class="small text-muted mb-2">Cover saat ini</p>
            </div>
          @endif

          <div class="input-group input-group-merge">
            <span class="input-group-text"><i class="bx bx-image-add"></i></span>
            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" accept="image/*" />
          </div>
          <small class="text-muted">
            {{ $isEdit ? 'Kosongkan jika tidak ingin mengubah gambar.' : 'Format: JPG, PNG, JPEG. Maksimal 2MB.' }}
          </small>
        </div>
      </div>

      <div class="row mb-3">
        <label class="col-sm-2 col-form-label">Deskripsi</label>
        <div class="col-sm-10">
          <div class="input-group input-group-merge">
            <span class="input-group-text"><i class="bx bx-detail"></i></span>
            <textarea
              class="form-control @error('deskripsi') is-invalid @enderror"
              placeholder="Masukkan sinopsis buku di sini..."
              name="deskripsi"
              rows="4"
            >{{ old('deskripsi', $buku->deskripsi) }}</textarea>
          </div>
        </div>
      </div>
    </div>

    <div class="card-footer">
      <a href="{{ route('buku.index') }}" class="btn btn-outline-secondary me-2">Batal</a>
      <button type="submit" class="btn btn-primary">{{ $isEdit ? 'Simpan Perubahan' : 'Simpan Buku' }}</button>
    </div>
  </div>
</form>