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
        Schema::create('icdtable', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';

            $table->integer('id_icd', true); // Primary key
            $table->string('kode_icd', 20)->unique(); // Contoh: "1A00"
            $table->string('judul')->nullable(); // Judul singkat diagnosis
            $table->text('deskripsi')->nullable(); // Penjelasan diagnosis
            $table->string('kategori')->nullable(); // Kelompok ICD (opsional)
            $table->string('subkategori')->nullable(); // Sub-kelompok (opsional)
            $table->string('versi')->default('2019'); // Versi ICD

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('icdtable');
    }
};
