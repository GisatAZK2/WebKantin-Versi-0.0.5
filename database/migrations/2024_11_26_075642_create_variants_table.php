<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariantsTable extends Migration
{
    public function up()
    {
        Schema::create('variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->string('name'); // Nama varian
            $table->decimal('price', 10, 2); // Harga per varian
            $table->integer('stock'); // Stok per varian
            $table->string('image')->nullable(); // Gambar per varian
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('variants');
    }
}
