<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PasienModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'pasien';
    // nama PK
    protected $primaryKey = 'id_pasien';
    // PK integer AI
    public $incrementing = true;

    protected $fillable = [
        'nama',
        'no_rm',
        'nama',
        'id_pengguna',
        'alamat',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'kelurahan',
        'no_telp',
        'email',
    
    ];

    public function pasien() {
        return $this->belongsTo(User::class, 'id_pengguna','id_pengguna');
    }
}
