<!-- Informasi Pribadi Section -->
<div class="mb-8">
    <div class="flex items-center gap-2 mb-4">
        <div class="w-1 h-6 bg-gradient-to-b from-orange-500 to-amber-500 rounded-full"></div>
        <h3 class="text-lg font-semibold text-gray-800">Informasi Pribadi</h3>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div class="group">
            <label for="customer_name" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                Nama Lengkap *
            </label>
            <input type="text" name="customer_name" id="customer_name" value="{{ old('customer_name') }}"
                class="block w-full px-4 py-3 rounded-xl border-2 border-gray-200 shadow-sm focus:border-orange-400 focus:ring-2 focus:ring-orange-200 transition-all duration-200 @error('customer_name') border-red-400 @enderror"
                placeholder="Masukkan nama lengkap Anda" required>
            @error('customer_name')
            <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
                {{ $message }}
            </p>
            @enderror
        </div>

        <div class="group">
            <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                </svg>
                Nomor Telepon *
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <span class="text-gray-500 font-medium">+62</span>
                </div>
                <input type="tel" name="phone" id="phone" value="{{ old('phone') }}"
                    class="pl-16 block w-full px-4 py-3 rounded-xl border-2 border-gray-200 shadow-sm focus:border-orange-400 focus:ring-2 focus:ring-orange-200 transition-all duration-200 @error('phone') border-red-400 @enderror"
                    placeholder="812 3456 7890" pattern="[0-9]*" required>
            </div>
            @error('phone')
            <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
                {{ $message }}
            </p>
            @enderror
        </div>

        <div class="group md:col-span-2">
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                Alamat Email *
            </label>
            <input type="email" name="email" id="email" value="{{ old('email') }}"
                class="block w-full px-4 py-3 rounded-xl border-2 border-gray-200 shadow-sm focus:border-orange-400 focus:ring-2 focus:ring-orange-200 transition-all duration-200 @error('email') border-red-400 @enderror"
                placeholder="contoh@email.com" required>
            @error('email')
            <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
                {{ $message }}
            </p>
            @enderror
        </div>
    </div>
</div>