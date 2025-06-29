<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class obatNonRacikanModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'obat_non_racikan';
    protected $primaryKey = 'id_obat_non_racikan';
    public $incrementing = true;

    protected $fillable = [
        'id_dokter',
        'id_pasien',
        'id_pemeriksaan_akhir',
        'kode_obat',
        'jml_obat',
        'bentuk_obat',
        'harga_satuan',
        'harga_total',
        'signatura',
        'signatura_label',
    ];

    public function dokter()
{
    return $this->belongsTo(DokterModel::class, 'id_dokter', 'id_dokter');
}
}
