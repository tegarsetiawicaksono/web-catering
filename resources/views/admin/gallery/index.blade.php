<x-admin-layout>
    <div class="mb-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Galeri Foto</h1>
                <p class="text-gray-600 mt-1">Kelola foto-foto untuk setiap kategori menu</p>
            </div>
            <a href="{{ route('admin.gallery.create') }}" 
               class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Foto
            </a>
        </div>
    </div>

    <!-- Filter Form -->
    <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
        <form method="GET" class="flex flex-wrap gap-3 items-end">
            <div class="flex-1 min-w-[200px]">
                <label class="block text-sm font-medium text-gray-700 mb-2">Filter Kategori</label>
                <select name="category" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->slug }}" @selected(request('category')==$category->slug)>{{ $category->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition-colors">
                    Filter
                </button>
                @if(request('category'))
                    <a href="{{ route('admin.gallery.index') }}" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg transition-colors">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Gallery Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($galleries as $gallery)
            <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow group">
                <div class="relative aspect-video overflow-hidden bg-gray-100">
                    <img src="{{ asset('storage/'.$gallery->path) }}?v={{ optional($gallery->updated_at)->timestamp }}" 
                         alt="{{ $gallery->caption }}" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    <div class="absolute top-2 right-2">
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
                        <span class="inline-block px-3 py-1 text-xs font-semibold text-white {{ $categoryColors[$gallery->category] ?? 'bg-gray-500' }} rounded-full">
                            {{ ucfirst($gallery->category) }}
                        </span>
                    </div>
                </div>
                <div class="p-4">
                    <p class="text-sm text-gray-600 mb-3 line-clamp-2 min-h-[40px]">
                        {{ $gallery->caption ?: 'Tidak ada caption' }}
                    </p>
                    <div class="flex gap-2">
                        <a href="{{ route('admin.gallery.edit', $gallery) }}" 
                           class="flex-1 text-center px-3 py-2 bg-blue-50 hover:bg-blue-100 text-blue-700 text-sm font-medium rounded-lg transition-colors">
                            Edit
                        </a>
                        <form action="{{ route('admin.gallery.destroy', $gallery) }}" 
                              method="POST" 
                              onsubmit="return confirm('Yakin ingin menghapus foto ini?')"
                              class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="w-full px-3 py-2 bg-red-50 hover:bg-red-100 text-red-700 text-sm font-medium rounded-lg transition-colors">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full">
                <div class="bg-white rounded-lg shadow-sm p-12 text-center">
                    <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Foto</h3>
                    <p class="text-gray-500 mb-4">Mulai tambahkan foto untuk galeri Anda</p>
                    <a href="{{ route('admin.gallery.create') }}" 
                       class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Foto
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($galleries->hasPages())
        <div class="mt-6">
            {{ $galleries->withQueryString()->links() }}
        </div>
    @endif
</x-admin-layout>
