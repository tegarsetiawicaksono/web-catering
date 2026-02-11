@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 pt-16">
    <!-- Header Section -->
    <div class="bg-[#86765a] text-white py-16">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl font-bold mb-4">Nasi Box</h1>
            <p class="text-lg opacity-90">Pilihan praktis untuk acara dan kegiatan Anda</p>
        </div>
    </div>

    <!-- Packages Grid -->
    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Paket Ekonomis -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="relative">
                    <img src="{{ asset('foto/nasibox.jpg') }}" alt="Paket Ekonomis" class="w-full h-48 object-cover">
                    <div class="absolute top-4 right-4 bg-white text-[#86765a] px-4 py-1 rounded-full font-semibold">
                        Rp 20.000/box
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Paket Ekonomis</h3>
                    <p class="text-gray-600 mb-4">Menu sederhana dan lezat</p>
                    <div class="space-y-4">
                        <div>
                            <h4 class="font-medium text-[#86765a]">Menu</h4>
                            <ul class="mt-2 space-y-1 text-gray-600">
                                <li>• Nasi Putih</li>
                                <li>• Ayam Goreng/Bakar</li>
                                <li>• Mie Goreng</li>
                                <li>• Sayur Acar</li>
                                <li>• Sambal</li>
                            </ul>
                        </div>
                    </div>
                    <div class="mt-6 space-y-3">
                        <!-- Primary Action -->
                        @auth
                        <a href="/checkout/direct?package=nasibox-ekonomis&name=Nasi Box Ekonomis&price=20000&min=50"
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
                                    quantity: 50,
                                    basePrice: 20000,
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
                                        this.cartStore.add('nasibox-ekonomis', 'Nasi Box Ekonomis', this.price, this.quantity);
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
                                    <span class="text-xs whitespace-nowrap">Keranjang</span>
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
                                                        <img src="{{ asset('foto/nasibox.jpg') }}" alt="Nasi Box Ekonomis" class="w-20 h-20 object-cover rounded-lg">
                                                        <div>
                                                            <h4 class="font-semibold text-gray-900">Nasi Box Ekonomis</h4>
                                                            <p class="text-gray-600">Menu sederhana dan lezat</p>
                                                            <div class="space-y-1">
                                                                <p class="text-gray-600" x-text="formatPrice(basePrice) + '/box'"></p>
                                                                <p class="text-sm text-gray-500">Minimal pemesanan 50 box</p>
                                                                <template x-if="discount">
                                                                    <p class="text-sm text-green-600 font-medium">
                                                                        Diskon Rp 5.000/box untuk pemesanan 300+ box
                                                                    </p>
                                                                </template>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Quantity Input -->
                                                    <div class="flex items-center justify-between border-t border-b border-gray-200 py-4">
                                                        <span class="text-gray-700">Jumlah Box</span>
                                                        <div class="flex items-center space-x-3">
                                                            <button @click="quantity = Math.max(50, quantity - 10)"
                                                                type="button"
                                                                class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-full text-gray-600 hover:bg-gray-100">
                                                                -
                                                            </button>
                                                            <input type="number"
                                                                x-model.number="quantity"
                                                                min="50"
                                                                class="w-24 text-center border-gray-300 rounded-md focus:border-orange-500 focus:ring-orange-500"
                                                                @keypress="$event.key === 'Enter' && $event.preventDefault()"
                                                                @blur="quantity = quantity < 50 ? 50 : quantity">
                                                            <button @click="quantity = quantity + 10"
                                                                type="button"
                                                                class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-full text-gray-600 hover:bg-gray-100">
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
                                                        <input type="hidden" name="menu_id" value="nasibox-ekonomis">
                                                        <input type="hidden" name="package_name" value="Nasi Box Ekonomis">
                                                        <input type="hidden" name="price" value="20000">
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
                                <span class="text-xs whitespace-nowrap">Login</span>
                            </a>
                            @endauth

                            <a href="https://wa.me/6282227110771?text=Halo%2C%20saya%20tertarik%20dengan%20Nasi%20Box%20Ekonomis.%20Mohon%20konsultasi%20mengenai:%0A-%20Jumlah%20box%20yang%20sesuai%0A-%20Menu%20yang%20recommended%0A-%20Ketersediaan%20untuk%20tanggal%20yang%20saya%20inginkan"
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

            <!-- Paket Regular -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="relative">
                    <img src="{{ asset('foto/nasibox.jpg') }}" alt="Paket Regular" class="w-full h-48 object-cover">
                    <div class="absolute top-4 right-4 bg-white text-[#86765a] px-4 py-1 rounded-full font-semibold">
                        Rp 25.000/box
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Paket Regular</h3>
                    <p class="text-gray-600 mb-4">Menu lengkap dengan tambahan lauk</p>
                    <div class="space-y-4">
                        <div>
                            <h4 class="font-medium text-[#86765a]">Menu</h4>
                            <ul class="mt-2 space-y-1 text-gray-600">
                                <li>• Nasi Putih</li>
                                <li>• Ayam Goreng/Bakar</li>
                                <li>• Telur Balado</li>
                                <li>• Mie Goreng</li>
                                <li>• Capcay</li>
                                <li>• Sambal</li>
                            </ul>
                        </div>
                    </div>
                    <div class="mt-6 space-y-3">
                        <!-- Primary Action -->
                        @auth
                        <a href="/checkout/direct?package=nasibox-regular&name=Nasi Box Regular&price=25000&min=50"
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
                                    quantity: 50,
                                    basePrice: 25000,
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
                                        this.cartStore.add('nasibox-regular', 'Nasi Box Regular', this.price, this.quantity);
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
                                    <span class="text-xs whitespace-nowrap">Keranjang</span>
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
                                                        <img src="{{ asset('foto/nasibox.jpg') }}" alt="Nasi Box Regular" class="w-20 h-20 object-cover rounded-lg">
                                                        <div>
                                                            <h4 class="font-semibold text-gray-900">Nasi Box Regular</h4>
                                                            <p class="text-gray-600">Menu lengkap dengan tambahan lauk</p>
                                                            <div class="space-y-1">
                                                                <p class="text-gray-600" x-text="formatPrice(basePrice) + '/box'"></p>
                                                                <p class="text-sm text-gray-500">Minimal pemesanan 50 box</p>
                                                                <template x-if="discount">
                                                                    <p class="text-sm text-green-600 font-medium">
                                                                        Diskon Rp 5.000/box untuk pemesanan 300+ box
                                                                    </p>
                                                                </template>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Quantity Input -->
                                                    <div class="flex items-center justify-between border-t border-b border-gray-200 py-4">
                                                        <span class="text-gray-700">Jumlah Box</span>
                                                        <div class="flex items-center space-x-3">
                                                            <button @click="quantity = Math.max(50, quantity - 10)"
                                                                type="button"
                                                                class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-full text-gray-600 hover:bg-gray-100">
                                                                -
                                                            </button>
                                                            <input type="number"
                                                                x-model.number="quantity"
                                                                min="50"
                                                                class="w-24 text-center border-gray-300 rounded-md focus:border-orange-500 focus:ring-orange-500"
                                                                @keypress="$event.key === 'Enter' && $event.preventDefault()"
                                                                @blur="quantity = quantity < 50 ? 50 : quantity">
                                                            <button @click="quantity = quantity + 10"
                                                                type="button"
                                                                class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-full text-gray-600 hover:bg-gray-100">
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
                                                        <input type="hidden" name="menu_id" value="nasibox-regular">
                                                        <input type="hidden" name="package_name" value="Nasi Box Regular">
                                                        <input type="hidden" name="price" value="25000">
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
                                <span class="text-xs whitespace-nowrap">Login</span>
                            </a>
                            @endauth

                            <a href="https://wa.me/6282227110771?text=Halo%2C%20saya%20tertarik%20dengan%20Nasi%20Box%20Regular.%20Mohon%20konsultasi%20mengenai:%0A-%20Jumlah%20box%20yang%20sesuai%0A-%20Menu%20yang%20recommended%0A-%20Ketersediaan%20untuk%20tanggal%20yang%20saya%20inginkan"
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

            <!-- Paket Premium -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="relative">
                    <img src="{{ asset('foto/nasibox.jpg') }}" alt="Paket Premium" class="w-full h-48 object-cover">
                    <div class="absolute top-4 right-4 bg-white text-[#86765a] px-4 py-1 rounded-full font-semibold">
                        Rp 35.000/box
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Paket Premium</h3>
                    <p class="text-gray-600 mb-4">Menu spesial dengan lauk premium</p>
                    <div class="space-y-4">
                        <div>
                            <h4 class="font-medium text-[#86765a]">Menu</h4>
                            <ul class="mt-2 space-y-1 text-gray-600">
                                <li>• Nasi Putih/Goreng</li>
                                <li>• Ayam Bakar Madu</li>
                                <li>• Rendang Sapi</li>
                                <li>• Mie Goreng Seafood</li>
                                <li>• Capcay Seafood</li>
                                <li>• Sambal</li>
                                <li>• Buah Potong</li>
                            </ul>
                        </div>
                    </div>
                    <div class="mt-6 space-y-3">
                        <!-- Primary Action -->
                        @auth
                        <a href="/checkout/direct?package=nasibox-premium&name=Nasi Box Premium&price=35000&min=50"
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
                                    quantity: 50,
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
                                        this.cartStore.add('nasibox-premium', 'Nasi Box Premium', this.price, this.quantity);
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
                                    <span class="text-xs whitespace-nowrap">Keranjang</span>
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
                                                        <img src="{{ asset('foto/nasibox.jpg') }}" alt="Nasi Box Premium" class="w-20 h-20 object-cover rounded-lg">
                                                        <div>
                                                            <h4 class="font-semibold text-gray-900">Nasi Box Premium</h4>
                                                            <p class="text-gray-600">Menu spesial dengan lauk premium</p>
                                                            <div class="space-y-1">
                                                                <p class="text-gray-600" x-text="formatPrice(basePrice) + '/box'"></p>
                                                                <p class="text-sm text-gray-500">Minimal pemesanan 50 box</p>
                                                                <template x-if="discount">
                                                                    <p class="text-sm text-green-600 font-medium">
                                                                        Diskon Rp 5.000/box untuk pemesanan 300+ box
                                                                    </p>
                                                                </template>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Quantity Input -->
                                                    <div class="flex items-center justify-between border-t border-b border-gray-200 py-4">
                                                        <span class="text-gray-700">Jumlah Box</span>
                                                        <div class="flex items-center space-x-3">
                                                            <button @click="quantity = Math.max(50, quantity - 10)"
                                                                type="button"
                                                                class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-full text-gray-600 hover:bg-gray-100">
                                                                -
                                                            </button>
                                                            <input type="number"
                                                                x-model.number="quantity"
                                                                min="50"
                                                                class="w-24 text-center border-gray-300 rounded-md focus:border-orange-500 focus:ring-orange-500"
                                                                @keypress="$event.key === 'Enter' && $event.preventDefault()"
                                                                @blur="quantity = quantity < 50 ? 50 : quantity">
                                                            <button @click="quantity = quantity + 10"
                                                                type="button"
                                                                class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-full text-gray-600 hover:bg-gray-100">
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
                                                        <input type="hidden" name="menu_id" value="nasibox-premium">
                                                        <input type="hidden" name="package_name" value="Nasi Box Premium">
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
                                <span class="text-xs whitespace-nowrap">Login</span>
                            </a>
                            @endauth

                            <a href="https://wa.me/6282227110771?text=Halo%2C%20saya%20tertarik%20dengan%20Nasi%20Box%20Premium.%20Mohon%20konsultasi%20mengenai:%0A-%20Jumlah%20box%20yang%20sesuai%0A-%20Menu%20yang%20recommended%0A-%20Ketersediaan%20untuk%20tanggal%20yang%20saya%20inginkan"
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
        </div>
    </div>

    <!-- Informasi Tambahan -->
    <div class="bg-white py-12">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl font-bold text-[#86765a] mb-6">Informasi Penting</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-gray-50 p-6 rounded-lg">
                    <h3 class="font-semibold text-lg mb-3">Minimal Pemesanan</h3>
                    <p class="text-gray-600">Minimal pemesanan 50 box untuk setiap paket</p>
                </div>
                <div class="bg-gray-50 p-6 rounded-lg">
                    <h3 class="font-semibold text-lg mb-3">Pengantaran</h3>
                    <p class="text-gray-600">Gratis pengantaran untuk area Surabaya (min. 100 box)</p>
                </div>
                <div class="bg-gray-50 p-6 rounded-lg">
                    <h3 class="font-semibold text-lg mb-3">Kemasan</h3>
                    <p class="text-gray-600">Menggunakan box yang aman dan higienis</p>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Cart functionality is now handled by Alpine.js store
</script>
@endpush

@endsection
