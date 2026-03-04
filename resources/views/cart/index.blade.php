@extends('layouts.app')

@section('content')
<div class="min-h-screen py-8 bg-gradient-to-br from-orange-50 via-white to-orange-50 sm:py-12">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex flex-col items-start justify-between gap-4 sm:flex-row sm:items-center">
                <div class="flex items-center">
                    <div class="flex items-center justify-center w-12 h-12 mr-3 rounded-full bg-gradient-to-r from-orange-500 to-orange-600">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900 sm:text-3xl">Keranjang Belanja</h1>
                        <p class="mt-1 text-sm text-gray-600">Kelola pesanan Anda sebelum checkout</p>
                    </div>
                </div>
                @if(count($cartItems) > 0)
                <form action="{{ route('cart.clear') }}" method="POST" onsubmit="return confirm('Yakin ingin mengosongkan keranjang?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-4 py-2 text-sm font-medium text-red-600 transition-all duration-200 bg-red-50 rounded-lg hover:bg-red-100">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Kosongkan Keranjang
                    </button>
                </form>
                @endif
            </div>
        </div>

        @if(count($cartItems) > 0)
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <!-- Cart Items -->
            <div class="space-y-4 lg:col-span-2">
                @foreach($cartItems as $item)
                <div class="overflow-hidden transition-all duration-300 bg-white shadow-md hover:shadow-lg rounded-xl">
                    <div class="p-6">
                        <div class="flex flex-col gap-4 sm:flex-row sm:items-center">
                            <!-- Item Image/Icon -->
                            <div class="flex-shrink-0">
                                @if(isset($item['image']) && $item['image'])
                                <div class="w-20 h-20 overflow-hidden rounded-lg shadow-md">
                                    <img src="{{ asset('foto/' . $item['image']) }}" alt="{{ $item['name'] }}" class="object-cover w-full h-full">
                                </div>
                                @else
                                <div class="flex items-center justify-center w-20 h-20 rounded-lg bg-gradient-to-br from-orange-100 to-orange-200">
                                    <svg class="w-10 h-10 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                                    </svg>
                                </div>
                                @endif
                            </div>

                            <!-- Item Details -->
                            <div class="flex-1 min-w-0">
                                <h3 class="text-lg font-semibold text-gray-900">{{ $item['name'] }}</h3>
                                <p class="mt-1 text-sm text-gray-500">
                                    <span class="font-medium text-orange-600">Rp {{ number_format($item['price'], 0, ',', '.') }}</span>
                                    <span class="text-gray-400">/porsi</span>
                                </p>
                                @php
                                    $minOrder = $item['min_order'] ?? 50;
                                @endphp
                                <p class="mt-1 text-xs text-gray-400">Min. pemesanan {{ $minOrder }} porsi</p>
                            </div>

                            <!-- Quantity & Actions -->
                            <div class="flex flex-col gap-3 sm:items-end">
                                <form action="{{ route('cart.update', $item['id']) }}" method="POST" class="flex items-center gap-2">
                                    @csrf
                                    @method('PATCH')
                                    <div class="flex items-center overflow-hidden bg-white border border-gray-300 rounded-lg">
                                        <input type="number" 
                                            name="quantity" 
                                            value="{{ $item['quantity'] }}" 
                                            min="{{ $minOrder }}" 
                                            step="{{ max(1, floor($minOrder / 10)) }}"
                                            class="w-24 px-3 py-2 text-center border-0 focus:ring-0 focus:outline-none">
                                        <span class="pr-3 text-sm text-gray-500">porsi</span>
                                    </div>
                                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white transition-all duration-200 bg-orange-500 rounded-lg hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                                        Update
                                    </button>
                                </form>

                                <div class="flex items-center gap-3">
                                    <p class="text-sm font-medium text-gray-900">
                                        Subtotal: <span class="text-lg text-orange-600">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</span>
                                    </p>
                                    <form action="{{ route('cart.destroy', $item['id']) }}" method="POST" onsubmit="return confirm('Hapus item ini dari keranjang?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-red-600 transition-colors rounded-lg hover:bg-red-50">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="sticky top-24">
                    <div class="overflow-hidden bg-white shadow-lg rounded-xl">
                        <!-- Header -->
                        <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-orange-50 to-orange-100">
                            <h2 class="text-lg font-semibold text-gray-900">Ringkasan Pesanan</h2>
                        </div>

                        <!-- Content -->
                        <div class="p-6 space-y-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Total Item</span>
                                <span class="font-medium text-gray-900">{{ count($cartItems) }} menu</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Total Porsi</span>
                                <span class="font-medium text-gray-900">{{ collect($cartItems)->sum('quantity') }} porsi</span>
                            </div>
                            <div class="pt-4 border-t border-gray-200">
                                <div class="flex justify-between">
                                    <span class="text-base font-semibold text-gray-900">Total</span>
                                    <span class="text-2xl font-bold text-orange-600">
                                        Rp {{ number_format(collect($cartItems)->sum(function($item) {
                                            return $item['price'] * $item['quantity'];
                                        }), 0, ',', '.') }}
                                    </span>
                                </div>
                                <p class="mt-2 text-xs text-gray-500">
                                    <svg class="inline w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Biaya pengiriman dihitung saat checkout
                                </p>
                            </div>
                        </div>

                        <!-- Footer Actions -->
                        <div class="p-6 space-y-3 border-t border-gray-200 bg-gray-50">
                            <a href="{{ route('checkout.from-cart') }}"
                                class="flex items-center justify-center w-full px-6 py-3 text-base font-medium text-white transition-all duration-200 rounded-lg shadow-md bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                </svg>
                                Lanjut ke Pembayaran
                            </a>
                            <a href="{{ route('home') }}" 
                                class="flex items-center justify-center w-full px-6 py-3 text-base font-medium text-orange-600 transition-all duration-200 bg-white border-2 border-orange-200 rounded-lg hover:bg-orange-50">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Lanjut Belanja
                            </a>
                        </div>
                    </div>

                    <!-- Trust Badges -->
                    <div class="p-4 mt-4 bg-white shadow-md rounded-xl">
                        <div class="space-y-3 text-sm">
                            <div class="flex items-center text-gray-600">
                                <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                Pembayaran Aman
                            </div>
                            <div class="flex items-center text-gray-600">
                                <svg class="w-5 h-5 mr-2 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                                </svg>
                                Layanan Pelanggan 24/7
                            </div>
                            <div class="flex items-center text-gray-600">
                                <svg class="w-5 h-5 mr-2 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                                    <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z" />
                                </svg>
                                Pengiriman Tepat Waktu
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <!-- Empty Cart State -->
        <div class="py-12 text-center bg-white shadow-lg rounded-xl sm:py-16">
            <div class="max-w-md mx-auto">
                <div class="flex items-center justify-center w-24 h-24 mx-auto mb-6 rounded-full bg-gradient-to-br from-orange-100 to-orange-200">
                    <svg class="w-12 h-12 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <h3 class="mb-2 text-2xl font-bold text-gray-900">Keranjang Kosong</h3>
                <p class="mb-8 text-gray-600">Belum ada menu yang ditambahkan. Mulai belanja dan temukan menu catering terbaik kami!</p>
                <a href="{{ route('home') }}" 
                    class="inline-flex items-center px-8 py-3 text-base font-medium text-white transition-all duration-200 rounded-lg shadow-md bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Jelajahi Menu
                </a>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
