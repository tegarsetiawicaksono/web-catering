<x-guest-layout>
    <div class="min-h-screen flex flex-col lg:flex-row bg-white">
        <!-- Left Side - Image -->
        <div class="hidden lg:block lg:w-1/2 relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-[#FDF1E7] to-[#FFF5ED]">
                <!-- Background Circles -->
                <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-[#943E51] rounded-full filter blur-[80px] opacity-10 -mr-48 -mt-48"></div>
                <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-[#943E51] rounded-full filter blur-[80px] opacity-10 -ml-48 -mb-48"></div>
                
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
            
            <!-- Center Logo -->
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="relative w-[400px] h-[400px] bg-white rounded-full p-10 shadow-xl
                     flex items-center justify-center transform hover:scale-105 transition-all duration-500">
                    <div class="absolute inset-0 bg-gradient-to-br from-white to-[#FDF1E7] rounded-full opacity-60"></div>
                    <div class="absolute inset-0 rounded-full shadow-inner"></div>
                    <img src="{{ asset('foto/rejosari.jpg') }}" alt="RS Logo" 
                         class="w-[380px] h-[380px] object-cover rounded-full relative z-10">
                    <div class="absolute -inset-3 bg-white/30 rounded-full blur-xl"></div>
                </div>
            </div>
        </div>

        <!-- Right Side - Register Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 lg:p-16 bg-white">
            <div class="w-full max-w-[420px] bg-white">
                <div class="text-center mb-10">
                    <div class="bg-white py-4 lg:hidden">
                        <img src="{{ asset('foto/rejosari.jpg') }}" alt="RS Logo" class="h-20 mx-auto mb-6">
                        <h1 class="text-3xl font-playfair font-bold text-gray-800">Daftar Akun</h1>
                    </div>
                    <h1 class="text-3xl font-playfair font-bold text-gray-800 mb-4 hidden lg:block">Daftar Akun</h1>
                </div>

                <!-- Register dengan Google -->
                <a href="{{ route('google.redirect') }}" 
                    class="flex items-center justify-center w-full px-6 py-3 mb-6 border border-gray-300 rounded-lg
                    hover:bg-gray-50 transition-colors duration-200 bg-white">
                    <img src="https://www.google.com/favicon.ico" alt="Google" class="w-5 h-5 mr-3">
                    <span class="text-gray-700 text-sm">Lanjutkan dengan Google</span>
                </a>

                <!-- Divider -->
                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-200"></div>
                    </div>
                    <div class="relative flex justify-center text-xs">
                        <span class="px-4 bg-white text-gray-500">atau Daftar dengan Email</span>
                    </div>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <!-- Name -->
                    <div>
                        <x-text-input id="name" 
                            class="block w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#943E51] focus:ring-[#943E51] 
                            text-sm placeholder-gray-500"
                            type="text"
                            name="name"
                            :value="old('name')"
                            required
                            placeholder="Nama Lengkap"
                            autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-1" />
                    </div>

                    <!-- Phone -->
                    <div>
                        <x-text-input id="phone" 
                            class="block w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#943E51] focus:ring-[#943E51] 
                            text-sm placeholder-gray-500"
                            type="tel"
                            name="phone"
                            :value="old('phone')"
                            required
                            placeholder="Nomor Telepon" />
                        <x-input-error :messages="$errors->get('phone')" class="mt-1" />
                    </div>

                    <!-- Email Address -->
                    <div>
                        <x-text-input id="email" 
                            class="block w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#943E51] focus:ring-[#943E51] 
                            text-sm placeholder-gray-500"
                            type="email"
                            name="email"
                            :value="old('email')"
                            required
                            placeholder="Email"
                            autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    <!-- Password -->
                    <div x-data="{ showPassword: false }">
                        <div class="relative">
                            <x-text-input id="password" 
                                class="block w-full px-4 py-3 pr-10 rounded-lg border border-gray-300 focus:border-[#943E51] focus:ring-[#943E51] 
                                text-sm placeholder-gray-500"
                                x-bind:type="showPassword ? 'text' : 'password'"
                                name="password"
                                required
                                placeholder="Kata Sandi"
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
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>
                       <!-- Confirm Password -->
                       <div x-data="{ showPassword: false }">
                           <div class="relative">
                               <x-text-input id="password_confirmation" 
                                   class="block w-full px-4 py-3 pr-10 rounded-lg border border-gray-300 focus:border-[#943E51] focus:ring-[#943E51] 
                                   text-sm placeholder-gray-500"
                                   x-bind:type="showPassword ? 'text' : 'password'"
                                   name="password_confirmation"
                                   required
                                   placeholder="Konfirmasi Kata Sandi"
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
                           <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                       </div>

                    <!-- Register Button -->
                    <button type="submit" 
                        class="w-full py-3 mt-6 bg-[#943E51] text-white text-sm font-semibold rounded-lg
                        hover:bg-[#7e334d] focus:outline-none focus:ring-2 focus:ring-[#943E51] focus:ring-offset-2
                        transition-colors duration-200">
                        Daftar
                    </button>
                </form>

                <!-- Login Link -->
                <div class="text-center mt-6">
                    <span class="text-gray-500 text-sm">Sudah punya akun? </span>
                    <a href="{{ route('login') }}" 
                        class="text-[#943E51] hover:text-[#7e334d] text-sm font-semibold hover:underline">
                        Masuk
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
