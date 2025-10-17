@extends('layouts.app')

@section('content')
<div class="min-h-screen pt-16 relative">
    <!-- Fixed Background -->
    <div class="fixed inset-0 z-0">
        <img src="{{ asset('foto/buffet/buffet.jpg') }}" alt="Background" class="w-full h-full object-cover">
        <div class="absolute inset-0 backdrop-blur-sm bg-white/60"></div>
    </div>

    <!-- Back Button -->
    <div class="fixed top-6 left-4 z-[60]">
        <a href="{{ route('home') }}#menu" class="flex items-center justify-center w-12 h-12 bg-gradient-to-r from-orange-400 to-orange-500 rounded-full shadow-lg hover:from-orange-500 hover:to-orange-600 transition-all duration-300 group">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white group-hover:scale-110 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
            </svg>
        </a>
    </div>

    <!-- Header Section -->
    <div class="relative">
        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('foto/buffet.jpg') }}" alt="Buffet Background" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/50"></div>
        </div>
        
        <!-- Content -->
        <div class="relative z-10 py-20">
            <div class="container mx-auto px-4">
                <h1 class="text-4xl md:text-5xl font-bold mb-4 text-white drop-shadow-lg">Paket Buffet</h1>
                <p class="text-lg text-white/90 max-w-2xl drop-shadow-md">Pilihan menu buffet berkualitas untuk berbagai acara Anda</p>
            </div>
        </div>
    </div>

    <!-- Packages Grid -->
    <div class="relative z-10">
        <div class="container max-w-7xl mx-auto px-4 py-16">
            <div class="grid grid-cols-1 md:grid-cols-[repeat(auto-fit,minmax(300px,1fr))] gap-8">
                <!-- Paket Silver -->
                <div class="bg-white/90 backdrop-blur-sm rounded-xl shadow-lg overflow-hidden hover:bg-white transition-all duration-300 hover:shadow-xl">
                <div class="relative">
                    <img src="{{ asset('foto/buffet.jpg') }}" alt="Paket Silver" class="w-full h-48 object-cover">
                    <div class="absolute top-4 right-4 bg-white text-[#86765a] px-4 py-1 rounded-full font-semibold">
                        Rp 30.000/pax
                    </div>
                </div>
                <div class="p-6 flex flex-col min-h-[600px]">
                    <div class="flex-grow">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Paket Silver</h3>
                        <div class="space-y-4">
                            <div>
                                <h4 class="font-medium text-[#86765a]">Appitizer</h4>
                                <ul class="mt-2 space-y-1 text-gray-600">
                                    <li>• Softdrink</li>
                                    <li>• 2 Macam Mini Snack</li>
                            </div>
                                <div>
                                <h4 class="font-medium text-[#86765a]">Buffet Menu</h4>
                                <ul class="mt-2 space-y-1 text-gray-600">
                                    <li>• Nasi Putih</li>
                                    <li>• 1 Macam Ayam</li>
                                    <li>• 1 Macam Menu Olahan</li>
                                    <li>• 1 Soup</li>
                                    <li>• Kerupuk</li>
                                </ul>
                            </div>
                            <div>
                                <h4 class="font-medium text-[#86765a]">Dessert</h4>
                                <ul class="mt-2 space-y-1 text-gray-600">
                                    <li>• 1 Macam Pilihan Es</li>
                                    <li>• Air Mineral</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-3">
                        <button onclick="addToCart('silver', 'Paket Prasmanan Silver', 35000, 100)" 
                                class="w-full bg-orange-500 text-white h-12 rounded-lg hover:bg-orange-600 transition-colors font-medium flex items-center justify-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <span>Tambahkan ke Keranjang</span>
                        </button>
                        <a href="https://wa.me/6282227110771?text=Halo%2C%20saya%20tertarik%20dengan%20Paket%20Prasmanan%20Silver%20(Rp%2030.000%2Fpax).%20Mohon%20informasi%20lebih%20detail%20mengenai%20paket%20ini." 
                           target="_blank"
                           class="w-full h-12 flex items-center justify-center space-x-2 bg-green-500 hover:bg-green-600 text-white rounded-lg transition-colors font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                            </svg>
                            <span>Konstulsai</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Paket Gold -->
             <div class="bg-white/90 backdrop-blur-sm rounded-xl shadow-lg overflow-hidden hover:bg-white transition-all duration-300 hover:shadow-xl">
                <div class="relative">
                    <img src="{{ asset('foto/buffet.jpg') }}" alt="Paket Gold" class="w-full h-48 object-cover">
                    <div class="absolute top-4 right-4 bg-white text-[#86765a] px-4 py-1 rounded-full font-semibold shadow-md">
                        Rp 35.000/pax
                    </div>
                </div>
                <div class="p-6 flex flex-col min-h-[600px]">
                    <div class="flex-grow">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Paket Gold</h3>
                        <div class="space-y-4">
                            <div>
                                <h4 class="font-medium text-[#86765a]">Appitizer</h4>
                                <ul class="mt-2 space-y-1 text-gray-600">
                                    <li>• 2 Juice & 2 Softdrink</li>
                                    <li>• 2 Macam Mini Snack</li>
                            </div>
                                <div>
                                <h4 class="font-medium text-[#86765a]">Buffet Menu</h4>
                                <ul class="mt-2 space-y-1 text-gray-600">
                                    <li>• Nasi Putih</li>
                                    <li>• 1 Macam Ayam / Daging</li>
                                    <li>• 1 Macam Menu Olahan</li>
                                    <li>• 1 Macam Cah / Oseng</li>
                                    <li>• 1 Soup</li>
                                    <li>• Kerupuk</li>
                                </ul>
                            </div>
                            <div>
                                <h4 class="font-medium text-[#86765a]">Dessert</h4>
                                <ul class="mt-2 space-y-1 text-gray-600">
                                    <li>• 1 Macam Pilihan Es</li>
                                    <li>• Air Mineral</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-3">
                        <button onclick="addToCart('gold', 'Paket Prasmanan Gold', 35000, 100)" 
                                class="w-full bg-orange-500 text-white h-12 rounded-lg hover:bg-orange-600 transition-colors font-medium flex items-center justify-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <span>Tambahkan ke Keranjang</span>
                        </button>
                        <a href="https://wa.me/6282227110771?text=Halo%2C%20saya%20tertarik%20dengan%20Paket%20Prasmanan%20Gold%20(Rp%2035.000%2Fpax).%20Mohon%20informasi%20lebih%20detail%20mengenai%20paket%20ini." 
                           target="_blank"
                           class="w-full h-12 flex items-center justify-center space-x-2 bg-green-500 hover:bg-green-600 text-white rounded-lg transition-colors font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                            </svg>
                            <span>Konsultasi</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Paket Platinum -->
            <div class="bg-white/90 backdrop-blur-sm rounded-xl shadow-lg overflow-hidden hover:bg-white transition-all duration-300 hover:shadow-xl">
                <div class="relative">
                    <img src="{{ asset('foto/buffet.jpg') }}" alt="Paket Platinum" class="w-full h-48 object-cover">
                    <div class="absolute top-4 right-4 bg-white text-[#86765a] px-4 py-1 rounded-full font-semibold shadow-md">
                        Rp 40.000/pax
                    </div>
                </div>
                <div class="p-6 flex flex-col min-h-[600px]">
                    <div class="flex-grow">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Paket Platinum</h3>
                        <div class="space-y-4">
                            <div>
                                <h4 class="font-medium text-[#86765a]">Appitizer</h4>
                                <ul class="mt-2 space-y-1 text-gray-600">
                                    <li>• 2 Juice & 2 Softdrink</li>
                                    <li>• 2 Macam Mini Snack</li>
                            </div>
                                <div>
                                <h4 class="font-medium text-[#86765a]">Buffet Menu</h4>
                                <ul class="mt-2 space-y-1 text-gray-600">
                                    <li>• Nasi Putih</li>
                                    <li>• 1 Macam Ayam</li>
                                    <li>• 1 Macam Daging</li>
                                    <li>• 1 Macam Ikan / Seafood</li>
                                    <li>• 1 Macam Cah / Oseng</li>
                                    <li>• 1 Soup</li>
                                    <li>• Kerupuk</li>
                                </ul>
                            </div>
                            <div>
                                <h4 class="font-medium text-[#86765a]">Dessert</h4>
                                <ul class="mt-2 space-y-1 text-gray-600">
                                    <li>• 1 Macam Pilihan Es</li>
                                    <li>• Air Mineral</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-3">
                        <button onclick="addToCart('platinum', 'Paket Prasmanan Platinum', 40000, 100)" 
                                class="w-full bg-orange-500 text-white h-12 rounded-lg hover:bg-orange-600 transition-colors font-medium flex items-center justify-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <span>Tambahkan ke Keranjang</span>
                        </button>
                        <a href="https://wa.me/6282227110771?text=Halo%2C%20saya%20tertarik%20dengan%20Paket%20Prasmanan%20Platinum%20(Rp%2040.000%2Fpax).%20Mohon%20informasi%20lebih%20detail%20mengenai%20paket%20ini." 
                           target="_blank"
                           class="w-full h-12 flex items-center justify-center space-x-2 bg-green-500 hover:bg-green-600 text-white rounded-lg transition-colors font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                            </svg>
                            <span>Konsultasi</span>
                        </a>
                    </div>
                </div>
            </div>

    <!-- Informasi Penting -->
    <div class="bg-white/95 backdrop-blur-sm py-12 mb-24 relative overflow-x-auto">
        <div class="container max-w-full mx-auto px-8">
            <h2 class="text-3xl font-bold text-[#86765a] mb-8 text-center">Informasi Penting</h2>

@push('scripts')
<script>
function addToCart(id, name, price, minOrder) {
    window.dispatchEvent(new CustomEvent('add-to-cart', {
        detail: {
            id: 'buffet-' + id,
            name: name,
            price: price,
            category: 'Buffet',
            image: "{{ asset('foto/buffet.jpg') }}",
            minOrder: minOrder
        }
    }));
}
</script>
@endpush
@endsection