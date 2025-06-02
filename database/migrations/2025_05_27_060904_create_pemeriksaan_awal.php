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
        Schema::create('pemeriksaan_awal', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';

            $table->integer('id_pemeriksaan_awal', true); // Primary Key (auto increment)
            $table->integer('id_pasien');            // Foreign Key dari tabel pasien
            $table->integer('id_dokter');            // Foreign Key dari tabel pasien

            // Data Pemeriksaan
            $table->date('tanggal_pemeriksaan')->nullable();
            $table->string('golongan_darah')->nullable();       
            $table->integer('berat_badan')->nullable();         // Dalam KG
            $table->integer('tinggi_badan')->nullable();        // Dalam CM
            $table->decimal('suhu_tubuh', 5, 2)->nullable();    // Contoh: 36.5
            $table->integer('nadi')->nullable();               // bpm
            $table->integer('sistole')->nullable();            // mmHg
            $table->integer('diastole')->nullable();           // mmHg
            $table->integer('pernapasan')->nullable();         // rpm

            $table->enum('merokok', ['Ya', 'Tidak'])->nullable();
            $table->enum('hamil_menyusui', ['Hamil', 'Menyusui', 'Tidak Keduanya'])->nullable();

            $table->text('keluhan_awal')->nullable();
            $table->string('ket_alergi_obat')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // Relasi ke tabel pasien
            $table->foreign('id_pasien')
                ->references('id_pasien')
                ->on('pasien')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

                 // Relasi ke tabel dokter
            $table->foreign('id_dokter')
                ->references('id_dokter')
                ->on('dokter')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /** 
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaan_awal');
    }
};
