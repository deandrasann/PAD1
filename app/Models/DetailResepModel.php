<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailResepModel extends Model
{
    use HasFactory;

    protected $table = 'detail_resep';
    // nama PK
    protected $primaryKey = 'kode_resep';
    // agar timestamps tidak otomatis masuk
    public $timestamps = false;
    // PK integer AI
    public $incrementing = true;

    protected $fillable = [
        'no_resep',
        'kode_obat',
        'jumlah_resep',
        'total_harga',
    ];

}
