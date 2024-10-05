<!-- component -->
@props(['mahasiswas', 'kelas', 'tampilan_dsn'])
<div class="max-w-[720px] mx-auto">
    
    <div class="block mb-4 mx-auto border-b border-slate-300 pb-2 max-w-[360px]">
   </div>

   <div class="w-full flex justify-between items-center mb-3 mt-1 pl-3">
       <div>
           <h3 class="text-lg font-semibold text-slate-800">Data Mahasiswa Kelas</h3>
           <p class="text-slate-500">Selamat Datang di Menu Kelas</p>
           @foreach($tampilan_dsn as $dosen)
                <h1 class="text-slate-500">Dosen Pengampu : {{ $dosen->nama }}</h1>
            @endforeach
       </div>
       <div class="ml-3">
           <div class="w-full max-w-sm min-w-[200px] relative">
               <div class="relative">
                   <input
                   class="bg-white w-full pr-11 h-10 pl-3 py-2 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded transition duration-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md"
                   placeholder="Cari dengan nama..."
                   />
                   <button
                   class="absolute h-8 w-8 right-1 top-1 my-auto px-2 flex items-center bg-white rounded "
                   type="button"
                   >
                   <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-8 h-8 text-slate-600">
                       <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                   </svg>
                   </button>
               </div>
           </div>
       </div>
   </div>
   
   <div class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 bg-white shadow-md rounded-lg bg-clip-border">
   <table class="w-full text-left table-auto min-w-max">
       <thead>
       <tr>
           <th class="p-4 border-b border-slate-200 bg-slate-50">
           <p class="text-sm font-normal leading-none text-slate-500">Nim</p>
           </th>
           <th class="p-4 border-b border-slate-200 bg-slate-50">
           <p class="text-sm font-normal leading-none text-slate-500">Nama</p>
           </th>
           <th class="p-4 border-b border-slate-200 bg-slate-50">
           <p class="text-sm font-normal leading-none text-slate-500">Tempat Lahir</p>
           </th>
           <th class="p-4 border-b border-slate-200 bg-slate-50">
           <p class="text-sm font-normal leading-none text-slate-500">Tanggal Lahir</p>
           </th>
           <th class="p-4 border-b border-slate-200 bg-slate-50">
           <p class="text-sm font-normal leading-none text-slate-500">Aksi</p>
           </th>
       </tr>
       </thead>
       <tbody>
       @foreach ($mahasiswas as $mahasiswa)
       <tr class="hover:bg-slate-50 border-b border-slate-200">
           <td class="p-4 py-5">
           <p class="block font-semibold text-sm text-slate-800">{{ $mahasiswa->nim }}</p>
           </td>
           <td class="p-4 py-5">
           <p class="text-sm text-slate-500">{{ $mahasiswa->nama }}</p>
           </td>
           <td class="p-4 py-5">
           <p class="text-sm text-slate-500">{{ $mahasiswa->tempat_lahir }}</p>
           </td>
           <td class="p-4 py-5">
           <p class="text-sm text-slate-500">{{ $mahasiswa->tanggal_lahir }}</p>
           </td>
           <td class="p-4 py-5">
                <div class="flex space-x-2">
                <!-- Tombol untuk Keluar dari Kelas -->
                @if($mahasiswa->kelas && $mahasiswa->kelas->jumlah !== null)
                    <form action="{{ route('keluarKelas', $mahasiswa->id) }}" method="POST" style="display: inline;">
                        @csrf <!-- Token CSRF untuk keamanan -->
                        <button 
                            type="submit" 
                            class="px-3 py-1 text-sm text-white bg-red-500 rounded hover:bg-red-600">
                            Keluar
                        </button>
                    </form>
                @endif

                <form action="{{ route('ubahKelas', $mahasiswa->id) }}" method="POST">
                    @csrf
                    <select 
                        class="px-3 py-1 text-sm text-white bg-blue-500 rounded hover:bg-blue-600"
                        name="kelas_id" onchange="this.form.submit()">
                        <option value="">Pilih Kelas</option>
                        @foreach($kelas as $k)
                            <option value="{{ $k->id }}" {{ $mahasiswa->kelas_id == $k->id ? 'selected' : '' }}>
                                {{ $k->nama }}
                            </option>
                        @endforeach
                    </select>
                </form> 
                </div>
           </td>
       </tr>
       @endforeach
       </tbody>
   </table>
   
   <div class="flex justify-between items-center px-4 py-3">
       <div class="text-sm text-slate-500"></div>
       <div class="flex space-x-1">
        <a href="{{ route('data_kelas') }}" class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-slate-500 bg-white border border-slate-200 rounded hover:bg-slate-50 hover:border-slate-400 transition duration-200 ease">
            Kembali
        </a>
       </div>
   </div>
   </div>
</div>

<script src="https://cdn.tailwindcss.com"></script>
