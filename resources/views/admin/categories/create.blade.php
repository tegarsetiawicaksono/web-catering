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
                <h2 class="text-2xl font-bold text-gray-900">Tambah Kategori Baru</h2>
                <p class="mt-1 text-sm text-gray-600">Isi form di bawah untuk menambah kategori menu</p>

                <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="mt-6 space-y-6">
                    @csrf

                    <!-- Nama Kategori -->
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700">Nama Kategori *</label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('nama') border-red-300 @enderror"
                            placeholder="Contoh: Buffet, Tumpeng, Nasi Box">
                        <p class="mt-1 text-xs text-gray-500">Slug akan dibuat otomatis dari nama kategori</p>
                        @error('nama')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Gambar Upload -->
                    <div>
                        <label for="gambar" class="block text-sm font-medium text-gray-700">Gambar Kategori</label>
                        <div class="flex items-center mt-1">
                            <input type="file" name="gambar" id="gambar" accept="image/*"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 @error('gambar') border-red-300 @enderror"
                                onchange="previewImage(event)">
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Format: JPG, PNG, GIF (Max: 2MB). Gambar akan disimpan di folder foto/</p>
                        @error('gambar')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        
                        <!-- Preview -->
                        <div id="imagePreview" class="hidden mt-3">
                            <p class="text-sm text-gray-600 mb-2">Preview:</p>
                            <img id="preview" src="" alt="Preview" class="w-32 h-32 object-cover rounded-lg border-2 border-gray-300">
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
                        <div class="flex items-center mt-1">
                            <input type="file" name="gambar_background" id="gambar_background" accept="image/*"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 @error('gambar_background') border-red-300 @enderror"
                                onchange="previewBackground(event)">
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Background untuk halaman menu kategori ini. Format: JPG, PNG (Max: 2MB)</p>
                        <p class="mt-1 text-xs text-blue-600">💡 Ukuran rekomendasi: <strong>1920 x 500 px</strong> atau <strong>1920 x 600 px</strong> (landscape)</p>
                        @error('gambar_background')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        
                        <!-- Preview -->
                        <div id="backgroundPreview" class="hidden mt-3">
                            <p class="text-sm text-gray-600 mb-2">Preview Background:</p>
                            <img id="previewBackground" src="" alt="Preview" class="w-64 h-32 object-cover rounded-lg border-2 border-gray-300">
                        </div>
                    </div>

                    <!-- Harga Mulai -->
                    <div>
                        <label for="harga_mulai" class="block text-sm font-medium text-gray-700">Harga Mulai (Rp)</label>
                        <input type="number" name="harga_mulai" id="harga_mulai" value="{{ old('harga_mulai') }}" min="0" step="1000"
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
                            placeholder="Deskripsi singkat tentang kategori ini">{{ old('deskripsi') }}</textarea>
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
                            placeholder="35+ Menu Pilihan&#10;Termasuk Peralatan&#10;Gratis konsultasi menu">{{ old('fitur_unggulan') }}</textarea>
                        <p class="mt-1 text-xs text-gray-500">Tulis satu fitur per baris. Setiap baris akan ditampilkan dengan icon checklist ✓ di halaman utama.</p>
                        @error('fitur_unggulan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status Aktif -->
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input type="checkbox" name="is_active" id="is_active" value="1" 
                                {{ old('is_active', true) ? 'checked' : '' }}
                                class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="is_active" class="font-medium text-gray-700">Aktif</label>
                            <p class="text-gray-500">Kategori aktif akan ditampilkan di menu</p>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end pt-5 space-x-3 border-t border-gray-200">
                        <a href="{{ route('admin.categories.index') }}"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Batal
                        </a>
                        <button type="submit"
                            class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-lg shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Simpan Kategori
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
