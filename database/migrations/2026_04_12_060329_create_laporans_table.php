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
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->string('classification');
            $table->string('judul');
            $table->text('isi');
            $table->date('tanggal');
            $table->string('lokasi');
            $table->string('instansi')->nullable();
            $table->string('kategori')->nullable();
            $table->string('lampiran')->nullable();
            $table->boolean('anonim')->default(false);
            $table->boolean('rahasia')->default(false);
            $table->enum('status', ['belum_diproses', 'proses', 'selesai'])->default('belum_diproses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
