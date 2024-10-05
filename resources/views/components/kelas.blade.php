@props(['data_kelas'])

@section('content')
<div class="bg-white p-8 rounded-md w-full">
    <div class="flex items-center justify-between pb-6">
        <h1 class="text-2xl font-bold">Data Permintaan</h1>
    </div>
    <a href="{{ route('tambah_kls') }}" class="inline-block rounded bg-green-500 px-4 py-2 text-xs font-medium text-white hover:bg-green-700">Tambah Kelas</a>
    <div class="overflow-x-auto">
        <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Nama Kelas
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Jumlah Kelas
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Reaksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data_kelas as $request)
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <div class="flex items-center">
                                <div class="ml-3">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ $request->nama ?? 'N/A' }} <!-- Pastikan ada kolom nama_kelas di model Kelas -->
                                    </p>	
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ $request->jumlah ?? 'N/A' }}</p> <!-- Pastikan ada kolom nama_mahasiswa di model Mahasiswa -->
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <div class="flex space-x-2">
                                <!-- Tombol Setuju -->
                                <a href="{{ route('tampilan_mhs', ['kelas_id' => $request->id]) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                    Kelas
                                </a>                                                                  
                                <!-- Tombol Setuju -->
                                <a href="{{ route('edit_kelas', $request->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                    Edit
                                </a>                                                             
                                <!-- Tombol Tolak -->
                                <form action="{{ route('hapus_kelas', $request->id) }}" method="POST" style="display: inline;">
                                    @csrf <!-- Token CSRF untuk keamanan -->
                                    @method('DELETE') <!-- Menentukan metode DELETE -->
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                        Delete
                                    </button>
                                </form>                                
                            </div>
                        </td>						
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@if ($errors->has('kelas_id'))
    <script>
    Swal.fire({
      icon: "error",
      title: "Maaf",
      text: "{{ $errors->first('kelas_id') }}", // Ambil pesan kesalahan pertama dari kelas_id
    });
    </script>
@endif
