<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite('resources/css/app.css')
    <title>Web Pendataan</title>
</head>
<body class="h-full">
  @yield('content')
  {{-- Navbar --}}
  <x-navbar />
  <x-banner />

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  @if($message = Session::get('berhasil'))
  <script>
      Swal.fire({
          icon: 'success',
          title: 'Selamat Datang',
          text: "{{ $message }}",
      });
  </script>
@endif
</body>

</html>