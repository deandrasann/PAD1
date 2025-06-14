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
        Schema::create('obat_racikan', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';

            $table->integer('id_obat_racikan', true);
            $table->integer('id_dokter');
            $table->integer('id_pasien');
            $table->integer('id_pemeriksaan_akhir');
            $table->string('nama_racikan')->nullable();
            $table->string('bentuk_obat')->nullable();       // dari table obat
            $table->string('kemasan_obat')->nullable();      // dari table obat
            $table->string('instruksi_pemakaian')->nullable();
            $table->string('instruksi_racikan')->nullable();
            $table->integer('jumlah_kemasan')->nullable();
            $table->integer('takaran_obat')->nullable();
            $table->string('dosis')->nullable();             // contoh: '3x1'

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_dokter')
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
                ->foreign('id_pemeriksaan_akhir')
                ->references('id_pemeriksaan_akhir')
                ->on('pemeriksaan_akhir')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('obat_racikan');
    }
};
