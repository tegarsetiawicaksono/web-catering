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

<div class="min-h-screen pt-16 bg-white relative">

    <!-- Header Section -->
    <div class="relative">
        @php
            $categoryBackground = ($category && $category->gambar_background)
                ? (\Illuminate\Support\Str::startsWith($category->gambar_background, ['foto/', 'http://', 'https://'])
                    ? $category->gambar_background
                    : 'foto/' . ltrim($category->gambar_background, '/'))
                : 'foto/buffet.jpg';
        @endphp
        <div class="absolute inset-0 z-0">
            <img src="{{ asset($categoryBackground) }}" alt="Buffet Background" class="w-full h-full object-cover" onerror="this.onerror=null;this.src='{{ asset('foto/buffet.jpg') }}';">
            <div class="absolute inset-0 bg-black/50"></div>
        </div>
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
            @if($menus->isEmpty())
            <div class="text-center py-12">
                <p class="text-gray-600 text-lg">Belum ada menu buffet tersedia</p>
            </div>
            @else
            <!-- Mobile: Horizontal Scroll -->
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
                <!-- Navigation Buttons -->
                <button @click="scrollLeft"
                    class="absolute left-0 top-1/2 -translate-y-1/2 z-20 bg-white/90 backdrop-blur-sm p-3 rounded-full shadow-xl hover:bg-white transition-all duration-300 -ml-4">
                    <svg class="w-6 h-6 text-[#86765a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>

                <button @click="scrollRight"
                    class="absolute right-0 top-1/2 -translate-y-1/2 z-20 bg-white/90 backdrop-blur-sm p-3 rounded-full shadow-xl hover:bg-white transition-all duration-300 -mr-4">
                    <svg class="w-6 h-6 text-[#86765a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>

                <!-- Scroll Container -->
                <div x-ref="scrollContainer" class="overflow-x-auto hide-scrollbar snap-x snap-mandatory px-2">
                    <div class="flex gap-6 pb-4">
                        @foreach($menus as $menu)
                        <div class="flex-shrink-0 w-80 snap-center" x-data="{ showMenu: false }">
                            <div class="bg-white/95 backdrop-blur-md rounded-2xl shadow-xl overflow-hidden h-full border border-white/50">
                                <div class="relative">
                                    @if($menu->gambar)
                                    @php
                                        $menuImage = \Illuminate\Support\Str::startsWith($menu->gambar, ['foto/', 'http://', 'https://'])
                                            ? $menu->gambar
                                            : 'foto/' . ltrim($menu->gambar, '/');
                                    @endphp
                                    <img src="{{ asset($menuImage) }}" alt="{{ $menu->nama }}" class="w-full h-56 sm:h-64 md:h-72 object-contain bg-gray-50 p-2" onerror="this.onerror=null;this.src='{{ asset('foto/buffet.jpg') }}';">
                                    @else
                                    <img src="{{ asset('foto/buffet.jpg') }}" alt="{{ $menu->nama }}" class="w-full h-56 sm:h-64 md:h-72 object-contain bg-gray-50 p-2" onerror="this.style.display='none';">
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
                                        <span x-text="showMenu ? 'Sembunyikan' : 'Lihat Detail'"></span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform" :class="{ 'rotate-180': showMenu }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>

                                    <!-- Menu Details -->
                                    <div x-show="showMenu"
                                        x-transition:enter="transition ease-out duration-300"
                                        x-transition:enter-start="opacity-0 -translate-y-2"
                                        x-transition:enter-end="opacity-100 translate-y-0"
                                        class="mb-4 bg-gradient-to-br from-orange-50 to-amber-50 rounded-xl p-4 border border-orange-200">
                                        <div class="bg-white/80 rounded-lg p-4 shadow-sm">
                                            <p class="text-sm text-gray-700 leading-relaxed whitespace-pre-line">{{ $menu->deskripsi }}</p>
                                        </div>
                                    </div>

                                    <div class="space-y-2 text-sm">
                                        <div class="flex items-center text-gray-600">
                                            <svg class="w-4 h-4 mr-2 text-[#86765a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                            <span>Min. Order: {{ $menu->min_order }} Porsi</span>
                                        </div>
                                    </div>

                                    <div class="mt-5 space-y-2">
                                        @auth
                                        <!-- Pesan Sekarang -->
                                        <a href="{{ route('checkout.show') }}?package=buffet&name={{ urlencode($menu->nama) }}&price={{ $menu->harga }}&min={{ $menu->min_order }}&menu_id={{ $menu->id }}"
                                            class="block w-full bg-gradient-to-r from-orange-500 to-amber-500 text-white py-3 rounded-xl hover:shadow-lg transition-all duration-300 font-bold text-center">
                                            <span class="flex items-center justify-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                Pesan Sekarang
                                            </span>
                                        </a>

                                        <!-- Tambah ke Keranjang -->
                                        <form action="{{ route('cart.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                            <input type="hidden" name="package_name" value="{{ $menu->nama }}">
                                            <input type="hidden" name="price" value="{{ $menu->harga }}">
                                            <input type="hidden" name="quantity" value="{{ $menu->min_order }}">
                                            <button type="submit"
                                                class="w-full bg-white border-2 border-orange-500 text-orange-500 py-3 rounded-xl hover:bg-orange-50 transition-all duration-300 font-semibold">
                                                <span class="flex items-center justify-center gap-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                                    </svg>
                                                    Tambah Keranjang
                                                </span>
                                            </button>
                                        </form>
                                        @else
                                        <a href="{{ route('login') }}"
                                            class="block w-full bg-gradient-to-r from-orange-500 to-amber-500 text-white py-3 rounded-xl hover:shadow-lg transition-all duration-300 font-bold text-center">
                                            <span class="flex items-center justify-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                                </svg>
                                                Login untuk Pesan
                                            </span>
                                        </a>
                                        @endauth

                                        <!-- WhatsApp -->
                                        <a href="https://wa.me/6282227110771?text=Halo%2C%20saya%20tertarik%20dengan%20{{ urlencode($menu->nama) }}"
                                            target="_blank"
                                            class="block w-full bg-white border-2 border-green-500 text-green-500 py-3 rounded-xl hover:bg-green-50 transition-all duration-300 font-semibold text-center">
                                            <span class="flex items-center justify-center gap-2 text-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                                                </svg>
                                                Konsultasi WA
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Desktop: Grid Layout -->
            <div class="hidden md:grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($menus as $menu)
                <div class="bg-white/90 backdrop-blur-sm rounded-xl shadow-lg overflow-hidden hover:bg-white transition-all duration-300 hover:shadow-xl">
                    <div class="relative">
                        @if($menu->gambar)
                        @php
                            $menuImage = \Illuminate\Support\Str::startsWith($menu->gambar, ['foto/', 'http://', 'https://'])
                                ? $menu->gambar
                                : 'foto/' . ltrim($menu->gambar, '/');
                        @endphp
                        <img src="{{ asset($menuImage) }}" alt="{{ $menu->nama }}" class="w-full h-56 sm:h-64 md:h-72 object-contain bg-gray-50 p-2" onerror="this.onerror=null;this.src='{{ asset('foto/buffet.jpg') }}';">
                        @else
                        <img src="{{ asset('foto/buffet.jpg') }}" alt="{{ $menu->nama }}" class="w-full h-56 sm:h-64 md:h-72 object-contain bg-gray-50 p-2" onerror="this.style.display='none';">
                        @endif
                        <div class="absolute top-4 right-4 bg-white text-[#86765a] px-4 py-1 rounded-full font-semibold">
                            Rp {{ number_format($menu->harga, 0, ',', '.') }}/pax
                        </div>
                    </div>
                    <div class="p-6 flex flex-col">
                        <div class="flex-grow">
                            <h3 class="text-xl font-bold text-gray-900 mb-4">{{ $menu->nama }}</h3>
                            <div class="space-y-4 mb-6">
                                <div class="bg-orange-50 p-4 rounded-lg">
                                    <p class="text-sm text-gray-700 leading-relaxed whitespace-pre-line">{{ $menu->deskripsi }}</p>
                                </div>
                                <div class="flex items-center text-gray-600 text-sm">
                                    <svg class="w-5 h-5 mr-2 text-[#86765a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    <span>Minimum Order: {{ $menu->min_order }} Porsi</span>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-3 mt-4">
                            @auth
                            <!-- Pesan Sekarang -->
                            <a href="{{ route('checkout.show') }}?package=buffet&name={{ urlencode($menu->nama) }}&price={{ $menu->harga }}&min={{ $menu->min_order }}"
                                class="w-full block bg-gradient-to-r from-orange-500 to-amber-500 text-white py-3 rounded-lg hover:shadow-lg transition-all duration-300 font-bold text-center">
                                <span class="flex items-center justify-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Pesan Sekarang
                                </span>
                            </a>

                            <!-- Tambah ke Keranjang -->
                            <form action="{{ route('cart.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                <input type="hidden" name="package_name" value="{{ $menu->nama }}">
                                <input type="hidden" name="price" value="{{ $menu->harga }}">
                                <input type="hidden" name="quantity" value="{{ $menu->min_order }}">
                                <button type="submit"
                                    class="w-full bg-white border-2 border-orange-500 text-orange-500 py-3 rounded-lg hover:bg-orange-50 transition-all duration-300 font-semibold">
                                    <span class="flex items-center justify-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        Tambah Keranjang
                                    </span>
                                </button>
                            </form>
                            @else
                            <a href="{{ route('login') }}"
                                class="w-full block bg-gradient-to-r from-orange-500 to-amber-500 text-white py-3 rounded-lg hover:shadow-lg transition-all duration-300 font-bold text-center">
                                <span class="flex items-center justify-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                    </svg>
                                    Login untuk Pesan
                                </span>
                            </a>
                            @endauth

                            <a href="https://wa.me/6282227110771?text=Halo%2C%20saya%20tertarik%20dengan%20{{ urlencode($menu->nama) }}"
                                target="_blank"
                                class="w-full block bg-white border-2 border-green-500 text-green-500 py-3 rounded-lg hover:bg-green-50 transition-all duration-300 font-semibold text-center">
                                <span class="flex items-center justify-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                                    </svg>
                                    Konsultasi via WhatsApp
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>

@if (session('success'))
<div class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50"
    x-data="{ show: true }"
    x-show="show"
    x-init="setTimeout(() => show = false, 3000)">
    {{ session('success') }}
</div>
@endif

@if (session('error'))
<div class="fixed bottom-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50"
    x-data="{ show: true }"
    x-show="show"
    x-init="setTimeout(() => show = false, 3000)">
    {{ session('error') }}
</div>
@endif

@if ($errors->any())
<div class="fixed bottom-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 max-w-md"
    x-data="{ show: true }"
    x-show="show"
    x-init="setTimeout(() => show = false, 5000)">
    <ul class="text-sm">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@endsection