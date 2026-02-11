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

        <!-- Right Side - Reset Password Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 lg:p-16 bg-white">
            <div class="w-full max-w-[420px]">
                <div class="text-center mb-8">
                    <img src="{{ asset('foto/rejosari.jpg') }}" alt="RS Logo" class="h-20 mx-auto mb-6 lg:hidden">
                    <h1 class="text-3xl font-playfair font-bold text-gray-800 mb-4">Lupa Kata Sandi?</h1>
                    <p class="text-gray-600 text-sm">
                        Tidak masalah! Masukkan email Anda dan kami akan mengirimkan link untuk mereset kata sandi Anda.
                    </p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Development Mode: Show Reset Link -->
                @if(session('dev_mode') && session('reset_link'))
                <div class="mb-6 p-4 bg-green-50 border-2 border-green-500 rounded-lg" x-data="{ copied: false }">
                    <div class="flex items-start">
                        <svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div class="flex-1">
                            <h3 class="font-semibold text-green-800 mb-2">✅ Link Reset Password Berhasil Dibuat!</h3>
                            <p class="text-sm text-green-700 mb-3">Klik tombol di bawah untuk reset password:</p>
                            
                            <!-- Reset Link Button -->
                            <a href="{{ session('reset_link') }}" 
                                class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors mb-3">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                </svg>
                                Buka Halaman Reset Password
                            </a>

                            <!-- Copy Link -->
                            <div class="bg-white p-3 rounded border border-green-300 mb-2">
                                <p class="text-xs text-gray-600 mb-1">Atau copy link ini:</p>
                                <div class="flex items-center gap-2">
                                    <input type="text" 
                                        value="{{ session('reset_link') }}" 
                                        readonly 
                                        class="flex-1 text-xs p-2 border rounded bg-gray-50 text-gray-700 font-mono"
                                        id="resetLink">
                                    <button @click="navigator.clipboard.writeText('{{ session('reset_link') }}'); copied = true; setTimeout(() => copied = false, 2000)"
                                        class="px-3 py-2 bg-gray-700 text-white rounded hover:bg-gray-800 text-xs whitespace-nowrap">
                                        <span x-show="!copied">📋 Copy</span>
                                        <span x-show="copied" x-cloak>✅ Copied!</span>
                                    </button>
                                </div>
                            </div>

                            <p class="text-xs text-green-600 mt-2">
                                💡 Mode Development: Link ditampilkan langsung di sini. Di production, link akan dikirim via email.
                            </p>
                        </div>
                    </div>
                </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                    @csrf

                    <!-- Email field -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Alamat Email <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <x-text-input 
                                id="email" 
                                type="email" 
                                name="email" 
                                class="block w-full pl-10 px-4 py-3 rounded-lg border border-gray-300 focus:border-[#943E51] focus:ring-[#943E51] text-sm placeholder-gray-500"
                                placeholder="contoh@email.com"
                                required 
                                autofocus />
                        </div>
                        <p class="mt-2 text-xs text-gray-500">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Link reset password akan dikirim ke email ini
                        </p>
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                        class="w-full py-3 bg-[#943E51] text-white text-sm font-semibold rounded-lg
                        hover:bg-[#7e334d] focus:outline-none focus:ring-2 focus:ring-[#943E51] focus:ring-offset-2
                        transition-colors duration-200 flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        Kirim Link Reset Password
                    </button>
                </form>

                <!-- Info Box -->
                <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                    <div class="flex">
                        <svg class="w-5 h-5 text-blue-500 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div class="text-sm text-blue-800">
                            <p class="font-semibold mb-1">Cara Reset Password:</p>
                            <ol class="list-decimal ml-4 space-y-1 text-xs">
                                <li>Masukkan email yang terdaftar</li>
                                <li>Klik tombol "Kirim Link Reset Password"</li>
                                <li>Cek email Anda (termasuk folder spam)</li>
                                <li>Klik link yang dikirimkan</li>
                                <li>Buat password baru</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <!-- Back to Login Link -->
                <div class="text-center mt-6">
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
