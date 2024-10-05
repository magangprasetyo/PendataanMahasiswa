<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kaprodi extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'kaprodi';

    // Kolom primary key di tabel
    protected $primaryKey = 'id';

    // Kolom yang dapat diisi (mass-assignable)
    protected $fillable = [
        'user_id',      // ID pengguna yang terhubung
        'kode_kaprodi', // Kode kaprodi
        'nip',          // Nomor Induk Pegawai
        'nama',         // Nama dosen
    ];

    // Nonaktifkan penggunaan timestamps otomatis (created_at & updated_at) jika tidak digunakan
    public $timestamps = true;

    // Relasi ke tabel User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
