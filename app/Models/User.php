<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = "id"; // Pastikan primary key diatur dengan benar
    protected $fillable = [
        'username',  // Menambahkan field 'username'
        'email',
        'password',
        'role',  // Menambahkan field 'role'
    ];

    public function kaprodi()
    {
        return $this->hasOne(Kaprodi::class, 'user_id', 'id'); // Mengubah hasMany menjadi hasOne
    }
    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class, 'user_id', 'id'); // Relasi ke tabel Kaprodi
    }
    public function dosen()
    {
        return $this->hasOne(Dosen::class, 'user_id', 'id'); // Mengubah hasMany menjadi hasOne
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static $roles = [
        'kaprodi',
        'dosen',
        'mahasiswa',
    ];
}
    