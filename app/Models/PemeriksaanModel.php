<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemeriksaanModel extends Model
{
    use HasFactory;

    protected $table = 'pemeriksaan';
    // nama PK
    protected $primaryKey = 'no_antrian';
    // agar timestamps tidak otomatis masuk
    public $timestamps = false;
    // PK integer AI
    public $incrementing = true;

}
