<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatMinumObatModel extends Model
{
    use HasFactory;

    protected $table = 'riwayat_minum_obat';
    // nama PK
    protected $primaryKey = 'id_riwayat';
    // agar timestamps tidak otomatis masuk
    public $timestamps = false;
    // PK integer AI
    public $incrementing = true;

    protected $fillable = [
        'id_pasien',
        'kode_obat',
        'jenis_obat',
        'nama_obat',
        'aturan_pakai',
        'waktu_minum_obat',
        'tanggal_minum',
        'jam_minum',
        'notifikasi',
        'status',
    ];

}
