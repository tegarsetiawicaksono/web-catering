@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-orange-50 via-white to-amber-50 py-8 md:py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Progress Indicator -->
        <x-checkout.progress-bar :current-step="2" />

        <!-- Package Info Card -->
        <x-checkout.package-card :name="$name" :price="$price" :min-order="$minOrder" />

        <!-- Form Step 2 -->
        <form action="{{ route('checkout.step2.store') }}" method="POST">
            @csrf
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden border border-orange-100">
                <!-- Header dengan Gradient -->
                <x-checkout.form-header
                    title="Detail Acara"
                    subtitle="Langkah 2 dari 3 - Informasi Acara"
                    icon="calendar" />

                <!-- Form Content -->
                <div class="p-6 md:p-8">
                    <div class="flex items-center gap-2 mb-6">
                        <div class="w-1 h-6 bg-gradient-to-b from-orange-500 to-amber-500 rounded-full"></div>
                        <h3 class="text-lg font-semibold text-gray-800">Waktu & Jumlah</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="group">
                            <label for="event_date" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                                <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Tanggal Acara *
                            </label>
                            <input type="date" name="event_date" id="event_date" value="{{ old('event_date') }}"
                                class="block w-full px-4 py-3 rounded-xl border-2 border-gray-200 shadow-sm focus:border-orange-400 focus:ring-2 focus:ring-orange-200 transition-all duration-200 @error('event_date') border-red-400 @enderror"
                                min="{{ date('Y-m-d', strtotime('+10 days')) }}" required>
                            <div class="mt-3 bg-gradient-to-br from-orange-50 to-amber-50 border-2 border-orange-200 rounded-xl p-3">
                                <p class="text-sm text-orange-700 flex items-center gap-2 font-medium">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                    </svg>
                                    Pre-order minimal H-10 sebelum acara
                                </p>
                            </div>
                            @error('event_date')
                            <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <div class="group">
                            <label for="event_time" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                                <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Waktu Acara *
                            </label>
                            <input type="time" name="event_time" id="event_time" value="{{ old('event_time') }}"
                                class="block w-full px-4 py-3 rounded-xl border-2 border-gray-200 shadow-sm focus:border-orange-400 focus:ring-2 focus:ring-orange-200 transition-all duration-200 @error('event_time') border-red-400 @enderror"
                                required>
                            @error('event_time')
                            <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <div class="group md:col-span-2">
                            <label for="quantity" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                                <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                Jumlah Porsi *
                            </label>
                            <input type="number" name="quantity" id="quantity" value="{{ old('quantity', $minOrder) }}"
                                class="block w-full px-4 py-3 rounded-xl border-2 border-gray-200 shadow-sm focus:border-orange-400 focus:ring-2 focus:ring-orange-200 transition-all duration-200 @error('quantity') border-red-400 @enderror"
                                min="{{ $minOrder }}" required>
                            <p class="mt-2 text-xs text-amber-600 flex items-center gap-1 font-medium">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                </svg>
                                Minimum order: {{ $minOrder }} porsi
                            </p>
                            @error('quantity')
                            <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <div class="group md:col-span-2">
                            <label for="notes" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                                <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Catatan Khusus (Opsional)
                            </label>
                            <textarea name="notes" id="notes" rows="4"
                                class="block w-full px-4 py-3 rounded-xl border-2 border-gray-200 shadow-sm focus:border-orange-400 focus:ring-2 focus:ring-orange-200 transition-all duration-200"
                                placeholder="Contoh: Preferensi rasa, alergi, atau permintaan khusus lainnya...">{{ old('notes') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Footer dengan Navigation -->
                <div class="bg-gradient-to-br from-gray-50 to-orange-50 px-8 py-6 border-t-2 border-orange-100">
                    <div class="flex items-center justify-between">
                        <a href="{{ route('checkout.step1') }}"
                            class="group inline-flex items-center gap-3 px-6 py-3 bg-white border-2 border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 hover:border-gray-400 transition-all duration-200 shadow-md">
                            <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                            <span class="font-semibold">Kembali</span>
                        </a>
                        <button type="submit"
                            class="group inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-orange-500 to-amber-500 text-white rounded-xl hover:from-orange-600 hover:to-amber-600 focus:outline-none focus:ring-4 focus:ring-orange-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 font-semibold">
                            <span>Lanjutkan ke Pembayaran</span>
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