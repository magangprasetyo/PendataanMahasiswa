{{-- resources/views/components/user.blade.php --}}

@props(['tampilan_mahasiswa', 'tampilan_dosen', 'tampilan_kaprodi']) <!-- Menerima props kaprodi -->
<div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
            @if(auth()->user()->role === 'dosen')
                <a href="{{ route('register') }}" class="inline-block rounded bg-green-500 px-4 py-2 text-xs font-medium text-white hover:bg-green-700">Tambah Mahasiswa</a>
            @endif        
            @if(auth()->user()->role === 'kaprodi')
                <a href="{{ route('register') }}" class="inline-block rounded bg-green-500 px-4 py-2 text-xs font-medium text-white hover:bg-green-700">Tambah Mahasiswa</a>
            @endif
            <thead class="ltr:text-left rtl:text-right">
                <tr>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-center">NIM</th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-center">NAMA</th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-center">TAMPAT_LAHIR</th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">TANGGAL_LAHIR</th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">KELAS</th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-center">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tampilan_mahasiswa as $item)
                    <tr>
                        <td class="whitespace-nowrap pl-14 py-2 text-gray-700 text-center">{{ $item->nim }}</td>
                        <td class="whitespace-nowrap pl-14 py-2 text-gray-700 text-center">{{ $item->nama }}</td>
                        <td class="whitespace-nowrap pl-14 py-2 text-gray-700 text-center">{{ $item->tempat_lahir }}</td>
                        <td class="whitespace-nowrap pl-14 py-2 text-gray-700 text-center">{{ $item->tanggal_lahir }}</td>
                        <td class="whitespace-nowrap pl-14 py-2 text-gray-700 text-center">{{ optional($item->kelas)->nama ?? 'Mahasiswa Tidak Ada Kelas' }}</td>
                        <td class="whitespace-nowrap pl-14 py-2">
                            @if(auth()->user()->role === 'dosen' && auth()->user()->dosen && auth()->user()->dosen->kelas_id === $item->kelas_id)
                        
                                <form action="{{ route('hapus_mahasiswa', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-block rounded bg-red-600 px-4 py-2 text-xs font-medium text-white hover:bg-red-700 ml-2">Delete</button>
                                </form>
                            @endif
                        
                            @if((auth()->user()->role === 'dosen' && auth()->user()->dosen && auth()->user()->dosen->kelas_id === $item->kelas_id) ||
                               (auth()->user()->role === 'mahasiswa' && auth()->user()->mahasiswa && auth()->user()->mahasiswa->edit === 1))
                        
                                <a href="{{ route('edit', $item->id) }}" class="inline-block rounded bg-indigo-600 px-4 py-2 text-xs font-medium text-white hover:bg-indigo-700">Edit</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
