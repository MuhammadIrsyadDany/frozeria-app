@extends('layouts.app')

@section('content')
    {{-- Cards Statistik --}}
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="card card-stat h-100 shadow-sm">
                <div class="card-body">
                    <div class="text-muted small mb-1">Total barang</div>
                    <div class="fw-bold fs-3">{{ $totalBarang }}</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card card-stat success h-100 shadow-sm">
                <div class="card-body">
                    <div class="text-muted small mb-1">Total kategori</div>
                    <div class="fw-bold fs-3">{{ $totalKategori }}</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card card-stat warning h-100 shadow-sm">
                <div class="card-body">
                    <div class="text-muted small mb-1">Stok menipis</div>
                    <div class="fw-bold fs-3">{{ $stokMenipis }}</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card card-stat danger h-100 shadow-sm">
                <div class="card-body">
                    <div class="text-muted small mb-1">Stok habis</div>
                    <div class="fw-bold fs-3">{{ $stokHabis }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Search & Filter --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('dashboard') }}" class="row g-2 align-items-center">
                <div class="col-12 col-md-6">
                    <input type="text" name="search" class="form-control" placeholder="Cari nama barang..."
                        value="{{ request('search') }}">
                </div>
                <div class="col-8 col-md-4">
                    <select name="kategori_id" class="form-select">
                        <option value="">Semua kategori</option>
                        @foreach ($kategoris as $k)
                            <option value="{{ $k->id }}" {{ request('kategori_id') == $k->id ? 'selected' : '' }}>
                                {{ $k->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-4 col-md-2 d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search me-1"></i>Cari
                    </button>
                    @if (request('search') || request('kategori_id'))
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary w-100">
                            <i class="bi bi-x-lg"></i>
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    {{-- Tabel Barang --}}
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-3">Nama barang</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th>Satuan</th>
                            <th>Harga jual</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($barangs as $barang)
                            <tr>
                                <td class="ps-3">{{ $barang->nama_barang }}</td>
                                <td>
                                    @if ($barang->kategori)
                                        <span class="badge bg-primary badge-kategori">
                                            {{ $barang->kategori->nama_kategori }}
                                        </span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($barang->jumlah_stok == 0)
                                        <span class="badge bg-danger">Habis</span>
                                    @elseif($barang->jumlah_stok < 20)
                                        <span class="badge bg-warning text-dark">{{ $barang->jumlah_stok }}</span>
                                    @else
                                        <span class="text-dark">{{ $barang->jumlah_stok }}</span>
                                    @endif
                                </td>
                                <td>{{ $barang->satuan }}</td>
                                <td>Rp {{ number_format($barang->harga_jual, 0, ',', '.') }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('barang.show', $barang->id) }}"
                                            class="btn btn-sm btn-outline-info">Detail</a>
                                        <a href="{{ route('barang.edit', $barang->id) }}"
                                            class="btn btn-sm btn-outline-primary">Edit</a>
                                        <button type="button" class="btn btn-sm btn-outline-danger btn-hapus"
                                            data-id="{{ $barang->id }}" data-nama="{{ $barang->nama_barang }}">
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    <i class="bi bi-inbox fs-4 d-block mb-2"></i>
                                    Tidak ada barang ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Footer Tabel: info + pagination --}}
        @if ($barangs->total() > 0)
            <div class="card-footer d-flex justify-content-between align-items-center flex-wrap gap-2">
                <small class="text-muted">
                    Menampilkan {{ $barangs->firstItem() }}–{{ $barangs->lastItem() }}
                    dari {{ $barangs->total() }} barang
                </small>
                {{ $barangs->links('pagination::bootstrap-5') }}
            </div>
        @endif
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
        // Trigger modal hapus
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
