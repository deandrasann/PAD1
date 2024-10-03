<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengawasModel extends Model
{
    use HasFactory;

    protected $table = 'pengawas';
    // nama PK
    protected $primaryKey = 'id_pengawas';
    // agar timestamps tidak otomatis masuk
    public $timestamps = false;
    // PK integer AI
    public $incrementing = true;

}
