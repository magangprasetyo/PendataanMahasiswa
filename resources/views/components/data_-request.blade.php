@props(['permintaan'])

@section('content')
<div class="bg-white p-8 rounded-md w-full">
    <div class="flex items-center justify-between pb-6">
        <h1 class="text-2xl font-bold">Data Permintaan</h1>
    </div>
    <div class="overflow-x-auto">
        <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Kelas Mahasiswa
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Nama Mahasiswa
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Keterangan
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Status
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Reaksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($permintaan as $request)
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <div class="flex items-center">
                                <div class="ml-3">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ $request->kelas->nama ?? 'N/A' }} <!-- Pastikan ada kolom nama_kelas di model Kelas -->
                                    </p>	
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ $request->mahasiswa->nama ?? 'N/A' }}</p> <!-- Pastikan ada kolom nama_mahasiswa di model Mahasiswa -->
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ $request->keterangan }}</p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
							<span class="relative inline-block px-3 py-1 font-semibold 
								{{ $request->mahasiswa->edit == 1 ? 'text-green-900' : 'text-red-900' }} leading-tight">
								<span aria-hidden class="absolute inset-0 
									{{ $request->mahasiswa->edit == 1 ? 'bg-green-200' : 'bg-red-200' }} opacity-50 rounded-full"></span>
								<span class="relative">
									{{ $request->mahasiswa->edit == 1 ? 'Aktif' : 'Tidak Aktif' }}
								</span>
							</span>
						</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <div class="flex space-x-2">
                                <!-- Tombol Setuju -->
                                <form action="{{ route('setuju', $request->id) }}" method="POST">
                                    @csrf <!-- Token CSRF untuk keamanan -->
                                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                        Setuju
                                    </button>
                                </form>                                
                                <!-- Tombol Tolak -->
                                <form action="{{ route('tolak', $request->id) }}" method="POST">
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                        Tolak
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
