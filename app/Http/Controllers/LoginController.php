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

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function register(){
        // Mengambil semua data kelas
        $tambah_kelas = Kelas::all();
        return view('auth.register', compact('tambah_kelas'));
    }

    public function login_proses(Request $request)
{
    // Validasi input
    $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string',
    ]);

    // Cek apakah pengguna dengan email sudah ada
    $user = User::where('email', $request->email)->first();

    if (!$user) {
        // Redirect jika pengguna tidak ditemukan
        return redirect()->route('login')->with('failed', 'Email tidak terdaftar.');
    }

    // Coba autentikasi dengan email dan password
    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        // Simpan role pengguna dalam session
        session(['role' => $user->role]); // Menyimpan role pengguna dalam session
        
        // Redirect setelah berhasil login dengan pesan sukses
        return redirect()->route('dashboard')->with('berhasil', 'Login berhasil!');
    } else {
        // Redirect jika gagal login dengan pesan gagal
        return redirect()->route('login')->with('failed', 'Email atau Password Salah');
    }
}

public function logout(Request $request)
{
    // Logika logout
    Auth::logout();

    // Hapus session role
    $request->session()->forget('role');

    // Invalidasi sesi dan regenerasi token CSRF
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    
    return redirect()->route('login')->with('berhasil_logout', 'Anda telah berhasil logout.');
}



// public function register_proses(Request $request)
// {
//     // Validasi input
//     $request->validate([
//         'username' => 'required|string|max:255|unique:users', // Validasi username
//         'email' => 'required|string|email|max:255|unique:users',
//         'password' => 'required|string', // Tambahkan minimum karakter password jika diperlukan
//         'role' => 'required|in:kaprodi,dosen,mahasiswa', // Validasi role dengan pilihan yang tersedia
//     ]);

//     // Coba buat pengguna baru
//     $user = User::create([
//         'username' => $request->username,
//         'email' => $request->email,
//         'password' => Hash::make($request->password),
//         'role' => $request->role,
//     ]);
    
//     // Cek apakah proses pembuatan pengguna berhasil
//     if ($user) {
//         // Redirect setelah berhasil dengan pesan sukses
//         return redirect()->route('login')->with('success', 'Pendaftaran berhasil! Silakan login.');
//     } else {
//         // Redirect jika gagal dengan pesan gagal
//         return redirect()->route('register')->with('failed', 'Pendaftaran gagal, silakan coba lagi.');
//     }
// }

