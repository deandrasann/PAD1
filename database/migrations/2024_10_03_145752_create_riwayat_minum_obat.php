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
        Schema::create('riwayat_minum_obat', function (Blueprint $table) {
            //table riwayat_minum_obat
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
            $table->integer('id_riwayat',true);
            $table->integer('kode_obat');
            $table->string('nama_obat');
            $table->string('aturan_pakai');
            $table->string('waktu_minum_obat')->nullable();
            $table->enum('status', ['sudah_minum', 'tidak_minum', 'tunda_minum'])->default('tidak_minum');
    
    
                $table
                ->foreign('kode_obat')
                ->references('kode_obat')
                ->on('obat')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_minum_obat');
    }
};
