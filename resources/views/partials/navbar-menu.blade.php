<nav class="bg-white/95 shadow-md py-4 fixed top-0 left-0 right-0 z-50">
  <div class="container mx-auto px-4">
    <div class="flex items-center">
      <!-- Hamburger Menu untuk Mobile -->
      <button class="sm:hidden mr-4" onclick="toggleSidenav()">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
        </svg>
      </button>
      <!-- KIRI: logo -->
      <div class="flex-1">
        <a href="{{ route('home') }}" class="flex items-center space-x-2">
          <img src="{{ asset('foto/rejosari.jpg') }}" alt="Rejosari Catering" class="h-8 md:h-10 w-auto object-contain rounded-full">
          <h1 class="font-bold text-lg md:text-xl leading-none">
            <span class="text-[#86765a]">REJOSARI</span>
            <span class="bg-gray-900 text-white text-xs font-extrabold rounded-sm px-1 align-top ml-1">CATERING</span>
          </h1>
        </a>
      </div>

      <!-- TENGAH: menu navigasi -->
      <div class="flex-1 flex justify-center">
        <div class="hidden sm:flex items-center space-x-6 md:space-x-8 lg:space-x-10">
          <a href="{{ route('home') }}#home" class="nav-link px-4 py-2 hover:text-[#86765a] transition">Home</a>
          <a href="{{ route('home') }}#about" class="nav-link px-4 py-2 hover:text-[#86765a] transition">About</a>
          <a href="{{ route('home') }}#menu" class="nav-link px-4 py-2 hover:text-[#86765a] transition">Menu</a>
          <a href="{{ route('home') }}#gallery" class="nav-link px-4 py-2 hover:text-[#86765a] transition">Gallery</a>
          <a href="{{ route('home') }}#contact" class="nav-link px-4 py-2 hover:text-[#86765a] transition">Contact</a>
        </div>
      </div>

      <!-- KANAN: cart, search dan login/profile -->
      <div class="flex-1 flex justify-end items-center space-x-4">
        <!-- Cart Button -->
        <x-cart-button />

        <!-- Search Button and Form -->
        <div class="relative" x-data="{ isOpen: false, searchQuery: '' }">
          <button type="button" 
                  class="p-2 hover:bg-gray-100 rounded-full" 
                  @click="isOpen = !isOpen">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
          </button>
          
          <!-- Search Form -->
          <div x-show="isOpen" 
               @click.away="isOpen = false"
               x-transition:enter="transition ease-out duration-200"
               x-transition:enter-start="opacity-0 scale-95"
               x-transition:enter-end="opacity-100 scale-100"
               x-transition:leave="transition ease-in duration-100"
               x-transition:leave-start="opacity-100 scale-100"
               x-transition:leave-end="opacity-0 scale-95"
               class="absolute right-0 mt-2 w-48 sm:w-72 bg-white rounded-lg shadow-xl border border-gray-200 py-2 px-3">
            <div class="relative">
              <input type="text" 
                     x-model="searchQuery"
                     @input.debounce.300ms="searchMenus()"
                     placeholder="Cari menu..." 
                     class="w-full text-sm sm:text-base pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-orange-500">
              <div class="absolute left-3 top-2.5">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
              </div>
            </div>
            
            <!-- Search Results -->
            <div x-show="searchQuery.length > 0" 
                 class="mt-4 max-h-64 overflow-y-auto" 
                 id="searchResults">
              <!-- Results will be dynamically inserted here -->
            </div>
          </div>
        </div>

        <!-- Account Button -->
        <div class="relative" x-data="{ isOpen: false }">
          <button @click="isOpen = !isOpen" class="p-2 hover:bg-gray-100 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
          </button>

          <div x-show="isOpen" 
               @click.away="isOpen = false"
               x-transition:enter="transition ease-out duration-200"
               x-transition:enter-start="opacity-0 scale-95"
               x-transition:enter-end="opacity-100 scale-100"
               x-transition:leave="transition ease-in duration-100"
               x-transition:leave-start="opacity-100 scale-100"
               x-transition:leave-end="opacity-0 scale-95"
               class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl border border-gray-200">
            @auth
            <div class="py-2">
              <div class="px-4 py-2 text-sm font-medium text-gray-800 border-b border-gray-100">
                Hi, {{ Auth::user()->name }}
              </div>
              <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                <div class="flex items-center space-x-2">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                  </svg>
                  <span>Profile</span>
                </div>
              </a>
              <form method="POST" action="{{ route('logout') }}" class="block">
                @csrf
                <button type="submit" class="w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100">
                  <div class="flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    <span>Logout</span>
                  </div>
                </button>
              </form>
            </div>
            @else
            <div class="py-2">
              <a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                <div class="flex items-center space-x-2">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                  </svg>
                  <span>Masuk</span>
                </div>
              </a>
              <a href="{{ route('register') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 border-t border-gray-100">
                <div class="flex items-center space-x-2">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                  </svg>
                  <span>Daftar</span>
                </div>
              </a>
            </div>
            @endauth
          </div>
        </div>


      </div>
    </div>
  </div>
