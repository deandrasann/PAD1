<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResepModel extends Model
{
    use HasFactory;

    protected $table = 'resep';
    // nama PK
    protected $primaryKey = 'no_resep';
    // agar timestamps tidak otomatis masuk
    public $timestamps = false;
    // PK integer AI
    public $incrementing = true;

    protected $fillable = [
        'no_antrian',
        'id_dokter',
        'id_pasien',
        'kode_obat',
        'tgl_resep',
        'total_harga',
        'status_resep'
    ];

}
