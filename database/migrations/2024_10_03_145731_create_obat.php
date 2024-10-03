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
            $table->string('nama_obat');
            $table->string('takaran_minum');
            $table->string('jml_kali_minum');
            $table->string('bentuk_obat');
            $table->string('aturan_pakai');
            $table->string('jumlah_obat');
            $table->string('waktu_minum');
            $table->text('keterangan');
            $table->string('kontraindikasi');
            $table->string('pola_makan');
            $table->string('interaksi_obat');
            $table->string('petunjuk_penyimpanan');
            $table->string('kekuatan_sediaan');
            $table->string('informasi_tambahan');
            $table->string('efek_samping');
            $table->string('indikasi');

            $table
            ->foreign('id_apoteker')
            ->references('id_apoteker')
            ->on('apoteker')
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
