<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;
    
      // Nama tabel di database
      protected $table = 'dosen';

      // Kolom primary key di tabel
      protected $primaryKey = 'id';
      
    protected $fillable = [
        'user_id',      // ID pengguna yang terhubung
        'kelas_id', // Kode kaprodi
        'kode_dosen',          // Nomor Induk Pegawai
        'nip',         // Nama dosen
        'nama', 
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
}
