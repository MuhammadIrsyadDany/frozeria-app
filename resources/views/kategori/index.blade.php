@extends('layouts.app')

@section('content')
    {{-- Header --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h5 class="mb-0 fw-bold">Daftar Kategori</h5>
        <a href="{{ route('kategori.create') }}" class="btn btn-primary btn-sm fw-semibold">
            <i class="bi bi-plus-lg me-1"></i>Tambah Kategori
        </a>
    </div>

    {{-- Search --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('kategori.index') }}" class="row g-2 align-items-center">
                <div class="col-12 col-md-8">
                    <input type="text" name="search" class="form-control" placeholder="Cari kategori..."
                        value="{{ request('search') }}">
                </div>
                <div class="col-12 col-md-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search me-1"></i>Cari
                    </button>
                    @if (request('search'))
                        <a href="{{ route('kategori.index') }}" class="btn btn-outline-secondary w-100">
                            <i class="bi bi-x-lg"></i>
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    {{-- Tabel Kategori --}}
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-3">Nama kategori</th>
                            <th>Jumlah barang</th>
                            <th>Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kategoris as $kategori)
                            <tr>
                                <td class="ps-3 fw-semibold">{{ $kategori->nama_kategori }}</td>
                                <td>
                                    <span class="text-muted">{{ $kategori->barangs_count }} barang</span>
                                </td>
                                <td>
                                    <span class="text-muted small">
                                        {{ $kategori->created_at->translatedFormat('d M Y') }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('kategori.edit', $kategori->id) }}"
                                            class="btn btn-sm btn-outline-primary">Edit</a>
                                        <button type="button" class="btn btn-sm btn-outline-danger btn-hapus"
                                            data-id="{{ $kategori->id }}" data-nama="{{ $kategori->nama_kategori }}">
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                    <i class="bi bi-inbox fs-4 d-block mb-2"></i>
                                    Tidak ada kategori ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Footer --}}
        <div class="card-footer">
            <small class="text-muted">{{ $kategoris->count() }} kategori terdaftar</small>
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
                            <h6 class="fw-bold mb-1">Hapus kategori?</h6>
                            <p class="text-muted mb-0 small">
                                Kategori <strong id="namaKategoriHapus"></strong> akan dihapus
                                secara permanen. Barang yang terkait akan menjadi tidak berkategori.
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

                document.getElementById('namaKategoriHapus').textContent = nama;
                document.getElementById('formHapus').action = '/kategori/' + id;

                new bootstrap.Modal(document.getElementById('modalHapus')).show();
            });
        });
    </script>
@endpush
