@extends('layouts.app')

<x-slot>
<div class="min-h-screen bg-gray-50 pt-16">
    <!-- Header Section -->
    <div class="bg-[#86765a] text-white py-16">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl font-bold mb-4">Paket Prasmanan</h1>
            <p class="text-lg opacity-90">Pilihan menu prasmanan berkualitas untuk berbagai acara Anda</p>
        </div>
    </div>

    <!-- Packages Grid -->
    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Paket Silver -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="relative">
                    <img src="{{ asset('foto/buffet.jpg') }}" alt="Paket Silver" class="w-full h-48 object-cover">
                    <div class="absolute top-4 right-4 bg-white text-[#86765a] px-4 py-1 rounded-full font-semibold">
                        Rp 35.000/pax
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Paket Silver</h3>
                    <p class="text-gray-600 mb-4">7 pilihan menu dengan berbagai hidangan lezat</p>
                    <div class="space-y-4">
                        <div>
                            <h4 class="font-medium text-[#86765a]">Menu Utama (Pilih 2)</h4>
                            <ul class="mt-2 space-y-1 text-gray-600">
                                <li>• Ayam Goreng</li>
                                <li>• Rendang Ayam</li>
                                <li>• Ikan Asam Manis</li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="font-medium text-[#86765a]">Pendamping</h4>
                            <ul class="mt-2 space-y-1 text-gray-600">
                                <li>• Nasi Putih</li>
                                <li>• Sayur Asem</li>
                                <li>• Cap Cay</li>
                            </ul>
                        </div>
                    </div>
                    <div class="mt-6 space-y-3">
                        <button onclick="addToCart('silver', 'Paket Prasmanan Silver', 35000, 100)" 
                                class="w-full bg-[#86765a] text-white py-2 rounded-lg hover:bg-[#6d5e48] transition-colors">
                            Pesan Sekarang
                        </button>
                        <a href="https://wa.me/6282227110771?text=Halo, saya tertarik dengan Paket Prasmanan Silver" 
                           target="_blank"
                           class="w-full block text-center bg-green-500 text-white py-2 rounded-lg hover:bg-green-600 transition-colors">
                            Konsultasi via WhatsApp
                        </a>
                    </div>
                </div>
            </div>

            <!-- Paket Gold -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="relative">
                    <img src="{{ asset('foto/buffet.jpg') }}" alt="Paket Gold" class="w-full h-48 object-cover">
                    <div class="absolute top-4 right-4 bg-white text-[#86765a] px-4 py-1 rounded-full font-semibold">
                        Rp 45.000/pax
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Paket Gold</h3>
                    <p class="text-gray-600 mb-4">10 pilihan menu premium dengan hidangan spesial</p>
                    <div class="space-y-4">
                        <div>
                            <h4 class="font-medium text-[#86765a]">Menu Utama (Pilih 3)</h4>
                            <ul class="mt-2 space-y-1 text-gray-600">
                                <li>• Ayam Bakar Madu</li>
                                <li>• Rendang Sapi</li>
                                <li>• Gurame Asam Manis</li>
                                <li>• Sate Ayam</li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="font-medium text-[#86765a]">Pendamping</h4>
                            <ul class="mt-2 space-y-1 text-gray-600">
                                <li>• Nasi Putih/Goreng</li>
                                <li>• Capcay Seafood</li>
                                <li>• Sop Ayam</li>
                                <li>• Mie Goreng</li>
                            </ul>
                        </div>
                    </div>
                    <div class="mt-6 space-y-3">
                        <button onclick="addToCart('gold', 'Paket Prasmanan Gold', 45000, 100)" 
                                class="w-full bg-[#86765a] text-white py-2 rounded-lg hover:bg-[#6d5e48] transition-colors">
                            Pesan Sekarang
                        </button>
                        <a href="https://wa.me/6282227110771?text=Halo, saya tertarik dengan Paket Prasmanan Gold" 
                           target="_blank"
                           class="w-full block text-center bg-green-500 text-white py-2 rounded-lg hover:bg-green-600 transition-colors">
                            Konsultasi via WhatsApp
                        </a>
                    </div>
                </div>
            </div>

            <!-- Paket Platinum -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="relative">
                    <img src="{{ asset('foto/buffet.jpg') }}" alt="Paket Platinum" class="w-full h-48 object-cover">
                    <div class="absolute top-4 right-4 bg-white text-[#86765a] px-4 py-1 rounded-full font-semibold">
                        Rp 55.000/pax
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Paket Platinum</h3>
                    <p class="text-gray-600 mb-4">12 pilihan menu premium dengan hidangan spesial dan eksklusif</p>
                    <div class="space-y-4">
                        <div>
                            <h4 class="font-medium text-[#86765a]">Menu Utama (Pilih 4)</h4>
                            <ul class="mt-2 space-y-1 text-gray-600">
                                <li>• Ayam Bakar Madu</li>
                                <li>• Rendang Sapi</li>
                                <li>• Gurame Asam Manis</li>
                                <li>• Udang Goreng Tepung</li>
                                <li>• Sate Lilit</li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="font-medium text-[#86765a]">Pendamping</h4>
                            <ul class="mt-2 space-y-1 text-gray-600">
                                <li>• Nasi Putih/Goreng</li>
                                <li>• Capcay Seafood</li>
                                <li>• Sup Asparagus</li>
                                <li>• Mie Goreng Seafood</li>
                                <li>• Salad Buah</li>
                            </ul>
                        </div>
                    </div>
                    <div class="mt-6 space-y-3">
                        <button onclick="addToCart('platinum', 'Paket Prasmanan Platinum', 55000, 100)" 
                                class="w-full bg-[#86765a] text-white py-2 rounded-lg hover:bg-[#6d5e48] transition-colors">
                            Pesan Sekarang
                        </button>
                        <a href="https://wa.me/6282227110771?text=Halo, saya tertarik dengan Paket Prasmanan Platinum" 
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
                    <p class="text-gray-600">Minimal pemesanan untuk semua paket adalah 100 porsi</p>
                </div>
                <div class="bg-gray-50 p-6 rounded-lg">
                    <h3 class="font-semibold text-lg mb-3">Peralatan</h3>
                    <p class="text-gray-600">Semua peralatan prasmanan termasuk dalam paket (meja, piring, sendok, pemanas, dll)</p>
                </div>
                <div class="bg-gray-50 p-6 rounded-lg">
                    <h3 class="font-semibold text-lg mb-3">Kustomisasi Menu</h3>
                    <p class="text-gray-600">Menu dapat disesuaikan dengan kebutuhan acara Anda</p>
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
            id: 'prasmanan-' + id,
            name: name,
            price: price,
            category: 'Prasmanan',
            image: '{{ asset('foto/buffet.jpg') }}',
            minOrder: minOrder
        }
    }));
}
</script>
@endpush

@endsection