// Fungsi untuk memproses pendaftaran
public function register_proses(Request $request)
{
    // Validasi input
    $validatedData = $request->validate([
        'username' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string',
        'nim' => 'required|string|unique:mahasiswa,nim',
        'kelas_id' => 'required|exists:kelas,id',
        'name' => 'required|string|max:255',
        'tempat_lahir' => 'required|string|max:255',
        'tanggal_lahir' => 'required|date',
        'role' => 'required|string|in:mahasiswa',
    ]);

    // Cek jumlah mahasiswa di kelas yang dipilih
    $kelas = Kelas::find($validatedData['kelas_id']);

    if (!$kelas) {
        return redirect()->back()->withErrors(['kelas_id' => 'Kelas tidak ditemukan.']);
    }

    // Hitung jumlah mahasiswa yang terdaftar di kelas tersebut
    $jumlahMahasiswa = Mahasiswa::where('kelas_id', $validatedData['kelas_id'])->count();

    // Pastikan jumlah mahasiswa belum melebihi kapasitas
    if ($jumlahMahasiswa >= $kelas->jumlah) { // Asumsi kolom 'jumlah' adalah kapasitas
        return redirect()->route('register')->withErrors(['kelas_id' => 'Kelas ini sudah penuh. Silakan pilih kelas lain.']);

    }

    // Buat user
    $user = User::create([
        'username' => $validatedData['username'],
        'email' => $validatedData['email'],
        'password' => Hash::make($validatedData['password']),
        'role' => $validatedData['role'],
    ]);

    // Buat mahasiswa
    Mahasiswa::create([
        'user_id' => $user->id,
        'kelas_id' => $validatedData['kelas_id'],
        'nim' => $validatedData['nim'],
        'nama' => $validatedData['name'],
        'tempat_lahir' => $validatedData['tempat_lahir'],
        'tanggal_lahir' => $validatedData['tanggal_lahir'],
    ]);

    // Redirect dengan pesan sukses
    return redirect()->route('mahasiswa')->with('success', 'Data mahasiswa berhasil ditambahkan.');
}


   

    public function dashboard(){
        /// Ambil semua data dari tabel kaprodi
        $tampilan_kaprodi = Kaprodi::all();

        // Kirim data ke view 'components.user'
        return view('layout.dashboard', compact('tampilan_kaprodi'));

    }

    public function kaprodi(){
        /// Ambil semua data dari tabel kaprodi
        $tampilan_kaprodi = Kaprodi::all();

        // Kirim data ke view 'components.user'
        return view('layout.kaprodi', compact('tampilan_kaprodi'));

    }
    
    public function tampilan_kaprodi()
    {
        // Ambil semua data dari tabel kaprodi
        $tampilan_kaprodi = Kaprodi::all();
        $tampilan_mahasiswa = Mahasiswa::all();

        // Kirim data ke view 'components.user'
        return view('components.user', compact('tampilan_kaprodi', 'tampilan_mahasiswa'));
    }

    public function tampilan_mahasiswa(){
        /// Ambil semua data dari tabel kaprodi
        $tampilan_mahasiswa = Mahasiswa::all();
        $tampilan_dosen = Dosen::all();
        $tampilan_kaprodi = Kaprodi::all();
        $permintaan = Permintaan::with(['mahasiswa', 'kelas'])->get();
        // Kirim data ke view 'components.user'
        return view('components.mahasiswa', compact('tampilan_mahasiswa', 'permintaan', 'tampilan_dosen', 'tampilan_kaprodi'));

    }
    
    public function mahasiswa(){
        /// Ambil semua data dari tabel kaprodi
        $tampilan_mahasiswa = Mahasiswa::all();
        $tampilan_dosen = Dosen::all();
        $tampilan_kaprodi = Kaprodi::all();
        $permintaan = Permintaan::with(['mahasiswa', 'kelas'])->get();

        // Kirim data ke view 'components.user'
        return view('layout.mahasiswa', compact('tampilan_mahasiswa', 'permintaan', 'tampilan_dosen', 'tampilan_kaprodi'));

    }

    public function profile(){
        $user = auth()->user(); // Mengambil pengguna yang sedang login
        $kaprodi = $user->kaprodi; // Mengambil data kaprodi terkait
        $mahasiswa = $user->mahasiswa;
        $dosen = $user->dosen;
        $kaprodi = $user->kaprodi;

        // Ambil semua data dari tabel kaprodi
        $tampilan_kaprodi = Kaprodi::all(); // Untuk melihat semua data kaprodi

        return view('layout.profile.profile', compact('kaprodi', 'tampilan_kaprodi', 'mahasiswa', 'dosen', 'kaprodi')); // Mengirim data kaprodi ke view
    }

    public function profile_view(){
        $user = auth()->user(); // Mengambil pengguna yang sedang login
        $kaprodi = $user->kaprodi; // Mengambil data kaprodi terkait
        $mahasiswa = $user->mahasiswa;
        $dosen = $user->dosen;
    
        // Ambil semua data dari tabel kaprodi
        // $tampilan_kaprodi = Kaprodi::all(); // Untuk melihat semua data kaprodi
    
        // Debugging
        dd($user, $kaprodi, $mahasiswa, $dosen);
        
        return view('component.profile', compact('kaprodi', 'tampilan_kaprodi', 'mahasiswa' ,'dosen')); // Mengirim data kaprodi ke view
    }
    

    public function dosen(){
        /// Ambil semua data dari tabel kaprodi
        $tampilan_dosen = Dosen::with('kelas')->get();
        $tampilan_kaprodi = Kaprodi::all();

        // Kirim data ke view 'components.user'
        return view('layout.dosen', compact('tampilan_dosen', 'tampilan_kaprodi'));

    }
    public function request(){

        // Kirim data ke view
        return view('layout.tambah.request');

    }

    public function data_request()
{
    // Mendapatkan user yang sedang login
    $user = auth()->user();

    // Pastikan dosen memiliki id_kelas yang valid
    if ($user->role !== 'dosen' || !$user->dosen) {
        return view('layout.data_request', ['permintaan' => []]); // Jika bukan dosen, kembalikan array kosong
    }

    // Ambil permintaan berdasarkan kelas yang diampu oleh dosen
    $permintaan = Permintaan::with(['mahasiswa', 'kelas'])
                ->whereHas('kelas', function ($query) use ($user) {
                    $query->where('id', $user->dosen->kelas_id); // Ambil permintaan yang sesuai dengan kelas dosen
                })
                ->get();

    // Kirim data ke view
    return view('layout.data_request', compact('permintaan'));
}

public function data_kelas()
{
    // Ambil semua data dari tabel kaprodi
    $data_kelas = Kelas::all();

    // Kirim data ke view 'components.user'
    return view('layout.data_kelas', compact('data_kelas'));
}

public function tambah_kls()
{
    // Kirim data ke view 'components.user'
    return view('layout.tambah.tambah_kelas');
}   

