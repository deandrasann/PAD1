<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PemeriksaanAwalModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'pemeriksaan_awal';
    // nama PK
    protected $primaryKey = 'id_pemeriksaan_awal';
    // PK integer AI
    public $incrementing = true;

    protected $fillable = [
        'id_pasien',
        'tanggal_pemeriksaan',
        'berat_badan',
        'tinggi_badan',
        'golongan_darah',
        'suhu_tubuh',
        'nadi',
        'sistole',
        'diastole',
        'pernapasan',
        'merokok',
        'hamil/menyusui',
        'keluhan_awal',
        'ket_alergi_obat',
    ];
}
