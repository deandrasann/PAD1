<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResepObatModel extends Model
{
    use HasFactory;

    protected $dates = ['deleted_at'];

    protected $table = 'resep_obat';
    // nama PK
    protected $primaryKey = 'id_resep_obat';
    // PK integer AI
    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'no_resep',
        'id_obat_racikan',
        'id_obat_non_racikan',
        'jenis_obat'
    ];

    public function obatRacikan()
    {
        return $this->hasMany(ObatRacikanModel::class, 'id_obat_racikan', 'id_obat_racikan');
    }

    public function obatNonRacikan()
    {
        return $this->hasMany(obatNonRacikanModel::class, 'id_obat_non_racikan', 'id_obat_non_racikan');
    }
}
