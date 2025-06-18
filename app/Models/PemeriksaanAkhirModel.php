<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PemeriksaanAkhirModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'pemeriksaan_akhir';
    // nama PK
    protected $primaryKey = 'id_pemeriksaan_akhir';
    // PK integer AI
    public $incrementing = true;

    public function dokter(){
        return $this->belongsTo(DokterModel::class, 'id_dokter', 'id_dokter');
    }
}
