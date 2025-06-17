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
            $table->integer('id_pasien')->after('id_riwayat');
            $table->enum('jenis_obat', ['racikan ', 'non_racikan'])->after('kode_obat')->nullable();

            // Add foreign key constraint if needed
            $table->foreign('id_pasien')
                ->references('id_pasien')
                ->on('pasien')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('riwayat_minum_obat', function (Blueprint $table) {
            $table->dropForeign(['id_pasien']);
            $table->dropColumn('id_pasien');
            $table->dropColumn('jenis_obat');
        });
    }
};
