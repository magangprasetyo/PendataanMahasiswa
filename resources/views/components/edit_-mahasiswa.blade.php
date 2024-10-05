@props(['tambah_kelas', 'mahasiswa']) <!-- Menerima props tambah_kelas dan mahasiswa -->
<script src="https://cdn.tailwindcss.com"></script>
<div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-lg text-center">
      <h1 class="text-2xl font-bold sm:text-3xl">Edit Data Mahasiswa</h1>
  
      <p class="mt-4 text-gray-500"></p>
    </div>
    
    <!-- Form Edit Mahasiswa -->
    <form action="{{ route('edit_mahasiswa', $mahasiswa->id) }}" method="POST" class="mx-auto mb-0 mt-8 max-w-md space-y-4">
      @csrf
      @method('PUT') <!-- Ubah method menjadi PUT untuk proses update -->

      <!-- Hidden input untuk user_id -->
      <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />

      <!-- Menampilkan Role secara readonly -->
      <div>
        <label for="role" class="sr-only">Role</label>
        <div class="relative">
          <input
            type="text"
            name="role"
            class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
            value="{{ $mahasiswa->user->role }}"
            readonly
          />
        </div>
      </div>

      <!-- Pilihan Kelas -->
      <div>
        <label for="tambah_mahasiswa" class="sr-only">Kelas</label>
        <div class="relative">
            <select name="kelas_id" class="w-full rounded-lg border-gray-200 p-4 text-sm shadow-sm" required>
                <option value="" disabled>Pilih Kelas</option>
                @foreach($tambah_kelas as $item)
                    <option value="{{ $item->id }}" {{ $mahasiswa->kelas_id == $item->id ? 'selected' : '' }}>
                      {{ $item->nama }}
                    </option>
                @endforeach
            </select>
        </div>
      </div>
    
      <!-- Input NIM -->
      <div>
        <label for="nim" class="sr-only">NIM</label>
        <div class="relative">
          <input
            type="text"
            name="nim"
            class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
            placeholder="Enter NIM"
            value="{{ $mahasiswa->nim }}"
            required
          />
        </div>
      </div>
  
      <!-- Input Nama -->
      <div>
        <label for="nama" class="sr-only">Nama</label>
        <div class="relative">
          <input
            type="text"
            name="nama"
            class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
            placeholder="Enter Nama"
            value="{{ $mahasiswa->nama }}" 
            required
          />
        </div>
      </div>
      

      <!-- Input Tempat Lahir -->
      <div>
        <label for="tempat_lahir" class="sr-only">Tempat Lahir</label>
        <div class="relative">
          <input
            type="text"
            name="tempat_lahir"
            class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
            placeholder="Enter Tempat Lahir"
            value="{{ $mahasiswa->tempat_lahir }}" 
            required
          />
        </div>
      </div>

      <!-- Input Edit -->
      <div>
        <label for="edit" class="sr-only">Edit</label>
        <div class="relative">
          <select
            name="edit"
            class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
            required
          >
            <option value="0" {{ $mahasiswa->edit == 0 ? 'selected' : '' }}>Tidak Diizinkan</option>
            <option value="1" {{ $mahasiswa->edit == 1 ? 'selected' : '' }}>izinkan</option>
          </select>
        </div>
      </div>
      

      <!-- Input Tanggal Lahir -->
      <div>
        <label for="tanggal_lahir" class="sr-only">Tanggal Lahir</label>
        <div class="relative">
          <input
            type="date"
            name="tanggal_lahir"
            class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
            value="{{ $mahasiswa->tanggal_lahir }}" 
            required
          />
        </div>
      </div>

      <!-- Tombol Submit -->
      <div class="flex items-center justify-between">
        <p class="text-sm text-gray-500"></p>
        <button
          type="submit"
          class="inline-block rounded-lg bg-blue-500 px-5 py-3 text-sm font-medium text-white"
        >
          Update Data
        </button>
      </div>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  @if($message = Session::get('error'))
    <script>
    Swal.fire({
      icon: "error",
      title: "Maaf",
      text: "{{ $message }}",
    });
    </script>
  @endif
