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
        Schema::create('pemeriksaan_akhir', function (Blueprint $table) {
            //pemeriksaan_akhir
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
            // $table->integer('no_antrian',true);
            $table->integer('id_pemeriksaan_akhir', true);
            $table->integer('id_pemeriksaan_awal')->nullable();
            $table->integer('id_dokter')->nullable();
            $table->integer('id_pasien')->nullable();
            // $table->string('kode_icd');
            $table->string('anamnesa')->nullable();
            $table->string('diagnosis')->nullable();
            $table->string('golongan_darah')->nullable();
            $table->integer('berat_badan')->nullable();
            $table->integer('tinggi_badan')->nullable();
            $table->json('kode_icd')->nullable(); // ubah dari string ke json
            // $table->date('tgl_diagnosa');
            $table->enum('merokok', ['Ya', 'Tidak'])->nullable();
            $table->enum('hamil_menyusui', ['Hamil', 'Menyusui', 'Tidak Keduanya'])->nullable();
            
            $table->text('keluhan_awal')->nullable();
            $table->decimal('suhu_tubuh', 5, 2)->nullable();    // Contoh: 36.5
            $table->integer('nadi')->nullable();               // bpm
            $table->integer('sistole')->nullable();            // mmHg
            $table->integer('diastole')->nullable();           // mmHg
            $table->integer('pernapasan')->nullable();         // rpm
            
            $table->enum('status_pemeriksaan', ['selesai', 'sedang berjalan', 'belum dipanggil'])->default('belum dipanggil')->nullable();
            $table->string('medikamentosa')->nullable();
            $table->string('non_medikamentosa')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table
                ->foreign('id_dokter')
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
                ->foreign('id_pemeriksaan_awal')
                ->references('id_pemeriksaan_awal')
                ->on('pemeriksaan_awal')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaan_akhir');
    }
};
