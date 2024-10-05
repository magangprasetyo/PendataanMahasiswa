<div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-lg text-center">
      <h1 class="text-2xl font-bold sm:text-3xl">Tambahkan Data Kelas</h1>
  
      <p class="mt-4 text-gray-500">
      </p>
    </div>
  
    <form action="{{ route('tambah') }}" method="POST" class="mx-auto mb-0 mt-8 max-w-md space-y-4">
      @csrf
      <div>
        <label for="nama" class="sr-only">Nama Kelas</label>
  
        <div class="relative">
          <input
            type="teks"
             name="nama"
            class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
            placeholder="Enter Nama Kelas"
          />   
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"
              />
            </svg>
          </span>
        </div>
      </div>

      <div>
        <label for="jumlah" class="sr-only">Jumlah Kelas</label>
  
        <div class="relative">
          <input
            type="number"
            name="jumlah"
            class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
            placeholder="Enter Jumlah Kelas"
          />
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"
              />
            </svg>
          </span>
        </div>
      </div>
      <div class="flex items-center justify-between">
        <p class="text-sm text-gray-500">
        </p>
  
        <button
          type="submit"
          class="inline-block rounded-lg bg-blue-500 px-5 py-3 text-sm font-medium text-white"
        >
          Tambah Data Kelas
        </button>
      </div>
    </form>
  </div>

  <script src="https://cdn.tailwindcss.com"></script>