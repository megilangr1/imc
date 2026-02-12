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
        Schema::create('penjualans', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();

            $table->string('nomor_nota');

            $table->string('nama_pekerjaan');
            $table->string('tempat_pekerjaan');
            $table->date('tanggal_pekerjaan');
            $table->string('pemilik_pekerjaan');
            $table->string('tanda_terima_pekerjaan');

            $table->decimal('total_nominal', 15, 2)->default(0);

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
        Schema::dropIfExists('penjualans');
    }
};
