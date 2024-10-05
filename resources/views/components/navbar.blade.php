<nav class="bg-gray-800" x-data="{ isOpen: false }">
  <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
    <div class="relative flex h-16 items-center justify-between">
      <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
        <!-- Mobile menu button-->
        <button type="button" @click="isOpen = !isOpen" class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
          <span class="absolute -inset-0.5"></span>
          <span class="sr-only">Open main menu</span>
          <!--
            Icon when menu is closed.

            Menu open: "hidden", Menu closed: "block"
          -->
          <svg :class="{'hidden': isOpen, 'block': !isOpen }" class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
          <!--
            Icon when menu is open.

            Menu open: "block", Menu closed: "hidden"
          -->
          <svg :class="{'block': isOpen, 'hidden': !isOpen }" class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
      <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
        <div class="flex flex-shrink-0 items-center">
          <img class="h-8 w-auto" src="{{ asset('img/logo2.jpg') }}" alt="Your Company">
        </div>
        <div class="hidden sm:ml-6 sm:block">
          <div class="flex space-x-4">
            <div class="relative">
              <a href="{{ route('dashboard') }}" class="rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white" aria-current="page">Dashboard</a>
            </div>
            <div class="relative">
              <a href="{{ route('kaprodi') }}" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Kaprodi</a>
            </div>
            <div class="relative">
              <a href="#" id="dosenDropdownButton" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Dosen</a>
               <!-- Dropdown Menu -->
               <div id="dosenDropdown" class="hidden absolute z-20 w-56 mt-2 bg-white rounded-md shadow-xl dark:bg-gray-800">
                <hr class="border-gray-200 dark:border-gray-700">
                <a href="{{ route('dosen') }}" class="block px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">Data Dosen</a> 
                @if(auth()->user()->role === 'kaprodi'|| auth()->user()->role === 'dosen')
                    <a href="{{ route('data_kelas') }}" class="block px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">Kelas</a>
                @endif
            </div>
            </div>
            <!-- Dropdown for Mahasiswa -->
            <div class="relative">
              @if(auth()->user()->role === 'kaprodi' || auth()->user()->role === 'dosen')
              <a href="#" id="mahasiswaDropdownButton" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Mahasiswa</a>
            
              <!-- Dropdown Menu -->
              <div id="mahasiswaDropdown" class="hidden absolute z-20 w-56 mt-2 bg-white rounded-md shadow-xl dark:bg-gray-800">
                  <hr class="border-gray-200 dark:border-gray-700">
                  <a href="{{ route('mahasiswa') }}" class="block px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">Data Mahasiswa</a>
                  <a href="{{ route('data_request') }}" class="block px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">Permintaan Request</a>
              </div>
              @endif
            </div>          
          </div>
          

          <script>
            const dosenDropdownButton = document.getElementById('dosenDropdownButton');
            const dosenDropdown = document.getElementById('dosenDropdown');
          
            dosenDropdownButton.addEventListener('click', function(event) {
              event.preventDefault(); // Prevent the default behavior of the anchor tag
              dosenDropdown.classList.toggle('hidden');
            });
          
            // Optional: Close the dropdown if clicked outside
            window.addEventListener('click', function(event) {
              if (!dosenDropdownButton.contains(event.target) && !dosenDropdown.contains(event.target)) {
                dosenDropdown.classList.add('hidden');
              }
            });
          </script>

          <script>
            const mahasiswaDropdownButton = document.getElementById('mahasiswaDropdownButton');
            const mahasiswaDropdown = document.getElementById('mahasiswaDropdown');
          
            mahasiswaDropdownButton.addEventListener('click', function(event) {
              event.preventDefault(); // Prevent the default behavior of the anchor tag
              mahasiswaDropdown.classList.toggle('hidden');
            });
          
            // Optional: Close the dropdown if clicked outside
            window.addEventListener('click', function(event) {
              if (!mahasiswaDropdownButton.contains(event.target) && !mahasiswaDropdown.contains(event.target)) {
                mahasiswaDropdown.classList.add('hidden');
              }
            });
          </script>
          
        </div>
      </div>
      <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">

        <!-- Profile dropdown -->
        <div class="relative ml-3">
          <div>
            <button type="button" @click="isOpen = !isOpen" class="relative flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
              <span class="absolute -inset-1.5"></span>
              <span class="sr-only">Open user menu</span>
              <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
            </button>
          </div>
          <div 
          x-show="isOpen"
          x-transition:enter="transition ease-out duration-100 transform"
          x-transition:enter-start="opacity-0 scale-95"
          x-transition:enter-end="opacity-100 scale-100"
          x-transition:leave="transition ease-in duration-75 transform"
          x-transition:leave-start="opacity-100 scale-100"
          x-transition:leave-end="opacity-0 scale-95"
          class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
            <!-- Active: "bg-gray-100", Not Active: "" -->
            <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Profile</a>
            <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Keluar</a>          
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Mobile menu, show/hide based on menu state. -->
  <div x-show="isOpen" class="sm:hidden" id="mobile-menu">
    <div class="space-y-1 px-2 pb-3 pt-2">
      <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
      <a href="#" class="block rounded-md bg-gray-900 px-3 py-2 text-base font-medium text-white" aria-current="page">Dashboard</a>
      <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Team</a>
      <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Projects</a>
      <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Calendar</a>
    </div>
  </div>
</nav>
