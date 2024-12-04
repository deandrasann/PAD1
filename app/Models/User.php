<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

     protected $table = 'users';
     protected $primaryKey = 'id_pengguna';

    protected $fillable = [
        'id_role',
        'nama_role',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
        ];
    }

    public function level_user() {
        return $this->belongsTo(AdminModel::class, 'id_pengguna','id_pengguna');
    }
    public function dokter() {
        return $this->belongsTo(DokterModel::class, 'id_pengguna','id_pengguna');
    }
    public function apoteker() {
        return $this->belongsTo(ApotekerModel::class, 'id_pengguna','id_pengguna');
    }
    public function pengawas() {
        return $this->belongsTo(PengawasModel::class, 'id_pengguna','id_pengguna');
    }
    public function pasien() {
        return $this->belongsTo(PasienModel::class, 'id_pengguna','id_pengguna');
    }
}
