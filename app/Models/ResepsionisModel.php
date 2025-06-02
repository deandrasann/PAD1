<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResepsionisModel extends Model
{
    use HasFactory;

    protected $table = 'resepsionis';
    // nama PK
    protected $primaryKey = 'id_resepsionis';
    // agar timestamps tidak otomatis masuk
    public $timestamps = false;
    // PK integer AI
    public $incrementing = true;

    protected $fillable = [
        'id_pengguna',
        'nama_resepsionis',
        'email',
        'foto',
    ];
    
    public function apoteker() {
        return $this->belongsTo(User::class, 'id_pengguna','id_pengguna');
    }
}
