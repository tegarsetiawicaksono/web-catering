@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-playfair font-bold text-amber-800 mb-4">Es & Minuman</h1>
            <p class="text-lg font-montserrat text-gray-600">Aneka minuman segar untuk melengkapi acara spesial Anda</p>
        </div>

        <!-- Menu Categories -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            <!-- Es Buah -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden group hover:shadow-xl transition-all duration-300">
                <div class="relative">
                    <img src="{{ asset('foto/es.jpg') }}" alt="Es Buah" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-4 left-4">
                        <span class="px-3 py-1 bg-orange-500 text-white text-sm font-montserrat rounded-full">Favorit</span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="font-playfair text-xl font-bold text-amber-800 mb-2">Es Buah Spesial</h3>
                    <p class="text-gray-600 mb-4">Es buah dengan berbagai macam buah segar pilihan</p>
                    <div class="space-y-2 mb-4">
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-5 h-5 text-amber-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>5+ jenis buah segar</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-5 h-5 text-amber-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Sirup premium</span>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-lg font-semibold text-amber-800">Rp 12.000/porsi</span>
                        <button class="add-to-cart bg-orange-500 text-white px-4 py-2 rounded-full hover:bg-orange-600 transition-colors duration-300">
                            Pesan
                        </button>
                    </div>
                </div>
            </div>

            <!-- Es Campur -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden group hover:shadow-xl transition-all duration-300">
                <div class="relative">
                    <img src="{{ asset('foto/es.jpg') }}" alt="Es Campur" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                </div>
                <div class="p-6">
                    <h3 class="font-playfair text-xl font-bold text-amber-800 mb-2">Es Campur</h3>
                    <p class="text-gray-600 mb-4">Es campur dengan aneka topping lengkap</p>
                    <div class="space-y-2 mb-4">
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-5 h-5 text-amber-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>8+ jenis topping</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-5 h-5 text-amber-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Susu & kelapa muda</span>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-lg font-semibold text-amber-800">Rp 10.000/porsi</span>
                        <button class="add-to-cart bg-orange-500 text-white px-4 py-2 rounded-full hover:bg-orange-600 transition-colors duration-300">
                            Pesan
                        </button>
                    </div>
                </div>
            </div>

            <!-- Es Teler -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden group hover:shadow-xl transition-all duration-300">
                <div class="relative">
                    <img src="{{ asset('foto/es.jpg') }}" alt="Es Teler" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                </div>
                <div class="p-6">
                    <h3 class="font-playfair text-xl font-bold text-amber-800 mb-2">Es Teler</h3>
                    <p class="text-gray-600 mb-4">Es teler klasik dengan kelapa muda</p>
                    <div class="space-y-2 mb-4">
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-5 h-5 text-amber-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Alpukat & nangka</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-5 h-5 text-amber-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Santan segar</span>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-lg font-semibold text-amber-800">Rp 8.000/porsi</span>
                        <button class="add-to-cart bg-orange-500 text-white px-4 py-2 rounded-full hover:bg-orange-600 transition-colors duration-300">
                            Pesan
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informasi Tambahan -->
        <div class="bg-white/80 backdrop-blur-sm rounded-xl p-8 shadow-lg">
            <h2 class="text-2xl font-playfair font-bold text-amber-800 mb-6">Informasi Pemesanan</h2>
            <div class="grid md:grid-cols-2 gap-8">
                <div class="space-y-4">
                    <h3 class="font-playfair text-xl font-bold text-gray-800">Ketentuan Pemesanan:</h3>
                    <ul class="space-y-2">
                        <li class="flex items-center text-gray-600">
                            <svg class="w-5 h-5 text-amber-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Minimal pemesanan 50 porsi
                        </li>
                        <li class="flex items-center text-gray-600">
                            <svg class="w-5 h-5 text-amber-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Pemesanan H-3 sebelum acara
                        </li>
                        <li class="flex items-center text-gray-600">
                            <svg class="w-5 h-5 text-amber-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Free peralatan & dispenser
                        </li>
                    </ul>
                </div>
                <div class="space-y-4">
                    <h3 class="font-playfair text-xl font-bold text-gray-800">Layanan Tambahan:</h3>
                    <ul class="space-y-2">
                        <li class="flex items-center text-gray-600">
                            <svg class="w-5 h-5 text-amber-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Setup tempat & dekorasi
                        </li>
                        <li class="flex items-center text-gray-600">
                            <svg class="w-5 h-5 text-amber-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Staff profesional
                        </li>
                        <li class="flex items-center text-gray-600">
                            <svg class="w-5 h-5 text-amber-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Pengiriman tepat waktu
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection