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
        Schema::create('pengajuan_dokumens', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('id_pengajuan');
            $table->string('kode_jenis_dokumen');
            $table->string('nama_jenis_dokumen');

            $table->text('disk')->nullable();
            $table->text('folder')->nullable();
            $table->text('filename')->nullable();
            $table->text('path')->nullable();

            $table->boolean('status_verifikasi')->default(false);
            $table->foreignId('id_verifikator')->nullable();
            $table->string('nama_verifikator')->nullable();

            $table->boolean('status_validasi')->default(false);
            $table->foreignId('id_validator')->nullable();
            $table->string('nama_validator')->nullable();

            $table->foreignId('id_creator')->nullable();
            $table->string('nama_creator')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_dokumens');
    }
};
