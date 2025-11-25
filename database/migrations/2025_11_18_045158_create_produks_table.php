<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->foreignId('id_kategori');
            $table->string('nama_produk');
            $table->string('slug_produk');

            $table->string('sku')->nullable();
            $table->string('brand')->nullable();

            $table->double('harga')->default(0);
            $table->integer('stok')->default(0);
            $table->string('satuan')->nullable();

            $table->longText('deskripsi')->nullable();

            $table->text('disk')->nullable();
            $table->text('folder')->nullable();
            $table->text('filename')->nullable();
            $table->text('path')->nullable();

            $table->boolean('published')->default(false);

            $table->foreignId('id_creator');
            $table->string('nama_creator');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
