<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Tambah Data kaprodi</title>
</head>
<body>
  @props(['tambah_kelas']) <!-- Menerima props tambah_kelas -->
<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
      <img class="mx-auto h-10 w-auto" src="{{ asset('img/logo.jpg') }}" alt="Your Company">
      <h2 class="mt-2 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Tambah Data Kaprodi</h2>
    </div> 
    <div class="mt-2 sm:mx-auto sm:w-full sm:max-w-sm">
      <form class="space-y-6" action="{{ route('kaprodi_proses') }}" method="POST">
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
          <label for="kode_kaprodi" class="block text-sm font-medium leading-6 text-gray-900">Kode Kaprodi</label>
          <div class="mt-2">
            <input id="kode_kaprodi" name="kode_kaprodi" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
          </div>
          @error('kode_kaprodi')
              <small class="text-red-600">{{ $message }}</small>
          @enderror
        </div>
      
        <div>
          <label for="nip" class="block text-sm font-medium leading-6 text-gray-900">Nip</label>
          <div class="mt-2">
            <input id="nip" name="nip" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
          </div>
          @error('nip')
              <small class="text-red-600">{{ $message }}</small>
          @enderror
        </div>

        <div>
          <label for="nama" class="block text-sm font-medium leading-6 text-gray-900">Nama</label>
          <div class="mt-2">
            <input id="nama" name="nama" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
          </div>
          @error('nama')
              <small class="text-red-600">{{ $message }}</small>
          @enderror
        </div>

        <input type="hidden" name="role" value="kaprodi">
        <div>
          <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Tambahkan</button>
        </div>
      </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if($message = Session::get('fild'))
    <script>
    Swal.fire({
      icon: "error",
      title: "Maaf",
      text: "{{ $message }}",
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
