@extends('layouts.app')

@section('content')
    <div class="d-flex align-items-center gap-2 mb-4">
        <a href="{{ route('kategori.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
        <h5 class="mb-0 fw-bold">Tambah Kategori</h5>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('kategori.store') }}" method="POST">
                @csrf

                {{-- Nama Kategori --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Nama kategori <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="nama_kategori"
                        class="form-control @error('nama_kategori') is-invalid @enderror" value="{{ old('nama_kategori') }}"
                        placeholder="Contoh: Ayam">
                    @error('nama_kategori')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div class="mb-4">
                    <label class="form-label fw-semibold">Deskripsi (opsional)</label>
                    <textarea name="deskripsi" rows="3" class="form-control" placeholder="Produk berbahan dasar ayam beku...">{{ old('deskripsi') }}</textarea>
                </div>

                {{-- Tombol --}}
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('kategori.index') }}" class="btn btn-outline-secondary">
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i>Simpan Kategori
                    </button>
                </div>

            </form>
        </div>
    </div>
@endsection
