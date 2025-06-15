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
        Schema::create('obat_non_racikan', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';

            $table->integer('id_obat_non_racikan', true);
            $table->integer('id_dokter')->nullable();
            $table->integer('id_pasien')->nullable();
            $table->integer('id_pemeriksaan_akhir')->nullable();
            $table->string('nama_obat')->nullable();
            $table->string('jml_obat')->nullable();
            $table->string('bentuk_obat')->nullable();
            $table->string('harga_satuan')->nullable();
            $table->string('harga_total')->nullable();
            $table->string('signatura')->nullable();
            $table->string('signatura_label')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_dokter')
                ->references('id_dokter')
                ->on('dokter')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreign('id_pasien')
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
        Schema::dropIfExists('obat_non_racikan');
    }
};
