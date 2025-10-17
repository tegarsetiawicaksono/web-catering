@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 pt-16">
    <!-- Header Section -->
    <div class="bg-[#86765a] text-white py-16">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl font-bold mb-4">Paket Tumpeng</h1>
            <p class="text-lg opacity-90">Tumpeng spesial untuk acara-acara penting Anda</p>
        </div>
    </div>

    <!-- Packages Grid -->
    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Tumpeng Mini -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="relative">
                    <img src="{{ asset('foto/tumpeng.jpg') }}" alt="Tumpeng Mini" class="w-full h-48 object-cover">
                    <div class="absolute top-4 right-4 bg-white text-[#86765a] px-4 py-1 rounded-full font-semibold">
                        Rp 350.000
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Tumpeng Mini</h3>
                    <p class="text-gray-600 mb-4">Cocok untuk 7-10 orang</p>
                    <div class="space-y-4">
                        <div>
                            <h4 class="font-medium text-[#86765a]">Menu</h4>
                            <ul class="mt-2 space-y-1 text-gray-600">
                                <li>• Nasi Kuning</li>
                                <li>• Ayam Goreng</li>
                                <li>• Telur Balado</li>
                                <li>• Mie Goreng</li>
                                <li>• Perkedel</li>
                                <li>• Kering Tempe</li>
                            </ul>
                        </div>
                    </div>
                    <div class="mt-6 space-y-3">
                        <button onclick="addToCart('mini', 'Tumpeng Mini', 350000, 1)" 
                                class="w-full bg-[#86765a] text-white py-2 rounded-lg hover:bg-[#6d5e48] transition-colors">
                            Pesan Sekarang
                        </button>
                        <a href="https://wa.me/6282227110771?text=Halo, saya tertarik dengan Tumpeng Mini" 
                           target="_blank"
                           class="w-full block text-center bg-green-500 text-white py-2 rounded-lg hover:bg-green-600 transition-colors">
                            Konsultasi via WhatsApp
                        </a>
                    </div>
                </div>
            </div>

            <!-- Tumpeng Sedang -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="relative">
                    <img src="{{ asset('foto/tumpeng.jpg') }}" alt="Tumpeng Sedang" class="w-full h-48 object-cover">
                    <div class="absolute top-4 right-4 bg-white text-[#86765a] px-4 py-1 rounded-full font-semibold">
                        Rp 500.000
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Tumpeng Sedang</h3>
                    <p class="text-gray-600 mb-4">Cocok untuk 15-20 orang</p>
                    <div class="space-y-4">
                        <div>
                            <h4 class="font-medium text-[#86765a]">Menu</h4>
                            <ul class="mt-2 space-y-1 text-gray-600">
                                <li>• Nasi Kuning</li>
                                <li>• Ayam Goreng</li>
                                <li>• Rendang Sapi</li>
                                <li>• Telur Balado</li>
                                <li>• Mie Goreng</li>
                                <li>• Perkedel</li>
                                <li>• Kering Tempe</li>
                                <li>• Urap Sayuran</li>
                            </ul>
                        </div>
                    </div>
                    <div class="mt-6 space-y-3">
                        <button onclick="addToCart('sedang', 'Tumpeng Sedang', 500000, 1)" 
                                class="w-full bg-[#86765a] text-white py-2 rounded-lg hover:bg-[#6d5e48] transition-colors">
                            Pesan Sekarang
                        </button>
                        <a href="https://wa.me/6282227110771?text=Halo, saya tertarik dengan Tumpeng Sedang" 
                           target="_blank"
                           class="w-full block text-center bg-green-500 text-white py-2 rounded-lg hover:bg-green-600 transition-colors">
                            Konsultasi via WhatsApp
                        </a>
                    </div>
                </div>
            </div>

            <!-- Tumpeng Besar -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="relative">
                    <img src="{{ asset('foto/tumpeng.jpg') }}" alt="Tumpeng Besar" class="w-full h-48 object-cover">
                    <div class="absolute top-4 right-4 bg-white text-[#86765a] px-4 py-1 rounded-full font-semibold">
                        Rp 750.000
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Tumpeng Besar</h3>
                    <p class="text-gray-600 mb-4">Cocok untuk 25-30 orang</p>
                    <div class="space-y-4">
                        <div>
                            <h4 class="font-medium text-[#86765a]">Menu</h4>
                            <ul class="mt-2 space-y-1 text-gray-600">
                                <li>• Nasi Kuning</li>
                                <li>• Ayam Goreng</li>
                                <li>• Rendang Sapi</li>
                                <li>• Telur Balado</li>
                                <li>• Mie Goreng</li>
                                <li>• Perkedel</li>
                                <li>• Kering Tempe</li>
                                <li>• Urap Sayuran</li>
                                <li>• Sambal Goreng Ati</li>
                                <li>• Acar Kuning</li>
                            </ul>
                        </div>
                    </div>
                    <div class="mt-6 space-y-3">
                        <button onclick="addToCart('besar', 'Tumpeng Besar', 750000, 1)" 
                                class="w-full bg-[#86765a] text-white py-2 rounded-lg hover:bg-[#6d5e48] transition-colors">
                            Pesan Sekarang
                        </button>
                        <a href="https://wa.me/6282227110771?text=Halo, saya tertarik dengan Tumpeng Besar" 
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
                    <h3 class="font-semibold text-lg mb-3">Pemesanan</h3>
                    <p class="text-gray-600">Pemesanan minimal H-3 sebelum acara</p>
                </div>
                <div class="bg-gray-50 p-6 rounded-lg">
                    <h3 class="font-semibold text-lg mb-3">Pengantaran</h3>
                    <p class="text-gray-600">Gratis pengantaran untuk area Surabaya</p>
                </div>
                <div class="bg-gray-50 p-6 rounded-lg">
                    <h3 class="font-semibold text-lg mb-3">Kustomisasi</h3>
                    <p class="text-gray-600">Menu dapat disesuaikan sesuai permintaan</p>
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
            id: 'tumpeng-' + id,
            name: name,
            price: price,
            category: 'Tumpeng',
            image: '{{ asset('foto/tumpeng.jpg') }}',
            minOrder: minOrder
        }
    }));
}
</script>
@endpush

@endsection