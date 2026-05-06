<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategoris = [
            ['nama_kategori' => 'Ayam',    'deskripsi' => 'Produk berbahan dasar ayam beku'],
            ['nama_kategori' => 'Sapi',    'deskripsi' => 'Produk berbahan dasar sapi beku'],
            ['nama_kategori' => 'Seafood', 'deskripsi' => 'Produk olahan laut beku'],
            ['nama_kategori' => 'Sayuran', 'deskripsi' => 'Sayuran beku siap masak'],
            ['nama_kategori' => 'Siap Saji', 'deskripsi' => 'Makanan beku siap saji'],
        ];

        foreach ($kategoris as $k) {
            Kategori::create($k);
        }
    }
}
