{{-- resources/views/components/user.blade.php --}}

@props(['tampilan_kaprodi']) <!-- Menerima props kaprodi -->
<div>
    <div class="overflow-x-auto">
        @if(session('error'))
            <div class="bg-red-500 text-white p-4 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
            <thead class="ltr:text-left rtl:text-right">
                <tr>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-center">KODE KAPRODI</th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-center">NIP</th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-center">NAMA</th>
                    @if(session('role') === 'kaprodi')<th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">AKSI</th>@endif
                </tr>
            </thead>
            <tbody>
                @foreach($tampilan_kaprodi as $item)
                    <tr>
                        <td class="whitespace-nowrap pl-14 py-2 text-gray-700 text-center">{{ $item->kode_kaprodi }}</td>
                        <td class="whitespace-nowrap pl-14 py-2 text-gray-700 text-center">{{ $item->nip }}</td>
                        <td class="whitespace-nowrap pl-14 py-2 text-gray-700 text-center">{{ $item->nama }}</td>
                        <td class="whitespace-nowrap pl-14 py-2">
                            @if(session('role') === 'kaprodi')
                                <a href="{{ route('edit_kaprodi', $item->id) }}" class="inline-block rounded bg-indigo-600 px-4 py-2 text-xs font-medium text-white hover:bg-indigo-700">Edit</a>
                                <form action="{{ route('hapus_kaprodi', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-block rounded bg-red-600 px-4 py-2 text-xs font-medium text-white hover:bg-red-700 ml-2">Delete</button>
                                </form>                                
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
