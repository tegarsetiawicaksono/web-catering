@props(['name', 'price', 'minOrder', 'image' => null])

<div class="mb-8 bg-white rounded-2xl shadow-xl overflow-hidden border border-orange-200">
    <!-- Header -->
    <div class="bg-gradient-to-r from-orange-500 to-amber-500 px-6 py-4">
        <div class="flex items-center gap-3">
            @if($image)
            <div class="w-16 h-16 rounded-xl overflow-hidden border-2 border-white/30 flex-shrink-0">
                <img src="{{ asset('foto/' . $image) }}" alt="{{ $name }}" class="w-full h-full object-cover">
            </div>
            @else
            <div class="bg-white/20 backdrop-blur-sm p-3 rounded-xl">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
                </svg>
            </div>
            @endif
            <div>
                <h2 class="text-xl md:text-2xl font-bold text-white">{{ $name }}</h2>
                <p class="text-orange-100 text-sm">Paket Catering Premium</p>
            </div>
        </div>
    </div>

    <!-- Package Description -->
    <div class="px-4 md:px-6 py-4 border-t border-gray-200">
        @php
        $packageDescriptions = config('packages');
        $currentPackage = $packageDescriptions[$name] ?? null;
        @endphp

        @if($currentPackage)
        <div class="mb-4">
            <h3 class="text-lg font-bold text-gray-900 mb-3 flex items-center gap-2">
                <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                </svg>
                Isi Paket
            </h3>
            @foreach($currentPackage['sections'] as $sectionName => $items)
            <div class="mb-3">
                <h4 class="font-semibold text-gray-800 mb-1 text-sm">{{ $sectionName }}</h4>
                @foreach($items as $item)
                <div class="flex items-center gap-2 text-sm text-gray-700 ml-2">
                    <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <span>• {{ $item }}</span>
                </div>
                @endforeach
            </div>
            @endforeach
        </div>
        @endif
    </div>

    <!-- Package Price Info -->
    <div class="px-4 md:px-6 pb-6">
        <div class="bg-gradient-to-br from-orange-50 to-amber-50 rounded-xl p-4 border border-orange-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Harga per porsi</p>
                    <p class="text-2xl font-bold text-orange-600">Rp {{ number_format($price, 0, ',', '.') }}</p>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-600">Minimum Order</p>
                    <p class="text-xl font-bold text-gray-900">{{ $minOrder }} porsi</p>
                </div>
            </div>
        </div>
    </div>
</div>