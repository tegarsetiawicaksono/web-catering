@extends('layouts.app')

@section('content')
<div class="min-h-screen pt-16 bg-gray-50">
    <!-- Header Section -->
    <div class="relative bg-gradient-to-r from-orange-500 to-amber-600 py-20">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="relative z-10 container mx-auto px-4">
            <h1 class="text-4xl md:text-5xl font-bold mb-4 text-white drop-shadow-lg text-center">Galeri Foto</h1>
            <p class="text-lg text-white/90 max-w-2xl mx-auto text-center drop-shadow-md">Lihat hasil catering kami untuk berbagai acara</p>
        </div>
    </div>

    <!-- Filter Section -->
    @php
        $normalizedSelectedCategory = in_array(request('category'), ['nasibox', 'nasi-box'], true)
            ? 'nasi-box'
            : request('category');
        $filterCategories = collect($categories ?? [])
            ->map(function ($category) {
                $category->filter_slug = in_array($category->slug, ['nasibox', 'nasi-box'], true)
                    ? 'nasi-box'
                    : $category->slug;

                return $category;
            })
            ->unique('filter_slug')
            ->values();
    @endphp
    <div class="bg-white border-b sticky top-16 z-40 shadow-sm">
        <div class="container mx-auto px-4 py-4">
            <div class="flex flex-wrap gap-3 justify-center">
                <a href="{{ route('gallery.index') }}" 
                   class="px-6 py-2 rounded-full font-medium transition-all {{ !$normalizedSelectedCategory ? 'bg-orange-500 text-white shadow-md' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    Semua
                </a>
                @foreach($filterCategories as $categoryItem)
                <a href="{{ route('gallery.index', ['category' => $categoryItem->filter_slug]) }}" 
                   class="px-6 py-2 rounded-full font-medium transition-all {{ $normalizedSelectedCategory === $categoryItem->filter_slug ? 'bg-orange-500 text-white shadow-md' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    {{ $categoryItem->nama }}
                </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Gallery Grid -->
    <div class="container mx-auto px-4 py-12">
        @if($galleries->isEmpty())
            <div class="text-center py-20">
                <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <h3 class="text-2xl font-semibold text-gray-700 mb-2">Belum Ada Foto</h3>
                <p class="text-gray-500">
                    @if(request('category'))
                        Belum ada foto untuk kategori {{ ucfirst(request('category')) }}
                    @else
                        Galeri foto belum tersedia
                    @endif
                </p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" 
                 x-data="{ 
                     selectedImage: null,
                     openLightbox(img, caption) {
                         this.selectedImage = { src: img, caption: caption };
                         document.body.style.overflow = 'hidden';
                     },
                     closeLightbox() {
                         this.selectedImage = null;
                         document.body.style.overflow = 'auto';
                     }
                 }">
                @foreach($galleries as $gallery)
                    @php
                        $categoryColors = [
                            'buffet' => 'bg-blue-500',
                            'tumpeng' => 'bg-green-500',
                            'nasibox' => 'bg-yellow-500',
                            'nasi-box' => 'bg-yellow-500',
                            'snack' => 'bg-pink-500',
                            'hampers' => 'bg-rose-500',
                        ];
                    @endphp
                    <div class="group relative overflow-hidden rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 bg-white cursor-pointer"
                        @click="openLightbox('{{ asset('storage/' . $gallery->path) }}?v={{ optional($gallery->updated_at)->timestamp }}', '{{ $gallery->caption }}')">
                        <div class="aspect-square overflow-hidden">
                           <img src="{{ asset('storage/' . $gallery->path) }}?v={{ optional($gallery->updated_at)->timestamp }}" 
                                 alt="{{ $gallery->caption }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        </div>
                        
                        <!-- Category Badge -->
                        <div class="absolute top-3 right-3">
                            <span class="inline-block px-3 py-1 text-xs font-semibold text-white {{ $categoryColors[$gallery->category] ?? 'bg-gray-500' }} rounded-full shadow-lg">
                                {{ ucfirst($gallery->category) }}
                            </span>
                        </div>
                        
                        <!-- Caption Overlay -->
                        @if($gallery->caption)
                        <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent p-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <p class="text-white text-sm font-medium">{{ $gallery->caption }}</p>
                        </div>
                        @endif

                        <!-- Zoom Icon -->
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-black/20">
                            <svg class="w-12 h-12 text-white drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7" />
                            </svg>
                        </div>
                    </div>
                @endforeach

                <!-- Lightbox Modal -->
                <div x-show="selectedImage" 
                     x-cloak
                     @click="closeLightbox()"
                     @keydown.escape.window="closeLightbox()"
                     class="fixed inset-0 z-50 flex items-center justify-center bg-black/90 p-4"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0">
                    
                    <!-- Close Button -->
                    <button @click="closeLightbox()" 
                            class="absolute top-4 right-4 text-white hover:text-gray-300 transition-colors z-60">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <!-- Image Container -->
                    <div class="max-w-5xl max-h-[90vh] relative" @click.stop>
                        <img :src="selectedImage?.src" 
                             :alt="selectedImage?.caption"
                             class="max-w-full max-h-[80vh] object-contain rounded-lg shadow-2xl">
                        <p x-show="selectedImage?.caption" 
                           x-text="selectedImage?.caption"
                           class="mt-4 text-center text-white text-lg"></p>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            @if($galleries->hasPages())
            <div class="mt-12">
                {{ $galleries->withQueryString()->links() }}
            </div>
            @endif
        @endif
    </div>
</div>

<style>
    [x-cloak] { display: none !important; }
</style>
@endsection
