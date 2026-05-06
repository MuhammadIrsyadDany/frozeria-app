@extends('layouts.app')

@section('content')
    <h5 class="fw-bold mb-4">Panduan Penggunaan Sistem</h5>

    {{-- Cara Menambah Barang Baru --}}
    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <h6 class="fw-bold mb-3">
                <i class="bi bi-plus-circle text-primary me-2"></i>Cara menambah barang baru
            </h6>
            <ol class="mb-0">
                <li class="mb-2">
                    Buka halaman <strong>Dashboard</strong>, klik tombol
                    <span class="badge bg-warning text-dark">+ Tambah Barang</span>
                    di kanan atas.
                </li>
                <li class="mb-2">
                    Unggah foto barang (opsional), lalu isi formulir:
                    nama, kategori, satuan, jumlah stok, harga, dan lainnya.
                </li>
                <li>
                    Klik <strong>Simpan Barang</strong>. Barang akan muncul
                    di daftar dashboard.
                </li>
            </ol>
        </div>
    </div>

    {{-- Cara Update Stok Barang Masuk --}}
    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <h6 class="fw-bold mb-3">
                <i class="bi bi-arrow-up-circle text-success me-2"></i>Cara update stok barang masuk
            </h6>
            <ol class="mb-0">
                <li class="mb-2">
                    Temukan barang di dashboard menggunakan kolom pencarian
                    atau filter kategori.
                </li>
                <li class="mb-2">
                    Klik tombol <span class="badge bg-primary">Edit</span>
                    pada baris barang tersebut.
                </li>
                <li>
                    Isi nilai <strong>Jumlah Barang Masuk</strong> sesuai
                    kondisi saat ini, lalu klik <strong>Simpan Barang</strong>.
                    Stok akan bertambah secara otomatis.
                </li>
            </ol>
        </div>
    </div>

    {{-- Cara Mengelola Kategori --}}
    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <h6 class="fw-bold mb-3">
                <i class="bi bi-tags text-warning me-2"></i>Cara mengelola kategori
            </h6>
            <ol class="mb-0">
                <li class="mb-2">
                    Buka halaman <strong>Kategori</strong> dari navigasi atas.
                </li>
                <li class="mb-2">
                    Tambah, edit, atau hapus kategori sesuai kebutuhan toko.
                </li>
                <li>
                    Menghapus kategori <strong>tidak</strong> akan menghapus
                    barang — barang akan menjadi tidak berkategori.
                </li>
            </ol>
        </div>
    </div>

    {{-- Cara Melihat Detail Barang --}}
    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <h6 class="fw-bold mb-3">
                <i class="bi bi-eye text-info me-2"></i>Cara melihat detail barang
            </h6>
            <ol class="mb-0">
                <li class="mb-2">
                    Dari dashboard, klik tombol
                    <span class="badge bg-info text-dark">Detail</span>
                    pada baris barang yang ingin dilihat.
                </li>
                <li>
                    Halaman detail menampilkan seluruh informasi barang
                    beserta foto, status stok, harga, lokasi simpan, dan deskripsi.
                </li>
            </ol>
        </div>
    </div>

    {{-- Cara Menghapus Barang --}}
    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <h6 class="fw-bold mb-3">
                <i class="bi bi-trash text-danger me-2"></i>Cara menghapus barang
            </h6>
            <ol class="mb-0">
                <li class="mb-2">
                    Klik tombol <span class="badge bg-danger">Hapus</span>
                    pada baris barang di dashboard, atau di halaman detail barang.
                </li>
                <li class="mb-2">
                    Akan muncul dialog konfirmasi penghapusan.
                </li>
                <li>
                    Klik <strong>Ya, Hapus</strong> untuk menghapus permanen,
                    atau <strong>Batal</strong> untuk membatalkan.
                </li>
            </ol>
        </div>
    </div>

    {{-- Informasi Satuan --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h6 class="fw-bold mb-2">
                <i class="bi bi-info-circle text-secondary me-2"></i>Informasi satuan
            </h6>
            <p class="mb-0 text-muted small">
                Satuan barang diisi bebas sesuai kebutuhan — misalnya:
                <strong>pcs</strong>, <strong>pack</strong>, <strong>box</strong>,
                <strong>kg</strong>, <strong>liter</strong>, dan lain-lain.
            </p>
        </div>
    </div>

    {{-- Informasi Developer --}}
    <div class="card shadow-sm border-primary">
        <div class="card-header bg-primary text-white fw-semibold">
            <i class="bi bi-person-badge me-2"></i>Informasi Pengembang
        </div>
        <div class="card-body">
            <table class="table table-borderless mb-0">
                <tbody>
                    <tr>
                        <td class="text-muted" style="width: 160px;">Nama</td>
                        <td class="fw-semibold">: Muhammad Irsyad Dany</td>
                    </tr>
                    <tr>
                        <td class="text-muted">NIM</td>
                        <td class="fw-semibold">: 2241720227</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Kelas</td>
                        <td class="fw-semibold">: TI-4G</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Alamat</td>
                        <td class="fw-semibold">: Perum. Green Prambangan Residence</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Nomor Telepon</td>
                        <td class="fw-semibold">: 08997984448</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Email</td>
                        <td class="fw-semibold">: irsyadnny09@gmail.com</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
