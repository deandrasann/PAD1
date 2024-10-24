<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasienModel extends Model
{
    use HasFactory;

    protected $table = 'pasien';
    // nama PK
    protected $primaryKey = 'id_pasien';
    // agar timestamps tidak otomatis masuk
    public $timestamps = false;
    // PK integer AI
    public $incrementing = true;

    protected $fillable = [
        'nama_pasien',
        'no_rm',
        'nama',
        'alamat',
        'jenis_kelamin',
        'tanggal_lahir',
        'no_telp',
        'berat_badan',
    
    ];

    public function pasien() {
        return $this->belongsTo(User::class, 'id_pengguna','id_pengguna');
    }
}
