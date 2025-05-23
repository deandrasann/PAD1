<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PemeriksaanModel extends Model
{
    use HasFactory;    
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'pemeriksaan';
    // nama PK
    protected $primaryKey = 'no_antrian';
    // agar timestamps tidak otomatis masuk
    public $timestamps = false;
    // PK integer AI
    public $incrementing = true;

}
