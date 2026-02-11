<x-admin-layout>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Edit Foto Galeri</h1>
        <p class="text-gray-600 mt-1">Perbarui informasi dan foto galeri</p>
    </div>

    <div class="max-w-2xl">
        <div class="bg-white rounded-lg shadow-sm p-6">
            <form action="{{ route('admin.gallery.update', $gallery) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')
                
                <!-- Category Selection -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Kategori <span class="text-red-500">*</span>
                    </label>
                    <select name="category" 
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('category') border-red-500 @enderror" 
                            required>
                        <option value="buffet" @selected($gallery->category=='buffet')>Buffet</option>
                        <option value="tumpeng" @selected($gallery->category=='tumpeng')>Tumpeng</option>
                        <option value="nasibox" @selected($gallery->category=='nasibox')>Nasi Box</option>
                        <option value="snack" @selected($gallery->category=='snack')>Snack</option>
                    </select>
                    @error('category')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Current Photo -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Foto Saat Ini</label>
                    <div class="relative aspect-video w-full max-w-md bg-gray-100 rounded-lg overflow-hidden">
                        <img src="{{ asset('storage/'.$gallery->path) }}" 
                             alt="Current photo" 
                             class="w-full h-full object-cover">
                    </div>
                </div>

                <!-- Photo Upload (Optional) -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Ganti Foto (Opsional)
                    </label>
                    <div class="flex items-center justify-center w-full">
                        <label for="photo-upload" class="flex flex-col items-center justify-center w-full h-48 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6" id="upload-placeholder">
                                <svg class="w-8 h-8 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Klik untuk upload foto baru</span></p>
                                <p class="text-xs text-gray-500">PNG, JPG, JPEG, GIF (MAX. 2MB)</p>
                            </div>
                            <img id="preview-image" class="hidden w-full h-full object-contain rounded-lg p-2" />
                            <input id="photo-upload" 
                                   type="file" 
                                   name="photo" 
                                   accept="image/*" 
                                   class="hidden"
                                   onchange="previewImage(event)">
                        </label>
                    </div>
                    @error('photo')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-2 text-xs text-gray-500">Biarkan kosong jika tidak ingin mengubah foto</p>
                </div>

                <!-- Caption -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Caption/Deskripsi
                    </label>
                    <input type="text" 
                           name="caption" 
                           value="{{ old('caption', $gallery->caption) }}"
                           maxlength="255"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('caption') border-red-500 @enderror" 
                           placeholder="Masukkan caption untuk foto (opsional)">
                    @error('caption')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-3 pt-4 border-t border-gray-200">
                    <button type="submit" 
                            class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                        Update Foto
                    </button>
                    <a href="{{ route('admin.gallery.index') }}" 
                       class="px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition-colors">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('preview-image');
            const placeholder = document.getElementById('upload-placeholder');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-admin-layout>
