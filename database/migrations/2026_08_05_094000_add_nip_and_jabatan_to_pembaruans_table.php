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
        Schema::table('pembaruans', function (Blueprint $table) {
            if (!Schema::hasColumn('pembaruans', 'nip')) {
                $table->string('nip', 18)->nullable()->after('nik');
            }
            if (!Schema::hasColumn('pembaruans', 'jabatan')) {
                $table->string('jabatan')->nullable()->after('instansi');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pembaruans', function (Blueprint $table) {
            if (Schema::hasColumn('pembaruans', 'nip')) {
                $table->dropColumn('nip');
            }
            if (Schema::hasColumn('pembaruans', 'jabatan')) {
                $table->dropColumn('jabatan');
            }
        });
    }
};
