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
        Schema::create('booking', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hewan_id')->constrained('hewan')->onDelete('cascade');
            $table->foreignId('layanan_id')->constrained('layanan');
            $table->date('tanggal_masuk');
            $table->date('tanggal_keluar')->nullable();
            $table->enum('status', ['menunggu', 'diterima', 'ditolak', 'diproses', 'selesai'])->default('menunggu');
            $table->text('alasan_penolakan')->nullable();
            $table->dateTime('estimasi_selesai')->nullable();
            $table->string('foto_before')->nullable();
            $table->string('foto_after')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking');
    }
};
