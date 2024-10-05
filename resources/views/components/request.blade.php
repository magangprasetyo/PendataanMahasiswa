<!-- component -->
<div class="max-w-lg lg:ms-auto mx-auto text-center py-20">
  <h1 class="text-2xl font-bold sm:text-3xl">Layanan Request</h1>
  <div class="py-16 px-7 rounded-md bg-white">                                 
    <form action="{{ route('tambah_permintaan') }}" method="POST">
      @csrf
      <div class="grid md:grid-cols-2 grid-cols-1 gap-6">
        <div class="md:col-span-2">
          <textarea name="keterangan" id="keterangan" rows="5" placeholder="Masukkan Keluhan Anda *" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-700" required></textarea>
        </div>
        <div class="md:col-span-2">
          <button class="py-3 text-base font-medium rounded text-white bg-blue-800 w-full hover:bg-blue-700 transition duration-300">Ajukan</button>
        </div>
      </div><!-- Grid End -->
    </form>

    <!-- Link Kembali -->
    <div class="mt-6 text-left">
      <a href="{{ route('profile') }}" class="text-blue-500 hover:underline">Kembali</a>
    </div>
  </div>
</div>

<script src="https://cdn.tailwindcss.com"></script>
