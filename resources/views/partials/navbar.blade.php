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
          <a href="#home" class="nav-link {{ Route::currentRouteName() == 'home' ? 'px-6 py-2 bg-[#86765a] text-white rounded-full font-semibold' : 'px-6 py-2 hover:text-[#86765a] transition' }}">Home</a>

          <a href="#about" class="nav-link {{ Route::currentRouteName() == 'about' ? 'px-6 py-2 bg-[#86765a] text-white rounded-full font-semibold' : 'px-4 py-2 hover:text-[#86765a] transition' }}">About</a>
          
          <a href="#menu" class="nav-link {{ Route::currentRouteName() == 'menu' ? 'px-6 py-2 bg-[#86765a] text-white rounded-full font-semibold' : 'px-4 py-2 hover:text-[#86765a] transition' }}">Menu</a>

          <a href="#gallery" class="nav-link {{ Route::currentRouteName() == 'gallery' ? 'px-6 py-2 bg-[#86765a] text-white rounded-full font-semibold' : 'px-4 py-2 hover:text-[#86765a] transition' }}">Gallery</a>
          
          <a href="#contact" class="nav-link {{ Route::currentRouteName() == 'contact' ? 'px-6 py-2 bg-[#86765a] text-white rounded-full font-semibold' : 'px-4 py-2 hover:text-[#86765a] transition' }}">Contact</a>
        </div>
      </div>

      <!-- KANAN: cart dan login/profile -->
      <div class="flex-1 flex justify-end items-center space-x-4">
        <x-cart-button />
        @auth
        <!-- Profile Menu (Desktop) -->
        <div class="hidden sm:block relative" x-data="{ isOpen: false }">
          <button @click="isOpen = !isOpen" class="flex items-center space-x-2 p-2 hover:bg-gray-100 rounded-full">
            <span class="text-gray-600">Hi, {{ Auth::user()->name }}</span>
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
          </div>
        </div>
        @endauth
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
        

        
        <!-- Icon Akun dengan Dropdown -->
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
      </div>
    </div>
  </div>
</nav>

<!-- Sidenav untuk Mobile -->
<div id="sidenav" class="fixed top-0 left-0 h-full w-64 bg-white shadow-lg transform -translate-x-full transition-transform duration-300 ease-in-out z-50">
    <div class="p-4 border-b">
        <div class="flex items-center justify-between">
            <img src="{{ asset('foto/rejosari.jpg') }}" alt="Rejosari Catering" class="h-8 w-auto object-contain rounded-full">
            <button onclick="toggleSidenav()" class="p-2 hover:bg-gray-100 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
    <nav class="p-4">
        <ul class="space-y-3">
            <li><a href="#home" class="block py-2 hover:text-[#86765a] transition">Home</a></li>
            <li><a href="#about" class="block py-2 hover:text-[#86765a] transition">About</a></li>
            <li x-data="{ isMenuOpen: false }">
                <button @click="isMenuOpen = !isMenuOpen" class="flex items-center justify-between w-full py-2 hover:text-[#86765a] transition">
                    <span>Menu</span>
                    <svg xmlns="http://www.w3.org/2000/svg" 
                         class="h-4 w-4 text-gray-500 transform transition-transform duration-200"
                         :class="{ 'rotate-180': isMenuOpen }"
                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="isMenuOpen"
                     x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="transform opacity-0 scale-95"
                     x-transition:enter-end="transform opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="transform opacity-100 scale-100"
                     x-transition:leave-end="transform opacity-0 scale-95"
                     class="ml-4 mt-2 space-y-2">
                    <a href="#buffet" class="block py-2 text-sm text-gray-600 hover:text-[#86765a] transition">Buffet</a>
                    <a href="#tumpeng" class="block py-2 text-sm text-gray-600 hover:text-[#86765a] transition">Tumpeng</a>
                    <a href="#nasi-box" class="block py-2 text-sm text-gray-600 hover:text-[#86765a] transition">Nasi Box</a>
                    <a href="#snack" class="block py-2 text-sm text-gray-600 hover:text-[#86765a] transition">Snack Box</a>
                </div>
            </li>
            <li><a href="#gallery" class="block py-2 hover:text-[#86765a] transition">Gallery</a></li>
            <li><a href="#contact" class="block py-2 hover:text-[#86765a] transition">Contact</a></li>
            <li class="pt-4 border-t" x-data="{ isOpen: false }">
                @auth
                <button @click="isOpen = !isOpen" class="flex items-center justify-between w-full py-2">
                    <div class="flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span class="text-gray-600">Profile</span>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" 
                         class="h-4 w-4 text-gray-500 transform transition-transform duration-200"
                         :class="{ 'rotate-180': isOpen }"
                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="isOpen"
                     x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="transform opacity-0 scale-95"
                     x-transition:enter-end="transform opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="transform opacity-100 scale-100"
                     x-transition:leave-end="transform opacity-0 scale-95"
                     class="mt-2 space-y-1 px-4">
                    <div class="block py-2 text-sm font-medium text-gray-800">
                        {{ Auth::user()->name }}
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="block">
                        @csrf
                        <button type="submit" class="w-full text-left py-2 text-sm text-gray-600 hover:text-[#86765a] transition">
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
                <button @click="isOpen = !isOpen" class="flex items-center justify-between w-full py-2">
                    <div class="flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span class="text-gray-600">Masuk/Daftar</span>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" 
                         class="h-4 w-4 text-gray-500 transform transition-transform duration-200"
                         :class="{ 'rotate-180': isOpen }"
                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="isOpen"
                     x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="transform opacity-0 scale-95"
                     x-transition:enter-end="transform opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="transform opacity-100 scale-100"
                     x-transition:leave-end="transform opacity-0 scale-95"
                     class="mt-2 space-y-1 px-4">
                    <a href="/login" class="block py-2 text-sm text-gray-600 hover:text-[#86765a] transition">
                        <div class="flex items-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                            <span>Masuk</span>
                        </div>
                    </a>
                    <a href="/register" class="block py-2 text-sm text-gray-600 hover:text-[#86765a] transition">
                        <div class="flex items-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                            <span>Daftar</span>
                        </div>
                    </a>
                </div>
                @endauth
            </li>
        </ul>
    </nav>
