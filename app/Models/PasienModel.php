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
