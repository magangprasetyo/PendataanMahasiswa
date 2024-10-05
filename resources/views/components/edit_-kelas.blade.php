@props(['kelas']) <!-- Menerima props tambah_kelas dan mahasiswa -->
<script src="https://cdn.tailwindcss.com"></script>
<div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-lg text-center">
      <h1 class="text-2xl font-bold sm:text-3xl">Edit Data Kelas</h1>
  
      <p class="mt-4 text-gray-500"></p>
    </div>
    
    <!-- Form Edit Mahasiswa -->
    <form action="{{ route('update_kelas', $kelas->id) }}" method="POST" class="mx-auto mb-0 mt-8 max-w-md space-y-4">
      @csrf
      @method('PUT') <!-- Ubah method menjadi PUT untuk proses update -->

      <!-- Hidden input untuk user_id -->
      <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
      <!-- Input Nama Kelas -->
      <div>
        <label for="nama" class="sr-only">Nama Kelas</label>
        <div class="relative">
          <input
            type="text"
            name="nama"
            class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
            placeholder="Enter NIM"
            value="{{ $kelas->nama }}"
            required
          />
        </div>
      </div>
  
      <!-- Input Jumlah -->
      <div>
        <label for="jumlah" class="sr-only">Jumlah</label>
        <div class="relative">
          <input
            type="text"
            name="jumlah"
            class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
            placeholder="Enter Nama"
            value="{{ $kelas->jumlah }}" 
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