</div>

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

<script>
document.addEventListener('DOMContentLoaded', function () {
  const homeUrl = "{{ route('home') }}";
  const homePath = (new URL(homeUrl, window.location.origin)).pathname;
  const nav = document.querySelector('nav');
  const navHeight = nav ? nav.offsetHeight : 0;

  const navLinks = Array.from(document.querySelectorAll('a.nav-link'));
  const navAnchors = Array.from(document.querySelectorAll('a.nav-anchor'));
  const activeClasses = ['bg-[#86765a]','text-white','rounded-full','font-semibold'];
  const hoverClass = 'hover:text-[#86765a]';

  function clearActive() {
    navLinks.forEach(l => {
      activeClasses.forEach(c => l.classList.remove(c));
      if (!l.classList.contains('transition')) l.classList.add('transition');
      if (!l.classList.contains(hoverClass)) l.classList.add(hoverClass);
    });
  }

  function setActive(link) {
    if (!link) return;
    clearActive();
    activeClasses.forEach(c => link.classList.add(c));
    link.classList.remove(hoverClass);
  }

  // improved scroll: use main if element is inside it, otherwise scroll window/document
  function scrollToHash(hash, smooth = true) {
    const id = hash.replace('#','');
    const el = document.getElementById(id);
    if (!el) return;
    const main = document.querySelector('main');
    // if element is inside main -> scroll main; else scroll window
    if (main && main.contains(el)) {
      const container = main;
      const containerRect = container.getBoundingClientRect();
      const elRect = el.getBoundingClientRect();
      const currentScroll = container.scrollTop;
      const target = currentScroll + (elRect.top - containerRect.top) - navHeight - 8;
      if (smooth && container.scrollTo) {
        container.scrollTo({ top: target, behavior: 'smooth' });
      } else {
        container.scrollTop = target;
      }
    } else {
      // element is outside main; scroll the page
      const elTop = el.getBoundingClientRect().top + window.pageYOffset;
      const target = elTop - navHeight - 8;
      if (smooth && 'scrollTo' in window) {
        window.scrollTo({ top: target, behavior: 'smooth' });
      } else {
        window.scrollTo(0, target);
      }
    }
  }

  function isOnHome() {
    return window.location.pathname.replace(/\/$/,'') === homePath.replace(/\/$/,'');
  }

  // intercept nav anchors only when we're already on home (do smooth scroll)
  navAnchors.forEach(a => {
    a.addEventListener('click', function (e) {
      try {
        const href = a.getAttribute('href') || '';
        const url = new URL(href, window.location.origin);
        const hash = url.hash;
        // if link points to home path and we're already on home -> smooth scroll
        if ((url.pathname.replace(/\/$/,'') === homePath.replace(/\/$/,'') || url.href === homeUrl) && isOnHome()) {
          e.preventDefault();
          if (hash) {
            scrollToHash(hash, true);
            history.replaceState(null, '', hash);
            setActive(a);
          }
        }
        // otherwise let browser navigate to home#hash (on load script will handle scrolling)
      } catch (err) {
        // ignore
      }
    });
  });

  // immediate active on click
  navLinks.forEach(a => {
    a.addEventListener('click', function () {
      setActive(a);
    });
  });

  // Scrollspy using IntersectionObserver (observe sections inside main if exists)
  const sections = Array.from(document.querySelectorAll('section[id]'));
  const observerRoot = document.querySelector('main') || null;
  if ('IntersectionObserver' in window && sections.length) {
    const obs = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const id = entry.target.id;
          const match = navLinks.find(a => (a.getAttribute('href')||'').includes('#'+id));
          if (match) setActive(match);
        }
      });
    }, { threshold: 0.55, root: observerRoot });
    sections.forEach(s => obs.observe(s));
  } else {
    // fallback
    window.addEventListener('scroll', function () {
      let nearest = null, nearestPos = Infinity;
      sections.forEach(s => {
        const rect = s.getBoundingClientRect();
        const pos = Math.abs(rect.top - navHeight);
        if (pos < nearestPos) { nearestPos = pos; nearest = s; }
      });
      if (nearest) {
        const id = nearest.id;
        const match = navLinks.find(a => (a.getAttribute('href')||'').includes('#'+id));
        if (match) setActive(match);
      }
    }, { passive: true });
  }

  // On full page load: if we landed with a hash (from other page), wait for load then scroll
  window.addEventListener('load', function () {
    if (window.location.hash) {
      // longer timeout for heavy pages; adjust if needed
      setTimeout(function () {
        scrollToHash(window.location.hash, true);
        const match = navLinks.find(a => (a.getAttribute('href')||'').includes(window.location.hash));
        if (match) setActive(match);
      }, 250);
    }
  });
});
</script>

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
  const section = document.getElementById('menu');
  section.scrollIntoView({ behavior: 'smooth' });
  
  // Close the search dropdown
  const searchInput = document.querySelector('input[x-model="searchQuery"]');
  if (searchInput) {
    searchInput.value = '';
    searchInput.dispatchEvent(new Event('input'));
  }
}

