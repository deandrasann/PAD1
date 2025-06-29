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
            //table resep 
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
            $table->integer('no_resep',true);
            $table->integer('id_pemeriksaan_akhir');
            $table->integer('id_dokter');
            $table->integer('id_pasien');
            $table->integer('kode_obat')->nullable();
            $table->enum('status_resep', ['setuju ', 'deleted'])->default('setuju')->nullable();
            $table->string('tgl_resep')->nullable();
            $table->string('dosis')->nullable();
            $table->string('jadwal_minum_obat')->nullable();
            $table->enum('status_pengobatan', ['Proses Pengobatan ', 'Pengobatan Selesai'])->default('Proses Pengobatan')->nullable();
            // $table->string('harga_satuan')->nullable();
            $table->timestamps();
            $table->softDeletes();


            $table
            ->foreign('id_pemeriksaan_akhir')
            ->references('id_pemeriksaan_akhir')
            ->on('pemeriksaan_akhir')
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
