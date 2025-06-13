<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class obatRacikanModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'obat_racikan';
    protected $primaryKey = 'id_obat_racikan';
    public $incrementing = true;

    protected $fillable = [
        'id_dokter',
        'id_pasien',
        'id_pemeriksaan_akhir',
        'nama_racikan',
        'bentuk_obat',
        'kemasan_obat',
        'instruksi_pemakaian',
        'instruksi_racikan',
        'jumlah_kemasan',
        'takaran_obat',
        'dosis',
    ];
    public function dokter()
{
    return $this->belongsTo(DokterModel::class, 'id_dokter', 'id_dokter');
}
}
