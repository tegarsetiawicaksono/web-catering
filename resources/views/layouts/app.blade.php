<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Rejosari Catering') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Styles -->
        <style>
            [x-cloak] {
                display: none !important;
            }

            .max-h-24 {
                max-height: 6rem;
                transition: max-height 0.3s ease-out;
            }
            
            /* Custom scrollbar */
            ::-webkit-scrollbar {
                width: 6px;
                height: 6px;
            }
            ::-webkit-scrollbar-thumb {
                background-color: #fb923c;
                border-radius: 3px;
            }

            /* Gallery animations */
            .gallery-item {
                transition: all 0.3s ease-in-out;
            }

            .gallery-item.hidden {
                opacity: 0;
                transform: scale(0.8);
            }

            .gallery-item.visible {
                opacity: 1;
                transform: scale(1);
            }
        </style>

        <!-- Scripts -->
        <script src="https://cdn.tailwindcss.com"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gray-50 font-sans text-gray-900">
        <div class="min-h-screen">
            <!-- Include Navbar -->
            @if(Route::currentRouteName() == 'home')
                @include('partials.navbar')
            @else
                @include('partials.navbar-menu')
            @endif

            <!-- Page Content -->
            @yield('content')

            <!-- Include Footer if exists -->
            @includeIf('partials.footer')

            <!-- Cart Drawer -->
            <x-cart-drawer />
            
            <!-- Notification -->
            <x-notification />
        </div>

        <!-- Additional Scripts -->
        <script src="{{ asset('js/scroll-spy.js') }}"></script>
        <script src="{{ asset('js/menu-navigation.js') }}"></script>
        @stack('scripts')
    </body>
</html>
