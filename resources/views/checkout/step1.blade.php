@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-orange-50 via-white to-amber-50 py-8 md:py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Progress Indicator -->
        <x-checkout.progress-bar :current-step="1" />

        <!-- Package Info Card atau Cart Summary -->
        @if($fromCart ?? false)
        <!-- Cart Summary -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-orange-200 mb-6">
            <div class="bg-gradient-to-r from-orange-500 to-amber-500 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="bg-white/20 backdrop-blur-sm p-2 rounded-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-white text-lg font-bold">Ringkasan Pesanan</h3>
                            <p class="text-orange-100 text-sm">{{ count($cartItems) }} menu</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <div class="space-y-3 mb-4">
                    @foreach($cartItems as $item)
                    <div class="bg-gradient-to-r from-orange-50 to-amber-50 p-4 rounded-xl border border-orange-100">
                        <div class="flex gap-3">
                            @if(isset($item['image']) && $item['image'])
                            <div class="w-16 h-16 rounded-lg overflow-hidden flex-shrink-0">
                                <img src="{{ asset('foto/' . $item['image']) }}" alt="{{ $item['name'] }}" class="w-full h-full object-contain bg-white p-1">
                            </div>
                            @endif
                            <div class="flex-1">
                                <div class="flex justify-between items-start mb-2">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2 mb-1">
                                            <svg class="w-4 h-4 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                                <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                                            </svg>
                                            <p class="font-bold text-gray-900">{{ $item['name'] }}</p>
                                        </div>
                                        <div class="flex items-center gap-4 text-sm">
                                            <span class="text-gray-600">{{ $item['quantity'] }} porsi</span>
                                            <span class="text-gray-400">×</span>
                                            <span class="text-orange-600 font-semibold">Rp {{ number_format($item['price'], 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-xl font-bold text-orange-600">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="bg-gradient-to-br from-orange-100 to-amber-100 rounded-xl p-5 border-2 border-orange-200">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Total Pembayaran</p>
                            <p class="text-lg font-bold text-gray-900">{{ collect($cartItems)->sum('quantity') }} porsi</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-600 mb-1">Grand Total</p>
                            <p class="text-3xl font-bold bg-gradient-to-r from-orange-600 to-amber-600 bg-clip-text text-transparent">
                                Rp {{ number_format(collect($cartItems)->sum(function($item) {
                                    return $item['price'] * $item['quantity'];
                                }), 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <!-- Single Package Card -->
        <x-checkout.package-card :name="$name" :price="$price" :min-order="$minOrder" :image="$image ?? null" />
        @endif

        <!-- Form Step 1 -->
        <form action="{{ route('checkout.step1.store') }}" method="POST">
            @csrf
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden border border-orange-100">
                <!-- Header dengan Gradient -->
                <x-checkout.form-header
                    title="Data Diri & Alamat"
                    subtitle="Langkah 1 dari 3 - Informasi Kontak"
                    icon="user" />

                <!-- Form Content -->
                <div class="p-6 md:p-8">
                    <!-- Informasi Pribadi Section -->
                    @include('checkout.partials.personal-info')

                    <!-- Divider -->
                    <div class="relative my-8">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t-2 border-gray-200"></div>
                        </div>
                        <div class="relative flex justify-center">
                            <span class="px-4 bg-white text-sm font-medium text-gray-500">Alamat Pengiriman</span>
                        </div>
                    </div>

                    <!-- Alamat Section -->
                    @include('checkout.partials.address-info')
                </div>

                <!-- Footer dengan Action Button -->
                <div class="bg-gradient-to-br from-gray-50 to-orange-50 px-8 py-6 border-t-2 border-orange-100">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            <span class="font-medium">Data Anda aman dan terenkripsi</span>
                        </div>
                        <button type="submit"
                            class="group inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-orange-500 to-amber-500 text-white rounded-xl hover:from-orange-600 hover:to-amber-600 focus:outline-none focus:ring-4 focus:ring-orange-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 font-semibold">
                            <span>Lanjutkan ke Detail Acara</span>
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>
@endsection