</nav>

<!-- Sidenav untuk Mobile -->
<div id="sidenav" class="fixed top-0 left-0 h-full w-64 bg-white shadow-lg transform -translate-x-full transition-transform duration-300 ease-in-out z-50">
    <div class="p-4 border-b">
        <div class="flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center space-x-2">
                <img src="{{ asset('foto/rejosari.jpg') }}" alt="Rejosari Catering" class="h-8 w-auto object-contain rounded-full">
                <span class="font-bold text-lg text-[#86765a]">REJOSARI</span>
            </a>
            <button onclick="toggleSidenav()" class="p-2 hover:bg-gray-100 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
    <nav class="p-4">
        <ul class="space-y-3">
            <!-- Back Button for Mobile -->
            <li class="mb-4">
                <a href="{{ route('home') }}#menu" class="flex items-center space-x-2 text-[#86765a] font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    <span>Kembali ke Menu Utama</span>
                </a>
            </li>
            <li class="border-t pt-4"><a href="{{ route('home') }}" class="block py-2 hover:text-[#86765a] transition">Home</a></li>
            <li><a href="{{ route('home') }}#about" class="block py-2 hover:text-[#86765a] transition">About</a></li>
            <li><a href="{{ route('home') }}#menu" class="block py-2 hover:text-[#86765a] transition">Menu</a></li>
            <li><a href="{{ route('home') }}#gallery" class="block py-2 hover:text-[#86765a] transition">Gallery</a></li>
            <li><a href="{{ route('home') }}#contact" class="block py-2 hover:text-[#86765a] transition">Contact</a></li>
        </ul>
    </nav>
</div>

<!-- Search functionality -->
<script>
// Daftar menu (dalam prakteknya, ini bisa diambil dari database)
const menuItems = {
  'prasmanan': [
    { name: 'Paket Prasmanan Standard', price: 'Rp 35.000/pax', description: 'Menu prasmanan lengkap 7 item', category: 'Prasmanan' },
    { name: 'Paket Prasmanan Premium', price: 'Rp 45.000/pax', description: 'Menu prasmanan lengkap 10 item', category: 'Prasmanan' }
  ],
  'tumpeng': [
    { name: 'Tumpeng Mini', price: 'Rp 250.000', description: 'Untuk 7-10 orang', category: 'Tumpeng' },
    { name: 'Tumpeng Regular', price: 'Rp 450.000', description: 'Untuk 15-20 orang', category: 'Tumpeng' }
  ],
  'nasi-box': [
    { name: 'Nasi Box Basic', price: 'Rp 25.000', description: '4 item menu', category: 'Nasi Box' },
    { name: 'Nasi Box Premium', price: 'Rp 35.000', description: '6 item menu', category: 'Nasi Box' }
  ],
  'snack': [
    { name: 'Snack Box Mini', price: 'Rp 15.000', description: '3 macam snack', category: 'Snack' },
    { name: 'Snack Box Complete', price: 'Rp 25.000', description: '5 macam snack', category: 'Snack' }
  ]
};

function searchMenus() {
  const searchQuery = document.querySelector('input[x-model="searchQuery"]').value.toLowerCase();
  const resultsContainer = document.getElementById('searchResults');
  
  if (searchQuery.length === 0) {
    resultsContainer.innerHTML = '';
    return;
  }

  let results = [];
  Object.values(menuItems).forEach(category => {
    category.forEach(item => {
      if (item.name.toLowerCase().includes(searchQuery) || 
          item.category.toLowerCase().includes(searchQuery) ||
          item.description.toLowerCase().includes(searchQuery)) {
        results.push(item);
      }
    });
  });

  if (results.length === 0) {
    resultsContainer.innerHTML = `
      <div class="py-3 px-4 text-gray-500 text-sm">
        Tidak ada menu yang ditemukan
      </div>
    `;
    return;
  }

  resultsContainer.innerHTML = results.map(item => `
    <div class="py-2 px-4 hover:bg-gray-50 cursor-pointer" onclick="scrollToCategory('${item.category.toLowerCase()}')">
      <div class="font-medium text-gray-800">${item.name}</div>
      <div class="text-sm text-gray-500">${item.category} • ${item.price}</div>
      <div class="text-xs text-gray-400">${item.description}</div>
    </div>
  `).join('');
}

function scrollToCategory(category) {
  const section = document.getElementById(category);
  if (section) {
    section.scrollIntoView({ behavior: 'smooth' });
  }
  
  // Close the search dropdown
  const searchInput = document.querySelector('input[x-model="searchQuery"]');
  if (searchInput) {
    searchInput.value = '';
    searchInput.dispatchEvent(new Event('input'));
  }
}
</script>

<!-- Import navbar.js -->
<script src="{{ asset('js/navbar.js') }}"></script>

<!-- spacer to avoid content being hidden under the fixed navbar -->
<div class="h-20"></div>