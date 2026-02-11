<x-guest-layout>
    <div class="min-h-screen flex flex-col lg:flex-row bg-white">
        <!-- Left Side - Image -->
        <div class="hidden lg:block lg:w-1/2 relative overflow-hidden bg-gradient-to-br from-[#FDF1E7] to-[#FFF5ED]">
            <!-- Background Layer -->
            <div class="absolute inset-0 z-0">
                <!-- Background Circles -->
                <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-[#943E51] rounded-full filter blur-[100px] opacity-10 -mr-48 -mt-48"></div>
                <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-[#943E51] rounded-full filter blur-[100px] opacity-10 -ml-48 -mb-48"></div>

                <!-- Small Dots Pattern -->
                <div class="absolute inset-0 bg-repeat opacity-5"
                    style="background-size: 24px 24px; background-image: radial-gradient(#943E51 0.5px, transparent 0.5px);">
                </div>

                <!-- Additional decorative elements -->
                <div class="absolute top-8 right-8">
                    <div class="w-4 h-4 flex gap-1">
                        <div class="w-1 h-1 rounded-full bg-[#943E51] opacity-40"></div>
                        <div class="w-1 h-1 rounded-full bg-[#943E51] opacity-40"></div>
                        <div class="w-1 h-1 rounded-full bg-[#943E51] opacity-40"></div>
                        <div class="w-1 h-1 rounded-full bg-[#943E51] opacity-40"></div>
                    </div>
                </div>
            </div>

            <!-- Center Logo - Higher Z-Index -->
            <div class="absolute inset-0 flex items-center justify-center z-50">
                <div class="relative w-[450px] h-[450px] rounded-full flex items-center justify-center">
                    <!-- White Circle Background -->
                    <div class="absolute inset-0 bg-white rounded-full shadow-2xl"></div>
                    <!-- Gradient Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-br from-white via-[#FDF1E7]/30 to-[#FFF5ED]/50 rounded-full"></div>
                    <!-- Inner Shadow -->
                    <div class="absolute inset-0 rounded-full shadow-inner"></div>
                    <!-- Logo Image -->
                    <img src="{{ asset('foto/logo.jpeg') }}" alt="RS Logo"
                        class="relative w-[440px] h-[440px] object-cover rounded-full z-10 ring-4 ring-white/80 shadow-lg">
                    <!-- Glow Effect -->
                    <div class="absolute -inset-6 bg-white/40 rounded-full blur-3xl -z-10"></div>
                </div>
            </div>
        </div>

        <!-- Right Side - Reset Password Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 lg:p-16 bg-white">
            <div class="w-full max-w-[420px] bg-white">
                <div class="text-center mb-10">
                    <div class="bg-white py-4 lg:hidden">
                        <img src="{{ asset('foto/logo.jpeg') }}" alt="RS Logo" class="h-20 mx-auto mb-6">
                    </div>
                    <div class="mb-6">
                        <div class="w-16 h-16 bg-[#943E51]/10 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-[#943E51]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                            </svg>
                        </div>
                        <h1 class="text-3xl font-playfair font-bold text-gray-800 mb-2">Reset Password</h1>
                        <p class="text-gray-600 text-sm">Masukkan password baru untuk akun Anda</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
                    @csrf

                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email Address (readonly) -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <x-text-input id="email" 
                                class="block w-full pl-10 px-4 py-3 rounded-lg border border-gray-300 bg-gray-50 focus:border-[#943E51] focus:ring-[#943E51] text-sm" 
                                type="email" 
                                name="email" 
                                :value="old('email', $request->email)" 
                                required 
                                readonly 
                                autocomplete="username" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div x-data="{ showPassword: false }">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            Password Baru <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <x-text-input id="password" 
                                class="block w-full pl-10 pr-10 px-4 py-3 rounded-lg border border-gray-300 focus:border-[#943E51] focus:ring-[#943E51] text-sm placeholder-gray-500" 
                                x-bind:type="showPassword ? 'text' : 'password'" 
                                name="password" 
                                required 
                                placeholder="Masukkan password baru"
                                autocomplete="new-password" />
                            <button type="button" @click="showPassword = !showPassword" 
                                class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600">
                                <svg x-show="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg x-show="showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                </svg>
                            </button>
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Minimal 8 karakter</p>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div x-data="{ showPassword: false }">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                            Konfirmasi Password <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <x-text-input id="password_confirmation" 
                                class="block w-full pl-10 pr-10 px-4 py-3 rounded-lg border border-gray-300 focus:border-[#943E51] focus:ring-[#943E51] text-sm placeholder-gray-500"
                                x-bind:type="showPassword ? 'text' : 'password'"
                                name="password_confirmation" 
                                required 
                                placeholder="Ulangi password baru"
                                autocomplete="new-password" />
                            <button type="button" @click="showPassword = !showPassword" 
                                class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600">
                                <svg x-show="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg x-show="showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                </svg>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                        class="w-full py-3 mt-6 bg-[#943E51] text-white text-sm font-semibold rounded-lg
                        hover:bg-[#7e334d] focus:outline-none focus:ring-2 focus:ring-[#943E51] focus:ring-offset-2
                        transition-colors duration-200 flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Reset Password
                    </button>
                </form>

                <!-- Back to Login Link -->
                <div class="text-center mt-8">
                    <a href="{{ route('login') }}" 
                        class="inline-flex items-center text-[#943E51] hover:text-[#7e334d] text-sm font-semibold hover:underline">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali ke Halaman Login
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
