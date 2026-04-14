<nav class="bg-white/95 shadow-md py-4 fixed top-0 left-0 right-0 z-50" x-data="{ mobileMenuOpen: false }">
  @php
    $userOrderNotificationCount = 0;
    if (Auth::check() && !Auth::user()->is_admin) {
      $lastUserOrderNotifReadAt = Auth::user()->last_user_order_notification_read_at;
      $userOrderNotificationQuery = \App\Models\Order::query()
        ->where(function ($query) {
          $query->where('user_id', Auth::id())
            ->orWhere('email', Auth::user()->email);
        });

      if ($lastUserOrderNotifReadAt) {
        $userOrderNotificationQuery->where('updated_at', '>', $lastUserOrderNotifReadAt);
      }

      $userOrderNotificationCount = $userOrderNotificationQuery->count();
    }

    $searchCategories = \App\Models\Category::query()
      ->where('is_active', true)
      ->orderBy('order')
      ->orderBy('id')
      ->get(['nama', 'slug', 'deskripsi']);

    $menuSearchItems = $searchCategories->map(function ($category) {
      return [
        'name' => $category->nama,
        'slug' => $category->slug,
        'category' => $category->nama,
        'description' => $category->deskripsi ?: 'Buka menu ' . strtolower($category->nama),
        'url' => route('menu.category', ['slug' => $category->slug]),
      ];
    })->values();
  @endphp
  <div class="container mx-auto px-4">
    <div class="flex items-center">
      <!-- Hamburger Menu untuk Mobile -->
      <button class="sm:hidden mr-4" @click="mobileMenuOpen = !mobileMenuOpen">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
        </svg>
      </button>
      <!-- KIRI: logo -->
      <div class="flex-1">
        <div class="flex items-center space-x-2">
          <img src="{{ asset('foto/logo.jpeg') }}" alt="Rejosari Catering" class="h-12 md:h-16 w-auto object-contain">
          <h1 class="font-bold text-lg md:text-xl leading-none">
            <span class="text-[#86765a]">REJOSARI CATERING</span>
          </h1>
        </div>
      </div>

      <!-- TENGAH: menu navigasi -->
      <div class="flex-1 flex justify-center">
        <div class="hidden sm:flex items-center space-x-6 md:space-x-8 lg:space-x-10">
          <a href="{{ route('home') }}#beranda" class="nav-link px-4 py-2 hover:text-[#86765a] transition">Beranda</a>
          <a href="{{ route('home') }}#tentang" class="nav-link px-4 py-2 hover:text-[#86765a] transition">Tentang</a>
          <a href="{{ route('home') }}#menu" class="nav-link px-4 py-2 hover:text-[#86765a] transition">Menu</a>
          <a href="{{ route('home') }}#galeri" class="nav-link px-4 py-2 hover:text-[#86765a] transition">Galeri</a>
          <a href="{{ route('home') }}#kontak" class="nav-link px-4 py-2 hover:text-[#86765a] transition">Kontak</a>
        </div>
      </div>

      <!-- KANAN: cart, search dan login/profile -->
      <div class="flex-1 flex justify-end items-center space-x-4">
        @auth
        @if(!Auth::user()->is_admin)
        <!-- Riwayat Pesanan Button -->
        <a href="{{ route('orders.history') }}" class="relative p-2 hover:bg-gray-100 rounded-full group" title="Riwayat Pesanan">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 group-hover:text-[#86765a]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
          </svg>
          @if($userOrderNotificationCount > 0)
          <span class="absolute -top-1 -right-1 min-w-[18px] h-[18px] px-1 bg-indigo-600 text-white text-[10px] rounded-full flex items-center justify-center font-bold leading-none border border-white">
            {{ $userOrderNotificationCount > 99 ? '99+' : $userOrderNotificationCount }}
          </span>
          @endif
        </a>
        @endif
        @endauth

        <!-- Cart Button -->
        <x-cart-button :order-notification-count="$userOrderNotificationCount" />

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
            style="display: none;"
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
            style="display: none;"
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

    <!-- Mobile Menu Dropdown -->
    <div x-show="mobileMenuOpen"
      x-transition:enter="transition ease-out duration-200"
      x-transition:enter-start="opacity-0 -translate-y-2"
      x-transition:enter-end="opacity-100 translate-y-0"
      x-transition:leave="transition ease-in duration-150"
      x-transition:leave-start="opacity-100 translate-y-0"
      x-transition:leave-end="opacity-0 -translate-y-2"
      @click.away="mobileMenuOpen = false"
      class="sm:hidden mt-4 bg-white rounded-lg shadow-xl border border-gray-200 overflow-hidden"
      style="display: none;">
      <div class="py-2">
        <!-- Menu Navigation -->
        <a href="{{ route('home') }}#beranda" @click="mobileMenuOpen = false" class="block px-4 py-3 text-gray-700 hover:bg-gray-100 transition">
          <div class="flex items-center space-x-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#86765a]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <span class="font-medium">Beranda</span>
          </div>
        </a>
        <a href="{{ route('home') }}#tentang" @click="mobileMenuOpen = false" class="block px-4 py-3 text-gray-700 hover:bg-gray-100 transition">
          <div class="flex items-center space-x-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#86765a]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="font-medium">Tentang</span>
          </div>
        </a>
        <a href="{{ route('home') }}#menu" @click="mobileMenuOpen = false" class="block px-4 py-3 text-gray-700 hover:bg-gray-100 transition">
          <div class="flex items-center space-x-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#86765a]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg>
            <span class="font-medium">Menu</span>
          </div>
        </a>
        <a href="{{ route('home') }}#galeri" @click="mobileMenuOpen = false" class="block px-4 py-3 text-gray-700 hover:bg-gray-100 transition">
          <div class="flex items-center space-x-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#86765a]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <span class="font-medium">Galeri</span>
          </div>
        </a>
        <a href="{{ route('home') }}#kontak" @click="mobileMenuOpen = false" class="block px-4 py-3 text-gray-700 hover:bg-gray-100 transition">
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
        <div class="px-4 py-2 text-sm font-medium text-gray-500">
          Hi, {{ Auth::user()->name }}
        </div>
        <a href="{{ route('orders.history') }}" @click="mobileMenuOpen = false" class="block px-4 py-3 text-gray-700 hover:bg-gray-100 transition">
          <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#86765a]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <span class="font-medium">Riwayat Pesanan</span>
            </div>
            @if($userOrderNotificationCount > 0)
            <span class="min-w-[18px] h-[18px] px-1 bg-indigo-600 text-white text-[10px] rounded-full flex items-center justify-center font-bold leading-none">
              {{ $userOrderNotificationCount > 99 ? '99+' : $userOrderNotificationCount }}
            </span>
            @endif
          </div>
        </a>
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
  </div>
</nav>

<!-- Old Sidenav - Commented Out -->
<!--
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
      <li class="mb-4">
        <a href="{{ route('home') }}#menu" class="flex items-center space-x-2 text-[#86765a] font-medium">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
          </svg>
          <span>Kembali ke Menu Utama</span>
        </a>
      </li>
      <li class="border-t pt-4"><a href="{{ route('home') }}" class="block py-2 hover:text-[#86765a] transition">Beranda</a></li>
      <li><a href="{{ route('home') }}#tentang" class="block py-2 hover:text-[#86765a] transition">Tentang</a></li>
      <li><a href="{{ route('home') }}#menu" class="block py-2 hover:text-[#86765a] transition">Menu</a></li>
      <li><a href="{{ route('home') }}#galeri" class="block py-2 hover:text-[#86765a] transition">Galeri</a></li>
      <li><a href="{{ route('home') }}#kontak" class="block py-2 hover:text-[#86765a] transition">Kontak</a></li>
    </ul>
  </nav>
</div>
-->

<!-- Search functionality -->
<script>
  window.menuSearchItems = @json($menuSearchItems);

  function normalizeSearchValue(value) {
    return (value || '')
      .toString()
      .toLowerCase()
      .replace(/[\s_-]+/g, '');
  }

  function closeSearchDropdown() {
    const searchInput = document.querySelector('input[x-model="searchQuery"]');
    if (searchInput) {
      searchInput.value = '';
      searchInput.dispatchEvent(new Event('input'));
    }
  }

  function selectMenuSearchItem(url) {
    closeSearchDropdown();
    window.location.href = url;
  }

  function searchMenus() {
    const searchInput = document.querySelector('input[x-model="searchQuery"]');
    const searchQuery = normalizeSearchValue(searchInput ? searchInput.value : '');
    const resultsContainer = document.getElementById('searchResults');

    if (searchQuery.length === 0) {
      resultsContainer.innerHTML = '';
      return;
    }

    const results = (window.menuSearchItems || []).filter(item => {
      const name = normalizeSearchValue(item.name);
      const category = normalizeSearchValue(item.category);
      const description = normalizeSearchValue(item.description);
      const slug = normalizeSearchValue(item.slug);

      return name.includes(searchQuery) ||
        category.includes(searchQuery) ||
        description.includes(searchQuery) ||
        slug.includes(searchQuery);
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
    <button type="button" class="w-full text-left py-2 px-4 hover:bg-gray-50 cursor-pointer" data-menu-url="${item.url}">
      <div class="font-medium text-gray-800">${item.name}</div>
      <div class="text-sm text-gray-500">${item.category}</div>
      <div class="text-xs text-gray-400">${item.description}</div>
    </button>
  `).join('');
    
    // Attach click handlers to all menu search result buttons
    document.querySelectorAll('[data-menu-url]').forEach(btn => {
      btn.addEventListener('click', function(e) {
        e.preventDefault();
        selectMenuSearchItem(this.getAttribute('data-menu-url'));
      });
    });
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