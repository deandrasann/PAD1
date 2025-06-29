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
        Schema::table('riwayat_minum_obat', function (Blueprint $table) {
            $table->string('tanggal_minum')->nullable();
            $table->string('jam_minum')->nullable()->after('tanggal_minum');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('riwayat_minum_obat', function (Blueprint $table) {
            $table->dropColumn(['tanggal_minum', 'jam_minum']);
        });
    }
};
