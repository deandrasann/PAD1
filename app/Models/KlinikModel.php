<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KlinikModel extends Model
{
    use HasFactory;

    protected $table = 'klinik';
    // nama PK
    protected $primaryKey = 'id_klinik';
    // agar timestamps tidak otomatis masuk
    public $timestamps = false;
    // PK integer AI
    public $incrementing = true;

}