public function tampilan_mhs(Request $request) // Tambahkan Request di sini
{
     // Ambil ID kelas dari request
     $kelas_id = $request->input('kelas_id');

     // Ambil data mahasiswa berdasarkan kelas_id
     $mahasiswas = Mahasiswa::where('kelas_id', $kelas_id)->get();
 
     // Ambil data kelas yang memiliki jumlah tidak null
     $kelas = Kelas::whereNotNull('jumlah')->get();

     $tampilan_dsn = Dosen::where('kelas_id', $kelas_id)->get();// Mengambil semua data dosen

    // Kirim data ke view 'data_mahasiswa.tampilan_mahasiswa'
    return view('data_mahasiswa.tampilan_mahasiswa', compact('mahasiswas', 'kelas', 'tampilan_dsn'));
}   

    public function tampilan_mhs2(Request $request)
    {
        // Ambil ID kelas dari request
        $kelas_id = $request->input('kelas_id');

        // Ambil data mahasiswa berdasarkan kelas_id
        $mahasiswas = Mahasiswa::where('kelas_id', $kelas_id)->get();

        // Ambil data kelas yang memiliki jumlah tidak null
        $kelas = Kelas::whereNotNull('jumlah')->get();

        $tampilan_dsn = Dosen::where('kelas_id', $kelas_id)->get(); // Mengambil semua data dosen

        // Kirim data mahasiswa dan kelas ke view
        return view('components.tampilan_-mahasiswa', compact('mahasiswas', 'kelas', 'tampilan_dsn'));
    }


public function keluarKelas(Request $request, $mahasiswaId)
{
    // Cari mahasiswa berdasarkan ID
    $mahasiswa = Mahasiswa::findOrFail($mahasiswaId);

    // Cari kelas yang memiliki jumlah null
    $kelasDenganJumlahNull = Kelas::whereNull('jumlah')->first();

    if ($kelasDenganJumlahNull) {
        // Atur kelas_id mahasiswa ke ID kelas yang jumlahnya null
        $mahasiswa->kelas_id = $kelasDenganJumlahNull->id;
    } else {
        // Jika tidak ada kelas dengan jumlah null, berikan respons yang sesuai
        return redirect()->back()->with('error', 'Tidak ada kelas dengan jumlah null.');
    }

    // Simpan perubahan mahasiswa
    $mahasiswa->save();

    return redirect()->back()->with('success', 'Mahasiswa berhasil keluar dari kelas dan dipindahkan ke kelas dengan jumlah null.');
}


public function view_kaprodi()
{
    // Kirim data ke view 'components.user'
    return view('components.tambah-kaprodi');
}  

// Fungsi untuk memproses pendaftaran
public function kaprodi_proses(Request $request)
{
    // Validasi input
    $validatedData = $request->validate([
        'username' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string',
        'kode_kaprodi' => 'required|string|unique:kaprodi,kode_kaprodi',
        'nip' => 'required|string|max:255',
        'nama' => 'required|string|max:255',
        'role' => 'required|string|in:kaprodi',
    ]);

    // Buat user
    $user = User::create([
        'username' => $validatedData['username'],
        'email' => $validatedData['email'],
        'password' => Hash::make($validatedData['password']),
        'role' => $validatedData['role'],
    ]);

    // Buat Kaprodi
    Kaprodi::create([
        'user_id' => $user->id,
        'kode_kaprodi' => $validatedData['kode_kaprodi'],
        'nip' => $validatedData['nip'],
        'nama' => $validatedData['nama'],
    ]);

    // Redirect dengan pesan sukses
    return redirect()->route('mahasiswa')->with('success', 'Data mahasiswa berhasil ditambahkan.');

}

    public function ubahKelas(Request $request, $mahasiswaId)
    {
        // Validasi input
        $request->validate([
            'kelas_id' => 'nullable|exists:kelas,id', // Bisa null untuk keluar dari kelas
        ]);

        // Cari mahasiswa berdasarkan ID
        $mahasiswa = Mahasiswa::findOrFail($mahasiswaId);

        // Jika mahasiswa ingin pindah ke kelas baru
        if ($request->input('kelas_id') && $request->input('kelas_id') != $mahasiswa->kelas_id) {
            // Hitung jumlah mahasiswa yang sudah terdaftar di kelas yang baru
            $jumlahMahasiswa = Mahasiswa::where('kelas_id', $request->input('kelas_id'))->count();
            $kelasBaru = Kelas::find($request->input('kelas_id'));

            // Cek jika jumlah mahasiswa di kelas baru sudah mencapai kapasitas tampilan_mhs data_kelas
            if ($jumlahMahasiswa >= $kelasBaru->jumlah) {
                return redirect()->route('data_kelas')->withErrors(['kelas_id' => 'Kelas ini sudah penuh. Silakan pilih kelas lain.']);
            }
        }

        // Update kelas_id mahasiswa
        $mahasiswa->kelas_id = $request->input('kelas_id');
        $mahasiswa->save();

        // Redirect kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Kelas berhasil diubah.');
    }

}
