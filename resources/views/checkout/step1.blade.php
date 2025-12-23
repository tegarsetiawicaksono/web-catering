@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-orange-50 via-white to-amber-50 py-8 md:py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Progress Indicator -->
        <x-checkout.progress-bar :current-step="1" />

        <!-- Package Info Card -->
        <x-checkout.package-card :name="$name" :price="$price" :min-order="$minOrder" />

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