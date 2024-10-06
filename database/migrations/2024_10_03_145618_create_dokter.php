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
        Schema::create('dokter', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
            $table->integer('id_dokter',true);
            $table->integer('id_pengguna');
            $table->integer('kode_klinik');
            $table->integer('kode_dokter');
            $table->string('jenis_dokter');
            $table->string('spesialis');
            $table->string('nama_dokter');
            $table->integer('kode_bpjs');

            $table
            ->foreign('kode_klinik')
            ->references('id_klinik')
            ->on('klinik')
            ->cascadeOnUpdate()
            ->cascadeOnDelete();

            $table
            ->foreign('id_pengguna')
            ->references('id_pengguna')
            ->on('users')
            ->cascadeOnUpdate()
            ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokter');
    }
};
