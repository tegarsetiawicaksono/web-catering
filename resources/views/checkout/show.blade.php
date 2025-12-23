@extends('layouts.app')

@section('content')
<style>
    /* Hide scrollbar for Chrome, Safari and Opera */
    .hide-scrollbar::-webkit-scrollbar {
        display: none;
    }

    /* Hide scrollbar for IE, Edge and Firefox */
    .hide-scrollbar {
        -ms-overflow-style: none;
        /* IE and Edge */
        scrollbar-width: none;
        /* Firefox */
    }
</style>
<div class="min-h-screen bg-gradient-to-br from-orange-50 via-white to-amber-50 py-8 md:py-12">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">Form Pemesanan</h1>
            <p class="text-gray-600">Lengkapi data di bawah untuk melanjutkan pemesanan</p>
        </div>

        <!-- Package Info Card -->
        <div class="mb-8 bg-white rounded-2xl shadow-xl overflow-hidden border border-orange-200">
            <div class="bg-gradient-to-r from-orange-500 to-amber-500 px-6 py-4">
                <h2 class="text-xl md:text-2xl font-bold text-white">{{ $name }}</h2>
            </div>

            <!-- Gallery Images - Compact Grid -->
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

            <!-- Package Price Info -->
            <div class="px-4 md:px-6 pb-6">
                <!-- Promo Banner -->
                <div class="bg-gradient-to-r from-yellow-100 to-orange-100 rounded-xl p-3 md:p-4 mb-4 border-2 border-yellow-400">
                    <div class="flex items-center gap-2">
                        <span class="bg-gradient-to-r from-yellow-400 to-orange-400 text-white text-xs font-bold px-3 py-1 rounded-full shadow-md">PROMO</span>
                        <p class="text-sm md:text-base font-semibold text-gray-800">Hemat hingga Rp 1.500.000 untuk 300+ porsi! 🎉</p>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-4">
                    <!-- Regular Package Card -->
                    <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-4 md:p-5 border border-gray-200">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <h3 class="text-lg md:text-xl font-bold text-gray-900">Paket Regular</h3>
                                <span class="inline-block mt-1 bg-gray-200 text-gray-700 text-xs px-2 py-1 rounded-full">100-300 porsi</span>
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-gray-600">Min. Order</p>
                                <p class="text-lg font-bold text-gray-900">100 porsi</p>
                            </div>
                        </div>
                        <p class="text-2xl md:text-3xl font-bold text-orange-600 mb-3">
                            Rp 35.000<span class="text-sm font-normal text-gray-600">/porsi</span>
                        </p>
                        <ul class="space-y-1.5 text-xs md:text-sm text-gray-700">
                            <li class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Free konsultasi menu
                            </li>
                            <li class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Peralatan makan lengkap
                            </li>
                        </ul>
                    </div>

                    <!-- Special Package Card -->
                    <div class="relative bg-gradient-to-br from-orange-500 to-amber-500 rounded-xl p-4 md:p-5 text-white shadow-lg">
                        <div class="absolute -top-3 -right-3">
                            <span class="bg-yellow-400 text-orange-900 text-xs font-bold px-3 py-1.5 rounded-full shadow-lg animate-pulse">
                                BEST DEAL!
                            </span>
                        </div>
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <h3 class="text-lg md:text-xl font-bold">Paket Spesial</h3>
                                <span class="inline-block mt-1 bg-white/30 text-white text-xs px-2 py-1 rounded-full">300+ porsi</span>
                            </div>
                            <div class="bg-white/20 backdrop-blur-sm px-3 py-1.5 rounded-lg text-center">
                                <p class="text-xs font-semibold leading-tight">Hemat<br />Rp 5.000/porsi</p>
                            </div>
                        </div>
                        <p class="text-2xl md:text-3xl font-bold mb-3">
                            Rp 30.000<span class="text-sm font-normal opacity-90">/porsi</span>
                        </p>
                        <ul class="space-y-1.5 text-xs md:text-sm">
                            <li class="flex items-center font-semibold text-yellow-100">
                                <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Hemat Rp 5.000/porsi
                            </li>
                            <li class="flex items-center">
                                <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Free konsultasi menu
                            </li>
                            <li class="flex items-center">
                                <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Peralatan makan lengkap
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Checkout Form -->
        <div class="bg-white rounded-2xl shadow-xl p-4 md:p-8 border border-gray-200">
            <div class="mb-6">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Detail Pemesanan</h2>
                <p class="text-gray-600">Isi form berikut dengan lengkap dan benar</p>
            </div>

            <form action="{{ route('checkout.store') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="package_name" value="{{ $name }}">
                <input type="hidden" name="package_price" value="{{ $price }}">
                <input type="hidden" name="min_order" value="{{ $minOrder }}">

                <!-- Multi-step form using Alpine.js -->
                <div x-data="{ 
                    step: 1,
                    isStep1Valid: false,
                    isStep2Valid: false,
                    isStep3Valid: false,
                    
                    validateForm() {
                        this.validateStep1();
                        this.validateStep2();
                        this.validateStep3();
                    },

                    validateStep1() {
                        const customerName = document.getElementById('customer_name')?.value;
                        const phone = document.getElementById('phone')?.value;
                        const email = document.getElementById('email')?.value;
                        const province = document.querySelector('input[name=province]')?.value;
                        const city = document.querySelector('input[name=city]')?.value;
                        const district = document.querySelector('input[name=district]')?.value;
                        const streetAddress = document.getElementById('street_address')?.value;
                        
                        const values = [customerName, phone, email, province, city, district, streetAddress];
                        this.isStep1Valid = values.every(val => val && val.trim().length > 0);
                    },

                    validateStep2() {
                        const eventDate = document.getElementById('event_date')?.value;
                        const eventTime = document.getElementById('event_time')?.value;
                        const quantity = parseInt(document.getElementById('quantity')?.value || '0');
                        
                        this.isStep2Valid = Boolean(
                            eventDate && 
                            eventTime && 
                            quantity >= {{ $minOrder }}
                        );
                    },

                    validateStep3() {
                        const paymentMethod = document.querySelector('input[name=payment_method]:checked');
                        this.isStep3Valid = paymentMethod !== null;
                    },

                    nextStep() {
                        this.validateForm();
                        if (this.step === 1 && this.isStep1Valid) {
                            this.step = 2;
                        } else if (this.step === 2 && this.isStep2Valid) {
                            this.step = 3;
                        }
                    },

                    prevStep() {
                        if (this.step > 1) {
                            this.step--;
                        }
                        this.validateForm();
                    }
                }"
                    x-init="validateForm()"
                    @input.debounce.250ms="validateForm()"
                    @change="validateForm()">

                    <!-- Step Indicator -->
                    <div class="mb-8 bg-white p-6 rounded-lg shadow-md">
                        <div class="flex items-center justify-between max-w-2xl mx-auto">
                            <div class="flex flex-col items-center flex-1">
                                <div class="flex items-center justify-center w-12 h-12 rounded-full font-bold text-lg transition-all duration-300 shadow-md"
                                    :class="step === 1 ? 'bg-blue-500 text-white scale-110' : step > 1 ? 'bg-green-500 text-white' : 'bg-gray-200 text-gray-600'">
                                    <span x-show="step > 1">✓</span>
                                    <span x-show="step <= 1">1</span>
                                </div>
                                <span class="mt-2 text-xs md:text-sm font-semibold text-center" :class="step === 1 ? 'text-blue-500' : step > 1 ? 'text-green-500' : 'text-gray-500'">Data Diri</span>
                            </div>
                            <div class="flex-1 h-2 mx-2 rounded-full transition-all duration-500" :class="step > 1 ? 'bg-green-500' : 'bg-gray-200'"></div>
                            <div class="flex flex-col items-center flex-1">
                                <div class="flex items-center justify-center w-12 h-12 rounded-full font-bold text-lg transition-all duration-300 shadow-md"
                                    :class="step === 2 ? 'bg-blue-500 text-white scale-110' : step > 2 ? 'bg-green-500 text-white' : 'bg-gray-200 text-gray-600'">
                                    <span x-show="step > 2">✓</span>
                                    <span x-show="step <= 2">2</span>
                                </div>
                                <span class="mt-2 text-xs md:text-sm font-semibold text-center" :class="step === 2 ? 'text-blue-500' : step > 2 ? 'text-green-500' : 'text-gray-500'">Detail Acara</span>
                            </div>
                            <div class="flex-1 h-2 mx-2 rounded-full transition-all duration-500" :class="step > 2 ? 'bg-green-500' : 'bg-gray-200'"></div>
                            <div class="flex flex-col items-center flex-1">
                                <div class="flex items-center justify-center w-12 h-12 rounded-full font-bold text-lg transition-all duration-300 shadow-md"
                                    :class="step === 3 ? 'bg-blue-500 text-white scale-110' : 'bg-gray-200 text-gray-600'">
                                    3
                                </div>
                                <span class="mt-2 text-xs md:text-sm font-semibold text-center" :class="step === 3 ? 'text-blue-500' : 'text-gray-500'">Pembayaran</span>
                            </div>
                        </div>
                    </div>

                    <!-- Steps Container - Only one visible at a time -->
                    <div class="relative min-h-screen">
                        <!-- Step 1: Personal Information -->
                        <div x-show="step === 1"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform translate-x-8"
                            x-transition:enter-end="opacity-100 transform translate-x-0"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                            class="bg-white p-8 rounded-xl shadow-lg border-2 border-blue-100">
                            <div class="mb-6 pb-4 border-b-2 border-blue-500">
                                <h2 class="text-3xl font-bold text-gray-900 flex items-center gap-3">
                                    <span class="flex items-center justify-center w-10 h-10 bg-blue-500 text-white rounded-full text-xl">1</span>
                                    Data Diri & Alamat
                                </h2>
                                <p class="mt-2 text-gray-600 ml-13">Silakan lengkapi informasi pribadi dan alamat pengiriman Anda</p>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                                <div class="space-y-4">
                                    <div>
                                        <label for="customer_name" class="block text-sm font-medium text-gray-700">Nama Lengkap *</label>
                                        <input type="text" name="customer_name" id="customer_name"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-colors"
                                            placeholder="Masukkan Nama Lengkap Anda"
                                            required>
                                    </div>

                                    <div>
                                        <label for="phone" class="block text-sm font-medium text-gray-700">Nomor Telepon *</label>
                                        <div class="mt-1 relative rounded-md shadow-sm">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <span class="text-gray-500 sm:text-sm">+62</span>
                                            </div>
                                            <input type="tel" name="phone" id="phone"
                                                class="pl-12 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 transition-colors"
                                                placeholder="Masukkan Nomor Telepon Anda"
                                                pattern="[0-9]*"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                required>
                                            <div class="text-xs text-gray-500 mt-1">Hanya angka yang diperbolehkan</div>
                                        </div>
                                    </div>

                                    <div>
                                        <label for="email" class="block text-sm font-medium text-gray-700">Email *</label>
                                        <input type="email" name="email" id="email"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-colors"
                                            placeholder="Masukkan Email Anda"
                                            required>
                                    </div>
                                </div>

                                <div class="space-y-4">
                                    <div x-data="addressForm">
                                        <div>
                                            <label for="province" class="block text-sm font-medium text-gray-700">Provinsi *</label>
                                            <div class="relative">
                                                <div @click="showProvinceDropdown = true"
                                                    class="mt-1 block w-full rounded-md border border-gray-300 bg-white cursor-pointer">
                                                    <div class="flex items-center justify-between px-3 py-2">
                                                        <span x-text="selectedProvince || 'Pilih Provinsi'"
                                                            class="text-gray-700"></span>
                                                        <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                        </svg>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="province" x-model="selectedProvince" required>
                                                <div x-show="showProvinceDropdown"
                                                    @click.away="showProvinceDropdown = false"
                                                    class="absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg">
                                                    <div class="p-2 border-b">
                                                        <input type="text"
                                                            x-model="provinceSearch"
                                                            @input="filterProvinces"
                                                            placeholder="Cari provinsi..."
                                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-indigo-500">
                                                    </div>
                                                    <div class="max-h-60 overflow-y-auto">
                                                        <template x-for="province in filteredProvinces" :key="province.id">
                                                            <div @click="selectProvince(province)"
                                                                class="px-4 py-2 hover:bg-gray-100 cursor-pointer"
                                                                x-text="province.name">
                                                            </div>
                                                        </template>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-4">
                                            <label for="city" class="block text-sm font-medium text-gray-700">Kota/Kabupaten *</label>
                                            <div class="relative">
                                                <div @click="showCityDropdown = true"
                                                    :class="{'opacity-50 cursor-not-allowed': !selectedProvince, 'cursor-pointer': selectedProvince}"
                                                    class="mt-1 block w-full rounded-md border border-gray-300 bg-white">
                                                    <div class="flex items-center justify-between px-3 py-2">
                                                        <span x-text="selectedCity || 'Pilih Kota/Kabupaten'"
                                                            class="text-gray-700"></span>
                                                        <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                        </svg>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="city" x-model="selectedCity" required>
                                                <div x-show="showCityDropdown && selectedProvince"
                                                    @click.away="showCityDropdown = false"
                                                    class="absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg">
                                                    <div class="p-2 border-b">
                                                        <input type="text"
                                                            x-model="citySearch"
                                                            @input="filterCities"
                                                            placeholder="Cari kota/kabupaten..."
                                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-indigo-500">
                                                    </div>
                                                    <div class="max-h-60 overflow-y-auto">
                                                        <template x-for="city in filteredCities" :key="city.id">
                                                            <div @click="selectCity(city)"
                                                                class="px-4 py-2 hover:bg-gray-100 cursor-pointer"
                                                                x-text="city.name">
                                                            </div>
                                                        </template>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-4">
                                            <label for="district" class="block text-sm font-medium text-gray-700">Kecamatan *</label>
                                            <div class="relative">
                                                <div @click="showDistrictDropdown = true"
                                                    :class="{'opacity-50 cursor-not-allowed': !selectedCity, 'cursor-pointer': selectedCity}"
                                                    class="mt-1 block w-full rounded-md border border-gray-300 bg-white">
                                                    <div class="flex items-center justify-between px-3 py-2">
                                                        <span x-text="selectedDistrict || 'Pilih Kecamatan'"
                                                            class="text-gray-700"></span>
                                                        <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                        </svg>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="district" x-model="selectedDistrict" required>
                                                <div x-show="showDistrictDropdown && selectedCity"
                                                    @click.away="showDistrictDropdown = false"
                                                    class="absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg">
                                                    <div class="p-2 border-b">
                                                        <input type="text"
                                                            x-model="districtSearch"
                                                            @input="filterDistricts"
                                                            placeholder="Cari kecamatan..."
                                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-indigo-500">
                                                    </div>
                                                    <div class="max-h-60 overflow-y-auto">
                                                        <template x-for="district in filteredDistricts" :key="district.id">
                                                            <div @click="selectDistrict(district)"
                                                                class="px-4 py-2 hover:bg-gray-100 cursor-pointer"
                                                                x-text="district.name">
                                                            </div>
                                                        </template>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                        document.addEventListener('alpine:init', () => {
                                            Alpine.data('addressForm', () => ({
                                                provinces: [],
                                                cities: [],
                                                districts: [],
                                                selectedProvince: '',
                                                selectedCity: '',
                                                selectedDistrict: '',
                                                provinceSearch: '',
                                                citySearch: '',
                                                districtSearch: '',
                                                showProvinceDropdown: false,
                                                showCityDropdown: false,
                                                showDistrictDropdown: false,
                                                filteredProvinces: [],
                                                filteredCities: [],
                                                filteredDistricts: [],

                                                async init() {
                                                    try {
                                                        const response = await fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json');
                                                        this.provinces = await response.json();
                                                        this.filteredProvinces = this.provinces;
                                                    } catch (error) {
                                                        console.error('Error fetching provinces:', error);
                                                    }
                                                },

                                                filterProvinces() {
                                                    if (!this.provinceSearch) {
                                                        this.filteredProvinces = this.provinces;
                                                        return;
                                                    }
                                                    this.filteredProvinces = this.provinces.filter(p =>
                                                        p.name.toLowerCase().includes(this.provinceSearch.toLowerCase())
                                                    );
                                                },

                                                filterCities() {
                                                    if (!this.citySearch) {
                                                        this.filteredCities = this.cities;
                                                        return;
                                                    }
                                                    this.filteredCities = this.cities.filter(c =>
                                                        c.name.toLowerCase().includes(this.citySearch.toLowerCase())
                                                    );
                                                },

                                                filterDistricts() {
                                                    if (!this.districtSearch) {
                                                        this.filteredDistricts = this.districts;
                                                        return;
                                                    }
                                                    this.filteredDistricts = this.districts.filter(d =>
                                                        d.name.toLowerCase().includes(this.districtSearch.toLowerCase())
                                                    );
                                                },

                                                async onProvinceChange() {
                                                    this.selectedCity = '';
                                                    this.citySearch = '';
                                                    this.selectedDistrict = '';
                                                    this.districtSearch = '';
                                                    this.districts = [];

                                                    if (!this.selectedProvince) {
                                                        this.cities = [];
                                                        return;
                                                    }

                                                    try {
                                                        const provinceId = this.provinces.find(p => p.name === this.selectedProvince)?.id;
                                                        if (provinceId) {
                                                            const response = await fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provinceId}.json`);
                                                            this.cities = await response.json();
                                                            this.filteredCities = this.cities;
                                                        }
                                                    } catch (error) {
                                                        console.error('Error fetching cities:', error);
                                                    }
                                                },

                                                async onCityChange() {
                                                    this.selectedDistrict = '';
                                                    this.districtSearch = '';

                                                    if (!this.selectedCity) {
                                                        this.districts = [];
                                                        return;
                                                    }

                                                    try {
                                                        const cityId = this.cities.find(c => c.name === this.selectedCity)?.id;
                                                        if (cityId) {
                                                            const response = await fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${cityId}.json`);
                                                            this.districts = await response.json();
                                                            this.filteredDistricts = this.districts;
                                                        }
                                                    } catch (error) {
                                                        console.error('Error fetching districts:', error);
                                                    }
                                                },

                                                async selectProvince(province) {
                                                    this.selectedProvince = province.name;
                                                    this.provinceSearch = province.name;
                                                    this.showProvinceDropdown = false;
                                                    await this.onProvinceChange();
                                                },

                                                async selectCity(city) {
                                                    this.selectedCity = city.name;
                                                    this.citySearch = city.name;
                                                    this.showCityDropdown = false;
                                                    await this.onCityChange();
                                                },

                                                selectDistrict(district) {
                                                    this.selectedDistrict = district.name;
                                                    this.districtSearch = district.name;
                                                    this.showDistrictDropdown = false;
                                                }
                                            }));
                                        });
                                    </script>

                                    <div>
                                        <label for="street_address" class="block text-sm font-medium text-gray-700">Alamat Lengkap *</label>
                                        <textarea name="street_address" id="street_address" rows="4"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-colors"
                                            required
                                            placeholder="Detail alamat lengkap (nama jalan, nomor rumah, RT/RW, dll)"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-end mt-6 pt-4 border-t border-gray-200">
                                <button type="button"
                                    @click="nextStep()"
                                    :disabled="!isStep1Valid"
                                    class="bg-blue-500 text-white px-8 py-3 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors disabled:opacity-50 disabled:cursor-not-allowed shadow-md">
                                    <span x-show="!isStep1Valid" class="flex items-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Lengkapi Semua Data Terlebih Dahulu
                                    </span>
                                    <span x-show="isStep1Valid" class="flex items-center gap-2">
                                        Lanjutkan ke Halaman 2
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                        </svg>
                                    </span>
                                </button>
                            </div>
                        </div>

                        <!-- Step 2: Event Details -->
                        <div x-show="step === 2"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform translate-x-8"
                            x-transition:enter-end="opacity-100 transform translate-x-0"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                            class="bg-white p-8 rounded-xl shadow-lg border-2 border-blue-100">
                            <div class="mb-6 pb-4 border-b-2 border-blue-500">
                                <h2 class="text-3xl font-bold text-gray-900 flex items-center gap-3">
                                    <span class="flex items-center justify-center w-10 h-10 bg-blue-500 text-white rounded-full text-xl">2</span>
                                    Detail Acara
                                </h2>
                                <p class="mt-2 text-gray-600 ml-13">Tentukan tanggal, waktu, dan jumlah porsi untuk acara Anda</p>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                                <div>
                                    <label for="event_date" class="block text-sm font-medium text-gray-700">Tanggal Acara *</label>
                                    <input type="date" name="event_date" id="event_date"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-colors"
                                        required
                                        min="{{ date('Y-m-d', strtotime('+10 days')) }}">
                                    <div class="mt-2 bg-blue-50 border border-blue-200 rounded-md p-3">
                                        <div class="flex">
                                            <svg class="h-5 w-5 text-blue-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <div>
                                                <p class="text-sm font-medium text-blue-800">Informasi Pemesanan</p>
                                                <ul class="mt-1 text-sm text-blue-700 list-disc list-inside">
                                                    <li>Pre-order dilakukan minimal H-10 sebelum acara</li>
                                                    <li>Contoh: Jika acara tanggal 28, pemesanan paling lambat tanggal 18</li>
                                                    <li>Hal ini untuk memastikan persiapan yang maksimal</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label for="event_time" class="block text-sm font-medium text-gray-700">Waktu Acara *</label>
                                    <input type="time" name="event_time" id="event_time"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-colors"
                                        required>
                                </div>

                                <div>
                                    <label for="quantity" class="block text-sm font-medium text-gray-700">Jumlah Porsi *</label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <input type="number" name="quantity" id="quantity"
                                            min="{{ $minOrder }}"
                                            value="0"
                                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-colors"
                                            required
                                            x-model="$store.orderQuantity.value"
                                            @change="checkSteps()">
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                            <span class="text-gray-500 sm:text-sm">porsi</span>
                                        </div>
                                    </div>
                                    <p class="mt-1 text-sm text-gray-500">Minimum Order : {{ $minOrder }} porsi</p>
                                </div>

                                <div>
                                    <label for="notes" class="block text-sm font-medium text-gray-700">Catatan Khusus</label>
                                    <textarea name="notes" id="notes" rows="4"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-colors"
                                        placeholder="Contoh: Preferensi rasa, alergi, atau permintaan khusus lainnya..."></textarea>
                                </div>
                            </div>

                            <!-- Navigation Buttons -->
                            <div class="flex justify-between mt-6 pt-4 border-t border-gray-200">
                                <button type="button"
                                    @click="prevStep()"
                                    class="text-gray-600 px-6 py-3 rounded-md hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors border border-gray-300 shadow-sm flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                    </svg>
                                    Kembali ke Halaman 1
                                </button>
                                <button type="button"
                                    @click="nextStep()"
                                    :disabled="!isStep2Valid"
                                    class="bg-blue-500 text-white px-8 py-3 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors disabled:opacity-50 disabled:cursor-not-allowed shadow-md">
                                    <span x-show="!isStep2Valid" class="flex items-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Lengkapi Semua Data Terlebih Dahulu
                                    </span>
                                    <span x-show="isStep2Valid" class="flex items-center gap-2">
                                        Lanjutkan ke Halaman 3
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                        </svg>
                                    </span>
                                </button>
                            </div>
                        </div>
                        <!-- End Step 2 -->

                        <!-- Step 3: Payment Method -->
                        <div x-show="step === 3"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform translate-x-8"
                            x-transition:enter-end="opacity-100 transform translate-x-0"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                            class="bg-white p-8 rounded-xl shadow-lg border-2 border-blue-100">
                            <div class="mb-6 pb-4 border-b-2 border-blue-500">
                                <h2 class="text-3xl font-bold text-gray-900 flex items-center gap-3">
                                    <span class="flex items-center justify-center w-10 h-10 bg-blue-500 text-white rounded-full text-xl">3</span>
                                    Metode Pembayaran
                                </h2>
                                <p class="mt-2 text-gray-600 ml-13">Pilih metode pembayaran yang Anda inginkan</p>
                            </div>
                            <div class="bg-gradient-to-br from-gray-50 to-blue-50 p-6 rounded-lg">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Pilih Metode Pembayaran</h3>
                                <div class="space-y-4">
                                    <div class="relative">
                                        <input type="radio" name="payment_method" id="transfer" value="transfer"
                                            class="peer hidden" required>
                                        <label for="transfer"
                                            class="block p-4 rounded-lg border-2 border-gray-200 cursor-pointer hover:border-blue-500 peer-checked:border-blue-500 peer-checked:bg-blue-50 transition-colors">
                                            <div class="flex items-center">
                                                <div class="w-6 h-6 border-2 rounded-full flex items-center justify-center border-gray-300 peer-checked:border-blue-500">
                                                    <div class="w-3 h-3 rounded-full bg-blue-500 hidden peer-checked:block"></div>
                                                </div>
                                                <div class="ml-4">
                                                    <h4 class="text-lg font-medium text-gray-900">Transfer Bank</h4>
                                                    <p class="text-gray-500">Transfer melalui rekening bank pilihan Anda</p>
                                                </div>
                                            </div>
                                        </label>
                                    </div>

                                    <div class="relative">
                                        <input type="radio" name="payment_method" id="cash" value="cash"
                                            class="peer hidden">
                                        <label for="cash"
                                            class="block p-4 rounded-lg border-2 border-gray-200 cursor-pointer hover:border-blue-500 peer-checked:border-blue-500 peer-checked:bg-blue-50 transition-colors">
                                            <div class="flex items-center">
                                                <div class="w-6 h-6 border-2 rounded-full flex items-center justify-center border-gray-300 peer-checked:border-blue-500">
                                                    <div class="w-3 h-3 rounded-full bg-blue-500 hidden peer-checked:block"></div>
                                                </div>
                                                <div class="ml-4">
                                                    <h4 class="text-lg font-medium text-gray-900">Tunai</h4>
                                                    <p class="text-gray-500">Bayar tunai saat pengiriman</p>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Navigation Buttons -->
                            <div class="flex justify-between mt-6 pt-4 border-t border-gray-200">
                                <button type="button"
                                    @click="prevStep()"
                                    class="text-gray-600 px-6 py-3 rounded-md hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors border border-gray-300 shadow-sm flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                    </svg>
                                    Kembali ke Halaman 2
                                </button>
                                <button type="submit"
                                    @click="validateForm()"
                                    :disabled="!isStep3Valid"
                                    class="bg-green-500 text-white px-8 py-3 rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors disabled:opacity-50 disabled:cursor-not-allowed shadow-md">
                                    <span x-show="!isStep3Valid" class="flex items-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Pilih Metode Pembayaran Terlebih Dahulu
                                    </span>
                                    <span x-show="isStep3Valid" class="flex items-center gap-2">
                                        Konfirmasi Pesanan
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- End Step 3 -->

                </div>
                <!-- End Steps Container -->
        </div>

        <!-- Order Summary -->
        <div class="bg-gray-50 p-4 rounded-lg" x-data="{ 
                get isSpecialPrice() {
                    return $store.orderQuantity.value > 300;
                },
                get pricePerUnit() {
                    return this.isSpecialPrice ? 30000 : 35000;
                },
                get totalPrice() {
                    return $store.orderQuantity.value * this.pricePerUnit;
                },
                formatPrice(price) {
                    return new Intl.NumberFormat('id-ID').format(price);
                }
            }">
            <h2 class="text-lg font-medium text-gray-900 mb-4">Ringkasan Pesanan</h2>
            <div class="space-y-4">
                <div class="flex justify-between items-start border-b border-gray-200 pb-4">
                    <div>
                        <span class="text-lg font-medium text-gray-900">{{ $name }}</span>
                        <div class="mt-1">
                            <span x-show="$store.orderQuantity.value >= 100" class="inline-flex items-center text-sm">
                                <template x-if="isSpecialPrice">
                                    <span class="text-green-600 font-medium">Harga Spesial</span>
                                </template>
                                <template x-if="!isSpecialPrice">
                                    <span class="text-gray-600">Harga Regular</span>
                                </template>
                            </span>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="text-lg font-medium text-gray-900" x-text="'Rp ' + formatPrice(pricePerUnit)"></span>
                        <p class="text-sm text-gray-500">/porsi</p>
                    </div>
                </div>

                <!-- Quantity and Total -->
                <div x-show="$store.orderQuantity.value >= 100"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform -translate-y-2"
                    x-transition:enter-end="opacity-100 transform translate-y-0">
                    <div class="bg-gray-100 rounded-lg p-4">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-gray-600">Jumlah Porsi</span>
                            <span class="font-medium" x-text="$store.orderQuantity.value + ' porsi'"></span>
                        </div>
                        <div class="flex justify-between items-center pt-2 border-t border-gray-200">
                            <div>
                                <span class="text-lg font-bold text-gray-900">Total Pembayaran</span>
                                <template x-if="isSpecialPrice">
                                    <p class="text-sm text-green-600">Anda hemat Rp <span x-text="formatPrice($store.orderQuantity.value * 5000)"></span>!</p>
                                </template>
                            </div>
                            <span class="text-xl font-bold text-gray-900" x-text="'Rp ' + formatPrice(totalPrice)"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.store('orderQuantity', {
                    value: 0
                })
            })
        </script>

        </form>
    </div>
</div>
<!-- Lightbox Modal -->
<div id="lightbox" class="fixed inset-0 z-50 bg-black bg-opacity-90 hidden" onclick="closeLightbox()">
    <div class="absolute top-4 right-4">
        <button onclick="closeLightbox()" class="text-white hover:text-gray-300">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    <div class="flex items-center justify-center h-full">
        <img id="lightbox-img" src="" alt="Menu Detail" class="max-w-4xl max-h-[80vh] object-contain">
    </div>
</div>

<script>
    function openLightbox(button) {
        const img = button.closest('.group').querySelector('img');
        document.getElementById('lightbox-img').src = img.src;
        document.getElementById('lightbox').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        document.getElementById('lightbox').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Close lightbox with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeLightbox();
        }
    });
</script>
@endsection