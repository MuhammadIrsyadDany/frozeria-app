@extends('layouts.app')

@section('content')
    <div class="d-flex align-items-center gap-2 mb-4">
        <a href="{{ route('dashboard') }}" class="btn btn-sm btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
        <h5 class="mb-0 fw-bold">Tambah Barang Baru</h5>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Upload Foto --}}
                <div class="mb-4">
                    <label class="form-label fw-semibold">Foto barang</label>
                    <div class="border rounded-2 p-4 text-center"
                        style="border-style: dashed !important; background: #f8f9fa; cursor:pointer;"
                        onclick="document.getElementById('inputFoto').click()">
                        <div id="previewContainer">
                            <i class="bi bi-image text-muted fs-2 d-block mb-2"></i>
                            <p class="text-muted small mb-1">Klik untuk memilih foto, atau seret file ke sini</p>
                            <p class="text-muted small mb-2">Format: JPG, PNG — Maks. 2 MB</p>
                            <button type="button" class="btn btn-sm btn-outline-primary"
                                onclick="event.stopPropagation(); document.getElementById('inputFoto').click()">
                                Pilih Foto
                            </button>
                        </div>
                        <img id="previewImg" src="#" alt="Preview" class="img-fluid rounded d-none"
                            style="max-height: 200px;">
                    </div>
                    <input type="file" id="inputFoto" name="foto" accept="image/jpg,image/jpeg,image/png"
                        class="d-none @error('foto') is-invalid @enderror" onchange="previewFoto(this)">
                    @error('foto')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Nama Barang --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama barang <span class="text-danger">*</span></label>
                    <input type="text" name="nama_barang" class="form-control @error('nama_barang') is-invalid @enderror"
                        value="{{ old('nama_barang') }}" placeholder="Contoh: Ayam nugget crispy">
                    @error('nama_barang')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Kategori & Satuan --}}
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Kategori <span class="text-danger">*</span></label>
                        <select name="kategori_id" class="form-select @error('kategori_id') is-invalid @enderror">
                            <option value="">Pilih kategori</option>
                            @foreach ($kategoris as $k)
                                <option value="{{ $k->id }}" {{ old('kategori_id') == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Satuan <span class="text-danger">*</span></label>
                        <input type="text" name="satuan" class="form-control @error('satuan') is-invalid @enderror"
                            value="{{ old('satuan') }}" placeholder="pcs / pack / box / kg">
                        @error('satuan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Jumlah Stok & Stok Minimum --}}
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Jumlah stok <span class="text-danger">*</span></label>
                        <input type="number" name="jumlah_stok"
                            class="form-control @error('jumlah_stok') is-invalid @enderror"
                            value="{{ old('jumlah_stok', 0) }}" min="0">
                        @error('jumlah_stok')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Stok minimum</label>
                        <input type="number" name="stok_minimum"
                            class="form-control @error('stok_minimum') is-invalid @enderror"
                            value="{{ old('stok_minimum', 20) }}" min="0">
                        @error('stok_minimum')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Harga Jual & Harga Beli --}}
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Harga jual (Rp) <span class="text-danger">*</span></label>
                        <input type="number" name="harga_jual"
                            class="form-control @error('harga_jual') is-invalid @enderror"
                            value="{{ old('harga_jual', 0) }}" min="0">
                        @error('harga_jual')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Harga beli (Rp)</label>
                        <input type="number" name="harga_beli"
                            class="form-control @error('harga_beli') is-invalid @enderror"
                            value="{{ old('harga_beli', 0) }}" min="0">
                        @error('harga_beli')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Berat/Ukuran & Lokasi Simpan --}}
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Berat / ukuran</label>
                        <input type="text" name="berat_ukuran" class="form-control"
                            value="{{ old('berat_ukuran') }}" placeholder="Contoh: 500 gram">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Lokasi simpan</label>
                        <input type="text" name="lokasi_simpan" class="form-control"
                            value="{{ old('lokasi_simpan') }}" placeholder="Contoh: Rak A-3">
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div class="mb-4">
                    <label class="form-label fw-semibold">Deskripsi</label>
                    <textarea name="deskripsi" rows="3" class="form-control" placeholder="Deskripsi singkat barang...">{{ old('deskripsi') }}</textarea>
                </div>

                {{-- Tombol --}}
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i>Simpan Barang
                    </button>
                </div>

            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function previewFoto(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('previewContainer').classList.add('d-none');
                    const img = document.getElementById('previewImg');
                    img.src = e.target.result;
                    img.classList.remove('d-none');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush
