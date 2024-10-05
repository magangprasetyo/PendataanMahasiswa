<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Kaprodi;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\Permintaan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class TambahDataController extends Controller
{
     // Menyimpan data kaprodi baru
     public function tambah(Request $request)
     {
               // Validasi data yang diterima
               $request->validate([
                'user_id' => 'required|exists:users,id|unique:kaprodi,user_id',
                'kode_kaprodi' => 'required|integer|unique:kaprodi,kode_kaprodi',
                'nip' => 'required|integer|unique:kaprodi,nip',
                'name' => 'required|string|max:255',
            ]);
    
            // Buat data kaprodi baru
            $kaprodi = Kaprodi::create([
                'user_id' => $request->user_id,
                'kode_kaprodi' => $request->kode_kaprodi,
                'nip' => $request->nip,
                'name' => $request->name,
            ]);
    
            if ($kaprodi) {
                // Redirect setelah berhasil dengan pesan sukses
                return redirect()->route('dashboard')->with('success', 'Pendaftaran berhasil! Silakan login.');
            } else {
                // Redirect jika gagal dengan pesan gagal
                return redirect()->route('dashboard')->with('failed', 'Pendaftaran gagal, silakan coba lagi.');
            }
     }
     
     public function tambah_kaprodi(){
        return view('layout.tambah.tambah_kaprodi');
    }

    public function proses_tambah(Request $request)
{
    // Debugging: Tampilkan isi request
    Log::info($request->all());

    // Cek apakah pengguna sudah menambahkan data kaprodi
    if (Kaprodi::where('user_id', Auth::id())->exists()) {
        return redirect()->back()->with('error', 'Anda sudah menambahkan data kaprodi sebelumnya.');
    }

    // Validasi input
    $request->validate([
        'kode_kaprodi' => 'required|unique:kaprodi,kode_kaprodi',
        'nip' => 'required|unique:kaprodi,nip',
        'nama' => 'required|string|max:255',
    ]);

    // Simpan data ke dalam tabel kaprodi
    $kaprodi = Kaprodi::create([
        'user_id' => Auth::id(),
        'kode_kaprodi' => $request->kode_kaprodi,
        'nip' => $request->nip,
        'nama' => $request->nama,
    ]);

    // Debugging: Cek apakah data berhasil disimpan
    Log::info('Kaprodi created: ', $kaprodi->toArray());

    // Redirect atau tampilkan pesan sukses
    return redirect()->route('kaprodi')->with('success', 'Data kaprodi berhasil ditambahkan.');
}

public function proses(Request $request)
{
    // Validasi input
    $request->validate([
        'kelas_id' => 'required|exists:kelas,id', // kelas_id harus valid
        'nim' => 'required|unique:mahasiswa,nim', // nim harus unik
        'nama' => 'required|string|max:255',
        'tempat_lahir' => 'required|string|max:255',
        'tanggal_lahir' => 'required|date',
    ]);

    // Log nilai input
    Log::info('Input data:', $request->all());

    // Ambil kelas yang dipilih
    $kelas = Kelas::find($request->kelas_id);

    // Hitung jumlah mahasiswa yang terdaftar di kelas tersebut
    $jumlahMahasiswaDiKelas = Mahasiswa::where('kelas_id', $kelas->id)->count();

    // Cek apakah jumlah mahasiswa di kelas sudah mencapai kapasitas
    if ($jumlahMahasiswaDiKelas >= $kelas->jumlah) {
        return redirect()->route('tambah_mahasiswa')->with('error', 'Jumlah mahasiswa di kelas ' . $kelas->nama . ' sudah mencapai batas maksimum.');
    }

    // Simpan data ke dalam tabel mahasiswa
    $mahasiswa = Mahasiswa::create([
        'user_id' => Auth::id(), // User ID dari pengguna yang login
        'kelas_id' => $request->kelas_id,
        'nim' => $request->nim,
        'nama' => $request->nama,
        'tempat_lahir' => $request->tempat_lahir,
        'tanggal_lahir' => $request->tanggal_lahir,
    ]);

    // Cek apakah mahasiswa berhasil disimpan
    Log::info('Mahasiswa created:', $mahasiswa->toArray());

    // Redirect atau tampilkan pesan sukses
    return redirect()->route('mahasiswa')->with('success', 'Data mahasiswa berhasil ditambahkan.');
}



 // Menyimpan kelas baru ke dalam database
 public function tambah_kelas(Request $request)
 {
     // Validasi input
     $request->validate([
         'nama' => 'required|string|max:255',
         'jumlah' => 'nullable|string',
     ]);

     // Simpan data kelas ke dalam tabel kelas
     Kelas::create([
         'nama' => $request->nama,
         'jumlah' => $request->jumlah,
     ]);

     // Redirect atau tampilkan pesan sukses
     return redirect()->route('data_kelas')->with('success', 'Kelas berhasil ditambahkan.');
 }

  public function hapus_kelas($id)
    {
        // Temukan data dosen berdasarkan ID
        $kelas = Kelas::findOrFail($id);

        // Hapus data dosen
        $kelas->delete();

        // Redirect kembali ke halaman dosen dengan pesan sukses
        return redirect()->route('data_kelas')->with('success', 'Data dosen berhasil dihapus.');
    }

 public function tambah_mahasiswa(){

    $tambah_kelas = Kelas::all(); // Ambil semua kelas
    return view('layout.tambah.tambah_mahasiswa', compact('tambah_kelas'));
    // return view('layout.tambah.tambah_kelas');
}

public function tambah_dosen(){

    $tambah_kelas = Kelas::all(); // Ambil semua kelas
    return view('layout.tambah.tambah_dosen', compact('tambah_kelas'));
    // return view('layout.tambah.tambah_kelas');
}
public function view_kelas()
{
    $tambah_kelas = Kelas::all(); // Ambil semua kelas
    return view('component.tambah_-mahasiswa', 'components.tambah_-dosen', compact('tambah_kelas'));
}

    public function proses_dosen(Request $request)
{
    // Validasi input
    $validatedData = $request->validate([
        'username' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string',
        'kode_dosen' => 'required|string|unique:dosen,kode_dosen',
        'kelas_id' => 'exists:kelas,id',
        'nip' => 'required|string|max:255',
        'name' => 'required|string|max:255',
        'role' => 'required|string|in:dosen',
    ]);

    // Buat user
    $user = User::create([
        'username' => $validatedData['username'],
        'email' => $validatedData['email'],
        'password' => Hash::make($validatedData['password']),
        'role' => $validatedData['role'],
    ]);

    // Buat mahasiswa
    Dosen::create([
        'user_id' => $user->id,
        'kelas_id' => $validatedData['kelas_id'] ?? null, // Jika kelas_id kosong, set null
        'kode_dosen' => $validatedData['kode_dosen'],
        'nip' => $validatedData['nip'],
        'nama' => $validatedData['name'],
    ]);

    // Redirect dengan pesan sukses
    return redirect()->route('dosen')->with('success', 'Data mahasiswa berhasil ditambahkan.');

}


    public function dosen_tampilan(){
        // Ambil semua data dari tabel dosen
        $tampilan_dosen = Dosen::all();
        // Kirim data ke view 'components.dosen'
        return view('components.dosen', compact('tampilan_dosen'));
    }

    // Method untuk menghapus data mahasiswa
    public function hapus_mahasiswa($id)
    {
        // Temukan data dosen berdasarkan ID
        $mahasiswa = Mahasiswa::findOrFail($id);
        
        // Jika mahasiswa memiliki user terkait, hapus juga data user-nya
        if ($mahasiswa->user) { // Pastikan relasi sudah ada di model Dosen
            $mahasiswa->user->delete(); // Hapus pengguna terkait
        }

        // Hapus data mahasiswa
        $mahasiswa->delete();

        // Redirect kembali ke halaman mahasiswa dengan pesan sukses
        return redirect()->route('mahasiswa')->with('success', 'Data mahasiswa berhasil dihapus.');
    }
    // Method untuk menampilkan form edit mahasiswa
    public function edit($id)
    {
        // Temukan data mahasiswa berdasarkan ID
        $mahasiswa = Mahasiswa::findOrFail($id);
        $tambah_kelas = Kelas::all(); // Mengambil semua data kelas
        // Kirim data mahasiswa ke view edit
        return view('components.edit_-mahasiswa', compact('mahasiswa', 'tambah_kelas'));
    }

    // Method untuk menyimpan perubahan (update) data mahasiswa
    public function edit_mahasiswa(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'kelas_id' => 'required',
        ]);
    
        // Temukan data mahasiswa berdasarkan ID
        $mahasiswa = Mahasiswa::findOrFail($id);
    
        // Update data mahasiswa, kecualikan user_id
        $mahasiswa->update($request->except('user_id'));
    
        // Cek apakah pengguna yang login adalah mahasiswa
        if (Auth::user()->role === 'mahasiswa') {
            // Jika mahasiswa, ubah nilai edit menjadi false
            $mahasiswa->edit = false;
            $mahasiswa->save();
        }
    
        // Redirect kembali dengan pesan sukses
        return redirect()->route('mahasiswa')->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    public function edit_kelas($id)
    {
        // Temukan kelas berdasarkan ID
        $kelas = Kelas::findOrFail($id);
        
        // Tampilkan view dengan data kelas
        return view('components.edit_-kelas', compact('kelas'));
    }
    
    // Method untuk mengupdate data kelas
    public function update_kelas(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'jumlah' => 'required|integer',
        ]);

        // Temukan kelas berdasarkan ID
        $kelas = Kelas::findOrFail($id);

        // Update data kelas
        $kelas->update([
            'nama' => $request->nama,
            'jumlah' => $request->jumlah,
        ]);

        // Redirect kembali ke halaman kelas dengan pesan sukses
        return redirect()->route('data_kelas')->with('success', 'Data kelas berhasil diupdate.');
    }
    //menampilkan data kaprodi bedasarkan id
    public function edit_kaprodi($id)
    {
        // Temukan kelas berdasarkan ID
        $kaprodi = Kaprodi::findOrFail($id);
        
        // Tampilkan view dengan data kelas
        return view('components.edit_-kaprodi', compact('kaprodi'));
    }
    //gungsi mengubah data kaprodi
    public function update_kaprodi(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'kode_kaprodi' => 'required|string|max:255',
            'nip' => 'required|integer',
            'nama' => 'required|string|max:255',
        ]);

        // Temukan kaprodi berdasarkan ID
        $kaprodi = Kaprodi::findOrFail($id);

        // Update data kaprodi
        $kaprodi->update([
            'kode_kaprodi' => $request->kode_kaprodi,
            'nip' => $request->nip,
            'nama' => $request->nama,
        ]);

        // Redirect kembali ke halaman kaprodi dengan pesan sukses
        return redirect()->route('kaprodi')->with('success', 'Data kaprodi berhasil diupdate.');
    }



    // Fungsi untuk menyimpan request ke database
    public function tambah_permintaan(Request $request)
    {
        // Validasi input
        $request->validate([
            'keterangan' => 'string|max:255', // Validasi keterangan
        ]);

        // Mendapatkan mahasiswa_id dari pengguna yang sedang login
        $mahasiswaId = Auth::user()->mahasiswa->id; // Asumsikan user memiliki relasi dengan mahasiswa

        // Mendapatkan kelas_id dari mahasiswa
        $kelasId = Auth::user()->mahasiswa->kelas_id; // Ambil dari relasi mahasiswa

        // Menyimpan request ke database
        Permintaan::create([
            'kelas_id' => $kelasId,
            'mahasiswa_id' => $mahasiswaId,
            'keterangan' => $request->keterangan,
        ]);

        // Redirect ke halaman profile dengan pesan sukses
        return redirect()->route('profile')->with('success', 'Request berhasil diajukan.');
    }

     // Fungsi untuk menyetujui permintaan
     public function setuju($id)
     {
         // Temukan permintaan berdasarkan ID
         $permintaan = Permintaan::find($id);
         
         if (!$permintaan) {
             return redirect()->back()->with('error', 'Permintaan tidak ditemukan');
         }
 
         // Temukan mahasiswa terkait dari permintaan tersebut
         $mahasiswa = $permintaan->mahasiswa;
 
         // Ubah kolom 'edit' menjadi true
         $mahasiswa->edit = true;
         $mahasiswa->save();
 
         // Hapus data permintaan setelah disetujui
         $permintaan->delete();
 
         // Redirect dengan pesan sukses
         return redirect()->route('mahasiswa')->with('success', 'Permintaan berhasil disetujui dan dihapus');
     }

     public function tolak($id)
     {
         // Temukan permintaan berdasarkan ID
         $permintaan = Permintaan::find($id);
 
         if (!$permintaan) {
             return redirect()->back()->with('error', 'Permintaan tidak ditemukan');
         }
 
         // Hapus data permintaan yang ditolak
         $permintaan->delete();
 
         // Redirect dengan pesan sukses
         return redirect()->back()->with('success', 'Permintaan berhasil ditolak dan dihapus');
     }

     // Method untuk menghapus data dosen
    public function hapus_dosen($id)
    {
        // Temukan data dosen berdasarkan ID
        $dosen = Dosen::findOrFail($id);
        
        // Jika dosen memiliki user terkait, hapus juga data user-nya
        if ($dosen->user) { // Pastikan relasi sudah ada di model Dosen
            $dosen->user->delete(); // Hapus pengguna terkait
        }

        // Hapus data dosen
        $dosen->delete();

        // Redirect kembali ke halaman dosen dengan pesan sukses
        return redirect()->route('dosen')->with('success', 'Data dosen dan pengguna berhasil dihapus.');
    }

        //fungsi hapus kaprodi
        public function hapus_kaprodi($id)
    {
        // Temukan data dosen berdasarkan ID
        $kaprodi = Kaprodi::findOrFail($id);
        
        // Jika dosen memiliki user terkait, hapus juga data user-nya
        if ($kaprodi->user) { // Pastikan relasi sudah ada di model Dosen
            $kaprodi->user->delete(); // Hapus pengguna terkait
        }

        // Hapus data kaprodi
        $kaprodi->delete();

        // Redirect kembali ke halaman kaprodi dengan pesan sukses
        return redirect()->route('login')->with('success', 'Data dosen dan pengguna berhasil dihapus.');
    }

}
