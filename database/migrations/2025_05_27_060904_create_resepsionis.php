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
        Schema::create('resepsionis', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
            $table->integer('id_resepsionis',true);
            $table->integer('id_pengguna');
            $table->string('nama_resepsionis');
            $table->string('email');
            $table->string('foto')->nullable();

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
        Schema::dropIfExists('resepsionis');
    }
};
