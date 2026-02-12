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
        Schema::create('penjualan_details', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->foreignId('id_penjualan');

            $table->string('item');
            $table->decimal('jumlah', 15, 2)->default(0);
            $table->decimal('harga', 15, 2)->default(0);

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
        Schema::dropIfExists('penjualan_details');
    }
};
