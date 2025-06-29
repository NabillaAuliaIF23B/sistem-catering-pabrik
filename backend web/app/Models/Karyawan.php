<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
class Karyawan extends Model
{
    use HasFactory;
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'karyawan';
    protected $primaryKey = 'id_karyawan';

    protected $fillable = [
        'foto',
        'username',
        'email',
        'nama',
        'password',
        'role',
        'tanggal_masuk',
        'status', // tambahkan jika memang ada kolom ini di database
    ];

    protected $hidden = [
        'password',
    ];

    // Otomatis hash password saat di-set
    public function setPasswordAttribute($value)
    {
        if ($value) {
            $this->attributes['password'] = bcrypt($value);
        }
    }
    
    
}
