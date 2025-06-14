<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PemeriksaanModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'pemeriksaan_akhir';
    // nama PK
    protected $primaryKey = 'id_pemeriksaan_akhir';
    // PK integer AI
    public $incrementing = true;

    protected $fillable = [
        'id_pemeriksaan_awal',
        'id_dokter',
        'id_pasien',
        'anamnesa',
        'diagnosis',
        'golongan_darah',
        'berat_badan',
        'tinggi_badan',
        'merokok',
        'hamil_menyusui',
        'keluhan_awal',
        'suhu_tubuh',
        'nadi',
        'sistole',
        'diastole',
        'pernapasan',
        'status_pemeriksaan',
        'medikamentosa',
        'non_medikamentosa',
        'kode_icd',
    ];

    protected $casts = [
        'kode_icd' => 'array',
    ];
}
