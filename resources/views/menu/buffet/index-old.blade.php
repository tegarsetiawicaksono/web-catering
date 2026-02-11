@extends('layouts.app')

@section('content')
<style>
    .hide-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    .hide-scrollbar::-webkit-scrollbar {
        display: none;
    }
</style>

<div class="min-h-screen pt-16 relative">
    <!-- Fixed Background -->
    <div class="fixed inset-0 z-0">
        <img src="{{ asset('foto/buffet/buffet.jpg') }}" alt="Background" class="w-full h-full object-cover">
        <div class="absolute inset-0 backdrop-blur-sm bg-white/60"></div>
    </div>

    <!-- Header Section -->
    <div class="relative">
        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('foto/buffet.jpg') }}" alt="Buffet Background" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/50"></div>
        </div>

        <!-- Content -->
        <div class="relative z-10 py-20">
            <div class="container mx-auto px-4">
                <h1 class="text-4xl md:text-5xl font-bold mb-4 text-white drop-shadow-lg">Paket Buffet</h1>
                <p class="text-lg text-white/90 max-w-2xl drop-shadow-md">Pilihan menu buffet berkualitas untuk berbagai acara Anda</p>
            </div>
        </div>
    </div>

    <!-- Packages Grid -->
    <div class="relative z-10">
        <div class="container max-w-7xl mx-auto px-4 py-16">
            <!-- Mobile: Horizontal Scroll with Navigation Buttons -->
            <div class="md:hidden relative" x-data="{ 
                scrollContainer: null,
                init() {
                    this.scrollContainer = this.$refs.scrollContainer;
                },
                scrollLeft() {
                    this.scrollContainer.scrollBy({ left: -320, behavior: 'smooth' });
                },
                scrollRight() {
                    this.scrollContainer.scrollBy({ left: 320, behavior: 'smooth' });
                }
            }">
                <!-- Left Arrow Button -->
                <button @click="scrollLeft"
                    class="absolute left-0 top-1/2 -translate-y-1/2 z-20 bg-white/90 backdrop-blur-sm p-3 rounded-full shadow-xl hover:bg-white transition-all duration-300 -ml-4">
                    <svg class="w-6 h-6 text-[#86765a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>

                <!-- Right Arrow Button -->
                <button @click="scrollRight"
                    class="absolute right-0 top-1/2 -translate-y-1/2 z-20 bg-white/90 backdrop-blur-sm p-3 rounded-full shadow-xl hover:bg-white transition-all duration-300 -mr-4">
                    <svg class="w-6 h-6 text-[#86765a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>

                <!-- Scroll Container -->
                <div x-ref="scrollContainer" class="overflow-x-auto hide-scrollbar snap-x snap-mandatory px-2">
                    <div class="flex gap-6 pb-4">
                        @forelse($menus as $menu)
                        <div class="flex-shrink-0 w-80 snap-center" x-data="{ showMenu: false }">
                            <div class="bg-white/95 backdrop-blur-md rounded-2xl shadow-xl overflow-hidden h-full border border-white/50">
                                <div class="relative">
                                    @if($menu->gambar)
                                    <img src="{{ asset('foto/' . $menu->gambar) }}" alt="{{ $menu->nama }}" class="w-full h-48 object-cover">
                                    @else
                                    <img src="{{ asset('foto/buffet.jpg') }}" alt="{{ $menu->nama }}" class="w-full h-48 object-cover">
                                    @endif
                                    <div class="absolute top-4 right-4 bg-gradient-to-r from-[#86765a] to-amber-600 text-white px-4 py-2 rounded-full font-bold shadow-lg">
                                        Rp {{ number_format($menu->harga, 0, ',', '.') }}/pax
                                    </div>
                                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent p-4">
                                        <h3 class="text-2xl font-bold text-white drop-shadow-lg">{{ $menu->nama }}</h3>
                                    </div>
                                </div>
                                <div class="p-5">
                                    <!-- Toggle Button -->
                                    <button @click="showMenu = !showMenu"
                                        class="w-full mb-4 bg-gradient-to-r from-amber-500 to-orange-500 text-white py-2.5 rounded-lg font-medium flex items-center justify-center gap-2 shadow-md hover:shadow-lg transition-all">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                        <span x-text="showMenu ? 'Sembunyikan Menu' : 'Lihat Detail Menu'"></span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform" :class="{ 'rotate-180': showMenu }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>

                                    <!-- Menu Details (Expandable) -->
                                    <div x-show="showMenu"
                                        x-transition:enter="transition ease-out duration-300"
                                        x-transition:enter-start="opacity-0 -translate-y-2"
                                        x-transition:enter-end="opacity-100 translate-y-0"
                                        x-transition:leave="transition ease-in duration-200"
                                        x-transition:leave-start="opacity-100 translate-y-0"
                                        x-transition:leave-end="opacity-0 -translate-y-2"
                                        class="mb-4 bg-gradient-to-br from-orange-50 to-amber-50 rounded-xl p-4 border border-orange-200">

                                        <div class="bg-white/80 rounded-lg p-4 shadow-sm">
                                            <h4 class="font-bold text-[#86765a] text-sm mb-3 flex items-center gap-2">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <circle cx="10" cy="10" r="3" />
                                                </svg>
                                                Deskripsi Menu
                                            </h4>
                                            <p class="text-sm text-gray-700 leading-relaxed whitespace-pre-line">{{ $menu->deskripsi }}</p>
                                        </div>
                                        <!-- Appetizer -->
                                        <div class="bg-white/80 rounded-lg p-3 shadow-sm">
                                            <h4 class="font-bold text-[#86765a] text-sm mb-2 flex items-center gap-2">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <circle cx="10" cy="10" r="3" />
                                                </svg>
                                                Appetizer
                                            </h4>
                                            <ul class="space-y-1 text-xs text-gray-700">
                                                <li class="flex items-start gap-2">
                                                    <span class="text-orange-500 mt-0.5">•</span>
                                                    <span>Softdrink</span>
                                                </li>
                                                <li class="flex items-start gap-2">
                                                    <span class="text-orange-500 mt-0.5">•</span>
                                                    <span>2 Macam Mini Snack</span>
                                                </li>
                                            </ul>
                                        </div>

                                        <!-- Buffet Menu -->
                                        <div class="bg-white/80 rounded-lg p-3 shadow-sm">
                                            <h4 class="font-bold text-[#86765a] text-sm mb-2 flex items-center gap-2">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <circle cx="10" cy="10" r="3" />
                                                </svg>
                                                Buffet Menu
                                            </h4>
                                            <ul class="space-y-1 text-xs text-gray-700">
                                                <li class="flex items-start gap-2">
                                                    <span class="text-orange-500 mt-0.5">•</span>
                                                    <span>Nasi Putih</span>
                                                </li>
                                                <li class="flex items-start gap-2">
                                                    <span class="text-orange-500 mt-0.5">•</span>
                                                    <span>1 Macam Ayam</span>
                                                </li>
                                                <li class="flex items-start gap-2">
                                                    <span class="text-orange-500 mt-0.5">•</span>
                                                    <span>1 Macam Menu Olahan</span>
                                                </li>
                                                <li class="flex items-start gap-2">
                                                    <span class="text-orange-500 mt-0.5">•</span>
                                                    <span>1 Soup</span>
                                                </li>
                                                <li class="flex items-start gap-2">
                                                    <span class="text-orange-500 mt-0.5">•</span>
                                                    <span>Kerupuk</span>
                                                </li>
                                            </ul>
                                        </div>

                                        <!-- Dessert -->
                                        <div class="bg-white/80 rounded-lg p-3 shadow-sm">
                                            <h4 class="font-bold text-[#86765a] text-sm mb-2 flex items-center gap-2">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <circle cx="10" cy="10" r="3" />
                                                </svg>
                                                Dessert
                                            </h4>
                                            <ul class="space-y-1 text-xs text-gray-700">
                                                <li class="flex items-start gap-2">
                                                    <span class="text-orange-500 mt-0.5">•</span>
                                                    <span>1 Macam Pilihan Es</span>
                                                </li>
                                                <li class="flex items-start gap-2">
                                                    <span class="text-orange-500 mt-0.5">•</span>
                                                    <span>Air Mineral</span>
                                                </li>
                                            </ul>
                                        </div>

                                        @elseif($pkg['name'] == 'Gold')
                                        <!-- Appetizer -->
                                        <div class="bg-white/80 rounded-lg p-3 shadow-sm">
                                            <h4 class="font-bold text-[#86765a] text-sm mb-2 flex items-center gap-2">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <circle cx="10" cy="10" r="3" />
                                                </svg>
                                                Appetizer
                                            </h4>
                                            <ul class="space-y-1 text-xs text-gray-700">
                                                <li class="flex items-start gap-2">
                                                    <span class="text-orange-500 mt-0.5">•</span>
                                                    <span>2 Juice & 2 Softdrink</span>
                                                </li>
                                                <li class="flex items-start gap-2">
                                                    <span class="text-orange-500 mt-0.5">•</span>
                                                    <span>2 Macam Mini Snack</span>
                                                </li>
                                            </ul>
                                        </div>

                                        <!-- Buffet Menu -->
                                        <div class="bg-white/80 rounded-lg p-3 shadow-sm">
                                            <h4 class="font-bold text-[#86765a] text-sm mb-2 flex items-center gap-2">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <circle cx="10" cy="10" r="3" />
                                                </svg>
                                                Buffet Menu
                                            </h4>
                                            <ul class="space-y-1 text-xs text-gray-700">
                                                <li class="flex items-start gap-2">
                                                    <span class="text-orange-500 mt-0.5">•</span>
                                                    <span>Nasi Putih</span>
                                                </li>
                                                <li class="flex items-start gap-2">
                                                    <span class="text-orange-500 mt-0.5">•</span>
                                                    <span>1 Macam Ayam</span>
                                                </li>
                                                <li class="flex items-start gap-2">
                                                    <span class="text-orange-500 mt-0.5">•</span>
                                                    <span>1 Macam Seafood</span>
                                                </li>
                                                <li class="flex items-start gap-2">
                                                    <span class="text-orange-500 mt-0.5">•</span>
                                                    <span>1 Macam Menu Olahan</span>
                                                </li>
                                                <li class="flex items-start gap-2">
                                                    <span class="text-orange-500 mt-0.5">•</span>
                                                    <span>1 Soup</span>
                                                </li>
                                                <li class="flex items-start gap-2">
                                                    <span class="text-orange-500 mt-0.5">•</span>
                                                    <span>Kerupuk</span>
                                                </li>
                                            </ul>
                                        </div>

                                        <!-- Dessert -->
                                        <div class="bg-white/80 rounded-lg p-3 shadow-sm">
                                            <h4 class="font-bold text-[#86765a] text-sm mb-2 flex items-center gap-2">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <circle cx="10" cy="10" r="3" />
                                                </svg>
                                                Dessert
                                            </h4>
                                            <ul class="space-y-1 text-xs text-gray-700">
                                                <li class="flex items-start gap-2">
                                                    <span class="text-orange-500 mt-0.5">•</span>
                                                    <span>1 Macam Pilihan Es</span>
                                                </li>
                                                <li class="flex items-start gap-2">
                                                    <span class="text-orange-500 mt-0.5">•</span>
                                                    <span>Air Mineral</span>
                                                </li>
                                            </ul>
                                        </div>

                                        @else
                                        <!-- Appetizer -->
                                        <div class="bg-white/80 rounded-lg p-3 shadow-sm">
                                            <h4 class="font-bold text-[#86765a] text-sm mb-2 flex items-center gap-2">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <circle cx="10" cy="10" r="3" />
                                                </svg>
                                                Appetizer
                                            </h4>
                                            <ul class="space-y-1 text-xs text-gray-700">
                                                <li class="flex items-start gap-2">
                                                    <span class="text-orange-500 mt-0.5">•</span>
                                                    <span>2 Juice & 2 Softdrink</span>
                                                </li>
                                                <li class="flex items-start gap-2">
                                                    <span class="text-orange-500 mt-0.5">•</span>
                                                    <span>2 Macam Mini Snack</span>
                                                </li>
                                            </ul>
                                        </div>

                                        <!-- Buffet Menu -->
                                        <div class="bg-white/80 rounded-lg p-3 shadow-sm">
                                            <h4 class="font-bold text-[#86765a] text-sm mb-2 flex items-center gap-2">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <circle cx="10" cy="10" r="3" />
                                                </svg>
                                                Buffet Menu
                                            </h4>
                                            <ul class="space-y-1 text-xs text-gray-700">
                                                <li class="flex items-start gap-2">
                                                    <span class="text-orange-500 mt-0.5">•</span>
                                                    <span>Nasi Putih</span>
                                                </li>
                                                <li class="flex items-start gap-2">
                                                    <span class="text-orange-500 mt-0.5">•</span>
                                                    <span>2 Macam Ayam</span>
                                                </li>
                                                <li class="flex items-start gap-2">
                                                    <span class="text-orange-500 mt-0.5">•</span>
                                                    <span>1 Macam Seafood</span>
                                                </li>
                                                <li class="flex items-start gap-2">
                                                    <span class="text-orange-500 mt-0.5">•</span>
                                                    <span>1 Macam Menu Olahan</span>
                                                </li>
                                                <li class="flex items-start gap-2">
                                                    <span class="text-orange-500 mt-0.5">•</span>
                                                    <span>1 Soup</span>
                                                </li>
                                                <li class="flex items-start gap-2">
                                                    <span class="text-orange-500 mt-0.5">•</span>
                                                    <span>Kerupuk</span>
                                                </li>
                                            </ul>
                                        </div>

                                        <!-- Dessert -->
                                        <div class="bg-white/80 rounded-lg p-3 shadow-sm">
                                            <h4 class="font-bold text-[#86765a] text-sm mb-2 flex items-center gap-2">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <circle cx="10" cy="10" r="3" />
                                                </svg>
                                                Dessert
                                            </h4>
                                            <ul class="space-y-1 text-xs text-gray-700">
                                                <li class="flex items-start gap-2">
                                                    <span class="text-orange-500 mt-0.5">•</span>
                                                    <span>1 Macam Pilihan Es</span>
                                                </li>
                                                <li class="flex items-start gap-2">
                                                    <span class="text-orange-500 mt-0.5">•</span>
                                                    <span>Air Mineral</span>
                                                </li>
                                            </ul>
                                        </div>
                                        @endif
                                    </div>

                                    <div class="space-y-3">
                                        @auth
                                        <a href="/checkout/direct?package={{ $pkg['route'] }}&name=Paket Prasmanan {{ $pkg['name'] }}&price={{ str_replace('.', '', $pkg['price']) }}&min=100"
                                            class="block w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white py-3 rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-300 font-semibold text-center shadow-lg">
                                            <span class="flex items-center justify-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                Pesan Sekarang
                                            </span>
                                        </a>
                                        @else
                                        <a href="{{ route('login') }}"
                                            class="block w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white py-3 rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-300 font-semibold text-center shadow-lg">
                                            <span class="flex items-center justify-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                                </svg>
                                                Login untuk Pesan
                                            </span>
                                        </a>
                                        @endauth

                                        <div class="grid grid-cols-2 gap-3">
                                            @auth
                                            <button type="button"
                                                class="bg-white border-2 border-orange-500 text-orange-500 py-3 rounded-xl hover:bg-orange-50 transition-all duration-300 font-semibold">
                                                <span class="flex items-center justify-center gap-2 text-sm">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                                    </svg>
                                                    Keranjang
                                                </span>
                                            </button>
                                            @else
                                            <a href="{{ route('login') }}"
                                                class="bg-white border-2 border-orange-500 text-orange-500 py-3 rounded-xl hover:bg-orange-50 transition-all duration-300 font-semibold">
                                                <span class="flex items-center justify-center gap-2 text-xs">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                                    </svg>
                                                    Login
                                                </span>
                                            </a>
                                            @endauth

                                            <a href="https://wa.me/6282227110771?text=Halo%2C%20saya%20tertarik%20dengan%20Paket%20Prasmanan%20{{ $pkg['name'] }}"
                                                target="_blank"
                                                class="bg-white border-2 border-green-500 text-green-500 py-3 rounded-xl hover:bg-green-50 transition-all duration-300 font-semibold">
                                                <span class="flex items-center justify-center gap-2 text-sm">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                                                    </svg>
                                                    WA
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Desktop: Grid Layout -->
            <div class="hidden md:grid grid-cols-1 md:grid-cols-[repeat(auto-fit,minmax(300px,1fr))] gap-8">
                <!-- Paket Silver -->
                <div class="bg-white/90 backdrop-blur-sm rounded-xl shadow-lg overflow-hidden hover:bg-white transition-all duration-300 hover:shadow-xl">
                    <div class="relative">
                        <img src="{{ asset('foto/buffet.jpg') }}" alt="Paket Silver" class="w-full h-48 object-cover">
                        <div class="absolute top-4 right-4 bg-white text-[#86765a] px-4 py-1 rounded-full font-semibold">
                            Rp 35.000/pax
                        </div>
                    </div>
                    <div class="p-6 flex flex-col min-h-[600px]">
                        <div class="flex-grow">
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Paket Silver</h3>
                            <div class="space-y-4">
                                <div>
                                    <h4 class="font-medium text-[#86765a]">Appitizer</h4>
                                    <ul class="mt-2 space-y-1 text-gray-600">
                                        <li>• Softdrink</li>
                                        <li>• 2 Macam Mini Snack</li>
                                </div>
                                <div>
                                    <h4 class="font-medium text-[#86765a]">Buffet Menu</h4>
                                    <ul class="mt-2 space-y-1 text-gray-600">
                                        <li>• Nasi Putih</li>
                                        <li>• 1 Macam Ayam</li>
                                        <li>• 1 Macam Menu Olahan</li>
                                        <li>• 1 Soup</li>
                                        <li>• Kerupuk</li>
                                    </ul>
                                </div>
                                <div>
                                    <h4 class="font-medium text-[#86765a]">Dessert</h4>
                                    <ul class="mt-2 space-y-1 text-gray-600">
                                        <li>• 1 Macam Pilihan Es</li>
                                        <li>• Air Mineral</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <!-- Primary Action (Pesan Sekarang) -->
                            @auth
                            <a href="/checkout/direct?package=silver&name=Paket Prasmanan Silver&price=35000&min=100"
                                class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white h-[48px] rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-300 font-medium flex items-center justify-center space-x-2 shadow-lg hover:shadow-blue-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-sm whitespace-nowrap">Pesan Sekarang</span>
                            </a>
                            @else
                            <a href="{{ route('login') }}"
                                class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white h-[48px] rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-300 font-medium flex items-center justify-center space-x-2 shadow-lg hover:shadow-blue-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                </svg>
                                <span class="text-sm whitespace-nowrap">Login untuk Pesan</span>
                            </a>
                            @endauth

                            <!-- Secondary Actions -->
                            <div class="grid grid-cols-2 gap-3">
                                @auth
                                <div x-data="{ 
                                    showModal: false,
                                    quantity: 100,
                                    basePrice: 35000,
                                    cartStore: Alpine.store('cart'),
                                    get price() {
                                        return this.quantity >= 300 ? this.basePrice - 5000 : this.basePrice;
                                    },
                                    get total() {
                                        return this.quantity * this.price;
                                    },
                                    get discount() {
                                        return this.quantity >= 300;
                                    },
                                    formatPrice(value) {
                                        return new Intl.NumberFormat('id-ID', {
                                            style: 'currency',
                                            currency: 'IDR',
                                            minimumFractionDigits: 0,
                                            maximumFractionDigits: 0
                                        }).format(value);
                                    },
                                    handleAddToCart() {
                                        this.cartStore.add('buffet-silver', 'Paket Prasmanan Silver', this.price, this.quantity);
                                        this.showModal = false;
                                        this.$dispatch('open-cart');
                                    }
                                }">
                                    <!-- Tombol Keranjang -->
                                    <button @click="showModal = true"
                                        type="button"
                                        class="w-full bg-white border-2 border-orange-500 text-orange-500 h-[48px] rounded-lg hover:bg-orange-50 transition-all duration-300 font-medium flex items-center justify-center space-x-2 px-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        <span class="text-sm whitespace-nowrap">+ Keranjang</span>
                                    </button>

                                    <!-- Modal -->
                                    <div x-show="showModal"
                                        class="fixed inset-0 z-50 overflow-y-auto"
                                        style="display: none;"
                                        @click.away="showModal = false">
                                        <div class="flex items-center justify-center min-h-screen px-4">
                                            <!-- Overlay -->
                                            <div class="fixed inset-0 bg-black opacity-30"></div>

                                            <!-- Modal Content -->
                                            <div class="relative bg-white rounded-lg shadow-xl max-w-md w-full">
                                                <div class="p-6">
                                                    <div class="flex items-center justify-between mb-4">
                                                        <h3 class="text-lg font-semibold text-gray-900">Tambah ke Keranjang</h3>
                                                        <button @click="showModal = false" class="text-gray-400 hover:text-gray-500">
                                                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                            </svg>
                                                        </button>
                                                    </div>

                                                    <div class="space-y-4">
                                                        <!-- Product Info -->
                                                        <div class="flex items-start space-x-4">
                                                            <img src="{{ asset('foto/buffet.jpg') }}" alt="Paket Silver" class="w-20 h-20 object-cover rounded-lg">
                                                            <div>
                                                                <h4 class="font-semibold text-gray-900">Paket Prasmanan Silver</h4>
                                                                <div class="space-y-1">
                                                                    <p class="text-gray-600" x-text="formatPrice(basePrice) + '/porsi'"></p>
                                                                    <p class="text-sm text-gray-500">Minimal pemesanan 100 porsi</p>
                                                                    <template x-if="discount">
                                                                        <p class="text-sm text-green-600 font-medium">
                                                                            Diskon Rp 5.000/porsi untuk pemesanan 300+ porsi
                                                                        </p>
                                                                    </template>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Quantity Input -->
                                                        <div class="flex items-center justify-between border-t border-b border-gray-200 py-4">
                                                            <span class="text-gray-700">Jumlah Porsi</span>
                                                            <div class="flex items-center space-x-3">
                                                                <button @click="quantity = Math.max(100, quantity - 10)"
                                                                    type="button"
                                                                    class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-full text-gray-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2">
                                                                    -
                                                                </button>
                                                                <input type="number"
                                                                    x-model.number="quantity"
                                                                    min="100"
                                                                    class="w-24 text-center border-gray-300 rounded-md focus:border-orange-500 focus:ring-orange-500"
                                                                    @keypress="$event.key === 'Enter' && $event.preventDefault()"
                                                                    @blur="quantity = quantity < 100 ? 100 : quantity">
                                                                <button @click="quantity = quantity + 10"
                                                                    type="button"
                                                                    class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-full text-gray-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2">
                                                                    +
                                                                </button>
                                                            </div>
                                                        </div>

                                                        <!-- Total -->
                                                        <div class="flex items-center justify-between font-semibold">
                                                            <span class="text-gray-900">Total</span>
                                                            <span class="text-orange-500" x-text="formatPrice(total)"></span>
                                                        </div>

                                                        <!-- Form Submission -->
                                                        <form action="{{ route('cart.store') }}" method="POST" class="mt-6">
                                                            @csrf
                                                            <input type="hidden" name="menu_id" value="buffet-silver">
                                                            <input type="hidden" name="package_name" value="Paket Prasmanan Silver">
                                                            <input type="hidden" name="price" value="35000">
                                                            <input type="hidden" name="quantity" x-model="quantity">
                                                            <button type="submit"
                                                                class="w-full bg-orange-500 text-white px-6 py-3 rounded-lg hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition-colors">
                                                                Tambah ke Keranjang
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <a href="{{ route('login') }}"
                                    class="w-full bg-white border-2 border-orange-500 text-orange-500 h-[48px] rounded-lg hover:bg-orange-50 transition-all duration-300 font-medium flex items-center justify-center space-x-2 px-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    <span class="text-sm whitespace-nowrap">Login untuk + Keranjang</span>
                                </a>
                                @endauth

                                <a href="https://wa.me/6282227110771?text=Halo%2C%20saya%20tertarik%20dengan%20Paket%20Prasmanan%20Silver%20(Rp%2035.000%2Fpax).%20Mohon%20konsultasi%20mengenai:%0A-%20Jumlah%20porsi%20yang%20sesuai%0A-%20Menu%20yang%20recommended%0A-%20Ketersediaan%20untuk%20tanggal%20yang%20saya%20inginkan"
                                    target="_blank"
                                    class="w-full h-[48px] flex items-center justify-center space-x-2 bg-white border-2 border-green-500 text-green-500 rounded-lg hover:bg-green-50 transition-all duration-300 font-medium px-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                                    </svg>
                                    <span class="text-sm whitespace-nowrap">Konsultasi</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Paket Gold -->
                <div class="bg-white/90 backdrop-blur-sm rounded-xl shadow-lg overflow-hidden hover:bg-white transition-all duration-300 hover:shadow-xl">
                    <div class="relative">
                        <img src="{{ asset('foto/buffet.jpg') }}" alt="Paket Gold" class="w-full h-48 object-cover">
                        <div class="absolute top-4 right-4 bg-white text-[#86765a] px-4 py-1 rounded-full font-semibold shadow-md">
                            Rp 35.000/pax
                        </div>
                    </div>
                    <div class="p-6 flex flex-col min-h-[600px]">
                        <div class="flex-grow">
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Paket Gold</h3>
                            <div class="space-y-4">
                                <div>
                                    <h4 class="font-medium text-[#86765a]">Appitizer</h4>
                                    <ul class="mt-2 space-y-1 text-gray-600">
                                        <li>• 2 Juice & 2 Softdrink</li>
                                        <li>• 2 Macam Mini Snack</li>
                                </div>
                                <div>
                                    <h4 class="font-medium text-[#86765a]">Buffet Menu</h4>
                                    <ul class="mt-2 space-y-1 text-gray-600">
                                        <li>• Nasi Putih</li>
                                        <li>• 1 Macam Ayam / Daging</li>
                                        <li>• 1 Macam Menu Olahan</li>
                                        <li>• 1 Macam Cah / Oseng</li>
                                        <li>• 1 Soup</li>
                                        <li>• Kerupuk</li>
                                    </ul>
                                </div>
                                <div>
                                    <h4 class="font-medium text-[#86765a]">Dessert</h4>
                                    <ul class="mt-2 space-y-1 text-gray-600">
                                        <li>• 1 Macam Pilihan Es</li>
                                        <li>• Air Mineral</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <!-- Primary Action (Pesan Sekarang) -->
                            @auth
                            <a href="/checkout/direct?package=gold&name=Paket Prasmanan Gold&price=35000&min=100"
                                class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white h-[48px] rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-300 font-medium flex items-center justify-center space-x-2 shadow-lg hover:shadow-blue-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-sm whitespace-nowrap">Pesan Sekarang</span>
                            </a>
                            @else
                            <a href="{{ route('login') }}"
                                class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white h-[48px] rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-300 font-medium flex items-center justify-center space-x-2 shadow-lg hover:shadow-blue-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                </svg>
                                <span class="text-sm whitespace-nowrap">Login untuk Pesan</span>
                            </a>
                            @endauth

                            <!-- Secondary Actions -->
                            <div class="grid grid-cols-2 gap-3">
                                @auth
                                <div x-data="{ 
                                    showModal: false,
                                    quantity: 100,
                                    basePrice: 35000,
                                    cartStore: Alpine.store('cart'),
                                    get price() {
                                        return this.quantity >= 300 ? this.basePrice - 5000 : this.basePrice;
                                    },
                                    get total() {
                                        return this.quantity * this.price;
                                    },
                                    get discount() {
                                        return this.quantity >= 300;
                                    },
                                    formatPrice(value) {
                                        return new Intl.NumberFormat('id-ID', {
                                            style: 'currency',
                                            currency: 'IDR',
                                            minimumFractionDigits: 0,
                                            maximumFractionDigits: 0
                                        }).format(value);
                                    },
                                    handleAddToCart() {
                                        this.cartStore.add('buffet-gold', 'Paket Prasmanan Gold', this.price, this.quantity);
                                        this.showModal = false;
                                        this.$dispatch('open-cart');
                                    }
                                }">
                                    <!-- Tombol Keranjang -->
                                    <button @click="showModal = true"
                                        type="button"
                                        class="w-full bg-white border-2 border-orange-500 text-orange-500 h-[48px] rounded-lg hover:bg-orange-50 transition-all duration-300 font-medium flex items-center justify-center space-x-2 px-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        <span class="text-sm whitespace-nowrap">+ Keranjang</span>
                                    </button>

                                    <!-- Modal -->
                                    <div x-show="showModal"
                                        class="fixed inset-0 z-50 overflow-y-auto"
                                        style="display: none;"
                                        @click.away="showModal = false">
                                        <div class="flex items-center justify-center min-h-screen px-4">
                                            <!-- Overlay -->
                                            <div class="fixed inset-0 bg-black opacity-30"></div>

                                            <!-- Modal Content -->
                                            <div class="relative bg-white rounded-lg shadow-xl max-w-md w-full">
                                                <div class="p-6">
                                                    <div class="flex items-center justify-between mb-4">
                                                        <h3 class="text-lg font-semibold text-gray-900">Tambah ke Keranjang</h3>
                                                        <button @click="showModal = false" class="text-gray-400 hover:text-gray-500">
                                                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                            </svg>
                                                        </button>
                                                    </div>

                                                    <div class="space-y-4">
                                                        <!-- Product Info -->
                                                        <div class="flex items-start space-x-4">
                                                            <img src="{{ asset('foto/buffet.jpg') }}" alt="Paket Gold" class="w-20 h-20 object-cover rounded-lg">
                                                            <div>
                                                                <h4 class="font-semibold text-gray-900">Paket Prasmanan Gold</h4>
                                                                <div class="space-y-1">
                                                                    <p class="text-gray-600" x-text="formatPrice(basePrice) + '/porsi'"></p>
                                                                    <p class="text-sm text-gray-500">Minimal pemesanan 100 porsi</p>
                                                                    <template x-if="discount">
                                                                        <p class="text-sm text-green-600 font-medium">
                                                                            Diskon Rp 5.000/porsi untuk pemesanan 300+ porsi
                                                                        </p>
                                                                    </template>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Quantity Input -->
                                                        <div class="flex items-center justify-between border-t border-b border-gray-200 py-4">
                                                            <span class="text-gray-700">Jumlah Porsi</span>
                                                            <div class="flex items-center space-x-3">
                                                                <button @click="quantity = Math.max(100, quantity - 10)"
                                                                    type="button"
                                                                    class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-full text-gray-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2">
                                                                    -
                                                                </button>
                                                                <input type="number"
                                                                    x-model.number="quantity"
                                                                    min="100"
                                                                    class="w-24 text-center border-gray-300 rounded-md focus:border-orange-500 focus:ring-orange-500"
                                                                    @keypress="$event.key === 'Enter' && $event.preventDefault()"
                                                                    @blur="quantity = quantity < 100 ? 100 : quantity">
                                                                <button @click="quantity = quantity + 10"
                                                                    type="button"
                                                                    class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-full text-gray-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2">
                                                                    +
                                                                </button>
                                                            </div>
                                                        </div>

                                                        <!-- Total -->
                                                        <div class="flex items-center justify-between font-semibold">
                                                            <span class="text-gray-900">Total</span>
                                                            <span class="text-orange-500" x-text="formatPrice(total)"></span>
                                                        </div>

                                                        <!-- Form Submission -->
                                                        <form action="{{ route('cart.store') }}" method="POST" class="mt-6">
                                                            @csrf
                                                            <input type="hidden" name="menu_id" value="buffet-gold">
                                                            <input type="hidden" name="package_name" value="Paket Prasmanan Gold">
                                                            <input type="hidden" name="price" value="35000">
                                                            <input type="hidden" name="quantity" x-model="quantity">
                                                            <button type="submit"
                                                                class="w-full bg-orange-500 text-white px-6 py-3 rounded-lg hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition-colors">
                                                                Tambah ke Keranjang
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <a href="{{ route('login') }}"
                                    class="w-full bg-white border-2 border-orange-500 text-orange-500 h-[48px] rounded-lg hover:bg-orange-50 transition-all duration-300 font-medium flex items-center justify-center space-x-2 px-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    <span class="text-sm whitespace-nowrap">Login untuk + Keranjang</span>
                                </a>
                                @endauth

                                <a href="https://wa.me/6282227110771?text=Halo%2C%20saya%20tertarik%20dengan%20Paket%20Prasmanan%20Gold%20(Rp%2035.000%2Fpax).%20Mohon%20konsultasi%20mengenai:%0A-%20Jumlah%20porsi%20yang%20sesuai%0A-%20Menu%20yang%20recommended%0A-%20Ketersediaan%20untuk%20tanggal%20yang%20saya%20inginkan"
                                    target="_blank"
                                    class="w-full h-[48px] flex items-center justify-center space-x-2 bg-white border-2 border-green-500 text-green-500 rounded-lg hover:bg-green-50 transition-all duration-300 font-medium px-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                                    </svg>
                                    <span class="text-sm whitespace-nowrap">Konsultasi</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Paket Platinum -->
                <div class="bg-white/90 backdrop-blur-sm rounded-xl shadow-lg overflow-hidden hover:bg-white transition-all duration-300 hover:shadow-xl">
                    <div class="relative">
                        <img src="{{ asset('foto/buffet.jpg') }}" alt="Paket Platinum" class="w-full h-48 object-cover">
                        <div class="absolute top-4 right-4 bg-white text-[#86765a] px-4 py-1 rounded-full font-semibold shadow-md">
                            Rp 40.000/pax
                        </div>
                    </div>
                    <div class="p-6 flex flex-col min-h-[600px]">
                        <div class="flex-grow">
                            <h3 class="text-lg font-bold text-gray-900 mb-2">Paket Platinum</h3>
                            <div class="space-y-2">
                                <div>
                                    <h4 class="font-medium text-[#86765a] text-sm">Appitizer</h4>
                                    <ul class="mt-1 space-y-0.5 text-gray-600 text-sm">
                                        <li>• 2 Juice & 2 Softdrink</li>
                                        <li>• 2 Macam Mini Snack</li>
                                </div>
                                <div>
                                    <h4 class="font-medium text-[#86765a] text-sm">Buffet Menu</h4>
                                    <ul class="mt-1 space-y-0.5 text-gray-600 text-sm">
                                        <li>• Nasi Putih</li>
                                        <li>• 1 Macam Ayam</li>
                                        <li>• 1 Macam Daging</li>
                                        <li>• 1 Macam Ikan / Seafood</li>
                                        <li>• 1 Macam Cah / Oseng</li>
                                        <li>• 1 Soup</li>
                                        <li>• Kerupuk</li>
                                    </ul>
                                </div>
                                <div>
                                    <h4 class="font-medium text-[#86765a] text-sm">Dessert</h4>
                                    <ul class="mt-1 space-y-0.5 text-gray-600 text-sm">
                                        <li>• 1 Macam Pilihan Es</li>
                                        <li>• Air Mineral</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <!-- Primary Action (Pesan Sekarang) -->
                            @auth
                            <a href="/checkout/direct?package=platinum&name=Paket Prasmanan Platinum&price=40000&min=100"
                                class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white h-[48px] rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-300 font-medium flex items-center justify-center space-x-2 shadow-lg hover:shadow-blue-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-sm whitespace-nowrap">Pesan Sekarang</span>
                            </a>
                            @else
                            <a href="{{ route('login') }}"
                                class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white h-[48px] rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-300 font-medium flex items-center justify-center space-x-2 shadow-lg hover:shadow-blue-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                </svg>
                                <span class="text-sm whitespace-nowrap">Login untuk Pesan</span>
                            </a>
                            @endauth

                            <!-- Secondary Actions -->
                            <div class="grid grid-cols-2 gap-3">
                                @auth
                                <div x-data="{ 
                                    showModal: false,
                                    quantity: 100,
                                    basePrice: 40000,
                                    cartStore: Alpine.store('cart'),
                                    get price() {
                                        return this.quantity >= 300 ? this.basePrice - 5000 : this.basePrice;
                                    },
                                    get total() {
                                        return this.quantity * this.price;
                                    },
                                    get discount() {
                                        return this.quantity >= 300;
                                    },
                                    formatPrice(value) {
                                        return new Intl.NumberFormat('id-ID', {
                                            style: 'currency',
                                            currency: 'IDR',
                                            minimumFractionDigits: 0,
                                            maximumFractionDigits: 0
                                        }).format(value);
                                    },
                                    handleAddToCart() {
                                        this.cartStore.add('buffet-platinum', 'Paket Prasmanan Platinum', this.price, this.quantity);
                                        this.showModal = false;
                                        this.$dispatch('open-cart');
                                    }
                                }">
                                    <!-- Tombol Keranjang -->
                                    <button @click="showModal = true"
                                        type="button"
                                        class="w-full bg-white border-2 border-orange-500 text-orange-500 h-[48px] rounded-lg hover:bg-orange-50 transition-all duration-300 font-medium flex items-center justify-center space-x-2 px-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        <span class="text-sm whitespace-nowrap">+ Keranjang</span>
                                    </button>

                                    <!-- Modal -->
                                    <div x-show="showModal"
                                        class="fixed inset-0 z-50 overflow-y-auto"
                                        style="display: none;"
                                        @click.away="showModal = false">
                                        <div class="flex items-center justify-center min-h-screen px-4">
                                            <!-- Overlay -->
                                            <div class="fixed inset-0 bg-black opacity-30"></div>

                                            <!-- Modal Content -->
                                            <div class="relative bg-white rounded-lg shadow-xl max-w-md w-full">
                                                <div class="p-6">
                                                    <div class="flex items-center justify-between mb-4">
                                                        <h3 class="text-lg font-semibold text-gray-900">Tambah ke Keranjang</h3>
                                                        <button @click="showModal = false" class="text-gray-400 hover:text-gray-500">
                                                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                            </svg>
                                                        </button>
                                                    </div>

                                                    <div class="space-y-4">
                                                        <!-- Product Info -->
                                                        <div class="flex items-start space-x-4">
                                                            <img src="{{ asset('foto/buffet.jpg') }}" alt="Paket Platinum" class="w-20 h-20 object-cover rounded-lg">
                                                            <div>
                                                                <h4 class="font-semibold text-gray-900">Paket Prasmanan Platinum</h4>
                                                                <div class="space-y-1">
                                                                    <p class="text-gray-600" x-text="formatPrice(basePrice) + '/porsi'"></p>
                                                                    <p class="text-sm text-gray-500">Minimal pemesanan 100 porsi</p>
                                                                    <template x-if="discount">
                                                                        <p class="text-sm text-green-600 font-medium">
                                                                            Diskon Rp 5.000/porsi untuk pemesanan 300+ porsi
                                                                        </p>
                                                                    </template>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Quantity Input -->
                                                        <div class="flex items-center justify-between border-t border-b border-gray-200 py-4">
                                                            <span class="text-gray-700">Jumlah Porsi</span>
                                                            <div class="flex items-center space-x-3">
                                                                <button @click="quantity = Math.max(100, quantity - 10)"
                                                                    type="button"
                                                                    class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-full text-gray-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2">
                                                                    -
                                                                </button>
                                                                <input type="number"
                                                                    x-model.number="quantity"
                                                                    min="100"
                                                                    class="w-24 text-center border-gray-300 rounded-md focus:border-orange-500 focus:ring-orange-500"
                                                                    @keypress="$event.key === 'Enter' && $event.preventDefault()"
                                                                    @blur="quantity = quantity < 100 ? 100 : quantity">
                                                                <button @click="quantity = quantity + 10"
                                                                    type="button"
                                                                    class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-full text-gray-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2">
                                                                    +
                                                                </button>
                                                            </div>
                                                        </div>

                                                        <!-- Total -->
                                                        <div class="flex items-center justify-between font-semibold">
                                                            <span class="text-gray-900">Total</span>
                                                            <span class="text-orange-500" x-text="formatPrice(total)"></span>
                                                        </div>

                                                        <!-- Form Submission -->
                                                        <form action="{{ route('cart.store') }}" method="POST" class="mt-6">
                                                            @csrf
                                                            <input type="hidden" name="menu_id" value="buffet-platinum">
                                                            <input type="hidden" name="package_name" value="Paket Prasmanan Platinum">
                                                            <input type="hidden" name="price" value="40000">
                                                            <input type="hidden" name="quantity" x-model="quantity">
                                                            <button type="submit"
                                                                class="w-full bg-orange-500 text-white px-6 py-3 rounded-lg hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition-colors">
                                                                Tambah ke Keranjang
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <a href="{{ route('login') }}"
                                    class="w-full bg-white border-2 border-orange-500 text-orange-500 h-[48px] rounded-lg hover:bg-orange-50 transition-all duration-300 font-medium flex items-center justify-center space-x-2 px-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    <span class="text-sm whitespace-nowrap">Login untuk + Keranjang</span>
                                </a>
                                @endauth

                                <a href="https://wa.me/6282227110771?text=Halo%2C%20saya%20tertarik%20dengan%20Paket%20Prasmanan%20Platinum%20(Rp%2040.000%2Fpax).%20Mohon%20konsultasi%20mengenai:%0A-%20Jumlah%20porsi%20yang%20sesuai%0A-%20Menu%20yang%20recommended%0A-%20Ketersediaan%20untuk%20tanggal%20yang%20saya%20inginkan"
                                    target="_blank"
                                    class="w-full h-[48px] flex items-center justify-center space-x-2 bg-white border-2 border-green-500 text-green-500 rounded-lg hover:bg-green-50 transition-all duration-300 font-medium px-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                                    </svg>
                                    <span class="text-sm whitespace-nowrap">Konsultasi</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>


                @if (session('success'))
                <div class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg"
                    x-data="{ show: true }"
                    x-show="show"
                    x-init="setTimeout(() => show = false, 3000)">
                    {{ session('success') }}
                </div>
                @endif
                @endsection