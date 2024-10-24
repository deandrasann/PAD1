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

    // protected $fillable = 'id_pasien';

    public function pasien() {
        return $this->belongsTo(User::class, 'id_pengguna','id_pengguna');
    }
}
