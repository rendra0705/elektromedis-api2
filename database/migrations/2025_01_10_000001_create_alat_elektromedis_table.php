<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alat_elektromedis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_alat', 100);
            $table->string('merk', 100);
            $table->year('tahun_pembuatan');
            $table->string('nomor_seri', 50)->unique();
            $table->enum('kondisi', ['Baik', 'Rusak Ringan', 'Rusak Berat'])->default('Baik');
            $table->enum('status', ['Aktif', 'Nonaktif', 'Maintenance'])->default('Aktif');
            $table->string('lokasi', 150);
            $table->date('tanggal_kalibrasi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alat_elektromedis');
    }
};
