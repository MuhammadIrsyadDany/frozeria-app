<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang', 150);
            $table->foreignId('kategori_id')->nullable()->constrained('kategoris')->nullOnDelete();
            $table->string('satuan', 50);
            $table->integer('jumlah_stok')->default(0);
            $table->integer('stok_minimum')->nullable()->default(20);
            $table->decimal('harga_jual', 12, 2)->default(0);
            $table->decimal('harga_beli', 12, 2)->nullable();
            $table->string('berat_ukuran', 100)->nullable();
            $table->string('lokasi_simpan', 100)->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('foto', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