// Cart Management
document.addEventListener('alpine:init', () => {
  Alpine.data('cart', () => ({
    isOpen: false,
    items: [],
    
    init() {
      // Load cart from localStorage
      const savedCart = localStorage.getItem('cart');
      if (savedCart) {
        this.items = JSON.parse(savedCart);
      }
      
      // Listen for add to cart events
      window.addEventListener('add-to-cart', (e) => {
        this.addItem(e.detail);
      });
    },

    get itemCount() {
      return this.items.reduce((sum, item) => sum + item.quantity, 0);
    },

    get total() {
      return this.items.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    },

    toggleCart() {
      this.isOpen = !this.isOpen;
    },

    addItem(item) {
      const existingItem = this.items.find(i => i.id === item.id);
      if (existingItem) {
        existingItem.quantity += 1;
      } else {
        this.items.push({
          ...item,
          quantity: 1
        });
      }
      this.saveCart();
      this.isOpen = true; // Show cart when adding items
    },

    incrementItem(item) {
      item.quantity += 1;
      this.saveCart();
    },

    decrementItem(item) {
      if (item.quantity > 1) {
        item.quantity -= 1;
      } else {
        this.removeItem(item);
      }
      this.saveCart();
    },

    removeItem(item) {
      const index = this.items.indexOf(item);
      if (index > -1) {
        this.items.splice(index, 1);
      }
      this.saveCart();
    },

    saveCart() {
      localStorage.setItem('cart', JSON.stringify(this.items));
    },

    formatPrice(price) {
      return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0,
        maximumFractionDigits: 0
      }).format(price);
    }
  }));
});

// Example of programmatically adding an item to the cart
document.querySelectorAll('.add-to-cart-button').forEach(button => {
  button.addEventListener('click', function () {
    const itemId = this.getAttribute('data-item-id');
    const itemName = this.getAttribute('data-item-name');
    const itemPrice = parseFloat(this.getAttribute('data-item-price'));
    const itemCategory = this.getAttribute('data-item-category');
    const itemImage = this.getAttribute('data-item-image');

    // Dispatch the add-to-cart event with item details
    document.dispatchEvent(new CustomEvent('add-to-cart', {
      detail: {
        id: itemId,
        name: itemName,
        price: itemPrice,
        category: itemCategory,
        image: itemImage
      }
    }));
  });
});
</script>