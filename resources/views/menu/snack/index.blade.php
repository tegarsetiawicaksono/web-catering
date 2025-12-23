@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 pt-24">
    <!-- Hero Section -->
    <div class="relative h-[300px] overflow-hidden">
        <img src="{{ asset('foto/buffet.jpg') }}" alt="Snack Box" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/60"></div>
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Menu Snack Box</h1>
                <p class="text-lg text-white/90">Aneka snack untuk melengkapi acara anda</p>
            </div>
        </div>
    </div>

    <!-- Menu Categories -->
    <div class="container mx-auto px-4 py-12">
        <!-- Snack Box Premium -->
        <div class="mb-16">
            <h2 class="text-3xl font-bold text-[#86765a] mb-8">Snack Box Premium</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="relative h-48">
                        <img src="{{ asset('foto/rejosari.jpg') }}" alt="Snack Box Premium" class="w-full h-full object-cover">
                        <div class="absolute top-4 right-4 bg-[#86765a] text-white px-4 py-1 rounded-full">
                            Rp 25.000/box
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-4">Premium Box A</h3>
                        <div class="space-y-4">
                            <div>
                                <h4 class="font-medium text-[#86765a] mb-2">Isi Box</h4>
                                <ul class="list-disc list-inside text-gray-600 space-y-1">
                                    <li>Roti Croissant</li>
                                    <li>Lumpia</li>
                                    <li>Risoles</li>
                                    <li>Kue Sus</li>
                                    <li>Puding</li>
                                    <li>Air Mineral</li>
                                </ul>
                            </div>
                        </div>
                        <div class="mt-6 space-y-3">
                            <!-- Primary Action -->
                            <a href="/checkout/direct?package=snack-premium-a&name=Snack Box Premium A&price=25000&min=50"
                               class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white h-[48px] rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-300 font-medium flex items-center justify-center space-x-2 shadow-lg hover:shadow-blue-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-sm whitespace-nowrap">Pesan Sekarang</span>
                            </a>

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
                                            this.cartStore.add('snack-premium-a', 'Snack Box Premium A', this.price, this.quantity);
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
                                                                <img src="{{ asset('foto/rejosari.jpg') }}" alt="Snack Box Premium A" class="w-20 h-20 object-cover rounded-lg">
                                                                <div>
                                                                    <h4 class="font-semibold text-gray-900">Snack Box Premium A</h4>
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
                                                                <input type="hidden" name="menu_id" value="snack-premium-a">
                                                                <input type="hidden" name="package_name" value="Snack Box Premium A">
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
                                        <span class="text-sm whitespace-nowrap">Login untuk + Keranjang</span>
                                    </a>
                                @endauth
                                
                                <a href="https://wa.me/6282227110771?text=Halo%2C%20saya%20tertarik%20dengan%20Snack%20Box%20Premium%20A.%20Mohon%20konsultasi%20mengenai:%0A-%20Jumlah%20box%20yang%20sesuai%0A-%20Menu%20yang%20recommended%0A-%20Ketersediaan%20untuk%20tanggal%20yang%20saya%20inginkan" 
                                   target="_blank"
                                   class="w-full h-[48px] flex items-center justify-center space-x-2 bg-white border-2 border-green-500 text-green-500 rounded-lg hover:bg-green-50 transition-all duration-300 font-medium px-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                                    </svg>
                                    <span class="text-sm whitespace-nowrap">Konsultasi</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="relative h-48">
                        <img src="{{ asset('foto/rejosari.jpg') }}" alt="Snack Box Premium B" class="w-full h-full object-cover">
                        <div class="absolute top-4 right-4 bg-[#86765a] text-white px-4 py-1 rounded-full">
                            Rp 25.000/box
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-4">Premium Box B</h3>
                        <div class="space-y-4">
                            <div>
                                <h4 class="font-medium text-[#86765a] mb-2">Isi Box</h4>
                                <ul class="list-disc list-inside text-gray-600 space-y-1">
                                    <li>Mini Burger</li>
                                    <li>Spring Roll</li>
                                    <li>Sosis Solo</li>
                                    <li>Pie Buah</li>
                                    <li>Brownies</li>
                                    <li>Air Mineral</li>
                                </ul>
                            </div>
                        </div>
                        <div class="mt-6 space-y-3">
                            <!-- Primary Action -->
                            <a href="/checkout/direct?package=snack-premium-b&name=Snack Box Premium B&price=30000&min=50"
                               class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white h-[48px] rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-300 font-medium flex items-center justify-center space-x-2 shadow-lg hover:shadow-blue-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-sm whitespace-nowrap">Pesan Sekarang</span>
                            </a>

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
                                            this.cartStore.add('snack-premium-b', 'Snack Box Premium B', this.price, this.quantity);
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
                                                                <img src="{{ asset('foto/rejosari.jpg') }}" alt="Snack Box Premium B" class="w-20 h-20 object-cover rounded-lg">
                                                                <div>
                                                                    <h4 class="font-semibold text-gray-900">Snack Box Premium B</h4>
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
                                                                <input type="hidden" name="menu_id" value="snack-premium-b">
                                                                <input type="hidden" name="package_name" value="Snack Box Premium B">
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
                                        <span class="text-sm whitespace-nowrap">Login untuk + Keranjang</span>
                                    </a>
                                @endauth
                                
                                <a href="https://wa.me/6282227110771?text=Halo%2C%20saya%20tertarik%20dengan%20Snack%20Box%20Premium%20B.%20Mohon%20konsultasi%20mengenai:%0A-%20Jumlah%20box%20yang%20sesuai%0A-%20Menu%20yang%20recommended%0A-%20Ketersediaan%20untuk%20tanggal%20yang%20saya%20inginkan" 
                                   target="_blank"
                                   class="w-full h-[48px] flex items-center justify-center space-x-2 bg-white border-2 border-green-500 text-green-500 rounded-lg hover:bg-green-50 transition-all duration-300 font-medium px-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                                    </svg>
                                    <span class="text-sm whitespace-nowrap">Konsultasi</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Snack Box Standard -->
        <div class="mb-16">
            <h2 class="text-3xl font-bold text-[#86765a] mb-8">Snack Box Standard</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="relative h-48">
                        <img src="{{ asset('foto/rejosari.jpg') }}" alt="Snack Box Standard" class="w-full h-full object-cover">
                        <div class="absolute top-4 right-4 bg-[#86765a] text-white px-4 py-1 rounded-full">
                            Rp 15.000/box
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-4">Standard Box A</h3>
                        <div class="space-y-4">
                            <div>
                                <h4 class="font-medium text-[#86765a] mb-2">Isi Box</h4>
                                <ul class="list-disc list-inside text-gray-600 space-y-1">
                                    <li>Roti</li>
                                    <li>Kue Sus</li>
                                    <li>Risoles</li>
                                    <li>Air Mineral</li>
                                </ul>
                            </div>
                        </div>
                        <div class="mt-6 space-y-3">
                            <!-- Primary Action -->
                            <a href="/checkout/direct?package=snack-standard-a&name=Snack Box Standard A&price=15000&min=50"
                               class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white h-[48px] rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-300 font-medium flex items-center justify-center space-x-2 shadow-lg hover:shadow-blue-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-sm whitespace-nowrap">Pesan Sekarang</span>
                            </a>

                            <!-- Secondary Actions -->
                            <div class="grid grid-cols-2 gap-3">
                                @auth
                                    <div x-data="{ 
                                        showModal: false,
                                        quantity: 50,
                                        basePrice: 15000,
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
                                            this.cartStore.add('snack-standard-a', 'Snack Box Standard A', this.price, this.quantity);
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
                                                                <img src="{{ asset('foto/rejosari.jpg') }}" alt="Snack Box Standard A" class="w-20 h-20 object-cover rounded-lg">
                                                                <div>
                                                                    <h4 class="font-semibold text-gray-900">Snack Box Standard A</h4>
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
                                                                <input type="hidden" name="menu_id" value="snack-standard-a">
                                                                <input type="hidden" name="package_name" value="Snack Box Standard A">
                                                                <input type="hidden" name="price" value="15000">
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
                                
                                <a href="https://wa.me/6282227110771?text=Halo%2C%20saya%20tertarik%20dengan%20Snack%20Box%20Standard%20A.%20Mohon%20konsultasi%20mengenai:%0A-%20Jumlah%20box%20yang%20sesuai%0A-%20Menu%20yang%20recommended%0A-%20Ketersediaan%20untuk%20tanggal%20yang%20saya%20inginkan" 
                                   target="_blank"
                                   class="w-full h-[48px] flex items-center justify-center space-x-2 bg-white border-2 border-green-500 text-green-500 rounded-lg hover:bg-green-50 transition-all duration-300 font-medium px-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
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
        <div class="bg-white rounded-lg shadow-lg p-8">
            <h2 class="text-2xl font-bold text-[#86765a] mb-4">Informasi Penting</h2>
            <ul class="list-disc list-inside space-y-2 text-gray-600">
                <li>Minimal pemesanan 50 box</li>
                <li>Pemesanan minimal H-3 sebelum acara</li>
                <li>DP 50% saat pemesanan</li>
                <li>Free delivery untuk area Weleri (min. 100 box)</li>
                <li>Menu dapat disesuaikan dengan kebutuhan</li>
            </ul>
        </div>
    </div>
</div>
@endsection