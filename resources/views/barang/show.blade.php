@extends('layouts.app')

@section('content')
    {{-- Header --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('dashboard') }}" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            <h5 class="mb-0 fw-bold">Detail Barang</h5>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-sm btn-primary">
                <i class="bi bi-pencil me-1"></i>Edit Barang
            </a>
            <button type="button" class="btn btn-sm btn-danger btn-hapus" data-id="{{ $barang->id }}"
                data-nama="{{ $barang->nama_barang }}">
                <i class="bi bi-trash me-1"></i>Hapus
            </button>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            {{-- Foto & Nama Barang --}}
            <div class="d-flex align-items-start gap-4 mb-4 pb-4 border-bottom">

                {{-- Foto --}}
                <div class="flex-shrink-0">
                    @if ($barang->foto)
                        <img src="{{ Storage::url($barang->foto) }}" alt="{{ $barang->nama_barang }}" class="rounded border"
                            style="width: 120px; height: 120px; object-fit: cover;">
                    @else
                        <div class="rounded border bg-light d-flex align-items-center justify-content-center"
                            style="width: 120px; height: 120px;">
                            <i class="bi bi-image text-muted fs-2"></i>
                        </div>
                    @endif
                </div>

                {{-- Nama & Kategori --}}
                <div>
                    <h4 class="fw-bold mb-1">{{ $barang->nama_barang }}</h4>
                    @if ($barang->kategori)
                        <span class="badge bg-primary badge-kategori">
                            {{ $barang->kategori->nama_kategori }}
                        </span>
                    @else
                        <span class="badge bg-secondary badge-kategori">Tanpa Kategori</span>
                    @endif

                    {{-- Status Stok --}}
                    <div class="mt-2">
                        @if ($barang->jumlah_stok == 0)
                            <span class="badge bg-danger">Stok Habis</span>
                        @elseif($barang->jumlah_stok < 20)
                            <span class="badge bg-warning text-dark">Stok Menipis</span>
                        @else
                            <span class="badge bg-success">Stok Tersedia</span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Grid Informasi Detail --}}
            <div class="row g-3">

                {{-- Jumlah Stok --}}
                <div class="col-md-6">
                    <div class="border rounded p-3">
                        <div class="text-muted small mb-1">Jumlah stok</div>
                        <div class="fw-semibold">{{ $barang->jumlah_stok }} {{ $barang->satuan }}</div>
                    </div>
                </div>

                {{-- Stok Minimum --}}
                <div class="col-md-6">
                    <div class="border rounded p-3">
                        <div class="text-muted small mb-1">Stok minimum</div>
                        <div class="fw-semibold">
                            {{ $barang->stok_minimum ?? '-' }}
                            {{ $barang->stok_minimum ? $barang->satuan : '' }}
                        </div>
                    </div>
                </div>

                {{-- Harga Jual --}}
                <div class="col-md-6">
                    <div class="border rounded p-3">
                        <div class="text-muted small mb-1">Harga jual</div>
                        <div class="fw-semibold">
                            Rp {{ number_format($barang->harga_jual, 0, ',', '.') }}
                        </div>
                    </div>
                </div>

                {{-- Harga Beli --}}
                <div class="col-md-6">
                    <div class="border rounded p-3">
                        <div class="text-muted small mb-1">Harga beli</div>
                        <div class="fw-semibold">
                            @if ($barang->harga_beli)
                                Rp {{ number_format($barang->harga_beli, 0, ',', '.') }}
                            @else
                                -
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Berat/Ukuran --}}
                <div class="col-md-6">
                    <div class="border rounded p-3">
                        <div class="text-muted small mb-1">Berat / ukuran</div>
                        <div class="fw-semibold">{{ $barang->berat_ukuran ?? '-' }}</div>
                    </div>
                </div>

                {{-- Lokasi Simpan --}}
                <div class="col-md-6">
                    <div class="border rounded p-3">
                        <div class="text-muted small mb-1">Lokasi simpan</div>
                        <div class="fw-semibold">{{ $barang->lokasi_simpan ?? '-' }}</div>
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div class="col-12">
                    <div class="border rounded p-3">
                        <div class="text-muted small mb-1">Deskripsi</div>
                        <div class="fw-semibold">
                            {{ $barang->deskripsi ?? '-' }}
                        </div>
                    </div>
                </div>

                {{-- Tanggal Dibuat --}}
                <div class="col-md-6">
                    <div class="border rounded p-3">
                        <div class="text-muted small mb-1">Tanggal ditambahkan</div>
                        <div class="fw-semibold">
                            {{ $barang->created_at->translatedFormat('d F Y') }}
                        </div>
                    </div>
                </div>

                {{-- Terakhir Diupdate --}}
                <div class="col-md-6">
                    <div class="border rounded p-3">
                        <div class="text-muted small mb-1">Terakhir diperbarui</div>
                        <div class="fw-semibold">
                            {{ $barang->updated_at->translatedFormat('d F Y') }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Modal Konfirmasi Hapus --}}
    <div class="modal fade" id="modalHapus" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-4">
                    <div class="d-flex align-items-start gap-3">
                        <div class="text-warning fs-3">
                            <i class="bi bi-exclamation-triangle"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Hapus barang?</h6>
                            <p class="text-muted mb-0 small">
                                Data <strong id="namaBarangHapus"></strong> akan dihapus secara
                                permanen dari sistem. Tindakan ini tidak dapat dibatalkan.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <form id="formHapus" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.querySelectorAll('.btn-hapus').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const id = this.dataset.id;
                const nama = this.dataset.nama;

                document.getElementById('namaBarangHapus').textContent = nama;
                document.getElementById('formHapus').action = '/barang/' + id;

                new bootstrap.Modal(document.getElementById('modalHapus')).show();
            });
        });
    </script>
@endpush
