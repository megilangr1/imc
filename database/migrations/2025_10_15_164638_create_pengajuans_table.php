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
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('id_skpd');
            $table->string('kode_skpd');
            $table->string('nama_skpd');

            $table->string('kode_jenis_pengajuan');
            $table->string('nama_jenis_pengajuan');

            $table->string('kegiatan');
            $table->string('sub_kegiatan')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('kode_rekening_belanja')->nullable();
            $table->string('nama_rekening_belanja')->nullable();
            $table->string('sumber_dana')->nullable();
            $table->string('nomor_sp_spk')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('nomor_spm');
            $table->date('tanggal_spm');
            $table->double('nominal');
            $table->string('nama_pihak_ketiga')->nullable();
            $table->string('kualifikasi')->nullable();
            $table->string('nomor_rekening')->nullable();
            $table->string('nama_bank')->nullable();
            $table->string('jangka_kontrak')->nullable();
            $table->date('tanggal_mulai_pekerjaan')->nullable();
            $table->date('tanggal_selesai_pekerjaan')->nullable();

            $table->text('bpdp_filename')->nullable();
            $table->text('bpdp_disk')->nullable();
            $table->text('bpdp_folder')->nullable();
            $table->text('bpdp_path')->nullable();

            $table->tinyInteger('kode_bulan')->nullable();
            $table->string('nama_bulan')->nullable();
            $table->string('jenis_belanja')->nullable();
            $table->string('jenis_pembayaran')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('nip_pa_kpa')->nullable();
            $table->string('nama_pa_kpa')->nullable();
            $table->string('jabatan_pa_kpa')->nullable();
            $table->string('nip_ppk')->nullable();
            $table->string('nama_ppk')->nullable();
            $table->string('jabatan_ppk')->nullable();

            $table->tinyInteger('status')->default(0);
            $table->date('tanggal_pengajuan_verifikasi')->nullable();

            $table->date('tanggal_verifikasi')->nullable();
            $table->foreignId('id_verifikator')->nullable();
            $table->string('nama_verifikator')->nullable();
            $table->text('catatan_verifikator')->nullable();

            $table->date('tanggal_validasi')->nullable();
            $table->foreignId('id_validator')->nullable();
            $table->string('nama_validator')->nullable();
            $table->text('catatan_validator')->nullable();

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
        Schema::dropIfExists('pengajuans');
    }
};
