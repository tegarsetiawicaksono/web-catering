<!-- Alamat Section -->
<div>
    <div class="flex items-center gap-2 mb-4">
        <div class="w-1 h-6 bg-gradient-to-b from-orange-500 to-amber-500 rounded-full"></div>
        <h3 class="text-lg font-semibold text-gray-800">Lokasi Acara</h3>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-5">
        <div class="group">
            <label for="province" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Provinsi *
            </label>
            <div class="relative">
                <input type="text" name="province" id="province" value="Jawa Tengah" readonly
                    class="block w-full px-4 py-3 rounded-xl border-2 border-gray-200 bg-gradient-to-br from-gray-50 to-gray-100 shadow-sm cursor-not-allowed font-medium text-gray-700"
                    required>
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
            </div>
            <p class="mt-2 text-xs text-amber-600 flex items-center gap-1 font-medium">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                </svg>
                Layanan khusus Kabupaten Kendal dan Sekitarnya
            </p>
        </div>

        <div class="group">
            <label for="city" class="block text-sm font-semibold text-gray-700 mb-2">Kabupaten *</label>
            <input type="text" name="city" id="city" value="{{ old('city') }}"
                class="block w-full px-4 py-3 rounded-xl border-2 border-gray-200 shadow-sm focus:border-orange-400 focus:ring-2 focus:ring-orange-200 transition-all duration-200 @error('city') border-red-400 @enderror"
                placeholder="Contoh: Kab. Kendal" required>
            @error('city')
            <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
                {{ $message }}
            </p>
            @enderror
        </div>

        <div class="group">
            <label for="district" class="block text-sm font-semibold text-gray-700 mb-2">Kecamatan *</label>
            <input type="text" name="district" id="district" value="{{ old('district') }}"
                class="block w-full px-4 py-3 rounded-xl border-2 border-gray-200 shadow-sm focus:border-orange-400 focus:ring-2 focus:ring-orange-200 transition-all duration-200 @error('district') border-red-400 @enderror"
                placeholder="Contoh: Weleri" required>
            @error('district')
            <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
                {{ $message }}
            </p>
            @enderror
        </div>
    </div>

    <div class="group">
        <label for="street_address" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
            <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </svg>
            Alamat Lengkap *
        </label>
        <textarea name="street_address" id="street_address" rows="4"
            class="block w-full px-4 py-3 rounded-xl border-2 border-gray-200 shadow-sm focus:border-orange-400 focus:ring-2 focus:ring-orange-200 transition-all duration-200 @error('street_address') border-red-400 @enderror"
            placeholder="Contoh: Jl. Merdeka No. 123, RT 02/RW 05, Dekat Indomaret" required>{{ old('street_address') }}</textarea>
        @error('street_address')
        <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
            {{ $message }}
        </p>
        @enderror
    </div>
</div>