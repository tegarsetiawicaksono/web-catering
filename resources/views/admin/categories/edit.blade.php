<x-admin-layout>
    <div class="max-w-3xl p-4 mx-auto sm:p-6 lg:p-8">
        <div class="mb-6">
            <a href="{{ route('admin.categories.index') }}" class="inline-flex items-center text-sm text-indigo-600 hover:text-indigo-700">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke List Kategori
            </a>
        </div>

        <div class="overflow-hidden bg-white rounded-lg shadow">
            <div class="px-4 py-5 sm:p-6">
                <h2 class="text-2xl font-bold text-gray-900">Edit Kategori</h2>
                <p class="mt-1 text-sm text-gray-600">Update informasi kategori menu</p>

                <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data" class="mt-6 space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Nama Kategori -->
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700">Nama Kategori *</label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama', $category->nama) }}" required
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('nama') border-red-300 @enderror"
                            placeholder="Contoh: Buffet, Tumpeng, Nasi Box">
                        <p class="mt-1 text-xs text-gray-500">Slug akan diperbarui otomatis dari nama kategori</p>
                        @error('nama')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Slug (Read Only) -->
                    <div>
                        <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                        <input type="text" id="slug" value="{{ $category->slug }}" disabled
                            class="block w-full px-3 py-2 mt-1 bg-gray-100 border border-gray-300 rounded-lg shadow-sm sm:text-sm text-gray-500">
                        <p class="mt-1 text-xs text-gray-500">Slug saat ini (akan diperbarui otomatis saat nama diubah)</p>
                    </div>

                    <!-- Gambar Upload -->
                    <div>
                        <label for="gambar" class="block text-sm font-medium text-gray-700">Gambar Kategori</label>

                        @if($category->gambar_url)
                        <div class="mt-2 mb-3">
                            <p class="mb-2 text-sm text-gray-600">Gambar saat ini:</p>
                            <img src="{{ asset($category->gambar_url) }}" alt="{{ $category->nama }}"
                                class="object-cover w-32 h-32 rounded-lg border-2 border-gray-300">
                        </div>
                        @endif

                        <div class="flex items-center mt-1">
                            <input type="file" name="gambar" id="gambar" accept="image/*"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 @error('gambar') border-red-300 @enderror"
                                onchange="previewImage(event)">
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Format: JPG, PNG, GIF (Max: 2MB). Kosongkan jika tidak ingin mengubah gambar.</p>
                        @error('gambar')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        
                        <!-- Preview -->
                        <div id="imagePreview" class="hidden mt-3">
                            <p class="text-sm text-gray-600 mb-2">Preview gambar baru:</p>
                            <img id="preview" src="" alt="Preview" class="w-32 h-32 object-cover rounded-lg border-2 border-indigo-500">
                        </div>
                    </div>

                    <script>
                    function previewImage(event) {
                        const preview = document.getElementById('preview');
                        const previewContainer = document.getElementById('imagePreview');
                        const file = event.target.files[0];
                        
                        if (file) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                preview.src = e.target.result;
                                previewContainer.classList.remove('hidden');
                            }
                            reader.readAsDataURL(file);
                        } else {
                            previewContainer.classList.add('hidden');
                        }
                    }

                    function previewBackground(event) {
                        const preview = document.getElementById('previewBackground');
                        const previewContainer = document.getElementById('backgroundPreview');
                        const file = event.target.files[0];
                        
                        if (file) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                preview.src = e.target.result;
                                previewContainer.classList.remove('hidden');
                            }
                            reader.readAsDataURL(file);
                        } else {
                            previewContainer.classList.add('hidden');
                        }
                    }
                    </script>

                    <!-- Gambar Background Upload -->
                    <div>
                        <label for="gambar_background" class="block text-sm font-medium text-gray-700">Gambar Background Halaman Menu</label>

                        @if($category->gambar_background)
                        <div class="mt-2 mb-3">
                            <p class="mb-2 text-sm text-gray-600">Background saat ini:</p>
                            <img src="{{ asset($category->gambar_background) }}" alt="Background"
                                class="object-cover w-64 h-32 rounded-lg border-2 border-gray-300">
                        </div>
                        @endif

                        <div class="flex items-center mt-1">
                            <input type="file" name="gambar_background" id="gambar_background" accept="image/*"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 @error('gambar_background') border-red-300 @enderror"
                                onchange="previewBackground(event)">
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Background untuk halaman menu kategori ini. Format: JPG, PNG (Max: 2MB). Kosongkan jika tidak ingin mengubah.</p>
                        <p class="mt-1 text-xs text-blue-600">💡 Ukuran rekomendasi: <strong>1920 x 500 px</strong> atau <strong>1920 x 600 px</strong> (landscape)</p>
                        @error('gambar_background')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        
                        <!-- Preview -->
                        <div id="backgroundPreview" class="hidden mt-3">
                            <p class="text-sm text-gray-600 mb-2">Preview background baru:</p>
                            <img id="previewBackground" src="" alt="Preview" class="w-64 h-32 object-cover rounded-lg border-2 border-purple-500">
                        </div>
                    </div>

                    <!-- Harga Mulai -->
                    <div>
                        <label for="harga_mulai" class="block text-sm font-medium text-gray-700">Harga Mulai (Rp)</label>
                        <input type="number" name="harga_mulai" id="harga_mulai" value="{{ old('harga_mulai', $category->harga_mulai) }}" min="0" step="1000"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('harga_mulai') border-red-300 @enderror"
                            placeholder="30000">
                        <p class="mt-1 text-xs text-gray-500">Harga mulai yang akan ditampilkan di halaman utama</p>
                        @error('harga_mulai')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi Kategori</label>
                        <textarea name="deskripsi" id="deskripsi" rows="3"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('deskripsi') border-red-300 @enderror"
                            placeholder="Deskripsi singkat tentang kategori ini">{{ old('deskripsi', $category->deskripsi) }}</textarea>
                        <p class="mt-1 text-xs text-gray-500">Deskripsi umum kategori (opsional)</p>
                        @error('deskripsi')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Fitur Unggulan -->
                    <div>
                        <label for="fitur_unggulan" class="block text-sm font-medium text-gray-700">Fitur Unggulan</label>
                        <textarea name="fitur_unggulan" id="fitur_unggulan" rows="4"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('fitur_unggulan') border-red-300 @enderror"
                            placeholder="35+ Menu Pilihan&#10;Termasuk Peralatan&#10;Gratis konsultasi menu">{{ old('fitur_unggulan', $category->fitur_unggulan) }}</textarea>
                        <p class="mt-1 text-xs text-gray-500">Tulis satu fitur per baris. Setiap baris akan ditampilkan dengan icon checklist ✓ di halaman utama.</p>
                        @error('fitur_unggulan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status Aktif -->
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input type="checkbox" name="is_active" id="is_active" value="1" 
                                {{ old('is_active', $category->is_active) ? 'checked' : '' }}
                                class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="is_active" class="font-medium text-gray-700">Aktif</label>
                            <p class="text-gray-500">Kategori aktif akan ditampilkan di menu</p>
                        </div>
                    </div>

                    <!-- Info Menu yang Menggunakan Kategori Ini -->
                    @php
                        $menusCount = $category->menus()->count();
                    @endphp
                    @if($menusCount > 0)
                    <div class="p-4 bg-blue-50 border border-blue-200 rounded-lg">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-blue-400 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                            </svg>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-blue-800">Informasi</h3>
                                <div class="mt-1 text-sm text-blue-700">
                                    Kategori ini digunakan oleh <strong>{{ $menusCount }} menu</strong>. 
                                    Perubahan slug akan mempengaruhi menu yang menggunakan kategori ini.
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Buttons -->
                    <div class="flex justify-end pt-5 space-x-3 border-t border-gray-200">
                        <a href="{{ route('admin.categories.index') }}"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Batal
                        </a>
                        <button type="submit"
                            class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-lg shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Update Kategori
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
