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
    Schema::create('penerbitans', function (Blueprint $table) {
        $table->id();
        $table->string('nama_lengkap');
        $table->string('nik', 16);
        $table->string('nip', 18);
        $table->string('email');
        $table->string('no_telepon')->nullable();
        $table->string('instansi');
        $table->string('jabatan');
        $table->text('alasan')->nullable();
        $table->string('dokumen')->nullable(); // Path/nama file upload
        $table->enum('status', ['Pending', 'Disetujui', 'Ditolak'])->default('Pending');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penerbitans');
    }
};
