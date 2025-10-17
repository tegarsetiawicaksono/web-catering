<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    @foreach($packages as $package)
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="relative">
            <img src="{{ $package['image'] }}" alt="{{ $package['name'] }}" class="w-full h-48 object-cover">
            <div class="absolute top-4 right-4 bg-white text-[#86765a] px-4 py-1 rounded-full font-semibold">
                {{ 'Rp ' . number_format($package['price'], 0, ',', '.') }}/pax
            </div>
        </div>
        <div class="p-6">
            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $package['name'] }}</h3>
            <p class="text-gray-600 mb-4">{{ $package['description'] }}</p>
            
            @if(isset($package['items']))
            <div class="space-y-4">
                @foreach($package['items'] as $category => $items)
                <div>
                    <h4 class="font-medium text-[#86765a]">{{ $category }}</h4>
                    <ul class="mt-2 space-y-1 text-gray-600">
                        @foreach($items as $item)
                        <li>• {{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
                @endforeach
            </div>
            @endif

            <div class="mt-6 space-y-3">
                <button x-on:click="$store.cart.add('{{ $package['id'] }}', '{{ $package['name'] }}', {{ $package['price'] }}, {{ $package['minOrder'] ?? 50 }})"
                        class="w-full bg-[#86765a] text-white py-2 rounded-lg hover:bg-[#6d5e48] transition-colors">
                    Pesan Sekarang
                </button>
                <a href="https://wa.me/6282227110771?text=Halo, saya tertarik dengan {{ $package['name'] }}" 
                   target="_blank"
                   class="w-full block text-center bg-green-500 text-white py-2 rounded-lg hover:bg-green-600 transition-colors">
                    Konsultasi via WhatsApp
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>