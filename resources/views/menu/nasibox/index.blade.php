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
                        <button onclick="addToCart('ekonomis', 'Nasi Box Ekonomis', 20000, 50)" 
                                class="w-full bg-[#86765a] text-white py-2 rounded-lg hover:bg-[#6d5e48] transition-colors">
                            Pesan Sekarang
                        </button>
                        <a href="https://wa.me/6282227110771?text=Halo, saya tertarik dengan Nasi Box Ekonomis" 
                           target="_blank"
                           class="w-full block text-center bg-green-500 text-white py-2 rounded-lg hover:bg-green-600 transition-colors">
                            Konsultasi via WhatsApp
                        </a>
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
                        <button onclick="addToCart('regular', 'Nasi Box Regular', 25000, 50)" 
                                class="w-full bg-[#86765a] text-white py-2 rounded-lg hover:bg-[#6d5e48] transition-colors">
                            Pesan Sekarang
                        </button>
                        <a href="https://wa.me/6282227110771?text=Halo, saya tertarik dengan Nasi Box Regular" 
                           target="_blank"
                           class="w-full block text-center bg-green-500 text-white py-2 rounded-lg hover:bg-green-600 transition-colors">
                            Konsultasi via WhatsApp
                        </a>
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
                        <button onclick="addToCart('premium', 'Nasi Box Premium', 35000, 50)" 
                                class="w-full bg-[#86765a] text-white py-2 rounded-lg hover:bg-[#6d5e48] transition-colors">
                            Pesan Sekarang
                        </button>
                        <a href="https://wa.me/6282227110771?text=Halo, saya tertarik dengan Nasi Box Premium" 
                           target="_blank"
                           class="w-full block text-center bg-green-500 text-white py-2 rounded-lg hover:bg-green-600 transition-colors">
                            Konsultasi via WhatsApp
                        </a>
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
function addToCart(id, name, price, minOrder) {
    window.dispatchEvent(new CustomEvent('add-to-cart', {
        detail: {
            id: 'nasibox-' + id,
            name: name,
            price: price,
            category: 'Nasi Box',
            image: '{{ asset('foto/nasibox.jpg') }}',
            minOrder: minOrder
        }
    }));
}
</script>
@endpush

@endsection