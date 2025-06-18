<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokterModel extends Model
{
    use HasFactory;

    protected $table = 'dokter';
    // nama PK
    protected $primaryKey = 'id_dokter';
    // agar timestamps tidak otomatis masuk
    public $timestamps = false;
    // PK integer AI
    public $incrementing = true;

    protected $fillable = [
        'id_pengguna',
        'kode_klinik',
        'kode_dokter',
        'kode_bpjs',
        'jenis_dokter',
        'spesialis',
        'nama_dokter',
        'email',
        'foto',
    ];

    public function dokter() {
        return $this->belongsTo(User::class, 'id_pengguna','id_pengguna');
    }
}
