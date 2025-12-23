@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-orange-50 via-white to-amber-50 py-8 md:py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Progress Indicator -->
        <x-checkout.progress-bar :current-step="3" />

        <!-- Package Info Card -->
        <div class="mb-8 bg-white rounded-2xl shadow-xl overflow-hidden border border-orange-200">
            <div class="bg-gradient-to-r from-orange-500 to-amber-500 px-6 py-4">
                <h2 class="text-xl md:text-2xl font-bold text-white">{{ $name }}</h2>
            </div>

            <!-- Gallery Images -->
            <div class="px-4 md:px-6 py-4">
                <div class="grid grid-cols-3 gap-2 md:gap-4">
                    <div class="relative group rounded-lg overflow-hidden aspect-square">
                        <img src="{{ asset('foto/rjsbackground.jpg') }}" alt="Menu 1" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-300">
                    </div>
                    <div class="relative group rounded-lg overflow-hidden aspect-square">
                        <img src="{{ asset('foto/buffet.jpg') }}" alt="Menu 2" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-300">
                    </div>
                    <div class="relative group rounded-lg overflow-hidden aspect-square">
                        <img src="{{ asset('foto/rjsbackground.jpg') }}" alt="Menu 3" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-300">
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="px-4 md:px-6 pb-6">
                <div class="bg-gradient-to-br from-orange-50 to-amber-50 rounded-xl p-6 border border-orange-200">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Ringkasan Pesanan</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center pb-3 border-b border-orange-200">
                            <span class="text-gray-600">Paket</span>
                            <span class="font-semibold text-gray-900">{{ $name }}</span>
                        </div>
                        <div class="flex justify-between items-center pb-3 border-b border-orange-200">
                            <span class="text-gray-600">Jumlah Porsi</span>
                            <span class="font-semibold text-gray-900">{{ $event['quantity'] }} porsi</span>
                        </div>
                        <div class="flex justify-between items-center pb-3 border-b border-orange-200">
                            <span class="text-gray-600">Harga per Porsi</span>
                            <span class="font-semibold text-gray-900">Rp {{ number_format($price, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center pb-3 border-b border-orange-200">
                            <span class="text-gray-600">Tanggal & Waktu</span>
                            <span class="font-semibold text-gray-900">{{ date('d M Y', strtotime($event['event_date'])) }} - {{ $event['event_time'] }}</span>
                        </div>
                        <div class="flex justify-between items-center pt-2">
                            <span class="text-lg font-bold text-gray-900">Total Harga</span>
                            <span class="text-2xl font-bold text-orange-600">Rp {{ number_format($event['quantity'] * $price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Step 3 -->
        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden border border-orange-100">
                <!-- Header dengan Gradient -->
                <x-checkout.form-header
                    title="Metode Pembayaran"
                    subtitle="Langkah 3 dari 3 - Pilih Pembayaran"
                    icon="cash" />

                <!-- Form Content -->
                <div class="p-6 md:p-8">
                    <div class="flex items-center gap-2 mb-6">
                        <div class="w-1 h-6 bg-gradient-to-b from-orange-500 to-amber-500 rounded-full"></div>
                        <h3 class="text-lg font-semibold text-gray-800">Pilih Metode Pembayaran</h3>
                    </div>

                    <div class="space-y-4">
                        <!-- Transfer Bank -->
                        <label class="relative block cursor-pointer group">
                            <input type="radio" name="payment_method" value="transfer" class="peer sr-only" required>
                            <div class="p-6 border-2 border-gray-200 rounded-2xl peer-checked:border-green-500 peer-checked:bg-gradient-to-br peer-checked:from-green-50 peer-checked:to-emerald-50 transition-all duration-200 hover:border-green-300 hover:shadow-md">
                                <div class="flex items-center gap-4">
                                    <div class="relative flex items-center justify-center w-12 h-12 rounded-full border-2 border-gray-300 peer-checked:border-green-500 bg-white shadow-sm">
                                        <div class="w-6 h-6 rounded-full bg-green-500 opacity-0 peer-checked:opacity-100 transition-opacity flex items-center justify-center">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="text-lg font-bold text-gray-900">Transfer Bank</h4>
                                        <p class="text-sm text-gray-600 mt-1">Transfer melalui rekening bank pilihan Anda</p>
                                    </div>
                                    <div class="p-3 bg-gradient-to-br from-orange-100 to-amber-100 rounded-xl">
                                        <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </label>

                        <!-- E-Wallet -->
                        <label class="relative block cursor-pointer group">
                            <input type="radio" name="payment_method" value="ewallet" class="peer sr-only">
                            <div class="p-6 border-2 border-gray-200 rounded-2xl peer-checked:border-green-500 peer-checked:bg-gradient-to-br peer-checked:from-green-50 peer-checked:to-emerald-50 transition-all duration-200 hover:border-green-300 hover:shadow-md">
                                <div class="flex items-center gap-4">
                                    <div class="relative flex items-center justify-center w-12 h-12 rounded-full border-2 border-gray-300 peer-checked:border-green-500 bg-white shadow-sm">
                                        <div class="w-6 h-6 rounded-full bg-green-500 opacity-0 peer-checked:opacity-100 transition-opacity flex items-center justify-center">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="text-lg font-bold text-gray-900">E-Wallet</h4>
                                        <p class="text-sm text-gray-600 mt-1">Bayar dengan OVO, GoPay, Dana, atau ShopeePay</p>
                                    </div>
                                    <div class="p-3 bg-gradient-to-br from-blue-100 to-cyan-100 rounded-xl">
                                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </label>

                        <!-- Cash -->
                        <label class="relative block cursor-pointer group">
                            <input type="radio" name="payment_method" value="cash" class="peer sr-only">
                            <div class="p-6 border-2 border-gray-200 rounded-2xl peer-checked:border-green-500 peer-checked:bg-gradient-to-br peer-checked:from-green-50 peer-checked:to-emerald-50 transition-all duration-200 hover:border-green-300 hover:shadow-md">
                                <div class="flex items-center gap-4">
                                    <div class="relative flex items-center justify-center w-12 h-12 rounded-full border-2 border-gray-300 peer-checked:border-green-500 bg-white shadow-sm">
                                        <div class="w-6 h-6 rounded-full bg-green-500 opacity-0 peer-checked:opacity-100 transition-opacity flex items-center justify-center">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="text-lg font-bold text-gray-900">Tunai (COD)</h4>
                                        <p class="text-sm text-gray-600 mt-1">Bayar tunai saat pengiriman</p>
                                    </div>
                                    <div class="p-3 bg-gradient-to-br from-amber-100 to-orange-100 rounded-xl">
                                        <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </label>
                    </div>

                    @error('payment_method')
                    <p class="mt-3 text-sm text-red-600 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <!-- Footer dengan Navigation -->
                <div class="bg-gradient-to-br from-gray-50 to-green-50 px-8 py-6 border-t-2 border-green-100">
                    <div class="flex items-center justify-between">
                        <a href="{{ route('checkout.step2') }}"
                            class="group inline-flex items-center gap-3 px-6 py-3 bg-white border-2 border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 hover:border-gray-400 transition-all duration-200 shadow-md">
                            <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                            <span class="font-semibold">Kembali</span>
                        </a>
                        <button type="submit"
                            class="group inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-green-500 to-emerald-500 text-white rounded-xl hover:from-green-600 hover:to-emerald-600 focus:outline-none focus:ring-4 focus:ring-green-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 font-semibold">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Konfirmasi Pesanan</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>
@endsection