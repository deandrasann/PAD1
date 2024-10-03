<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApotekerModel extends Model
{
    use HasFactory;

    protected $table = 'apoteker';
    // nama PK
    protected $primaryKey = 'id_apoteker';
    // agar timestamps tidak otomatis masuk
    public $timestamps = false;
    // PK integer AI
    public $incrementing = true;

}
