<x-admin-layout>
    <div class="max-w-3xl p-4 mx-auto sm:p-6 lg:p-8">
        <div class="mb-6">
            <a href="{{ route('admin.menus.index') }}" class="inline-flex items-center text-sm text-indigo-600 hover:text-indigo-700">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke List Menu
            </a>
        </div>

        <div class="overflow-hidden bg-white rounded-lg shadow">
            <div class="px-4 py-5 sm:p-6">
                <h2 class="text-2xl font-bold text-gray-900">Edit Menu</h2>
                <p class="mt-1 text-sm text-gray-600">Update informasi menu catering</p>

                <form action="{{ route('admin.menus.update', $menu) }}" method="POST" enctype="multipart/form-data" class="mt-6 space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Nama Menu -->
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700">Nama Menu *</label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama', $menu->nama) }}" required
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('nama') border-red-300 @enderror">
                        @error('nama')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label for="kategori" class="block text-sm font-medium text-gray-700">Kategori *</label>
                        <select name="kategori" id="kategori" required
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('kategori') border-red-300 @enderror">
                            <option value="">Pilih Kategori</option>
                            <option value="buffet" {{ old('kategori', $menu->kategori) === 'buffet' ? 'selected' : '' }}>Buffet</option>
                            <option value="tumpeng" {{ old('kategori', $menu->kategori) === 'tumpeng' ? 'selected' : '' }}>Tumpeng</option>
                            <option value="nasibox" {{ old('kategori', $menu->kategori) === 'nasibox' ? 'selected' : '' }}>Nasi Box</option>
                            <option value="snack" {{ old('kategori', $menu->kategori) === 'snack' ? 'selected' : '' }}>Snack</option>
                        </select>
                        @error('kategori')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi *</label>
                        <textarea name="deskripsi" id="deskripsi" rows="4" required
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('deskripsi') border-red-300 @enderror">{{ old('deskripsi', $menu->deskripsi) }}</textarea>
                        @error('deskripsi')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Harga & Min Order -->
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div>
                            <label for="harga" class="block text-sm font-medium text-gray-700">Harga (Rp) *</label>
                            <input type="number" name="harga" id="harga" value="{{ old('harga', $menu->harga) }}" min="0" step="1000" required
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('harga') border-red-300 @enderror">
                            @error('harga')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="min_order" class="block text-sm font-medium text-gray-700">Minimum Order (porsi) *</label>
                            <input type="number" name="min_order" id="min_order" value="{{ old('min_order', $menu->min_order) }}" min="1" required
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('min_order') border-red-300 @enderror">
                            @error('min_order')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Gambar -->
                    <div>
                        <label for="gambar" class="block text-sm font-medium text-gray-700">Gambar Menu</label>

                        @if($menu->gambar)
                        <div class="mt-2 mb-3">
                            <p class="mb-2 text-sm text-gray-600">Gambar saat ini:</p>
                            <img src="{{ asset('foto/' . $menu->gambar) }}" alt="{{ $menu->nama }}"
                                class="object-cover w-32 h-32 rounded-lg">
                        </div>
                        @endif

                        <div class="flex items-center mt-1">
                            <input type="file" name="gambar" id="gambar" accept="image/*"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 @error('gambar') border-red-300 @enderror">
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Format: JPG, PNG, GIF (Max: 2MB). Kosongkan jika tidak ingin mengubah gambar.</p>
                        @error('gambar')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end pt-5 space-x-3 border-t border-gray-200">
                        <a href="{{ route('admin.menus.index') }}"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Batal
                        </a>
                        <button type="submit"
                            class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-lg shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Update Menu
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>