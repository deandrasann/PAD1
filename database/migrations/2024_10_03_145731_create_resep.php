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
        Schema::create('resep', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
            $table->integer('no_resep',true);
            $table->integer('no_antrian');
            $table->integer('id_dokter');
            $table->integer('id_pasien');
            $table->integer('kode_obat');
            $table->enum('status_resep', ['setuju ', 'deleted'])->default('setuju')->nullable();
            $table->date('tgl_resep');
            // $table->string('harga_satuan')->nullable();


            $table
            ->foreign('no_antrian')
            ->references('no_antrian')
            ->on('pemeriksaan')
            ->cascadeOnUpdate()
            ->cascadeOnDelete();

            $table
            ->foreign('id_dokter')
            ->references('id_dokter')
            ->on('dokter')
            ->cascadeOnUpdate()
            ->cascadeOnDelete();

            $table
            ->foreign('id_pasien')
            ->references('id_pasien')
            ->on('pasien')
            ->cascadeOnUpdate()
            ->cascadeOnDelete();

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
        Schema::dropIfExists('resep');
    }
};
