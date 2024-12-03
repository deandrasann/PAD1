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
        Schema::create('detail_resep', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
            $table->integer('kode_detail_resep',true);
            $table->integer('no_resep');
            $table->integer('kode_obat');
            $table->integer('nama_obat');
            $table->integer('dosis');
            $table->integer('aturan_pakai');
            $table->integer('jumlah_resep');
            $table->integer('harga_satuan');


            $table
            ->foreign('no_resep')
            ->references('no_resep')
            ->on('resep')
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
        Schema::dropIfExists('obat');
    }
};
