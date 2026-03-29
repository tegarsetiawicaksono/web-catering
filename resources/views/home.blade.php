<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Rejosari Catering</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/home.css') }}">
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
    .hide-scrollbar {
      -ms-overflow-style: none;
      scrollbar-width: none;
    }

    .hide-scrollbar::-webkit-scrollbar {
      display: none;
    }

    @keyframes scroll-left {
      0% {
        transform: translateX(0);
      }

      100% {
        transform: translateX(-50%);
      }
    }

    .animate-scroll {
      animation: scroll-left 40s linear infinite;
    }

    .animate-scroll-slow {
      animation: scroll-left 50s linear infinite;
    }

    /* Custom scrollbar styling */
    .overflow-x-auto::-webkit-scrollbar {
      height: 6px;
    }

    .overflow-x-auto::-webkit-scrollbar-track {
      background: rgba(255, 255, 255, 0.1);
      border-radius: 10px;
    }

    .overflow-x-auto::-webkit-scrollbar-thumb {
      background: rgba(255, 255, 255, 0.3);
      border-radius: 10px;
    }

    .overflow-x-auto::-webkit-scrollbar-thumb:hover {
      background: rgba(255, 255, 255, 0.5);
    }
  </style>
</head>

<body class="bg-gray-50 font-sans text-gray-900 overflow-x-hidden overflow-y-auto">

  <!-- Navbar -->
  @include('partials.navbar')

  <!-- Main container -->
  <main class="w-full">
    <!-- Hero Section (Home) -->
    <section id="beranda" class="min-h-screen flex items-center relative py-4 md:py-8">
      <!-- Background image slider with overlay -->
      <div class="absolute inset-0 z-0 overflow-hidden">
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
          <div class="w-full md:w-1/2 flex flex-col justify-center p-6 sm:p-8 md:p-8 text-center md:text-left">
            <h2 class="text-3xl sm:text-5xl md:text-6xl lg:text-7xl font-extrabold mb-3 sm:mb-4 leading-tight text-white">
              Cari Catering Murah?<br />
              <span>Rejosari Catering Solusinya</span>
            </h2>
            <div class="mt-3 sm:mt-6 flex justify-center md:justify-start space-x-4">
              <a href="#menu" class="inline-flex items-center px-4 sm:px-6 py-2 sm:py-3 bg-orange-500 text-white text-sm sm:text-base font-semibold rounded-full hover:bg-orange-600 transition">Pesan Sekarang</a>
            </div>
          </div>
          <div class="hidden md:block md:w-1/2 relative">
            <div class="flex justify-center md:justify-end items-center relative h-full p-6">
              <img src="foto/logo.jpeg" alt="Rejosari Catering" class="w-2/5 md:w-3/4 rounded-tl-lg object-cover" />
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- About Section -->
    <section id="tentang" class="py-12 md:min-h-screen flex items-center relative">
      <!-- Background with overlay -->
      <div class="absolute inset-0 z-0">
        <img src="{{ asset('foto/rjsbackground.jpg') }}" alt="Background" class="w-full h-full object-cover opacity-80">
      </div>

      <!-- Content -->
      <div class="container mx-auto px-3 sm:px-4 relative z-10">
        <div class="max-w-1xl mx-auto backdrop-blur-sm rounded-lg p-3 sm:p-4 md:p-8">
          <div class="text-center mb-6 sm:mb-8 md:mb-16">
            <h2 class="text-xl sm:text-2xl md:text-5xl font-playfair font-extrabold text-white tracking-wide normal-case relative inline-block">
              Tentang Kami
              <div class="w-20 sm:w-24 md:w-32 h-1 bg-gradient-to-r from-amber-600 via-orange-500 to-amber-600 mx-auto mt-2 sm:mt-3 md:mt-4 rounded-full"></div>
            </h2>
          </div>

          <div class="space-y-8">
            <div class="flex flex-col md:flex-row gap-4 md:gap-6 items-center mb-8">
              <div class="w-full sm:w-2/3 md:w-1/3 mx-auto md:mx-0 flex items-center justify-center">
                <img src="{{ asset('foto/logo.jpeg') }}" alt="Rejosari Catering" class="w-full h-auto max-h-48 sm:max-h-64 md:max-h-none rounded-lg shadow-xl object-contain transform hover:scale-105 transition-transform duration-300">
              </div>
              <div class="flex-1 bg-gradient-to-br from-white via-white to-orange-50 rounded-lg shadow-lg p-3 sm:p-4 md:p-6 border-t-4 border-orange-500" x-data="{ expanded: false }" x-cloak>
                <h3 class="text-lg sm:text-xl md:text-3xl lg:text-4xl font-playfair font-bold mb-3 sm:mb-4 md:mb-6 text-gray-800 leading-tight flex items-center">
                  <span class="w-1 sm:w-1.5 md:w-2 h-5 sm:h-6 md:h-8 bg-orange-500 rounded-full mr-2 sm:mr-3 md:mr-4"></span>
                  Sejarah Rejosari Catering
                </h3>
                <div class="relative">
                  <div class="text-black leading-relaxed space-y-3 sm:space-y-4 text-xs sm:text-sm md:text-base lg:text-xl" :class="{ 'max-h-32 overflow-hidden': !expanded }">
                    <p class="text-justify text-black text-xs sm:text-sm md:text-base lg:text-xl font-poppins">
                      <span class="font-bold text-black">Rejosari Catering</span> didirikan pada Tahun <span class="font-bold text-black">2000</span> oleh Ibu H Suratmi dengan visi menjadi penyedia layanan catering terpercaya di Kota Weleri dan Sekitarnya.
                      Berawal dari dapur rumah sederhana di Weleri, kini telah berkembang menjadi salah satu layanan catering terkemuka di Kabupaten Kendal dan Sekitarnya.
                      Penamaan Rejosari sendiri diambil dari kata <span class="font-bold text-gray-800">Rejo</span> dan <span class="font-bold text-gray-800">Sari</span> yang memiliki arti masing-masing. Nama Rejosari, <span class="font-bold text-gray-800">Rejo</span> istilahnya pusat kemewahan, sedangkan <span class="font-bold text-gray-800">Sari</span> berarti keindahan. Keunggulan dari Katering Rejosari adalah memiliki harga yang murah dan rasa yang enak dibandingkan katering lainnya.
                    </p>
                    <div x-show="expanded" class="space-y-3 sm:space-y-4">
                      <p class="text-justify text-black text-xs sm:text-sm md:text-base lg:text-xl font-poppins">
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
                    class="mt-3 sm:mt-4 text-orange-500 hover:text-orange-600 font-medium transition-colors duration-200 text-xs sm:text-sm md:text-base">
                    <span x-text="expanded ? 'Lihat lebih sedikit' : 'Lihat selengkapnya'"></span>
                  </button>
                </div>
              </div>
            </div>

            <div class="grid grid-cols-3 md:grid-cols-3 gap-2 md:gap-6 text-center mb-4 sm:mb-6 md:mb-8">
              <div class="p-2 sm:p-3 md:p-4 bg-white/80 rounded-lg shadow">
                <div class="text-xl sm:text-2xl md:text-4xl font-bold text-[#86765a] mb-0.5 sm:mb-1 md:mb-2">25+</div>
                <div class="text-[10px] sm:text-xs md:text-base font-bold text-black-600">Tahun</div>
              </div>
              <div class="p-2 sm:p-3 md:p-4 bg-white/80 rounded-lg shadow">
                <div class="text-xl sm:text-2xl md:text-4xl font-bold text-[#86765a] mb-0.5 sm:mb-1 md:mb-2">1000+</div>
                <div class="text-[10px] sm:text-xs md:text-base font-bold text-black-600">Acara</div>
              </div>
              <div class="p-2 sm:p-3 md:p-4 bg-white/80 rounded-lg shadow">
                <div class="text-xl sm:text-2xl md:text-4xl font-bold text-[#86765a] mb-0.5 sm:mb-1 md:mb-2">50+</div>
                <div class="text-[10px] sm:text-xs md:text-base font-bold text-black-600">Menu</div>
              </div>
            </div>

            <div class="space-y-6 sm:space-y-8">
              <div class="flex-1 bg-gradient-to-br from-white via-white to-orange-50 rounded-lg shadow-lg p-4 sm:p-6 md:p-8 relative overflow-hidden border border-orange-200 font-poppins">
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
                        <h4 class="text-xs sm:text-sm md:text-xl font-semibold text-black mb-1.5 md:mb-3">Komitmen Kami</h4>
                        <p class="text-xs sm:text-sm md:text-base lg:text-xl text-black leading-relaxed">
                          Komitmen kami adalah menghadirkan cita rasa autentik dengan standar kualitas tinggi. Setiap hidangan diolah
                          dengan bahan-bahan segar pilihan dan resep yang telah teruji selama bertahun-tahun.
                        </p>
                      </div>
                    </div>
                  </div>

                  <!-- Bagian Layanan -->
                  <div class="space-y-3 sm:space-y-4">
                    <p class="font-bold text-xs sm:text-sm md:text-base lg:text-xl flex items-center">
                      <span class="w-1 sm:w-1.5 h-4 sm:h-6 bg-orange-500 rounded-full mr-2 sm:mr-3"></span>
                      Rejosari Catering melayani berbagai acara seperti:
                    </p>

                    <div class="flex items-center space-x-2">
                      <span class="w-1.5 sm:w-2 h-1.5 sm:h-2 bg-orange-500 rounded-full flex-shrink-0"></span>
                      <span class="text-xs sm:text-sm md:text-base lg:text-xl">Pernikahan</span>
                    </div>
                    <div class="flex items-center space-x-2">
                      <span class="w-1.5 sm:w-2 h-1.5 sm:h-2 bg-orange-500 rounded-full flex-shrink-0"></span>
                      <span class="text-xs sm:text-sm md:text-base lg:text-xl">Acara Kantor dan Seminar</span>
                    </div>
                    <div class="flex items-center space-x-2">
                      <span class="w-1.5 sm:w-2 h-1.5 sm:h-2 bg-orange-500 rounded-full flex-shrink-0"></span>
                      <span class="text-xs sm:text-sm md:text-base lg:text-xl">Syukuran dan Pengajian</span>
                    </div>
                    <div class="flex items-center space-x-2">
                      <span class="w-1.5 sm:w-2 h-1.5 sm:h-2 bg-orange-500 rounded-full flex-shrink-0"></span>
                      <span class="text-xs sm:text-sm md:text-base lg:text-xl">Arisan dan Gathering</span>
                    </div>
                    <div class="flex items-center space-x-2">
                      <span class="w-1.5 sm:w-2 h-1.5 sm:h-2 bg-orange-500 rounded-full flex-shrink-0"></span>
                      <span class="text-xs sm:text-sm md:text-base lg:text-xl">Pesta Ulang Tahun</span>
                    </div>
                    <div class="flex items-center space-x-2">
                      <span class="w-1.5 sm:w-2 h-1.5 sm:h-2 bg-orange-500 rounded-full flex-shrink-0"></span>
                      <span class="text-xs sm:text-sm md:text-base lg:text-xl">Akikah</span>
                    </div>
                    <div class="flex items-center space-x-2">
                      <span class="w-1.5 sm:w-2 h-1.5 sm:h-2 bg-orange-500 rounded-full flex-shrink-0"></span>
                      <span class="text-xs sm:text-sm md:text-base lg:text-xl">Acara Keluarga</span>
                    </div>
                    <div class="flex items-center space-x-2">
                      <span class="w-1.5 sm:w-2 h-1.5 sm:h-2 bg-orange-500 rounded-full flex-shrink-0"></span>
                      <span class="text-xs sm:text-sm md:text-base lg:text-xl">Dan Lain-lain...</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
      </div>
    </section>

    <!-- Menu (full) -->
    <section id="menu" class="py-12 md:min-h-screen flex items-center relative">
      <!-- Background image with overlay -->
      <div class="absolute inset-0 z-0">
        <img src="{{ asset('foto/rjsbackground.jpg') }}" alt="Background" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black opacity-60"></div>
      </div>

      <!-- Content -->
      <div class="container mx-auto px-3 sm:px-4 relative z-10 py-12 sm:py-16 md:py-0">
        <div class="text-center mb-8 sm:mb-10 md:mb-12">
          <h2 class="text-xl sm:text-2xl md:text-4xl lg:text-5xl font-playfair font-bold text-white relative inline-block">
            Pilihan Menu
            <div class="w-24 sm:w-28 md:w-32 h-1 bg-gradient-to-r from-amber-400 via-orange-400 to-amber-400 mx-auto mt-3 sm:mt-4 rounded-full"></div>
          </h2>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-3 sm:gap-4 md:gap-6 lg:gap-8 pb-12 sm:pb-16 md:pb-0">
          @foreach($categories as $category)
          @php
            $categoryImage = (is_string($category->gambar_url) && trim($category->gambar_url) !== '')
              ? (\Illuminate\Support\Str::startsWith($category->gambar_url, ['foto/', 'http://', 'https://'])
                  ? $category->gambar_url
                  : 'foto/' . ltrim($category->gambar_url, '/'))
              : 'foto/buffet.jpg';
          @endphp
          <!-- {{ $category->nama }} -->
          <div class="group h-full">
            <a href="{{ route('menu.category', ['slug' => $category->slug]) }}" class="block h-full transition transform hover:-translate-y-1">
              <div class="bg-white/90 backdrop-blur-sm rounded-xl p-2 sm:p-3 md:p-5 shadow-lg group-hover:shadow-xl h-full border border-amber-100/80 flex flex-col">
                <div class="relative overflow-hidden rounded-lg">
                  <img src="{{ asset($categoryImage) }}" class="w-full h-36 sm:h-44 md:h-52 lg:h-60 object-contain bg-gradient-to-b from-amber-50 to-orange-50 p-2 transition duration-500 group-hover:scale-105" alt="Menu {{ $category->nama }}" onerror="this.onerror=null;this.src='{{ asset('foto/buffet.jpg') }}';" />
                </div>
                <h3 class="mt-2 sm:mt-3 md:mt-4 font-playfair font-bold text-sm sm:text-base md:text-lg lg:text-xl xl:text-2xl text-amber-800 line-clamp-2 min-h-[2.8rem] sm:min-h-[3.2rem]">
                  {{ $category->nama }}
                </h3>
                <p class="mt-1 md:mt-2 text-[10px] sm:text-xs md:text-sm font-montserrat text-gray-600 line-clamp-2 min-h-[2rem] sm:min-h-[2.5rem]">
                  {{ $category->deskripsi ?? 'Menu ' . strtolower($category->nama) . ' untuk berbagai acara' }}
                </p>
                <div class="mt-2 sm:mt-3 md:mt-4 space-y-1 md:space-y-2 flex-grow">
                  {{-- Fitur Unggulan dengan icon checklist --}}
                  @if($category->fitur_unggulan)
                    @foreach(explode("\n", trim($category->fitur_unggulan)) as $item)
                      @if(trim($item))
                      <div class="flex items-center text-[10px] sm:text-xs md:text-sm text-gray-600">
                        <svg class="w-3 h-3 sm:w-4 sm:h-4 md:w-5 md:h-5 text-amber-500 mr-1 sm:mr-1.5 md:mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>{{ trim($item) }}</span>
                      </div>
                      @endif
                    @endforeach
                  @else
                    {{-- Fallback jika fitur unggulan kosong (menggunakan hardcoded) --}}
                    @if($category->slug === 'buffet')
                    <div class="flex items-center text-[10px] sm:text-xs md:text-sm text-gray-600">
                      <svg class="w-3 h-3 sm:w-4 sm:h-4 md:w-5 md:h-5 text-amber-500 mr-1 sm:mr-1.5 md:mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                      </svg>
                      <span>35+ Menu Pilihan</span>
                    </div>
                    <div class="flex items-center text-[10px] sm:text-xs md:text-sm text-gray-600">
                      <svg class="w-3 h-3 sm:w-4 sm:h-4 md:w-5 md:h-5 text-amber-500 mr-1 sm:mr-1.5 md:mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                      </svg>
                      <span>Termasuk Peralatan</span>
                    </div>
                    @elseif($category->slug === 'tumpeng')
                    <div class="flex items-center text-[10px] sm:text-xs md:text-sm text-gray-600">
                      <svg class="w-3 h-3 sm:w-4 sm:h-4 md:w-5 md:h-5 text-amber-500 mr-1 sm:mr-1.5 md:mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                      </svg>
                      <span>5-10 lauk pendamping</span>
                    </div>
                    <div class="flex items-center text-[10px] sm:text-xs md:text-sm text-gray-600">
                      <svg class="w-3 h-3 sm:w-4 sm:h-4 md:w-5 md:h-5 text-amber-500 mr-1 sm:mr-1.5 md:mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                      </svg>
                      <span>Free dekorasi tumpeng</span>
                    </div>
                    @elseif(in_array($category->slug, ['nasibox', 'nasi-box']))
                    <div class="flex items-center text-[10px] sm:text-xs md:text-sm text-gray-600">
                      <svg class="w-3 h-3 sm:w-4 sm:h-4 md:w-5 md:h-5 text-amber-500 mr-1 sm:mr-1.5 md:mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                      </svg>
                      <span>3-5 menu dalam 1 box</span>
                    </div>
                    <div class="flex items-center text-[10px] sm:text-xs md:text-sm text-gray-600">
                      <svg class="w-3 h-3 sm:w-4 sm:h-4 md:w-5 md:h-5 text-amber-500 mr-1 sm:mr-1.5 md:mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                      </svg>
                      <span>Packaging eksklusif</span>
                    </div>
                    @elseif($category->slug === 'snack')
                    <div class="flex items-center text-[10px] sm:text-xs md:text-sm text-gray-600">
                      <svg class="w-3 h-3 sm:w-4 sm:h-4 md:w-5 md:h-5 text-amber-500 mr-1 sm:mr-1.5 md:mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                      </svg>
                      <span>4-6 jenis snack/box</span>
                    </div>
                    <div class="flex items-center text-[10px] sm:text-xs md:text-sm text-gray-600">
                      <svg class="w-3 h-3 sm:w-4 sm:h-4 md:w-5 md:h-5 text-amber-500 mr-1 sm:mr-1.5 md:mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                      </svg>
                      <span>Tersedia snack tradisional & modern</span>
                    </div>
                    @endif
                  @endif
                </div>
                <div class="mt-3 sm:mt-4 md:mt-6 flex items-center justify-between gap-2 pt-2 border-t border-amber-100/70">
                  <span class="text-amber-800 font-montserrat font-semibold text-[10px] sm:text-xs md:text-sm">
                    @if($category->harga_mulai)
                      @if($category->slug === 'tumpeng')
                        Mulai Rp {{ number_format($category->harga_mulai, 0, ',', '.') }}
                      @else
                        Mulai Rp {{ number_format($category->harga_mulai, 0, ',', '.') }}/{{ $category->slug === 'buffet' ? 'porsi' : 'box' }}
                      @endif
                    @else
                      Hubungi kami
                    @endif
                  </span>
                  <span class="inline-flex items-center text-orange-500 text-[10px] sm:text-xs md:text-sm font-medium hover:text-orange-600">
                    Lihat Menu
                    <svg class="w-2.5 h-2.5 sm:w-3 sm:h-3 md:w-4 md:h-4 ml-0.5 sm:ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                  </span>
                </div>
              </div>
            </a>
          </div>
          @endforeach
        </div>
      </div>
    </section>

    <!-- Gallery (full) -->
    <section id="galeri" class="py-12 md:min-h-screen flex flex-col relative">
      <!-- Background image with overlay -->
      <div class="absolute inset-0 z-0">
        <img src="{{ asset('foto/buffet.jpg') }}" alt="Background" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black opacity-60"></div>
      </div>

      <!-- Content -->
      <div class="relative z-10 container mx-auto max-w-7xl px-4 py-12">
        <div class="backdrop-blur-md bg-white/30 py-8 px-6 rounded-2xl shadow-2xl mb-8 border border-white/20">
          <div class="flex flex-col items-center gap-4 mb-8">
            <h2 class="text-3xl md:text-4xl font-playfair font-bold text-white text-center drop-shadow-lg">
              Galeri Foto
              <div class="h-1 w-24 mx-auto mt-2 bg-gradient-to-r from-orange-500 to-amber-500 rounded-full"></div>
            </h2>
            <p class="text-center font-montserrat text-white drop-shadow max-w-2xl">Koleksi foto hidangan terbaik kami untuk berbagai acara istimewa Anda</p>
          </div>

          <!-- Gallery Category Tabs -->
            @php
            $galleryFilterCategories = $categories
              ->map(function ($category) {
                $category->filter_slug = in_array($category->slug, ['nasibox', 'nasi-box'], true)
                  ? 'nasi-box'
                  : $category->slug;

                return $category;
              })
              ->unique('filter_slug')
              ->values();
            @endphp
            <div class="mb-8" x-data="{ selectedCategory: 'all' }">
            <!-- Mobile scroll indicator -->
            <div class="md:hidden text-center mb-2">
            </div>
            <div class="overflow-x-auto hide-scrollbar">
              <div class="flex md:flex-wrap md:justify-center gap-2 pb-2" style="min-width: max-content;">
                <button @click="selectedCategory = 'all'; $dispatch('category-change', 'all')" class="px-4 md:px-6 py-2 font-montserrat text-sm rounded-full hover:shadow-lg transition-all duration-300 transform hover:scale-105 whitespace-nowrap" :class="selectedCategory === 'all' ? 'bg-gradient-to-r from-orange-500 to-amber-500 text-white font-semibold' : 'backdrop-blur-sm bg-white/30 text-white font-medium border border-white/20'">Semua</button>
                @foreach($galleryFilterCategories as $galleryCategory)
                  <button @click="selectedCategory = '{{ $galleryCategory->filter_slug }}'; $dispatch('category-change', '{{ $galleryCategory->filter_slug }}')" class="px-4 md:px-6 py-2 font-montserrat text-sm rounded-full hover:shadow-lg transition-all duration-300 transform hover:scale-105 whitespace-nowrap" :class="selectedCategory === '{{ $galleryCategory->filter_slug }}' ? 'bg-gradient-to-r from-orange-500 to-amber-500 text-white font-semibold' : 'backdrop-blur-sm bg-white/30 text-white font-medium border border-white/20'">{{ $galleryCategory->nama }}</button>
                @endforeach
              </div>
            </div>
          </div>

          <!-- Gallery Grid with Slider -->
          <div class="relative" x-data="gallerySlider()" @category-change.window="setCategory($event.detail)" @touchstart="handleTouchStart($event)" @touchmove="handleTouchMove($event)" @touchend="handleTouchEnd($event)">
            <!-- Navigation Buttons - Hidden on Mobile -->
            <button @click="prevSlide()" class="hidden md:flex absolute left-0 top-1/2 -translate-y-1/2 -translate-x-4 z-20 bg-white/90 hover:bg-white text-orange-500 rounded-full p-3 shadow-xl transition-all duration-300 hover:scale-110 items-center justify-center backdrop-blur-sm" x-show="canGoPrev()">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
              </svg>
            </button>

            <button @click="nextSlide()" class="hidden md:flex absolute right-0 top-1/2 -translate-y-1/2 translate-x-4 z-20 bg-white/90 hover:bg-white text-orange-500 rounded-full p-3 shadow-xl transition-all duration-300 hover:scale-110 items-center justify-center backdrop-blur-sm" x-show="canGoNext()">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
              </svg>
            </button>

            <!-- Gallery Container with Smooth Transitions -->
            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 md:gap-4 transition-all duration-500 ease-in-out" :class="{'opacity-0': isTransitioning, 'opacity-100': !isTransitioning}">
              @if(isset($galleries) && $galleries->count() > 0)
                @foreach($galleries as $gallery)
                  @php
                    $dataCategory = in_array($gallery->category, ['nasibox', 'nasi-box'], true)
                      ? 'nasi-box'
                      : $gallery->category;
                  @endphp
                  <a href="{{ asset('storage/' . $gallery->path) }}?v={{ optional($gallery->updated_at)->timestamp }}" target="_blank" 
                     class="gallery-item group relative overflow-hidden rounded-xl shadow-lg hover:shadow-2xl transition-all duration-500 block transform hover:-translate-y-1" 
                     data-category="{{ $dataCategory }}" 
                     x-show="isVisible($el)" 
                     x-transition:enter="transition ease-out duration-300" 
                     x-transition:enter-start="opacity-0 scale-95" 
                     x-transition:enter-end="opacity-100 scale-100" 
                     @click="if(window.innerWidth < 768) $event.preventDefault()">
                    <img src="{{ asset('storage/' . $gallery->path) }}?v={{ optional($gallery->updated_at)->timestamp }}" 
                         alt="{{ $gallery->caption ?? ucfirst($gallery->category) }}" 
                         class="w-full h-48 sm:h-56 md:h-64 lg:h-72 xl:h-80 object-cover transition duration-500 transform group-hover:scale-110">
                    @if($gallery->caption)
                      <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-3">
                        <p class="text-white text-sm font-medium">{{ $gallery->caption }}</p>
                      </div>
                    @endif
                  </a>
                @endforeach
              @else
                <!-- Fallback jika belum ada data di database -->
                <a href="{{ asset('foto/buffet1.jpeg') }}" target="_blank" class="gallery-item group relative overflow-hidden rounded-xl shadow-lg hover:shadow-2xl transition-all duration-500 block transform hover:-translate-y-1" data-category="buffet" x-show="isVisible($el)">
                  <img src="{{ asset('foto/buffet1.jpeg') }}" alt="Buffet 1" class="w-full h-48 sm:h-56 md:h-64 lg:h-72 xl:h-80 object-cover transition duration-500 transform group-hover:scale-110">
                </a>
              @endif
            </div>

            <!-- Dots Indicator - Improved Design -->
            <div class="flex justify-center mt-8 gap-2">
              <template x-for="(page, index) in totalPages()" :key="index">
                <button @click="goToPage(index)"
                  class="transition-all duration-300 rounded-full"
                  :class="currentPage === index ? 'bg-orange-500 w-8 h-3' : 'bg-white/50 hover:bg-white/80 w-3 h-3'"
                  :aria-label="'Go to page ' + (index + 1)">
                </button>
              </template>
            </div>

            <!-- Page Counter for Mobile -->
            <div class="md:hidden text-center mt-4">
              <span class="text-white/80 text-sm font-montserrat bg-black/20 px-4 py-2 rounded-full backdrop-blur-sm">
                <span x-text="currentPage + 1"></span> / <span x-text="totalPages()"></span>
              </span>
            </div>
          </div>
        </div>
    </section>

    <!-- Track Order (full) -->
    <section id="kontak" class="py-12 md:min-h-screen flex items-start md:pt-20 relative">
      <!-- Background image with overlay -->
      <div class="absolute inset-0 z-0">
        <img src="{{ asset('foto/rjsbackground.jpg') }}" alt="Background" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black opacity-60"></div>
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
                    <img src="https://img.icons8.com/color/48/000000/whatsapp.png" class="w-8 h-8" alt="whatsapp" />
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

                <a href="https://instagram.com/rejosaricatering" target="_blank" class="w-full flex items-center space-x-4 p-4 border border-gray-200 rounded-lg hover:shadow-lg transition">
                  <img src="https://img.icons8.com/fluency/48/000000/instagram-new.png" class="w-10 h-10" alt="instagram" />
                  <div class="text-left">
                    <div class="font-semibold text-lg">Instagram</div>
                    <div class="text-sm text-gray-500">@rejosaricatering</div>
                  </div>
                </a>

                <a href="mailto:info@rejosari.com" class="w-full flex items-center space-x-4 p-4 border border-gray-200 rounded-lg hover:shadow-lg transition">
                  <img src="https://img.icons8.com/fluency/48/000000/new-post.png" class="w-10 h-10" alt="email" />
                  <div class="text-left">
                    <div class="font-semibold text-lg">Email</div>
                    <div class="text-sm text-gray-500">rejosaricatering.rs@gmail.com</div>
                  </div>
                </a>

                <div class="w-full flex items-start space-x-4 p-4 border border-gray-200 rounded-lg">
                  <img src="https://img.icons8.com/fluency/48/000000/marker.png" class="w-10 h-10 mt-1" alt="alamat" />
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
                      src="https://maps.google.com/maps?q=Rejosari+Catering,+Jl.+Niaga,+Kedonsari,+Weleri,+Kendal&output=embed"
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
                  <img src="https://img.icons8.com/color/48/000000/whatsapp.png" alt="WA" class="w-6 h-6" />
                  <span>Hubungi Kami Sekarang</span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Clients Section -->
    <section id="klien" class="flex items-center relative py-8 md:py-16 overflow-hidden">
      <!-- Background with pattern overlay -->
      <div class="absolute inset-0 z-0">
        <img src="{{ asset('foto/rjsbackground.jpg') }}" alt="Background" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black opacity-60"></div>
      </div>

      <!-- Content -->
      <div class="w-full relative z-10 px-4 md:px-8">
        <!-- Header -->
        <div class="text-center mb-8 md:mb-12">
          <h2 class="text-2xl md:text-4xl lg:text-5xl font-montserrat font-bold text-white tracking-widest mb-4">
            REJOSARI CATERING CLIENT
          </h2>
          <div class="w-32 h-1 bg-gradient-to-r from-transparent via-white to-transparent mx-auto"></div>
        </div>

        <!-- Carousel Container -->
        <div class="relative max-w-6xl mx-auto" x-data="clientCarousel()">
          <!-- Carousel Track -->
          <div class="overflow-hidden">
            <div class="flex transition-transform duration-500 ease-in-out"
                 :style="`transform: translateX(-${currentSlide * 100}%)`">
              
              <!-- Slide 1 -->
              <div class="w-full flex-shrink-0">
                <div class="grid grid-cols-4 gap-2 md:gap-8">
                  <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 md:w-32 md:h-32 flex items-center justify-center mb-1 md:mb-3 bg-white/10 rounded-lg p-2 md:p-4">
                      <img src="{{ asset('foto/clients/kemenkes.png') }}" alt="Puskesmas" class="max-w-full max-h-full object-contain">
                    </div>
                    <p class="text-[8px] md:text-sm font-semibold text-white text-center uppercase tracking-wide">PUSKESMAS</p>
                  </div>
                  <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 md:w-32 md:h-32 flex items-center justify-center mb-1 md:mb-3 bg-white/10 rounded-lg p-2 md:p-4">
                      <img src="{{ asset('foto/clients/rsbh.jpg') }}" alt="RS Baitul Hikmah" class="max-w-full max-h-full object-contain">
                    </div>
                    <p class="text-[8px] md:text-sm font-semibold text-white text-center uppercase tracking-wide">RS BAITUL HIKMAH</p>
                  </div>
                  <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 md:w-32 md:h-32 flex items-center justify-center mb-1 md:mb-3 bg-white/10 rounded-lg p-2 md:p-4">
                      <img src="{{ asset('foto/clients/ksb.png') }}" alt="Kusuma Sumbing" class="max-w-full max-h-full object-contain">
                    </div>
                    <p class="text-[8px] md:text-sm font-semibold text-white text-center uppercase tracking-wide">KUSUMA SUMBING</p>
                  </div>
                  <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 md:w-32 md:h-32 flex items-center justify-center mb-1 md:mb-3 bg-white/10 rounded-lg p-2 md:p-4">
                      <img src="{{ asset('foto/clients/rsi.png') }}" alt="RSI Muhammadiyah" class="max-w-full max-h-full object-contain">
                    </div>
                    <p class="text-[8px] md:text-sm font-semibold text-white text-center uppercase tracking-wide">RSI MUHAMMADIYAH</p>
                  </div>
                </div>
              </div>

              <!-- Slide 2 -->
              <div class="w-full flex-shrink-0">
                <div class="grid grid-cols-4 gap-2 md:gap-8">
                  <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 md:w-32 md:h-32 flex items-center justify-center mb-1 md:mb-3 bg-white/10 rounded-lg p-2 md:p-4">
                      <img src="{{ asset('foto/clients/kecamatan.png') }}" alt="Kecamatan Weleri" class="max-w-full max-h-full object-contain">
                    </div>
                    <p class="text-[8px] md:text-sm font-semibold text-white text-center uppercase tracking-wide">KECAMATAN WELERI</p>
                  </div>
                  <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 md:w-32 md:h-32 flex items-center justify-center mb-1 md:mb-3 bg-white/10 rounded-lg p-2 md:p-4">
                      <img src="{{ asset('foto/clients/polsek.png') }}" alt="Polsek Weleri" class="max-w-full max-h-full object-contain">
                    </div>
                    <p class="text-[8px] md:text-sm font-semibold text-white text-center uppercase tracking-wide">POLSEK WELERI</p>
                  </div>
                  <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 md:w-32 md:h-32 flex items-center justify-center mb-1 md:mb-3 bg-white/10 rounded-lg p-2 md:p-4">
                      <img src="{{ asset('foto/clients/kitb.jpeg') }}" alt="KITB Gallery" class="max-w-full max-h-full object-contain">
                    </div>
                    <p class="text-[8px] md:text-sm font-semibold text-white text-center uppercase tracking-wide">KITB GALLERY</p>
                  </div>
                  <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 md:w-32 md:h-32 flex items-center justify-center mb-1 md:mb-3 bg-white/10 rounded-lg p-2 md:p-4">
                      <img src="{{ asset('foto/clients/bahana.jpg') }}" alt="PT Bahana Bhumi" class="max-w-full max-h-full object-contain">
                    </div>
                    <p class="text-[8px] md:text-sm font-semibold text-white text-center uppercase tracking-wide">PT BAHANA BHUMI</p>
                  </div>
                </div>
              </div>

              <!-- Slide 3 -->
              <div class="w-full flex-shrink-0">
                <div class="grid grid-cols-4 gap-2 md:gap-8">
                  <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 md:w-32 md:h-32 flex items-center justify-center mb-1 md:mb-3 bg-white/10 rounded-lg p-2 md:p-4">
                      <img src="{{ asset('foto/clients/hbr.png') }}" alt="PT HBR Jaya" class="max-w-full max-h-full object-contain">
                    </div>
                    <p class="text-[8px] md:text-sm font-semibold text-white text-center uppercase tracking-wide">PT HBR JAYA</p>
                  </div>
                  <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 md:w-32 md:h-32 flex items-center justify-center mb-1 md:mb-3 bg-white/10 rounded-lg p-2 md:p-4">
                      <img src="{{ asset('foto/clients/hkt.jpeg') }}" alt="PT HKT" class="max-w-full max-h-full object-contain">
                    </div>
                    <p class="text-[8px] md:text-sm font-semibold text-white text-center uppercase tracking-wide">PT HKT</p>
                  </div>
                  <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 md:w-32 md:h-32 flex items-center justify-center mb-1 md:mb-3 bg-white/10 rounded-lg p-2 md:p-4">
                      <img src="{{ asset('foto/clients/sps.png') }}" alt="CV Surya Pangan" class="max-w-full max-h-full object-contain">
                    </div>
                    <p class="text-[8px] md:text-sm font-semibold text-white text-center uppercase tracking-wide">CV SURYA PANGAN</p>
                  </div>
                  <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 md:w-32 md:h-32 flex items-center justify-center mb-1 md:mb-3 bg-white/10 rounded-lg p-2 md:p-4">
                      <img src="{{ asset('foto/clients/gula.jpeg') }}" alt="PT Industri Gula" class="max-w-full max-h-full object-contain">
                    </div>
                    <p class="text-[8px] md:text-sm font-semibold text-white text-center uppercase tracking-wide">PT INDUSTRI GULA</p>
                  </div>
                </div>
              </div>

              <!-- Slide 4 -->
              <div class="w-full flex-shrink-0">
                <div class="grid grid-cols-4 gap-2 md:gap-8">
                  <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 md:w-32 md:h-32 flex items-center justify-center mb-1 md:mb-3 bg-white/10 rounded-lg p-2 md:p-4">
                      <img src="{{ asset('foto/clients/smansawel.png') }}" alt="SMAN 1 Weleri" class="max-w-full max-h-full object-contain">
                    </div>
                    <p class="text-[8px] md:text-sm font-semibold text-white text-center uppercase tracking-wide">SMAN 1 WELERI</p>
                  </div>
                  <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 md:w-32 md:h-32 flex items-center justify-center mb-1 md:mb-3 bg-white/10 rounded-lg p-2 md:p-4">
                      <img src="{{ asset('foto/clients/smpcep.png') }}" alt="SMPN 1 Cepiring" class="max-w-full max-h-full object-contain">
                    </div>
                    <p class="text-[8px] md:text-sm font-semibold text-white text-center uppercase tracking-wide">SMPN 1 CEPIRING</p>
                  </div>
                  <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 md:w-32 md:h-32 flex items-center justify-center mb-1 md:mb-3 bg-white/10 rounded-lg p-2 md:p-4">
                      <img src="{{ asset('foto/clients/smpsawel.jpg') }}" alt="SMPN 1 Weleri" class="max-w-full max-h-full object-contain">
                    </div>
                    <p class="text-[8px] md:text-sm font-semibold text-white text-center uppercase tracking-wide">SMPN 1 WELERI</p>
                  </div>
                  <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 md:w-32 md:h-32 flex items-center justify-center mb-1 md:mb-3 bg-white/10 rounded-lg p-2 md:p-4">
                      <img src="{{ asset('foto/clients/smk2.jpg') }}" alt="SMKN 2 Kendal" class="max-w-full max-h-full object-contain">
                    </div>
                    <p class="text-[8px] md:text-sm font-semibold text-white text-center uppercase tracking-wide">SMKN 2 KENDAL</p>
                  </div>
                </div>
              </div>

              <!-- Slide 5 -->
              <div class="w-full flex-shrink-0">
                <div class="grid grid-cols-4 gap-2 md:gap-8">
                  <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 md:w-32 md:h-32 flex items-center justify-center mb-1 md:mb-3 bg-white/10 rounded-lg p-2 md:p-4">
                      <img src="{{ asset('foto/clients/duwel.jpg') }}" alt="SMPN 2 Weleri" class="max-w-full max-h-full object-contain">
                    </div>
                    <p class="text-[8px] md:text-sm font-semibold text-white text-center uppercase tracking-wide">SMPN 2 WELERI</p>
                  </div>
                  <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 md:w-32 md:h-32 flex items-center justify-center mb-1 md:mb-3 bg-white/10 rounded-lg p-2 md:p-4">
                      <img src="{{ asset('foto/clients/bri.png') }}" alt="Bank BRI" class="max-w-full max-h-full object-contain">
                    </div>
                    <p class="text-[8px] md:text-sm font-semibold text-white text-center uppercase tracking-wide">BANK BRI</p>
                  </div>
                  <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 md:w-32 md:h-32 flex items-center justify-center mb-1 md:mb-3 bg-white/10 rounded-lg p-2 md:p-4">
                      <img src="{{ asset('foto/clients/smkweleri.png') }}" alt="SMK Muhammadiyah" class="max-w-full max-h-full object-contain">
                    </div>
                    <p class="text-[8px] md:text-sm font-semibold text-white text-center uppercase tracking-wide">SMK MUHAMMADIYAH</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Navigation Buttons -->
          <button @click="prevSlide()" 
                  class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-4 md:-translate-x-12 bg-white/20 hover:bg-white/30 text-white p-3 rounded-full transition-all duration-300 backdrop-blur-sm">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
          </button>
          <button @click="nextSlide()" 
                  class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-4 md:translate-x-12 bg-white/20 hover:bg-white/30 text-white p-3 rounded-full transition-all duration-300 backdrop-blur-sm">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
          </button>

          <!-- Indicators -->
          <div class="flex justify-center space-x-2 mt-8">
            <template x-for="i in totalSlides" :key="i">
              <button @click="goToSlide(i - 1)" 
                      :class="currentSlide === (i - 1) ? 'bg-white w-8' : 'bg-white/40 w-2'"
                      class="h-2 rounded-full transition-all duration-300">
              </button>
            </template>
          </div>

          <!-- CTA Text -->
          <div class="text-center mt-8">
            <p class="text-white text-sm md:text-base font-poppins">
              Bergabunglah dengan klien-klien kami yang telah mempercayakan kebutuhan catering mereka kepada kami
            </p>
          </div>
        </div>
      </div>
    </section>

    <div class="bg-gray-900 text-gray-400 text-center text-xs py-4">
      © Rejosari Catering Copyright 2025. All Rights Reserved. &nbsp;|&nbsp; Privacy Policy &nbsp;|&nbsp; Terms &nbsp;|&nbsp; Pricing &nbsp;|&nbsp; Do not sell or share my personal Information
    </div>
    </footer>

    <!-- Add JavaScript for filtering and gallery slider -->
    <script>
      // Gallery Slider Function with Touch Support
      function gallerySlider() {
        return {
          currentPage: 0,
          itemsPerPage: 8,
          activeCategory: 'all',
          isTransitioning: false,
          touchStartX: 0,
          touchEndX: 0,
          minSwipeDistance: 50,

          init() {
            this.updateItemsPerPage();
            window.addEventListener('resize', () => {
              this.updateItemsPerPage();
              // Reset to first page if current page exceeds new total pages
              if (this.currentPage >= this.totalPages()) {
                this.currentPage = Math.max(0, this.totalPages() - 1);
              }
            });
          },

          updateItemsPerPage() {
            // 4 items for mobile (< 768px), 8 items for desktop
            this.itemsPerPage = window.innerWidth < 768 ? 4 : 8;
          },

          getVisibleItems() {
            const items = Array.from(document.querySelectorAll('.gallery-item'));
            if (this.activeCategory === 'all') {
              return items;
            }
            return items.filter(item => item.dataset.category === this.activeCategory);
          },

          totalPages() {
            const visibleCount = this.getVisibleItems().length;
            return Math.ceil(visibleCount / this.itemsPerPage);
          },

          isVisible(el) {
            // Check if item matches active category first
            if (this.activeCategory !== 'all' && el.dataset.category !== this.activeCategory) {
              return false;
            }

            const items = this.getVisibleItems();
            const index = items.indexOf(el);

            if (index === -1) return false;

            const start = this.currentPage * this.itemsPerPage;
            const end = start + this.itemsPerPage;

            return index >= start && index < end;
          },

          nextSlide() {
            if (this.currentPage < this.totalPages() - 1) {
              this.animateTransition(() => {
                this.currentPage++;
              });
            }
          },

          prevSlide() {
            if (this.currentPage > 0) {
              this.animateTransition(() => {
                this.currentPage--;
              });
            }
          },

          goToPage(index) {
            if (index !== this.currentPage) {
              this.animateTransition(() => {
                this.currentPage = index;
              });
            }
          },

          animateTransition(callback) {
            this.isTransitioning = true;
            setTimeout(() => {
              callback();
              setTimeout(() => {
                this.isTransitioning = false;
              }, 50);
            }, 150);
          },

          canGoNext() {
            return this.currentPage < this.totalPages() - 1;
          },

          canGoPrev() {
            return this.currentPage > 0;
          },

          setCategory(category) {
            this.activeCategory = category;
            this.currentPage = 0;
          },

          // Touch event handlers
          handleTouchStart(event) {
            this.touchStartX = event.touches[0].clientX;
          },

          handleTouchMove(event) {
            this.touchEndX = event.touches[0].clientX;
          },

          handleTouchEnd(event) {
            const swipeDistance = this.touchStartX - this.touchEndX;

            if (Math.abs(swipeDistance) > this.minSwipeDistance) {
              if (swipeDistance > 0 && this.canGoNext()) {
                // Swipe left - next slide
                this.nextSlide();
              } else if (swipeDistance < 0 && this.canGoPrev()) {
                // Swipe right - previous slide
                this.prevSlide();
              }
            }

            this.touchStartX = 0;
            this.touchEndX = 0;
          }
        }
      }

      // Category filtering is now handled by Alpine.js
    </script>

    <!-- Add this script before closing body tag -->
    <script>
      function imageSlider() {
        return {
          activeSlide: 1,
          init() {
            setInterval(() => {
              this.activeSlide = this.activeSlide === 3 ? 1 : this.activeSlide + 1;
            }, 3000);
          }
        }
      }

      // Client Slider with Drag Support
      function clientCarousel() {
        return {
          currentSlide: 0,
          totalSlides: 5,
          autoplayInterval: null,

          init() {
            this.startAutoplay();
          },

          startAutoplay() {
            this.autoplayInterval = setInterval(() => {
              this.nextSlide();
            }, 4000); // Auto-slide every 4 seconds
          },

          stopAutoplay() {
            if (this.autoplayInterval) {
              clearInterval(this.autoplayInterval);
            }
          },

          nextSlide() {
            this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
          },

          prevSlide() {
            this.currentSlide = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
            this.resetAutoplay();
          },

          goToSlide(index) {
            this.currentSlide = index;
            this.resetAutoplay();
          },

          resetAutoplay() {
            this.stopAutoplay();
            this.startAutoplay();
          }
        }
      }
    </script>
</body>

</html>