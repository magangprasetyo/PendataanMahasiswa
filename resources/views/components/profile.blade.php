@props(['kaprodi', 'tampilan_kaprodi' ,'mahasiswa' ,'dosen', 'kaprodi'])

<div class="bg-white max-w-2xl shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-5 sm:px-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
            Profile Akun
        </h3>
        <p class="mt-1 max-w-2xl text-sm text-gray-500">
            Selamat Datang
        </p>
    </div>
    <div class="border-t border-gray-200">
        <dl>
            @if($kaprodi)
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Kode Kaprodi</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $kaprodi->kode_kaprodi }}
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">NIP</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $kaprodi->nip }}
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Nama</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $kaprodi->nama }}
                    </dd>
                </div>
                

            {{-- Jika role adalah mahasiswa --}}
            @elseif($mahasiswa)
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">NIM</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $mahasiswa->nim }}
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Nama</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $mahasiswa->nama }}
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Tempat Lahir</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $mahasiswa->tempat_lahir }}
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Tanggal Lahir</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $mahasiswa->tanggal_lahir }}
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Kelas</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        @if($mahasiswa->kelas)  {{-- Pastikan $mahasiswa->kelas ada --}}
                            {{ $mahasiswa->kelas->nama }}  {{-- Menampilkan nama kelas jika ada --}}
                        @else
                            Mahasiswa Belum ada Kelas  {{-- Menampilkan pesan jika kelas null --}}
                        @endif
                    </dd>
                </div> 

            {{-- Jika role adalah dosen --}}
            @elseif($dosen)
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">Kode Dosen</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{ $dosen->kode_dosen }}
                </dd>
            </div>
            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">Nip</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{ $dosen->nip }}
                </dd>
            </div>
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">Nama</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{ $dosen->nama }}
                </dd>
            </div>
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">Kelas</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    @if($dosen->kelas)  {{-- Pastikan $dosen->kelas ada --}}
                        {{ $dosen->kelas->nama }}  {{-- Menampilkan nama kelas jika ada --}}
                    @else
                        Dosen Bisa  {{-- Menampilkan pesan jika kelas null --}}
                    @endif
                </dd>
            </div>            
            @else
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Silahkan Isi Data Terlebih Dahulu</dt>
                </div>
            @endif
        </dl>
    </div>

    <div class="flex justify-between items-center px-4 py-5">
        <!-- Tombol 'Edit Profil' berdasarkan peran -->
        @if(session('role') === 'kaprodi' && !$kaprodi)
            <a href="{{ route('tambah_kaprodi') }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                Edit Profile
            </a>
        @elseif(session('role') === 'mahasiswa' && !$mahasiswa)
            <a href="{{ route('tambah_mahasiswa') }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                Tambah Profil
            </a>
        @elseif(session('role') === 'mahasiswa' && $mahasiswa->edit == true)
            <a href="{{ route('edit', $mahasiswa->id) }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                Edit Profil
            </a>   
        @elseif(session('role') === 'dosen' && !$dosen)
            <a href="{{ route('tambah_dosen') }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                Edit Profil
            </a>
        @endif  
        <!-- Tombol Ajukan Request hanya untuk mahasiswa -->
        @if(session('role') === 'mahasiswa')
            <a href="{{ route('request') }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 -ml-4">
                Ajukan Request
            </a>
        @endif
    </div>    
</div>
