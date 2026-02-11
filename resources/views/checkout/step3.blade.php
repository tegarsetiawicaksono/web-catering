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
        <form action="{{ route('checkout.store') }}" method="POST" x-data="{ submitting: false }" @submit.prevent="if(!submitting) { submitting = true; $el.submit(); }">
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
                        @php
                            $colors = [
                                ['border' => 'blue-500', 'bg' => 'blue', 'icon' => 'blue-600'],
                                ['border' => 'orange-500', 'bg' => 'orange', 'icon' => 'orange-600'],
                                ['border' => 'blue-600', 'bg' => 'blue', 'icon' => 'blue-700'],
                                ['border' => 'yellow-500', 'bg' => 'yellow', 'icon' => 'yellow-600'],
                                ['border' => 'purple-500', 'bg' => 'purple', 'icon' => 'purple-600'],
                                ['border' => 'pink-500', 'bg' => 'pink', 'icon' => 'pink-600'],
                            ];
                        @endphp
                        
                        @foreach($bankAccounts as $index => $bank)
                        @php
                            $color = $colors[$index % count($colors)];
                        @endphp
                        <label class="relative block cursor-pointer group">
                            <input type="radio" name="payment_method" value="{{ $bank->bank_name }}" class="peer sr-only" @if($loop->first) required @endif>
                            <div class="p-6 border-2 border-gray-200 rounded-2xl peer-checked:border-{{ $color['border'] }} peer-checked:bg-gradient-to-br peer-checked:from-{{ $color['bg'] }}-50 peer-checked:to-{{ $color['bg'] }}-100 transition-all duration-200 hover:border-{{ $color['border'] }} hover:shadow-md">
                                <div class="flex items-center gap-4">
                                    <div class="relative flex items-center justify-center w-12 h-12 rounded-full border-2 border-gray-300 peer-checked:border-{{ $color['border'] }} bg-white shadow-sm">
                                        <div class="w-6 h-6 rounded-full bg-{{ $color['border'] }} opacity-0 peer-checked:opacity-100 transition-opacity flex items-center justify-center">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="text-lg font-bold text-gray-900">{{ $bank->bank_name }}</h4>
                                        <p class="text-sm text-gray-600 mt-1">{{ $bank->account_holder }}</p>
                                        <p class="text-sm font-semibold text-gray-800 mt-1">{{ $bank->account_number }}</p>
                                    </div>
                                    <div class="p-3 bg-gradient-to-br from-{{ $color['bg'] }}-100 to-{{ $color['bg'] }}-200 rounded-xl">
                                        <svg class="w-8 h-8 text-{{ $color['icon'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </label>
                        @endforeach

                        <!-- Cash/Tunai -->
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
                                        <h4 class="text-lg font-bold text-gray-900">Tunai (Cash)</h4>
                                        <p class="text-sm text-gray-600 mt-1">Bayar tunai saat pengiriman</p>
                                    </div>
                                    <div class="p-3 bg-gradient-to-br from-green-100 to-emerald-100 rounded-xl">
                                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                            :disabled="submitting"
                            class="group inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-green-500 to-emerald-500 text-white rounded-xl hover:from-green-600 hover:to-emerald-600 focus:outline-none focus:ring-4 focus:ring-green-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 font-semibold disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-show="!submitting">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <svg class="animate-spin w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" x-show="submitting" style="display: none;">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span x-text="submitting ? 'Memproses...' : 'Konfirmasi Pesanan'">Konfirmasi Pesanan</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>
@endsection
