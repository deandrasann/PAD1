<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdminModel extends Model
{
    use HasFactory;

    protected $table = 'admin';
    // nama PK
    protected $primaryKey = 'id_admin';
    // agar timestamps tidak otomatis masuk
    public $timestamps = false;
    // PK integer AI
    public $incrementing = true;

    public function LevelUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_role', 'id_admin');
    }
}
