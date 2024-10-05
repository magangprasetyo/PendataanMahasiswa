<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Tambah Data Mahasiswa</title>
</head>
<body>
  @props(['tambah_kelas']) <!-- Menerima props tambah_kelas -->
<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
      <img class="mx-auto h-10 w-auto" src="{{ asset('img/logo.jpg') }}" alt="Your Company">
      <h2 class="mt-2 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Tambah Data Mahasiswa</h2>
    </div> 
    <div class="mt-2 sm:mx-auto sm:w-full sm:max-w-sm">
      <form class="space-y-6" action="{{ route('register-proses') }}" method="POST">
        @csrf
        <div>
          <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Username</label>
          <div class="mt-2">
            <input id="username" name="username" type="text" autocomplete="username" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
          </div>
          @error('username')
              <small class="text-red-600">{{ $message }}</small>
          @enderror
        </div>

        <div>
          <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
          <div class="mt-2">
            <input id="email" name="email" type="email" autocomplete="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
          </div>
          @error('email')
              <small class="text-red-600">{{ $message }}</small>
          @enderror
        </div>

        <div>
          <div class="flex items-center justify-between">
            <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
          </div>
          <div class="mt-2">
            <input id="password" name="password" type="password" autocomplete="current-password" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
          </div>
          @error('password')
              <small class="text-red-600">{{ $message }}</small>
          @enderror
        </div>

        <div>
          <label for="nim" class="block text-sm font-medium leading-6 text-gray-900">NIM</label>
          <div class="mt-2">
            <input id="nim" name="nim" type="number" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
          </div>
          @error('nim')
              <small class="text-red-600">{{ $message }}</small>
          @enderror
        </div>

        <div>
          <label for="tambah_kelas" class="sr-only">Kelas</label>
          <div class="relative">
              <select name="kelas_id" class="w-full rounded-lg border-gray-200 p-4 text-sm shadow-sm" required>
                  <option value="" disabled selected>Pilih Kelas</option>
                  @foreach($tambah_kelas as $item)
                      <option value="{{ $item->id }}" {{ old('kelas_id') == $item->id ? 'selected' : '' }}>
                          {{ $item->nama }}
                      </option>
                  @endforeach
              </select>
          </div>
      </div>
      

        <div>
          <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Nama</label>
          <div class="mt-2">
            <input id="name" name="name" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
          </div>
          @error('name')
              <small class="text-red-600">{{ $message }}</small>
          @enderror
        </div>

        <div>
          <label for="tempat_lahir" class="block text-sm font-medium leading-6 text-gray-900">Tempat Lahir</label>
          <div class="mt-2">
            <input id="tempat_lahir" name="tempat_lahir" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
          </div>
          @error('tempat_lahir')
              <small class="text-red-600">{{ $message }}</small>
          @enderror
        </div>

        <div>
          <label for="tanggal_lahir" class="block text-sm font-medium leading-6 text-gray-900">Tanggal Lahir</label>
          <div class="mt-2">
            <input id="tanggal_lahir" name="tanggal_lahir" type="date" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
          </div>
          @error('tanggal_lahir')
              <small class="text-red-600">{{ $message }}</small>
          @enderror
        </div>

        <input type="hidden" name="role" value="mahasiswa">

        <div>
          <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Tambahkan</button>
        </div>
      </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if ($errors->has('kelas_id'))
    <script>
    Swal.fire({
      icon: "error",
      title: "Maaf",
      text: "{{ $errors->first('kelas_id') }}", // Ambil pesan kesalahan pertama dari kelas_id
    });
    </script>
@endif

@if(session('success'))
    <script>
    Swal.fire({
      icon: "success",
      title: "Berhasil",
      text: "{{ session('success') }}",
    });
    </script>
@endif

</body>
</html>
