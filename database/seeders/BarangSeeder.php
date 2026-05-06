<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barang;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        $barangs = [
            ['nama_barang' => 'Ayam nugget crispy',  'kategori_id' => 1, 'satuan' => 'pcs',  'jumlah_stok' => 120, 'stok_minimum' => 20, 'harga_jual' => 35000, 'harga_beli' => 28000, 'berat_ukuran' => '500 gram', 'lokasi_simpan' => 'Rak A-1', 'deskripsi' => 'Nugget ayam crispy kemasan 500gr'],
            ['nama_barang' => 'Sosis sapi premium',  'kategori_id' => 2, 'satuan' => 'pack', 'jumlah_stok' => 15,  'stok_minimum' => 20, 'harga_jual' => 28000, 'harga_beli' => 22000, 'berat_ukuran' => '250 gram', 'lokasi_simpan' => 'Rak B-1', 'deskripsi' => 'Sosis sapi premium kemasan 250gr'],
            ['nama_barang' => 'Dim sum udang',        'kategori_id' => 3, 'satuan' => 'box',  'jumlah_stok' => 0,   'stok_minimum' => 20, 'harga_jual' => 45000, 'harga_beli' => 38000, 'berat_ukuran' => '300 gram', 'lokasi_simpan' => 'Rak C-1', 'deskripsi' => 'Dim sum udang isi 10pcs'],
            ['nama_barang' => 'Bakso urat sapi',      'kategori_id' => 2, 'satuan' => 'pack', 'jumlah_stok' => 60,  'stok_minimum' => 20, 'harga_jual' => 22000, 'harga_beli' => 17000, 'berat_ukuran' => '200 gram', 'lokasi_simpan' => 'Rak B-2', 'deskripsi' => 'Bakso urat sapi asli'],
            ['nama_barang' => 'Edamame beku',         'kategori_id' => 4, 'satuan' => 'pack', 'jumlah_stok' => 0,   'stok_minimum' => 20, 'harga_jual' => 18000, 'harga_beli' => 13000, 'berat_ukuran' => '400 gram', 'lokasi_simpan' => 'Rak D-1', 'deskripsi' => 'Edamame beku siap rebus'],
            ['nama_barang' => 'Ayam katsu',           'kategori_id' => 1, 'satuan' => 'pcs',  'jumlah_stok' => 10,  'stok_minimum' => 20, 'harga_jual' => 32000, 'harga_beli' => 25000, 'berat_ukuran' => '450 gram', 'lokasi_simpan' => 'Rak A-2', 'deskripsi' => 'Ayam katsu beku siap goreng'],
            ['nama_barang' => 'Udang tempura',        'kategori_id' => 3, 'satuan' => 'pack', 'jumlah_stok' => 25,  'stok_minimum' => 20, 'harga_jual' => 55000, 'harga_beli' => 45000, 'berat_ukuran' => '300 gram', 'lokasi_simpan' => 'Rak C-2', 'deskripsi' => 'Udang tempura beku isi 8pcs'],
            ['nama_barang' => 'Kentang goreng beku',  'kategori_id' => 5, 'satuan' => 'pack', 'jumlah_stok' => 40,  'stok_minimum' => 20, 'harga_jual' => 25000, 'harga_beli' => 19000, 'berat_ukuran' => '1 kg',    'lokasi_simpan' => 'Rak E-1', 'deskripsi' => 'Kentang goreng beku siap saji'],
        ];

        foreach ($barangs as $b) {
            Barang::create($b);
        }
    }
}
