<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a href="{{ route('google.redirect') }}" class="inline-flex items-center px-3 py-2 bg-white border rounded-md hover:shadow-sm">
                <!-- Google "G" logo (inline SVG) -->
                <svg class="w-5 h-5 mr-2" viewBox="0 0 533.5 544.3" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path fill="#4285F4" d="M533.5 278.4c0-18.5-1.6-36.2-4.6-53.5H272v101.2h146.9c-6.4 34.8-25.8 64.3-55.1 84v69h89c52-48 82.7-118.6 82.7-200.7z"/>
                    <path fill="#34A853" d="M272 544.3c74 0 136.1-24.4 181.5-66.4l-89-69c-24.7 16.6-56.5 26.5-92.5 26.5-71 0-131.1-47.9-152.6-112.1h-90.1v70.6C91.3 485 176.1 544.3 272 544.3z"/>
                    <path fill="#FBBC05" d="M119.4 322.3c-10.7-32.1-10.7-66.5 0-98.6V153.1h-90.1C9 208.8 0 239.5 0 272s9 63.2 29.3 118.9l90.1-68.6z"/>
                    <path fill="#EA4335" d="M272 107.7c39.9 0 75.9 13.7 104.2 40.7l78-78C403.9 24.1 344.8 0 272 0 176.1 0 91.3 59.3 29.3 153.1l90.1 70.6C140.9 155.6 201 107.7 272 107.7z"/>
                </svg>
                <span class="text-sm text-gray-700 font-medium font-bold">Sign in with Google</span>
            </a>

            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 ms-3" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
