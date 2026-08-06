<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('pembaruans', function (Blueprint $table) {
        $table->id();
        $table->string('nama_lengkap');
        $table->string('nik', 16);
        $table->string('nip', 18)->nullable();
        $table->string('email');
        $table->string('no_telepon')->nullable();
        $table->string('instansi');
        $table->string('jabatan')->nullable();
        $table->text('alasan')->nullable(); // Alasan permohonan pembaruan
        $table->string('surat_permohonan')->nullable(); // Path file Surat Permohonan
        $table->string('surat_rekomendasi')->nullable(); // Path file Surat Rekomendasi Unit Kerja
        $table->string('foto_ktp')->nullable(); // Path file Foto KTP
        $table->enum('status', ['Pending', 'Disetujui', 'Ditolak'])->default('Pending');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembaruans');
    }
};
