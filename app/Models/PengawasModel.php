<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PengawasModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'pengawas';
    // nama PK
    protected $primaryKey = 'id_pengawas';
    // agar timestamps tidak otomatis masuk
    public $timestamps = false;
    // PK integer AI
    public $incrementing = true;

    protected $fillable = [
        'id_pengawas',
        'id_pengguna',
        'kode_klinik',
        'nama_pengawas',
        'email',
        'foto'
    ];

    public function pengawas() {
        return $this->belongsTo(User::class, 'id_pengguna','id_pengguna');
    }
}
