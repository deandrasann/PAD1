<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IcdModel extends Model
{
    use HasFactory;

     protected $table = 'icdtable';
    // nama PK
    protected $primaryKey = 'id_icd';

    protected $fillable = [
        'kode_icd',
        'judul',
        'deskripsi',
        'kategori',
        'subkategori',
        'versi',
    ];
}
