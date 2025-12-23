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

        <!-- Right Side - Login Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 lg:p-16 bg-white">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <div class="w-full max-w-[420px] bg-white">
                <div class="text-center mb-10">
                    <div class="bg-white py-4 lg:hidden">
                        <img src="{{ asset('foto/rejosari.jpg') }}" alt="RS Logo" class="h-20 mx-auto mb-6">
                        <h1 class="text-3xl font-playfair font-bold text-gray-800">Masuk ke Akun Anda</h1>
                    </div>
                    <h1 class="text-3xl font-playfair font-bold text-gray-800 mb-4 hidden lg:block">Masuk ke Akun Anda</h1>
                </div>

                <!-- Google Login Button -->
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
                            <span class="px-4 bg-white text-gray-500">atau Login dengan Email</span>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf
                        
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
                                autofocus />
                            <x-input-error :messages="$errors->get('email')" class="mt-1" />
                        </div>

                        <!-- Password -->
                        <div>
                            <x-text-input id="password"
                                class="block w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#943E51] focus:ring-[#943E51] 
                                text-sm placeholder-gray-500"
                                type="password"
                                name="password"
                                required
                                placeholder="Password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-1" />
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="flex items-center justify-between mt-2">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" 
                                    class="rounded border-gray-300 text-[#943E51] focus:ring-[#943E51] cursor-pointer"
                                    name="remember">
                                <span class="ml-2 text-sm text-gray-600">Ingat Saya</span>
                            </label>

                            @if (Route::has('password.request'))
                            <a class="text-sm text-[#943E51] hover:text-[#7e334d] hover:underline" 
                                href="{{ route('password.request') }}">
                                Lupa Kata Sandi?
                            </a>
                            @endif
                        </div>

                        <!-- Login Button -->
                        <button type="submit" 
                            class="w-full py-3 mt-6 bg-[#943E51] text-white text-sm font-semibold rounded-lg
                            hover:bg-[#7e334d] focus:outline-none focus:ring-2 focus:ring-[#943E51] focus:ring-offset-2
                            transition-colors duration-200">
                            Masuk
                        </button>
                    </form>

                    <!-- Register Link -->
                    <div class="text-center mt-8">
                        <span class="text-gray-600 text-sm">Belum Daftar? </span>
                        <a href="{{ route('register') }}" 
                            class="text-[#943E51] hover:text-[#7e334d] text-sm font-semibold hover:underline">
                            Buat Akun
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>