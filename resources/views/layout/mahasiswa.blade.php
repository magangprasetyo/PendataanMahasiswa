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
    <title>Document</title>
</head>
<body class="h-full">
  @yield('content')
  {{-- Navbar --}}
  <x-navbar />
  <x-mahasiswa :tampilan_mahasiswa="$tampilan_mahasiswa" :permintaan="$permintaan" :tampilan_dosen="$tampilan_dosen" :tampilan_kaprodi="$tampilan_kaprodi" />

</body>

</html>