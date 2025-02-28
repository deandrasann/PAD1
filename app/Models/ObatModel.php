<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ObatModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];  

    protected $table = 'obat';
    // nama PK
    protected $primaryKey = 'kode_obat';
    // PK integer AI
    public $incrementing = true;

    protected $fillable = [
        'id_apoteker',
        'id_pasien',
        'nama_obat',
        'takaran_minum',
        'jml_kali_minum',
        'bentuk_obat',
        'aturan_pakai',
        'golongan_obat',
        'jumlah_obat',
        'waktu_minum',
        'keterangan',
        'kontraindikasi',
        'pola_makan',
        'interaksi_obat',
        'petunjuk_penyimpanan',
        'kekuatan_sediaan',
        'informasi_tambahan',
        'efek_samping',
        'indikasi',
        'status_ketersediaan_obat',
    ];
    
}
