<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Primary key untuk tabel products
            $table->string('name');
            $table->foreignId('category_id') // Kolom untuk relasi ke tabel categories
                ->constrained('kategoris') // Tabel tujuan relasi
                ->cascadeOnDelete(); // Hapus produk jika kategori terkait dihapus
            $table->decimal('price', 10, 2)->nullable(); // Harga tanpa varian
            $table->integer('stock')->nullable(); // Stok tanpa varian
            $table->string('description')->nullable();
            $table->boolean('status')->default(true);
            $table->json('images')->nullable(); // Multiple images
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
}
