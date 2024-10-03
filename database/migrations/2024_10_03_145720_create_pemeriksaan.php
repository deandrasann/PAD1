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
        Schema::create('pemeriksaan', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
            $table->integer('no_antrian',true);
            $table->string('kode_icd');
            $table->string('anamnesa');
            $table->string('pemeriksaan_fisik');
            $table->string('jenis_diagnosa');
            $table->string('jenis_kasus');
            $table->date('tgl_diagnosa');
            $table->string('pemeriksaan_penunjang');
            $table->text('catatan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaan');
    }
};
