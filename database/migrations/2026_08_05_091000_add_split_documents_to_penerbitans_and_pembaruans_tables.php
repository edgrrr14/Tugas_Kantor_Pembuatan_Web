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
        Schema::table('penerbitans', function (Blueprint $table) {
            if (!Schema::hasColumn('penerbitans', 'surat_permohonan')) {
                $table->string('surat_permohonan')->nullable()->after('alasan');
            }
            if (!Schema::hasColumn('penerbitans', 'surat_rekomendasi')) {
                $table->string('surat_rekomendasi')->nullable()->after('surat_permohonan');
            }
            if (!Schema::hasColumn('penerbitans', 'foto_ktp')) {
                $table->string('foto_ktp')->nullable()->after('surat_rekomendasi');
            }
        });

        Schema::table('pembaruans', function (Blueprint $table) {
            if (!Schema::hasColumn('pembaruans', 'surat_permohonan')) {
                $table->string('surat_permohonan')->nullable()->after('instansi');
            }
            if (!Schema::hasColumn('pembaruans', 'surat_rekomendasi')) {
                $table->string('surat_rekomendasi')->nullable()->after('surat_permohonan');
            }
            if (!Schema::hasColumn('pembaruans', 'foto_ktp')) {
                $table->string('foto_ktp')->nullable()->after('surat_rekomendasi');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penerbitans', function (Blueprint $table) {
            if (Schema::hasColumn('penerbitans', 'surat_permohonan')) {
                $table->dropColumn('surat_permohonan');
            }
            if (Schema::hasColumn('penerbitans', 'surat_rekomendasi')) {
                $table->dropColumn('surat_permohonan_rekomendasi');
            }
            if (Schema::hasColumn('penerbitans', 'foto_ktp')) {
                $table->dropColumn('foto_ktp');
            }
        });

        Schema::table('pembaruans', function (Blueprint $table) {
            if (Schema::hasColumn('pembaruans', 'surat_permohonan')) {
                $table->dropColumn('surat_permohonan');
            }
            if (Schema::hasColumn('pembaruans', 'foto_ktp')) {
                $table->dropColumn('foto_ktp');
            }
        });
    }
};
