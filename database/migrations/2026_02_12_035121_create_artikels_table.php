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
        Schema::create('artikels', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->string('judul');
            $table->string('slug');
            $table->string('desc');

            $table->longText('content')->nullable();

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
        Schema::dropIfExists('artikels');
    }
};
