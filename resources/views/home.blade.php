<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Rejosari Catering</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            'playfair': ['Playfair Display', 'serif'],
            'montserrat': ['Montserrat', 'sans-serif'],
            'poppins': ['Poppins', 'sans-serif'],
          }
        }
      }
    }
  </script>
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }

    [x-cloak] {
      display: none !important;
    }

    .max-h-24 {
      max-height: 6rem;
      transition: max-height 0.3s ease-out;
    }
    
    /* Custom scrollbar on notifications */
    ::-webkit-scrollbar {
      width: 6px;
      height: 6px;
    }
    ::-webkit-scrollbar-thumb {
      background-color: #fb923c;
      border-radius: 3px;
    }
  </style>
</head>
<body class="bg-gray-50 font-sans text-gray-900">

   <!-- Navbar -->
  @include('partials.navbar')

  <!-- Main container -->
  <main class="h-screen overflow-y-auto scroll-smooth">
    <!-- Hero Section (Home) -->
    <section id="home" class="snap-start h-screen flex items-center relative overflow-hidden">
      <!-- Background image slider with overlay -->
      <div class="absolute inset-0 z-0">
        <div class="relative w-full h-full" x-data="imageSlider()">
          <!-- Image 1 -->
          <div class="absolute inset-0 transition-opacity duration-1000 ease-in-out transform scale-110"
               :class="{'opacity-100 scale-125': activeSlide === 1, 'opacity-0': activeSlide !== 1}">
            <img src="{{ asset('foto/rjsbackground.jpg') }}" alt="Background 1" class="w-full h-full object-cover">
          </div>
          <!-- Image 2 -->
          <div class="absolute inset-0 transition-opacity duration-1000 ease-in-out transform scale-110"
               :class="{'opacity-100 scale-125': activeSlide === 2, 'opacity-0': activeSlide !== 2}">
            <img src="{{ asset('foto/buffet.jpg') }}" alt="Background 2" class="w-full h-full object-cover">
          </div>
          <!-- Image 3 -->
          <div class="absolute inset-0 transition-opacity duration-1000 ease-in-out transform scale-110"
               :class="{'opacity-100 scale-125': activeSlide === 3, 'opacity-0': activeSlide !== 3}">
            <img src="{{ asset('foto/bg.jpg') }}" alt="Background 3" class="w-full h-full object-cover">
          </div>
          <!-- Overlay -->
          <div class="absolute inset-0 bg-black opacity-60"></div>
        </div>
      </div>
      
      <!-- Content -->
      <div class="container mx-auto px-4 relative z-10">
        <div class="backdrop-blur-sm bg-white/20 rounded-lg shadow-lg overflow-hidden w-full flex flex-col md:flex-row">
          <div class="w-full md:w-1/2 flex flex-col justify-center p-6 md:p-8 text-center md:text-left">
            <h2 class="text-4xl sm:text-5xl md:text-7xl font-extrabold mb-2 leading-tight text-white">
              Cari Catering Murah?<br/>
              <span>Rejosari Catering Solusinya</span>
            </h2>
            <div class="mt-6 flex justify-center md:justify-start space-x-4">
              <a href="#contact" class="inline-flex items-center px-6 py-3 bg-orange-500 text-white font-semibold rounded-full hover:bg-orange-600 transition">Pesan Sekarang</a>
            </div>
          </div>
          <div class="hidden md:block md:w-1/2 relative">
            <div class="flex justify-center md:justify-end items-center relative h-full p-6">
              <img src="foto/rejosari.jpg" alt="Rejosari Catering" class="w-2/5 md:w-3/4 rounded-tl-lg object-cover" />
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- About Section -->
    <section id="about" class="snap-start min-h-screen flex items-center relative">
      <!-- Background with overlay -->
      <div class="absolute inset-0 z-0">
        <img src="{{ asset('foto/rjsbackground.jpg') }}" alt="Background" class="w-full h-full object-cover opacity-80">
      </div>

      <!-- Content -->
      <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-1xl mx-auto backdrop-blur-sm rounded-lg p-4 md:p-8">
          <div class="text-center mb-8 md:mb-16">
            <h2 class="text-2xl md:text-5xl font-playfair font-extrabold text-white tracking-wide normal-case relative inline-block">
              Tentang Kami
              <div class="w-24 md:w-32 h-1 bg-gradient-to-r from-amber-600 via-orange-500 to-amber-600 mx-auto mt-3 md:mt-4 rounded-full"></div>
            </h2>
          </div>
          
          <div class="space-y-8">
              <div class="flex flex-col md:flex-row gap-4 md:gap-6 items-center mb-8">
                <img src="{{ asset('foto/rejosari.jpg') }}" alt="Rejosari Catering" class="w-full md:w-1/3 h-48 md:h-auto rounded-lg shadow-xl object-cover transform hover:scale-105 transition-transform duration-300">
                <div class="flex-1 bg-gradient-to-br from-white via-white to-orange-50 rounded-lg shadow-lg p-4 md:p-6 border-t-4 border-orange-500" x-data="{ expanded: false }" x-cloak>
                <h3 class="text-2xl md:text-4xl font-playfair font-bold mb-6 text-gray-800 leading-tight flex items-center">
                  <span class="w-1.5 md:w-2 h-6 md:h-8 bg-orange-500 rounded-full mr-3 md:mr-4"></span>
                  Sejarah Rejosari Catering
                </h3>
                <div class="relative">
                  <div class="text-black leading-relaxed space-y-4 text-sm md:text-xl" :class="{ 'max-h-32 overflow-hidden': !expanded }">
                    <p class="text-justify text-black text-base md:text-xl font-poppins">
                      <span class="font-bold text-black">Rejosari Catering</span> didirikan pada Tahun <span class="font-bold text-black">2000</span> oleh Ibu H Suratmi dengan visi menjadi penyedia layanan catering terpercaya di Kota Weleri dan Sekitarnya. 
                      Berawal dari dapur rumah sederhana di Weleri, kini telah berkembang menjadi salah satu layanan catering terkemuka di Kabupaten Kendal dan Sekitarnya.
                      Penamaan rejosari sendiri diambil dari kata <span class="font-bold text-gray-800">Rejo</span> dan <span class="font-bold text-gray-800">Sari</span> yang memiliki arti masing-masing. Nama Rejosari, <span class="font-bold text-gray-800">Rejo</span> istilahnya pusat kemewahan, sedangkan <span class="font-bold text-gray-800">Sari</span> berarti keindahan. Keunggulan dari Katering Rejosari adalah memiliki harga yang murah dan rasa yang enak dibandingkan katering lainnya.
                    </p>
                    <div x-show="expanded" class="space-y-4">
                      <p class="text-justify text-black text-base md:text-xl font-poppins">
                        Rejosari Catering telah melayani ribuan acara dengan berbagai skala.
                        Dengan pengalaman lebih dari 20 Tahun dalam industri katering, komitmen kami terhadap kualitas
                        dan kepuasan pelanggan telah mengantarkan Rejosari Catering menjadi
                        pilihan utama untuk berbagai acara penting di wilayah Kendal dan sekitarnya.
                        Kami terus berinovasi dalam menciptakan menu-menu baru sambil tetap mempertahankan cita rasa
                        autentik yang telah menjadi ciri khas kami sejak awal.
                      </p>
                    </div>
                  </div>
                  <button 
                    @click="expanded = !expanded"
                    class="mt-4 text-orange-500 hover:text-orange-600 font-medium transition-colors duration-200"
                  >
                    <span x-text="expanded ? 'Lihat lebih sedikit' : 'Lihat selengkapnya'"></span>
                  </button>
                </div>
              </div>
            </div>

            <div class="grid grid-cols-3 md:grid-cols-3 gap-2 md:gap-6 text-center mb-6 md:mb-8">
              <div class="p-3 md:p-4 bg-white/80 rounded-lg shadow">
                <div class="text-2xl md:text-4xl font-bold text-[#86765a] mb-1 md:mb-2">25+</div>
                <div class="text-xs md:text-base font-bold text-black-600">Tahun</div>
              </div>
              <div class="p-3 md:p-4 bg-white/80 rounded-lg shadow">
                <div class="text-2xl md:text-4xl font-bold text-[#86765a] mb-1 md:mb-2">1000+</div>
                <div class="text-xs md:text-base font-bold text-black-600">Acara</div>
              </div>
              <div class="p-3 md:p-4 bg-white/80 rounded-lg shadow">
                <div class="text-2xl md:text-4xl font-bold text-[#86765a] mb-1 md:mb-2">50+</div>
                <div class="text-xs md:text-base font-bold text-black-600">Menu</div>
              </div>
            </div>

            <div class="space-y-8">
              <div class="flex-1 bg-gradient-to-br from-white via-white to-orange-50 rounded-lg shadow-lg p-8 relative overflow-hidden border border-orange-200 font-poppins">
                <!-- Elemen dekoratif -->
                <div class="absolute top-0 right-0 w-32 h-32 bg-orange-100 rounded-full -mr-16 -mt-16 opacity-30"></div>
                <div class="absolute bottom-0 left-0 w-40 h-40 bg-orange-100 rounded-full -ml-20 -mb-20 opacity-30"></div>
                
                <!-- Border Accent -->
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-orange-500 to-orange-300"></div>
                
                <!-- Konten -->
                <div class="relative z-10 space-y-8">
                  <!-- Bagian Komitmen -->
                  <div class="p-3 md:p-6 bg-white/50 rounded-lg backdrop-blur-sm border-l-4 border-orange-500">
                    <div class="flex items-start space-x-2 md:space-x-3">
                      <div class="hidden md:block w-1.5 h-full bg-gradient-to-b from-orange-500 to-orange-300 rounded-full"></div>
                      <div class="flex-1">
                        <h4 class="text-sm md:text-xl font-semibold text-black mb-1.5 md:mb-3">Komitmen Kami</h4>
                        <p class="text-sm md:text-xl text-black leading-relaxed">
                          Komitmen kami adalah menghadirkan cita rasa autentik dengan standar kualitas tinggi. Setiap hidangan diolah 
                          dengan bahan-bahan segar pilihan dan resep yang telah teruji selama bertahun-tahun.
                        </p>
                      </div>
                    </div>
                  </div>

                  <!-- Bagian Layanan -->
                  <div class="space-y-4">
                    <p class="font-bold text-base md:text-xl flex items-center">
                      <span class="w-1.5 h-6 bg-orange-500 rounded-full mr-3"></span>
                      Rejosari Catering melayani berbagai acara seperti:
                    </p>
                    
                      <div class="flex items-center space-x-2">
                        <span class="w-2 h-2 bg-orange-500 rounded-full"></span>
                        <span class="text-xl">Pernikahan</span>
                      </div>
                      <div class="flex items-center space-x-2">
                        <span class="w-2 h-2 bg-orange-500 rounded-full"></span>
                        <span class="text-xl">Acara Kantor dan Seminar</span>
                      </div>
                      <div class="flex items-center space-x-2">
                        <span class="w-2 h-2 bg-orange-500 rounded-full"></span>
                        <span class="text-xl">Syukuran dan Pengajian</span>
                      </div>
                      <div class="flex items-center space-x-2">
                        <span class="w-2 h-2 bg-orange-500 rounded-full"></span>
                        <span class="text-xl">Arisan dan Gathering</span>
                      </div>
                      <div class="flex items-center space-x-2">
                        <span class="w-2 h-2 bg-orange-500 rounded-full"></span>
                        <span class="text-xl">Pesta Ulang Tahun</span>
                      </div>
                      <div class="flex items-center space-x-2">
                        <span class="w-2 h-2 bg-orange-500 rounded-full"></span>
                        <span class="text-xl">Akikah</span>
                      </div>
                      <div class="flex items-center space-x-2">
                        <span class="w-2 h-2 bg-orange-500 rounded-full"></span>
                        <span class="text-xl">Acara Keluarga</span>
                      </div>
                      <div class="flex items-center space-x-2">
                        <span class="w-2 h-2 bg-orange-500 rounded-full"></span>
                        <span class="text-xl">Dan Lain-lain...</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              </div>
            </div>

            <div class="text-center mt-8">
              <a href="#contact" class="inline-flex items-center px-6 py-3 bg-[#86765a] text-white font-semibold rounded-full hover:bg-[#6d5e48] transition">
                Hubungi Kami
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Menu (full) -->
    <section id="menu" class="snap-start min-h-screen flex items-center relative">
      <!-- Background image with overlay -->
      <div class="absolute inset-0 z-0">
        <img src="{{ asset('foto/rjsbackground.jpg') }}" alt="Background" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black opacity-60"></div>
      </div>
      
      <!-- Content -->
      <div class="container mx-auto px-4 relative z-10 py-16 md:py-0">
        <div class="text-center mb-12">
          <span class="block text-lg font-montserrat font-medium tracking-wider text-amber-300 mb-2">Pilihan Menu Kami</span>
          <h2 class="text-3xl md:text-5xl font-playfair font-bold text-white relative inline-block">
            Menu Spesial
            <div class="w-32 h-1 bg-gradient-to-r from-amber-400 via-orange-400 to-amber-400 mx-auto mt-4 rounded-full"></div>
          </h2>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 md:gap-6 lg:gap-8 pb-16 md:pb-0">
          <!-- Buffet -->
          <div class="group">
            <a href="{{ route('menu.buffet') }}" class="block transition transform hover:-translate-y-1">
              <div class="bg-white/90 backdrop-blur-sm rounded-xl p-3 md:p-5 shadow-lg group-hover:shadow-xl h-full">
                <div class="relative overflow-hidden rounded-lg">
                  <img src="{{ asset('foto/buffet.jpg') }}" class="w-full h-32 md:h-40 lg:h-48 object-cover transition duration-300 group-hover:scale-110" alt="Menu Buffet" />
                  <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                  <div class="absolute bottom-2 md:bottom-4 left-2 md:left-4">
                    <span class="px-2 py-1 md:px-3 md:py-1 bg-orange-500 text-white text-xs md:text-sm font-montserrat rounded-full">Mulai dari 50 porsi</span>
                  </div>
                </div>
                <h3 class="mt-3 md:mt-4 font-playfair font-bold text-lg md:text-xl lg:text-2xl text-amber-800">Buffet</h3>
                <p class="mt-1 md:mt-2 text-xs md:text-sm font-montserrat text-gray-600">Pilihan menu buffet untuk berbagai acara</p>
                <div class="mt-3 md:mt-4 space-y-1 md:space-y-2">
                  <div class="flex items-center text-xs md:text-sm text-gray-600">
                    <svg class="w-4 h-4 md:w-5 md:h-5 text-amber-500 mr-1.5 md:mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>7-15 menu pilihan</span>
                  </div>
                  <div class="flex items-center text-xs md:text-sm text-gray-600">
                    <svg class="w-4 h-4 md:w-5 md:h-5 text-amber-500 mr-1.5 md:mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>Termasuk peralatan & pelayan</span>
                  </div>
                </div>
                <div class="mt-4 md:mt-6 flex items-center justify-between">
                  <span class="text-amber-800 font-montserrat font-semibold text-xs md:text-sm">Mulai Rp 25rb/porsi</span>
                  <span class="inline-flex items-center text-orange-500 text-xs md:text-sm font-medium hover:text-orange-600">
                    Lihat Menu
                    <svg class="w-3 h-3 md:w-4 md:h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                  </span>
                </div>
              </div>
            </a>
          </div>
          
          <!-- Tumpeng -->
          <div class="group">
            <a href="{{ route('menu.tumpeng') }}" class="block transition transform hover:-translate-y-1">
              <div class="bg-white/90 backdrop-blur-sm rounded-xl p-3 md:p-5 shadow-lg group-hover:shadow-xl h-full">
                <div class="relative overflow-hidden rounded-lg">
                  <img src="{{ asset('foto/buffet.jpg') }}" class="w-full h-32 md:h-40 lg:h-48 object-cover transition duration-300 group-hover:scale-110" alt="Menu Tumpeng" />
                  <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                  <div class="absolute bottom-2 md:bottom-4 left-2 md:left-4">
                    <span class="px-2 py-1 md:px-3 md:py-1 bg-orange-500 text-white text-xs md:text-sm font-montserrat rounded-full">Tersedia berbagai ukuran</span>
                  </div>
                </div>
                <h3 class="mt-3 md:mt-4 font-playfair font-bold text-lg md:text-xl lg:text-2xl text-amber-800">Tumpeng</h3>
                <p class="mt-1 md:mt-2 text-xs md:text-sm font-montserrat text-gray-600">Tumpeng spesial untuk acara istimewa</p>
                <div class="mt-3 md:mt-4 space-y-1 md:space-y-2">
                  <div class="flex items-center text-xs md:text-sm text-gray-600">
                    <svg class="w-4 h-4 md:w-5 md:h-5 text-amber-500 mr-1.5 md:mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>5-10 lauk pendamping</span>
                  </div>
                  <div class="flex items-center text-xs md:text-sm text-gray-600">
                    <svg class="w-4 h-4 md:w-5 md:h-5 text-amber-500 mr-1.5 md:mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>Free dekorasi tumpeng</span>
                  </div>
                </div>
                <div class="mt-4 md:mt-6 flex items-center justify-between">
                  <span class="text-amber-800 font-montserrat font-semibold text-xs md:text-sm">Mulai Rp 350rb</span>
                  <span class="inline-flex items-center text-orange-500 text-xs md:text-sm font-medium hover:text-orange-600">
                    Lihat Menu
                    <svg class="w-3 h-3 md:w-4 md:h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                  </span>
                </div>
              </div>
            </a>
          </div>

          <!-- Nasi Box -->
          <div class="group">
            <a href="{{ route('menu.nasibox') }}" class="block transition transform hover:-translate-y-1">
              <div class="bg-white/90 backdrop-blur-sm rounded-xl p-3 md:p-5 shadow-lg group-hover:shadow-xl h-full">
                <div class="relative overflow-hidden rounded-lg">
                  <img src="{{ asset('foto/buffet.jpg') }}" class="w-full h-32 md:h-40 lg:h-48 object-cover transition duration-300 group-hover:scale-110" alt="Menu Nasi Box" />
                  <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                  <div class="absolute bottom-2 md:bottom-4 left-2 md:left-4">
                    <span class="px-2 py-1 md:px-3 md:py-1 bg-orange-500 text-white text-xs md:text-sm font-montserrat rounded-full">Min. 50 box</span>
                  </div>
                </div>
                <h3 class="mt-3 md:mt-4 font-playfair font-bold text-lg md:text-xl lg:text-2xl text-amber-800">Nasi Box</h3>
                <p class="mt-1 md:mt-2 text-xs md:text-sm font-montserrat text-gray-600">Praktis dan ekonomis untuk acara apapun</p>
                <div class="mt-3 md:mt-4 space-y-1 md:space-y-2">
                  <div class="flex items-center text-xs md:text-sm text-gray-600">
                    <svg class="w-4 h-4 md:w-5 md:h-5 text-amber-500 mr-1.5 md:mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>3-5 menu dalam 1 box</span>
                  </div>
                  <div class="flex items-center text-xs md:text-sm text-gray-600">
                    <svg class="w-4 h-4 md:w-5 md:h-5 text-amber-500 mr-1.5 md:mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>Packaging eksklusif</span>
                  </div>
                </div>
                <div class="mt-4 md:mt-6 flex items-center justify-between">
                  <span class="text-amber-800 font-montserrat font-semibold text-xs md:text-sm">Mulai Rp 25rb/box</span>
                  <span class="inline-flex items-center text-orange-500 text-xs md:text-sm font-medium hover:text-orange-600">
                    Lihat Menu
                    <svg class="w-3 h-3 md:w-4 md:h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                  </span>
                </div>
              </div>
            </a>
          </div>

          <!-- Snack Box -->
          <div class="group">
            <a href="{{ route('menu.snack') }}" class="block transition transform hover:-translate-y-1">
              <div class="bg-white/90 backdrop-blur-sm rounded-xl p-3 md:p-5 shadow-lg group-hover:shadow-xl h-full">
                <div class="relative overflow-hidden rounded-lg">
                  <img src="{{ asset('foto/buffet.jpg') }}" class="w-full h-32 md:h-40 lg:h-48 object-cover transition duration-300 group-hover:scale-110" alt="Menu Snack" />
                  <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                  <div class="absolute bottom-2 md:bottom-4 left-2 md:left-4">
                    <span class="px-2 py-1 md:px-3 md:py-1 bg-orange-500 text-white text-xs md:text-sm font-montserrat rounded-full">Min. 100 box</span>
                  </div>
                </div>
                <h3 class="mt-3 md:mt-4 font-playfair font-bold text-lg md:text-xl lg:text-2xl text-amber-800">Snack Box</h3>
                <p class="mt-1 md:mt-2 text-xs md:text-sm font-montserrat text-gray-600">Aneka snack dan kue untuk coffee break</p>
                <div class="mt-3 md:mt-4 space-y-1 md:space-y-2">
                  <div class="flex items-center text-xs md:text-sm text-gray-600">
                    <svg class="w-4 h-4 md:w-5 md:h-5 text-amber-500 mr-1.5 md:mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>4-6 jenis snack/box</span>
                  </div>
                  <div class="flex items-center text-xs md:text-sm text-gray-600">
                    <svg class="w-4 h-4 md:w-5 md:h-5 text-amber-500 mr-1.5 md:mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>Tersedia snack tradisional & modern</span>
                  </div>
                </div>
                <div class="mt-4 md:mt-6 flex items-center justify-between">
                  <span class="text-amber-800 font-montserrat font-semibold text-xs md:text-sm">Mulai Rp 15rb/box</span>
                  <span class="inline-flex items-center text-orange-500 text-xs md:text-sm font-medium hover:text-orange-600">
                    Lihat Menu
                    <svg class="w-3 h-3 md:w-4 md:h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                  </span>
                </div>
              </div>
            </a>
          </div>

          <!-- Es & Minuman -->
          <div class="group">
            <a href="{{ route('menu.es') }}" class="block transition transform hover:-translate-y-1">
              <div class="bg-white/90 backdrop-blur-sm rounded-xl p-3 md:p-5 shadow-lg group-hover:shadow-xl h-full">
                <div class="relative overflow-hidden rounded-lg">
                  <img src="{{ asset('foto/buffet.jpg') }}" class="w-full h-32 md:h-40 lg:h-48 object-cover transition duration-300 group-hover:scale-110" alt="Menu Es & Minuman" />
                  <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                  <div class="absolute bottom-2 md:bottom-4 left-2 md:left-4">
                    <span class="px-2 py-1 md:px-3 md:py-1 bg-orange-500 text-white text-xs md:text-sm font-montserrat rounded-full">Min. 50 porsi</span>
                  </div>
                </div>
                <h3 class="mt-3 md:mt-4 font-playfair font-bold text-lg md:text-xl lg:text-2xl text-amber-800">Es & Minuman</h3>
                <p class="mt-1 md:mt-2 text-xs md:text-sm font-montserrat text-gray-600">Aneka es dan minuman segar untuk acara Anda</p>
                <div class="mt-3 md:mt-4 space-y-1 md:space-y-2">
                  <div class="flex items-center text-xs md:text-sm text-gray-600">
                    <svg class="w-4 h-4 md:w-5 md:h-5 text-amber-500 mr-1.5 md:mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>Es Buah, Es Campur, Es Teler</span>
                  </div>
                  <div class="flex items-center text-xs md:text-sm text-gray-600">
                    <svg class="w-4 h-4 md:w-5 md:h-5 text-amber-500 mr-1.5 md:mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>Aneka jus & minuman tradisional</span>
                  </div>
                <div class="mt-4 md:mt-6 flex items-center justify-between">
                  <span class="text-amber-800 font-montserrat font-semibold text-xs md:text-sm">Mulai Rp 8rb/porsi</span>
                  <span class="inline-flex items-center text-orange-500 text-xs md:text-sm font-medium hover:text-orange-600">
                    Lihat Menu
                    <svg class="w-3 h-3 md:w-4 md:h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                  </span>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </section>

    <!-- Gallery (full) -->
    <section id="gallery" class="snap-start min-h-screen flex flex-col relative">
      <!-- Background image with overlay -->
      <div class="absolute inset-0 z-0">
        <img src="{{ asset('foto/buffet.jpg') }}" alt="Background" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-b from-black/30 to-black/1000 backdrop-blur-sm"></div> <!-- Ganti Background Blur sesuai kebutuhan-->
      </div>
      
      <!-- Content -->
      <div class="relative z-10 container mx-auto max-w-7xl px-4 py-12">
        <div class="backdrop-blur-lg bg-black/20 py-8 px-6 rounded-2xl shadow-2xl border border-white/10 mb-8">
          <div class="flex flex-col items-center gap-4 mb-8">
            <h2 class="text-3xl md:text-4xl font-playfair font-bold text-white text-center">
              Galeri Foto
              <div class="h-1 w-24 mx-auto mt-2 bg-gradient-to-r from-orange-500 to-amber-500 rounded-full"></div>
            </h2>
            <p class="text-center font-montserrat text-orange-100 max-w-2xl">Koleksi foto hidangan terbaik kami untuk berbagai acara istimewa Anda</p>
          </div>
        
        <!-- Gallery Category Tabs -->
        <div class="py-4 px-3 rounded-2xl shadow-lg mb-8 bg-white/10 backdrop-blur-sm">
          <!-- Mobile scroll indicator -->
          <div class="md:hidden text-center mb-2">
            <span class="inline-flex items-center text-gray-400 text-xs">
              <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
              </svg>
              Geser untuk melihat menu
            </span>
          </div>
          <div class="overflow-x-auto hide-scrollbar">
            <div class="flex md:flex-wrap md:justify-center gap-2 pb-2" style="min-width: max-content;">
              <button class="category-btn bg-gradient-to-r from-orange-500 to-amber-500 text-white px-4 md:px-6 py-2 font-montserrat font-semibold text-sm rounded-full hover:shadow-lg transition-all duration-300 transform hover:scale-105 whitespace-nowrap" data-category="all">Semua</button>
              <button class="category-btn bg-white/90 text-gray-700 px-4 md:px-6 py-2 font-montserrat font-medium text-sm rounded-full hover:bg-white hover:shadow-lg transition-all duration-300 transform hover:scale-105 whitespace-nowrap" data-category="buffet">Buffet</button>
              <button class="category-btn bg-white/90 text-gray-700 px-4 md:px-6 py-2 font-montserrat font-medium text-sm rounded-full hover:bg-white hover:shadow-lg transition-all duration-300 transform hover:scale-105 whitespace-nowrap" data-category="tumpeng">Tumpeng</button>
              <button class="category-btn bg-white/90 text-gray-700 px-4 md:px-6 py-2 font-montserrat font-medium text-sm rounded-full hover:bg-white hover:shadow-lg transition-all duration-300 transform hover:scale-105 whitespace-nowrap" data-category="nasi-box">Nasi Box</button>
              <button class="category-btn bg-white/90 text-gray-700 px-4 md:px-6 py-2 font-montserrat font-medium text-sm rounded-full hover:bg-white hover:shadow-lg transition-all duration-300 transform hover:scale-105 whitespace-nowrap" data-category="snack">Snack</button>
              <button class="category-btn bg-white/90 text-gray-700 px-4 md:px-6 py-2 font-montserrat font-medium text-sm rounded-full hover:bg-white hover:shadow-lg transition-all duration-300 transform hover:scale-105 whitespace-nowrap" data-category="minuman">Es & Minuman</button>
            </div>
          </div>
        </div>
        
        <!-- Gallery Grid with enhanced hover effects -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
          <!-- Buffet Items -->
          <div class="gallery-item group relative cursor-pointer overflow-hidden rounded-xl shadow-lg" data-category="buffet">
            <img src="{{ asset('foto/bg.jpg') }}" alt="Buffet" class="w-full h-64 object-cover transition duration-500 transform group-hover:scale-110">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500 flex items-center justify-center">
              <h3 class="text-white font-playfair font-bold text-2xl transform -translate-y-4 group-hover:translate-y-0 transition-all duration-500">Buffet</h3>
            </div>
          </div>

          <div class="gallery-item group relative cursor-pointer overflow-hidden rounded-xl shadow-lg" data-category="buffet">
            <img src="{{ asset('foto/bg.jpg') }}" alt="Buffet 2" class="w-full h-64 object-cover transition duration-500 transform group-hover:scale-110">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500 flex flex-col justify-end p-6">
              <h3 class="font-playfair font-bold text-xl text-white transform translate-y-4 group-hover:translate-y-0 transition-all duration-500">Buffet Standar</h3>
              <p class="font-montserrat text-sm text-orange-100 mt-2 transform translate-y-4 group-hover:translate-y-0 transition-all duration-500 delay-100">Menu standar 7 item masakan Indonesia</p>
            </div>
          </div>

          <!-- Tumpeng Items -->
          <div class="gallery-item group relative cursor-pointer overflow-hidden rounded-xl shadow-lg" data-category="tumpeng">
            <img src="{{ asset('foto/bg.jpg') }}" alt="Tumpeng" class="w-full h-64 object-cover transition duration-300 transform group-hover:scale-110">
            <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center">
              <h3 class="text-white font-bold text-2xl">Tumpeng</h3>
            </div>
          </div>

          <!-- Nasi Box Items -->
          <div class="gallery-item group relative cursor-pointer overflow-hidden rounded-xl shadow-lg" data-category="nasi-box">
            <img src="{{ asset('foto/bg.jpg') }}" alt="Nasi Box" class="w-full h-64 object-cover transition duration-300 transform group-hover:scale-110">
            <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center">
              <h3 class="text-white font-bold text-2xl">Nasi Box</h3>
            </div>
          </div>

          <!-- Es & Minuman Items -->
          <div class="gallery-item group relative cursor-pointer overflow-hidden rounded-xl shadow-lg" data-category="minuman">
            <img src="{{ asset('foto/es.jpg') }}" alt="Es & Minuman" class="w-full h-64 object-cover transition duration-500 transform group-hover:scale-110">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500 flex items-center justify-center">
              <h3 class="text-white font-playfair font-bold text-2xl transform -translate-y-4 group-hover:translate-y-0 transition-all duration-500">Es & Minuman</h3>
            </div>
          </div>

          <div class="gallery-item group relative cursor-pointer overflow-hidden rounded-xl shadow-lg" data-category="minuman">
            <img src="{{ asset('foto/es.jpg') }}" alt="Es Buah" class="w-full h-64 object-cover transition duration-500 transform group-hover:scale-110">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500 flex flex-col justify-end p-6">
              <h3 class="font-playfair font-bold text-xl text-white transform translate-y-4 group-hover:translate-y-0 transition-all duration-500">Paket Es Buah</h3>
              <p class="font-montserrat text-sm text-orange-100 mt-2 transform translate-y-4 group-hover:translate-y-0 transition-all duration-500 delay-100">Es buah spesial dengan aneka buah segar</p>
            </div>
          </div>

          <div class="gallery-item group relative cursor-pointer overflow-hidden rounded-xl shadow-lg" data-category="minuman">
            <img src="{{ asset('foto/es.jpg') }}" alt="Es Campur" class="w-full h-64 object-cover transition duration-500 transform group-hover:scale-110">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500 flex flex-col justify-end p-6">
              <h3 class="font-playfair font-bold text-xl text-white transform translate-y-4 group-hover:translate-y-0 transition-all duration-500">Aneka Es Campur</h3>
              <p class="font-montserrat text-sm text-orange-100 mt-2 transform translate-y-4 group-hover:translate-y-0 transition-all duration-500 delay-100">Es campur dengan berbagai topping pilihan</p>
            </div>
          </div>

          <div class="gallery-item group relative cursor-pointer overflow-hidden rounded-lg" data-category="nasi-box">
            <img src="{{ asset('foto/bg.jpg') }}" alt="Nasi Box 2" class="w-full h-64 object-cover transition duration-300 transform group-hover:scale-110">
            <div class="absolute inset-0 bg-black/50 backdrop-blur-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-4">
              <h3 class="text-white font-bold text-lg">Nasi Box Standar</h3>
              <p class="text-white text-sm">Paket nasi box standar untuk acara dan meeting</p>
            </div>
          </div>

          <!-- Snack Items -->
          <div class="gallery-item group relative cursor-pointer overflow-hidden rounded-xl shadow-lg" data-category="snack">
            <img src="{{ asset('foto/bg.jpg') }}" alt="Snack" class="w-full h-64 object-cover transition duration-300 transform group-hover:scale-110">
            <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center">
              <h3 class="text-white font-bold text-2xl">Snack Box</h3>
            </div>
          </div>

          <div class="gallery-item group relative cursor-pointer overflow-hidden rounded-lg" data-category="snack">
            <img src="{{ asset('foto/bg.jpg') }}" alt="Snack 2" class="w-full h-64 object-cover transition duration-300 transform group-hover:scale-110">
            <div class="absolute inset-0 bg-black/50 backdrop-blur-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-4">
              <h3 class="text-white font-bold text-lg">Snack Box Standar</h3>
              <p class="text-white text-sm">Aneka snack tradisional dan modern</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Track Order (full) -->
    <section id="contact" class="snap-start min-h-screen flex items-start pt-20 relative">
      <!-- Background image with overlay -->
      <div class="absolute inset-0 z-0">
        <img src="{{ asset('foto/contact.jpg') }}" alt="Background" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black opacity-50"></div>
      </div>
      
      <!-- Content -->
      <div class="container mx-auto px-4 relative z-10">
        <div class="w-full max-w-3xl mx-auto">
          <h2 class="text-4xl font-extrabold mb-4 text-center text-white">Hubungi Kami</h2>
        <p class="text-center text-gray-200 mb-8 max-w-2xl mx-auto">Kami siap melayani kebutuhan catering Anda. Hubungi kami melalui channel yang tersedia atau kunjungi lokasi kami.</p>

          <div class="bg-white/95 backdrop-blur-sm rounded-2xl p-8 shadow-2xl space-y-8 border border-white/20">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
              <!-- Contact Info Column -->
              <div class="space-y-4">
                <a href="https://wa.me/6282227110771" target="_blank" class="w-full flex items-center space-x-4 p-4 border border-gray-200 rounded-lg hover:shadow-lg hover:border-green-500 transition-all duration-300">
                  <div class="bg-green-500 rounded-full p-2">
                    <img src="https://img.icons8.com/color/48/000000/whatsapp.png" class="w-8 h-8" alt="whatsapp"/>
                  </div>
                  <div class="text-left flex-1">
                    <div class="font-semibold text-lg text-green-600">WhatsApp</div>
                    <div class="font-semibold text-lg">Nina Sugiatni <span class="text-xs"></span></div>
                    <div class="text-xs text-green-600">+62 822-2711-0771</div>
                  </div>
                  <div class="text-green-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                  </div>
                </a>

                <a href="https://instagram.com/rejosari.catering" target="_blank" class="w-full flex items-center space-x-4 p-4 border border-gray-200 rounded-lg hover:shadow-lg transition">
                  <img src="https://img.icons8.com/fluency/48/000000/instagram-new.png" class="w-10 h-10" alt="instagram"/>
                  <div class="text-left">
                    <div class="font-semibold text-lg">Instagram</div>
                    <div class="text-sm text-gray-500">@rejosari.catering</div>
                  </div>
                </a>

                <a href="mailto:info@rejosari.com" class="w-full flex items-center space-x-4 p-4 border border-gray-200 rounded-lg hover:shadow-lg transition">
                  <img src="https://img.icons8.com/fluency/48/000000/new-post.png" class="w-10 h-10" alt="email"/>
                  <div class="text-left">
                    <div class="font-semibold text-lg">Email</div>
                    <div class="text-sm text-gray-500">rejosaricatering.rs@gmail.com</div>
                  </div>
                </a>

                <div class="w-full flex items-start space-x-4 p-4 border border-gray-200 rounded-lg">
                  <img src="https://img.icons8.com/fluency/48/000000/marker.png" class="w-10 h-10 mt-1" alt="alamat"/>
                  <div class="text-left">
                    <div class="font-semibold text-lg">Alamat</div>
                    <div class="text-sm text-gray-500">Jl. Niaga, Kedonsari, Penyangkringan, Kec. Weleri, Kabupaten Kendal, Jawa Tengah 51355</div>
                  </div>
                </div>
              </div>

              <!-- Map Column -->
              <div class="flex flex-col items-center space-y-4">
                <div class="w-full bg-gray-50 rounded-xl p-4 shadow-inner">
                  <h3 class="font-semibold text-gray-800 mb-2 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Lokasi Kami
                  </h3>
                  <div class="rounded-xl overflow-hidden border border-gray-200 shadow-lg w-full h-[280px] hover:shadow-xl transition-shadow duration-300">
                    <iframe
                      src="https://www.google.com/maps?q=Rejosari%20Catering&output=embed"
                      width="100%" 
                      height="100%" 
                      style="border:0;" 
                      allowfullscreen="" 
                      loading="lazy" 
                      referrerpolicy="no-referrer-when-downgrade"
                      class="w-full h-full">
                    </iframe>
                  </div>
                </div>
              </div>
            </div>

            <!-- Divider -->
            <div class="border-t border-gray-200 col-span-full my-4"></div>
            
            <!-- Call to Action -->
            <div class="col-span-full text-center space-y-4">
              <h3 class="text-xl font-bold text-gray-800">Siap Memesan?</h3>
              <p class="text-gray-600">Tim kami siap membantu mewujudkan acara sempurna Anda</p>
              <div class="flex justify-center pt-2">
                <a href="https://wa.me/6282227110771?text=Halo%20Rejosari,%20saya%20ingin%20memesan" 
                   target="_blank" 
                   class="bg-gradient-to-r from-green-500 to-green-600 text-white px-8 py-4 rounded-xl font-semibold hover:shadow-lg hover:shadow-green-500/30 transform hover:-translate-y-1 transition-all duration-300 flex items-center space-x-3">
                  <img src="https://img.icons8.com/color/48/000000/whatsapp.png" alt="WA" class="w-6 h-6"/>
                  <span>Hubungi Kami Sekarang</span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <div class="bg-gray-900 text-gray-400 text-center text-xs py-4">
      © Rejosari Catering Copyright 2025. All Rights Reserved. &nbsp;|&nbsp; Privacy Policy &nbsp;|&nbsp; Terms &nbsp;|&nbsp; Pricing &nbsp;|&nbsp; Do not sell or share my personal Information
    </div>
  </footer>

  <!-- Add JavaScript for filtering -->
  <script>
  document.addEventListener('DOMContentLoaded', function() {
    const categoryButtons = document.querySelectorAll('.category-btn');
    const galleryItems = document.querySelectorAll('.gallery-item');
    const gallerySection = document.querySelector('#gallery');

    categoryButtons.forEach(button => {
      button.addEventListener('click', (e) => {
        e.preventDefault(); // Prevent default action
        
        // Get the section's position
        const sectionTop = gallerySection.offsetTop;
        
        // Remove active class from all buttons
        categoryButtons.forEach(btn => {
          btn.classList.remove('bg-orange-500', 'text-white');
          btn.classList.add('bg-white/80', 'backdrop-blur-sm', 'text-gray-700');
        });

        // Add active class to clicked button
        button.classList.remove('bg-white/80', 'backdrop-blur-sm', 'text-gray-700');
        button.classList.add('bg-orange-500', 'text-white');

        const category = button.dataset.category;

        // Show/hide items based on category with fade effect
        galleryItems.forEach(item => {
          if (category === 'all' || item.dataset.category === category) {
            item.style.opacity = '0';
            item.style.display = 'block';
            setTimeout(() => {
              item.style.opacity = '1';
            }, 50);
          } else {
            item.style.opacity = '0';
            setTimeout(() => {
              item.style.display = 'none';
            }, 200);
          }
        });

        // Maintain scroll position at the top of the gallery section
        window.scrollTo({
          top: sectionTop - 100, // Subtract some pixels to account for fixed header
          behavior: 'smooth'
        });
      });
    });

    // Add transition style to gallery items
    galleryItems.forEach(item => {
      item.style.transition = 'opacity 0.2s ease-in-out';
    });
  });
  </script>

  <!-- Add Alpine.js to your head section -->
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<!-- Add this script before closing body tag -->
<script>
function imageSlider() {
    return {
        activeSlide: 1,
        init() {
            setInterval(() => {
                this.activeSlide = this.activeSlide === 3 ? 1 : this.activeSlide + 1;
            }, 3000); // Changed from 5000 to 8000 ms (8 seconds)
        }
    }
}
</script>
</body>
</html>
