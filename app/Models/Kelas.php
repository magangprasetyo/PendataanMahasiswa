<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'kelas';

    // Kolom primary key di tabel
    protected $primaryKey = 'id';

    // Kolom yang dapat diisi (mass-assignable)
    protected $fillable = [
        'nama',      // ID pengguna yang terhubung
        'jumlah', // Kode kaprodi
    ];

    // Nonaktifkan penggunaan timestamps otomatis (created_at & updated_at) jika tidak digunakan
    public $timestamps = true;  

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, 'kelas_id', 'id'); // Relasi ke tabel Mahasiswa
    }
    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'kelas_id', 'id'); // Relasi ke tabel Dosen
    }
}
