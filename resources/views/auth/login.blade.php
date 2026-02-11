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

        <!-- Right Side - Login Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 lg:p-16 bg-white">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <div class="w-full max-w-[420px] bg-white">
                <div class="text-center mb-10">
                    <div class="bg-white py-4 lg:hidden">
                        <img src="{{ asset('foto/logo.jpeg') }}" alt="RS Logo" class="h-20 mx-auto mb-6">
                        <h1 class="text-3xl font-playfair font-bold text-gray-800">Masuk ke Akun Anda</h1>
                    </div>
                    <h1 class="text-3xl font-playfair font-bold text-gray-800 mb-4 hidden lg:block">Masuk ke Akun Anda</h1>
                </div>

                <!-- Error Messages -->
                @if (session('error'))
                <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg" role="alert">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-sm">{{ session('error') }}</span>
                    </div>
                </div>
                @endif

                <!-- Success Message - Password Reset -->
                @if (session('password_reset_success'))
                <div class="mb-6 p-4 bg-green-50 border-2 border-green-500 rounded-lg" role="alert" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" x-transition>
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-3 flex-1">
                            <h3 class="text-sm font-semibold text-green-800 mb-1">
                                ✅ Password Berhasil Direset!
                            </h3>
                            <p class="text-sm text-green-700">
                                Password Anda telah berhasil diubah. Silakan login dengan password baru Anda.
                            </p>
                        </div>
                        <button @click="show = false" class="flex-shrink-0 ml-3 text-green-500 hover:text-green-700">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
                @endif

                <!-- Google Login Button -->
                <a href="{{ route('google.redirect') }}"
                    class="flex items-center justify-center w-full px-6 py-3 mb-6 border-2 border-[#4285F4] rounded-lg shadow-sm
                    hover:bg-[#f1f6fd] transition-colors duration-200 bg-white group">
                    <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google" class="w-5 h-5 mr-3">
                    <span class="text-[#4285F4] text-base font-semibold group-hover:underline">Login dengan Google</span>
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
                    <div x-data="{ showPassword: false }">
                        <div class="relative">
                            <x-text-input id="password"
                                class="block w-full px-4 py-3 pr-10 rounded-lg border border-gray-300 focus:border-[#943E51] focus:ring-[#943E51] 
                                    text-sm placeholder-gray-500"
                                x-bind:type="showPassword ? 'text' : 'password'"
                                name="password"
                                required
                                placeholder="Password" />
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