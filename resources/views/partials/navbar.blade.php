<nav class="bg-white/95 shadow-md py-4 fixed top-0 left-0 right-0 z-50" x-data="{ mobileMenuOpen: false }">
  <div class="container mx-auto px-4">
    <div class="flex items-center">
      <!-- Hamburger Menu untuk Mobile -->
      <button @click="mobileMenuOpen = !mobileMenuOpen" class="sm:hidden mr-4 p-2 hover:bg-gray-100 rounded-lg transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
        </svg>
      </button>
      <!-- KIRI: logo -->
      <div class="flex-1">
        <div class="flex items-center space-x-2">
          <img src="{{ asset('foto/logo.jpeg') }}" alt="Rejosari Catering" class="h-10 md:h-14 w-auto object-contain">
          <h1 class="font-bold text-lg md:text-xl leading-none">
            <span class="text-[#86765a]">REJOSARI CATERING</span>
          </h1>
        </div>
      </div>

      <!-- TENGAH: menu navigasi -->
      <div class="flex-1 flex justify-center">
        <div class="hidden sm:flex items-center space-x-6 md:space-x-8 lg:space-x-10">
          <a href="{{ url('/#beranda') }}" class="nav-link {{ Route::currentRouteName() == 'home' ? 'px-6 py-2 text-[#86765a] font-semibold' : 'px-6 py-2 hover:text-[#86765a] transition' }}">Beranda</a>

          <a href="{{ url('/#tentang') }}" class="nav-link {{ Route::currentRouteName() == 'about' ? 'px-6 py-2 bg-[#86765a] text-white rounded-full font-semibold' : 'px-4 py-2 hover:text-[#86765a] transition' }}">Tentang</a>

          <a href="{{ url('/#menu') }}" class="nav-link {{ Route::currentRouteName() == 'menu' ? 'px-6 py-2 bg-[#86765a] text-white rounded-full font-semibold' : 'px-4 py-2 hover:text-[#86765a] transition' }}">Menu</a>

          <a href="{{ url('/#galeri') }}" class="nav-link {{ Route::currentRouteName() == 'gallery' ? 'px-6 py-2 bg-[#86765a] text-white rounded-full font-semibold' : 'px-4 py-2 hover:text-[#86765a] transition' }}">Galeri</a>

          <a href="{{ url('/#kontak') }}" class="nav-link {{ Route::currentRouteName() == 'contact' ? 'px-6 py-2 bg-[#86765a] text-white rounded-full font-semibold' : 'px-4 py-2 hover:text-[#86765a] transition' }}">Kontak</a>
        </div>
      </div>

      <!-- KANAN: cart dan login/profile -->
      <div class="flex-1 flex justify-end items-center space-x-2 sm:space-x-4">
        @auth
        @if(!Auth::user()->is_admin)
        <!-- Riwayat Pesanan Button - Hidden on mobile -->
        <a href="{{ route('orders.history') }}" class="hidden sm:block relative p-2 hover:bg-gray-100 rounded-full group" title="Riwayat Pesanan">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 group-hover:text-[#86765a]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
          </svg>
        </a>
        <!-- Cart Button - Hidden on mobile -->
        <a href="{{ url('/cart') }}" class="hidden sm:block relative p-2 hover:bg-gray-100 rounded-full group">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 group-hover:text-[#86765a]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
          </svg>
          <span x-show="itemCount > 0"
                x-text="itemCount"
                class="absolute -top-1 -right-1 bg-orange-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-bold">
          </span>
        </a>
        @endif
          @if(Auth::user()->is_admin)
          <!-- Cart Button - Keep visible for admin as requested -->
          <a href="{{ url('/cart') }}" class="hidden sm:inline-flex items-center justify-center relative w-10 h-10 hover:bg-gray-100 rounded-full group transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 group-hover:text-[#86765a]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
          </a>
          @endif
        @endauth

        @auth
        <!-- Profile Menu (Desktop) -->
        <div class="hidden sm:block relative order-3" x-data="{ isOpen: false }">
          <button @click="isOpen = !isOpen" class="flex items-center space-x-2 p-2 hover:bg-gray-100 rounded-full">
            <span class="text-sm md:text-base text-gray-600">Hi, {{ Auth::user()->name }}</span>
            <svg xmlns="http://www.w3.org/2000/svg"
              class="h-4 w-4 text-gray-500 transform transition-transform duration-200"
              :class="{ 'rotate-180': isOpen }"
              fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </button>
          <div x-show="isOpen"
            @click.away="isOpen = false"
            x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="transform opacity-0 scale-95"
            x-transition:enter-end="transform opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="transform opacity-100 scale-100"
            x-transition:leave-end="transform opacity-0 scale-95"
            class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl border border-gray-200">
            <div class="py-2">
              @if(Auth::user()->is_admin)
              <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                <div class="flex items-center space-x-2">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                  </svg>
                  <span>Dashboard Admin</span>
                </div>
              </a>
              @else
              <a href="{{ route('orders.history') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                <div class="flex items-center space-x-2">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                  </svg>
                  <span>Riwayat Pesanan</span>
                </div>
              </a>
              @endif
              <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                <div class="flex items-center space-x-2">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                  </svg>
                  <span>Profil</span>
                </div>
              </a>
              <form method="POST" action="{{ route('logout') }}" class="block">
                @csrf
                <button type="submit" class="w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100">
                  <div class="flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    <span>Keluar</span>
                  </div>
                </button>
              </form>
            </div>
          </div>
        </div>
        @endauth
        <!-- Search Button and Form -->
        <div class="relative @auth order-2 @endauth" x-data="{ isOpen: false, searchQuery: '' }">
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
            class="absolute right-0 mt-2 w-64 sm:w-72 bg-white rounded-lg shadow-xl border border-gray-200 py-2 px-3">
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



        <!-- Icon Akun dengan Dropdown - Only for Guests -->
        @guest
        <div class="relative" x-data="{ isOpen: false }">
          <div @click="isOpen = !isOpen" class="flex items-center space-x-2 cursor-pointer p-2 hover:bg-gray-100 rounded-full">
            <!-- Icon visible on all screens -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
          </div>

          <!-- Account Dropdown -->
          <div x-show="isOpen"
            @click.away="isOpen = false"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-100"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl border border-gray-200 py-2 z-50">
            <a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
              Masuk
            </a>
            <a href="{{ route('register') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 border-t border-gray-100">
              Daftar
            </a>
          </div>
        </div>
        @endguest
      </div>
    </div>
  </div>

  <!-- Mobile Menu Dropdown -->
  <div x-show="mobileMenuOpen"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 -translate-y-2"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 -translate-y-2"
    @click.away="mobileMenuOpen = false"
    class="sm:hidden mt-4 mb-4 bg-white rounded-lg shadow-xl border border-gray-200 overflow-hidden max-h-[calc(100vh-120px)] overflow-y-auto"
    style="display: none;">
    <div class="py-2">
      <!-- Menu Navigation -->
      <a href="{{ url('/#beranda') }}" @click="mobileMenuOpen = false" class="block px-4 py-3 text-gray-700 hover:bg-gray-100 transition">
        <div class="flex items-center space-x-3">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#86765a]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
          </svg>
          <span class="font-medium">Beranda</span>
        </div>
      </a>
      <a href="{{ url('/#tentang') }}" @click="mobileMenuOpen = false" class="block px-4 py-3 text-gray-700 hover:bg-gray-100 transition">
        <div class="flex items-center space-x-3">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#86765a]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          <span class="font-medium">Tentang</span>
        </div>
      </a>
      <a href="{{ url('/#menu') }}" @click="mobileMenuOpen = false" class="block px-4 py-3 text-gray-700 hover:bg-gray-100 transition">
        <div class="flex items-center space-x-3">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#86765a]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
          </svg>
          <span class="font-medium">Menu</span>
        </div>
      </a>
      <a href="{{ url('/#galeri') }}" @click="mobileMenuOpen = false" class="block px-4 py-3 text-gray-700 hover:bg-gray-100 transition">
        <div class="flex items-center space-x-3">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#86765a]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
          </svg>
          <span class="font-medium">Galeri</span>
        </div>
      </a>
      <a href="{{ url('/#kontak') }}" @click="mobileMenuOpen = false" class="block px-4 py-3 text-gray-700 hover:bg-gray-100 transition">
        <div class="flex items-center space-x-3">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#86765a]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
          </svg>
          <span class="font-medium">Kontak</span>
        </div>
      </a>

      <!-- Divider -->
      <div class="border-t border-gray-200 my-2"></div>

      <!-- Account Section -->
      @auth
      <!-- Cart and History for Mobile -->
      <a href="{{ url('/cart') }}" @click="mobileMenuOpen = false" class="block px-4 py-3 text-gray-700 hover:bg-gray-100 transition">
        <div class="flex items-center justify-between">
          <div class="flex items-center space-x-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#86765a]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <span class="font-medium">Keranjang</span>
          </div>
          <span x-show="itemCount > 0" x-text="itemCount" class="bg-orange-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-bold"></span>
        </div>
      </a>
      
      <div class="border-t border-gray-100"></div>
      
      <div class="px-4 py-2 text-sm font-medium text-gray-500">
        Hi, {{ Auth::user()->name }}
      </div>
      @if(Auth::user()->is_admin)
      <a href="{{ route('admin.dashboard') }}" @click="mobileMenuOpen = false" class="block px-4 py-3 text-gray-700 hover:bg-gray-100 transition">
        <div class="flex items-center space-x-3">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#86765a]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
          </svg>
          <span class="font-medium">Dashboard Admin</span>
        </div>
      </a>
      @else
      <a href="{{ route('orders.history') }}" @click="mobileMenuOpen = false" class="block px-4 py-3 text-gray-700 hover:bg-gray-100 transition">
        <div class="flex items-center space-x-3">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#86765a]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
          </svg>
          <span class="font-medium">Riwayat Pesanan</span>
        </div>
      </a>
      @endif
      <a href="{{ route('profile.edit') }}" @click="mobileMenuOpen = false" class="block px-4 py-3 text-gray-700 hover:bg-gray-100 transition">
        <div class="flex items-center space-x-3">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#86765a]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
          </svg>
          <span class="font-medium">Profil</span>
        </div>
      </a>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="w-full text-left px-4 py-3 text-gray-700 hover:bg-gray-100 transition">
          <div class="flex items-center space-x-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
            <span class="font-medium">Keluar</span>
          </div>
        </button>
      </form>
      @else
      <a href="{{ route('login') }}" @click="mobileMenuOpen = false" class="block px-4 py-3 text-gray-700 hover:bg-gray-100 transition">
        <div class="flex items-center space-x-3">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#86765a]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
          </svg>
          <span class="font-medium">Masuk</span>
        </div>
      </a>
      <a href="{{ route('register') }}" @click="mobileMenuOpen = false" class="block px-4 py-3 text-gray-700 hover:bg-gray-100 transition">
        <div class="flex items-center space-x-3">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#86765a]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
          </svg>
          <span class="font-medium">Daftar</span>
        </div>
      </a>
      @endauth
    </div>
  </div>
</nav>

<!-- Old Sidenav - Commented Out -->
<!--
<div id="sidenav" class="fixed top-0 left-0 h-full w-64 bg-white shadow-lg transform -translate-x-full transition-transform duration-300 ease-in-out z-50">
  ... sidenav content ...
</div>
-->

<!-- Search Overlay -->
<div id="searchOverlay" class="fixed inset-0 bg-black/50 backdrop-filter backdrop-blur-sm hidden z-40">
  <div class="container mx-auto px-4 pt-20">
    <div class="bg-white rounded-lg shadow-xl max-w-2xl mx-auto">
      <div class="p-4 flex items-center border-b">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
        <input type="search"
          id="searchInput"
          placeholder="Cari menu..."
          class="flex-1 outline-none text-lg">
        <button onclick="toggleSearch()" class="p-2 hover:bg-gray-100 rounded-full ml-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
      <div class="p-4 max-h-96 overflow-y-auto" id="searchResults">
        <!-- Search results will be populated here -->
      </div>
    </div>
  </div>
</div>

<!-- Import navbar.js -->
<script src="{{ asset('js/navbar.js') }}"></script>

<!-- spacer to avoid content being hidden under the fixed navbar -->
<div class="h-20"></div>