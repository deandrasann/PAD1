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
        Schema::create('obat', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
            $table->integer('kode_obat',true);
            $table->integer('id_apoteker');
            $table->integer('id_pasien')->nullable();
            $table->string('nama_obat')->nullable();
            $table->string('takaran_minum')->nullable();
            $table->string('jml_kali_minum')->nullable();
            $table->string('bentuk_obat')->nullable();
            $table->string('aturan_pakai')->nullable();
            $table->string('golongan_obat')->nullable();
            $table->string('jumlah_obat')->nullable();
            $table->string('waktu_minum')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('kontraindikasi')->nullable();
            $table->string('pola_makan')->nullable();
            $table->string('interaksi_obat')->nullable();
            $table->string('petunjuk_penyimpanan')->nullable();
            $table->integer('kekuatan_sediaan')->nullable();
            $table->string('informasi_tambahan')->nullable();
            $table->string('efek_samping')->nullable();
            $table->string('indikasi')->nullable();

            $table
            ->foreign('id_apoteker')
            ->references('id_apoteker')
            ->on('apoteker')
            ->cascadeOnUpdate()
            ->cascadeOnDelete();

            $table
            ->foreign('id_pasien')
            ->references('id_pasien')
            ->on('pasien')
            ->cascadeOnUpdate()
            ->cascadeOnDelete();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('obat');
    }
};
