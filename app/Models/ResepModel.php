<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResepModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'resep';
    // nama PK
    protected $primaryKey = 'no_resep';
    // agar timestamps tidak otomatis masuk
    public $timestamps = false;
    // PK integer AI
    public $incrementing = true;

    protected $fillable = [
        'id_pemeriksaan_akhir',
        'id_dokter',
        'id_pasien',
        'kode_obat',
        'tgl_resep',
        'status_resep',
        'status_diserahkan',
        'dosis',
        'jadwal_minum_obat',
    ];

}
