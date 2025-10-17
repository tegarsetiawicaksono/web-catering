@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 pt-24">
    <!-- Hero Section -->
    <div class="relative h-[300px] overflow-hidden">
        <img src="{{ asset('foto/buffet.jpg') }}" alt="Snack Box" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/60"></div>
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Menu Snack Box</h1>
                <p class="text-lg text-white/90">Aneka snack untuk melengkapi acara anda</p>
            </div>
        </div>
    </div>

    <!-- Menu Categories -->
    <div class="container mx-auto px-4 py-12">
        <!-- Snack Box Premium -->
        <div class="mb-16">
            <h2 class="text-3xl font-bold text-[#86765a] mb-8">Snack Box Premium</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="relative h-48">
                        <img src="{{ asset('foto/rejosari.jpg') }}" alt="Snack Box Premium" class="w-full h-full object-cover">
                        <div class="absolute top-4 right-4 bg-[#86765a] text-white px-4 py-1 rounded-full">
                            Rp 25.000/box
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-4">Premium Box A</h3>
                        <div class="space-y-4">
                            <div>
                                <h4 class="font-medium text-[#86765a] mb-2">Isi Box</h4>
                                <ul class="list-disc list-inside text-gray-600 space-y-1">
                                    <li>Roti Croissant</li>
                                    <li>Lumpia</li>
                                    <li>Risoles</li>
                                    <li>Kue Sus</li>
                                    <li>Puding</li>
                                    <li>Air Mineral</li>
                                </ul>
                            </div>
                        </div>
                        <a href="https://wa.me/6282227110771?text=Halo%20Rejosari,%20saya%20tertarik%20dengan%20Snack%20Box%20Premium%20A" 
                           class="mt-6 block text-center bg-[#86765a] text-white py-2 px-4 rounded-lg hover:bg-[#86765a]/90 transition">
                            Pesan Sekarang
                        </a>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="relative h-48">
                        <img src="{{ asset('foto/rejosari.jpg') }}" alt="Snack Box Premium B" class="w-full h-full object-cover">
                        <div class="absolute top-4 right-4 bg-[#86765a] text-white px-4 py-1 rounded-full">
                            Rp 30.000/box
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-4">Premium Box B</h3>
                        <div class="space-y-4">
                            <div>
                                <h4 class="font-medium text-[#86765a] mb-2">Isi Box</h4>
                                <ul class="list-disc list-inside text-gray-600 space-y-1">
                                    <li>Mini Burger</li>
                                    <li>Spring Roll</li>
                                    <li>Sosis Solo</li>
                                    <li>Pie Buah</li>
                                    <li>Brownies</li>
                                    <li>Air Mineral</li>
                                </ul>
                            </div>
                        </div>
                        <a href="https://wa.me/6282227110771?text=Halo%20Rejosari,%20saya%20tertarik%20dengan%20Snack%20Box%20Premium%20B" 
                           class="mt-6 block text-center bg-[#86765a] text-white py-2 px-4 rounded-lg hover:bg-[#86765a]/90 transition">
                            Pesan Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Snack Box Standard -->
        <div class="mb-16">
            <h2 class="text-3xl font-bold text-[#86765a] mb-8">Snack Box Standard</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="relative h-48">
                        <img src="{{ asset('foto/rejosari.jpg') }}" alt="Snack Box Standard" class="w-full h-full object-cover">
                        <div class="absolute top-4 right-4 bg-[#86765a] text-white px-4 py-1 rounded-full">
                            Rp 15.000/box
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-4">Standard Box A</h3>
                        <div class="space-y-4">
                            <div>
                                <h4 class="font-medium text-[#86765a] mb-2">Isi Box</h4>
                                <ul class="list-disc list-inside text-gray-600 space-y-1">
                                    <li>Roti</li>
                                    <li>Kue Sus</li>
                                    <li>Risoles</li>
                                    <li>Air Mineral</li>
                                </ul>
                            </div>
                        </div>
                        <a href="https://wa.me/6282227110771?text=Halo%20Rejosari,%20saya%20tertarik%20dengan%20Snack%20Box%20Standard%20A" 
                           class="mt-6 block text-center bg-[#86765a] text-white py-2 px-4 rounded-lg hover:bg-[#86765a]/90 transition">
                            Pesan Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informasi Tambahan -->
        <div class="bg-white rounded-lg shadow-lg p-8">
            <h2 class="text-2xl font-bold text-[#86765a] mb-4">Informasi Penting</h2>
            <ul class="list-disc list-inside space-y-2 text-gray-600">
                <li>Minimal pemesanan 50 box</li>
                <li>Pemesanan minimal H-3 sebelum acara</li>
                <li>DP 50% saat pemesanan</li>
                <li>Free delivery untuk area Weleri (min. 100 box)</li>
                <li>Menu dapat disesuaikan dengan kebutuhan</li>
            </ul>
        </div>
    </div>
</div>
@endsection