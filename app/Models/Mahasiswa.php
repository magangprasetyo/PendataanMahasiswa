<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'mahasiswa';

    // Kolom primary key di tabel
    protected $primaryKey = 'id';

    // Kolom yang dapat diisi (mass-assignable)
    protected $fillable = [
        'user_id',      // ID pengguna yang terhubung
        'kelas_id', // Kode kaprodi
        'nim',          // Nomor Induk Pegawai
        'nama',         // Nama dosen
        'tempat_lahir', 
        'tanggal_lahir', 
        'edit', 

    ];

    // Nonaktifkan penggunaan timestamps otomatis (created_at & updated_at) jika tidak digunakan
    public $timestamps = true;

    // Relasi ke tabel User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }
    public function permintaan()
    {
        return $this->hasMany(Permintaan::class, 'mahasiswa_id', 'id'); // Relasi ke model Permintaan
    }
}
