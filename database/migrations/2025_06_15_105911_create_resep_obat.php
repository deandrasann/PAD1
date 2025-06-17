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
        Schema::create('resep_obat', function (Blueprint $table) {
            $table->integer('id_resep_obat',true);
            $table->integer('no_resep');
            $table->integer('id_obat_racikan')->nullable();
            $table->integer('id_obat_non_racikan')->nullable();
            $table->enum('jenis_obat', ['racikan ', 'non_racikan'])->nullable();

            $table
            ->foreign('no_resep')
            ->references('no_resep')
            ->on('resep')
            ->cascadeOnUpdate()
            ->cascadeOnDelete();

             $table
            ->foreign('id_obat_racikan')
            ->references('id_obat_racikan')
            ->on('obat_racikan')
            ->cascadeOnUpdate()
            ->cascadeOnDelete();

             $table
            ->foreign('id_obat_non_racikan')
            ->references('id_obat_non_racikan')
            ->on('obat_non_racikan')
            ->cascadeOnUpdate()
            ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resep_obat');
    }
};
