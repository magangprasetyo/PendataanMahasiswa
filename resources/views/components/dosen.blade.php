{{-- resources/views/components/user.blade.php --}}

@props(['tampilan_dosen', 'tampilan_kaprodi']) <!-- Menerima props kaprodi -->
<div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
            @foreach($tampilan_kaprodi as $item)
                @if(auth()->user()->role === 'kaprodi')
                    <a href="{{ route('tambah_dosen') }}" class="inline-block rounded bg-green-500 px-4 py-2 text-xs font-medium text-white hover:bg-green-700">Tambah Dosen</a>
                @endif
            @endforeach
            <thead class="ltr:text-left rtl:text-right">
                <tr>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-center">KODE DOSEN</th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-center">NIP</th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-center">NAMA</th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-center">DOSEN KELAS</th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-center">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tampilan_dosen as $item)
                    <tr>
                        <td class="whitespace-nowrap pl-14 py-2 text-gray-700 text-center">{{ $item->kode_dosen }}</td>
                        <td class="whitespace-nowrap pl-14 py-2 text-gray-700 text-center">{{ $item->nip }}</td>
                        <td class="whitespace-nowrap pl-14 py-2 text-gray-700 text-center">{{ $item->nama }}</td>
                        <td class="whitespace-nowrap pl-14 py-2 text-gray-700 text-center">{{ optional($item->kelas)->nama ?? 'Dosen Bisa' }}</td>
                        <td class="whitespace-nowrap pl-14 py-2">
                            @if(auth()->user()->role === 'kaprodi' || (auth()->user()->role === 'dosen' && auth()->user()->dosen && auth()->user()->dosen->kelas_id === $item->kelas_id))
                                <a href="" class="inline-block rounded bg-indigo-600 px-4 py-2 text-xs font-medium text-white hover:bg-indigo-700">Edit</a>
                                <form action="{{ route('hapus_dosen', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus dosen ini?');" class="inline-block">
                                    @csrf
                                    @method('DELETE') <!-- Menentukan bahwa metode yang digunakan adalah DELETE -->
                                    <button type="submit" class="rounded bg-red-600 px-4 py-2 text-xs font-medium text-white hover:bg-red-700">
                                        Delete
                                    </button>
                                </form>
                                
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script src="https://cdn.tailwindcss.com"></script>
