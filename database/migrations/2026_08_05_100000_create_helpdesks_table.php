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
        Schema::create('helpdesks', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nip', 18);
            $table->string('nik', 16);
            $table->string('unit_kerja');
            $table->text('keterangan');
            $table->enum('status', ['Baru', 'Sudah Direspons', 'Selesai'])->default('Baru');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('helpdesks');
    }
};
