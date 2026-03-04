<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Panel - {{ config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    
    <style>
        /* Custom Scrollbar untuk Sidebar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        
        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }
        
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 10px;
        }
        
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }
        
        /* Animation untuk menu hover */
        @keyframes slideRight {
            from {
                transform: translateX(0);
            }
            to {
                transform: translateX(4px);
            }
        }
        
        /* Hide scrollbar untuk Firefox */
        .custom-scrollbar {
            scrollbar-width: thin;
            scrollbar-color: rgba(255, 255, 255, 0.3) rgba(255, 255, 255, 0.1);
        }
        
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="h-full bg-gray-50" x-data="{ sidebarOpen: false }">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar Mobile Overlay -->
        <div x-show="sidebarOpen"
            x-cloak
            x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            @click="sidebarOpen = false"
            class="fixed inset-0 z-40 bg-gray-900 bg-opacity-50 md:hidden">
        </div>

        <!-- Sidebar -->
        <aside class="fixed inset-y-0 left-0 z-50 flex flex-col w-64 transition-transform duration-300 transform bg-gradient-to-br from-indigo-600 via-indigo-700 to-indigo-800 shadow-2xl md:translate-x-0"
            :class="{ '-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen }">

            <!-- Logo -->
            <div class="relative px-6 py-5 overflow-hidden bg-gradient-to-r from-indigo-800 to-indigo-900">
                <!-- Decorative Background -->
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute w-32 h-32 bg-white rounded-full -top-10 -right-10"></div>
                    <div class="absolute w-24 h-24 bg-white rounded-full -bottom-5 -left-5"></div>
                </div>
                
                <div class="relative flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <!-- Logo Rejosari -->
                        <div class="relative flex items-center justify-center w-12 h-12 transition-transform duration-300 bg-white shadow-lg rounded-xl hover:scale-105">
                            <img src="{{ asset('foto/logo.jpeg') }}" alt="Rejosari Catering" class="object-cover w-full h-full rounded-xl">
                        </div>
                        <div class="leading-tight">
                            <h1 class="text-base font-bold text-white sm:text-lg">Rejosari Catering</h1>
                            <p class="text-xs text-indigo-200">Admin Dashboard</p>
                        </div>
                    </div>
                    <button @click="sidebarOpen = false" class="p-2 text-white transition-colors rounded-lg hover:bg-indigo-950 md:hidden">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-3 py-6 space-y-1 overflow-y-auto custom-scrollbar sm:px-4">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center px-3 py-3 text-sm font-medium transition-all duration-200 rounded-lg group sm:px-4
                          @if(request()->routeIs('admin.dashboard')) bg-white shadow-lg text-indigo-700 @else text-indigo-50 hover:bg-white hover:bg-opacity-10 hover:text-white hover:pl-5 @endif">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Dashboard
                </a>

                <a href="{{ route('admin.orders.index') }}"
                    class="flex items-center px-3 py-3 text-sm font-medium transition-all duration-200 rounded-lg group sm:px-4
                          @if(request()->routeIs('admin.orders.*')) bg-white shadow-lg text-indigo-700 @else text-indigo-50 hover:bg-white hover:bg-opacity-10 hover:text-white hover:pl-5 @endif">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    Pesanan
                </a>

                <a href="{{ route('admin.menus.index') }}"
                    class="flex items-center px-3 py-3 text-sm font-medium transition-all duration-200 rounded-lg group sm:px-4
                          @if(request()->routeIs('admin.menus.*')) bg-white shadow-lg text-indigo-700 @else text-indigo-50 hover:bg-white hover:bg-opacity-10 hover:text-white hover:pl-5 @endif">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Kelola Menu
                </a>

                <a href="{{ route('admin.categories.index') }}"
                    class="flex items-center px-3 py-3 text-sm font-medium transition-all duration-200 rounded-lg group sm:px-4
                          @if(request()->routeIs('admin.categories.*')) bg-white shadow-lg text-indigo-700 @else text-indigo-50 hover:bg-white hover:bg-opacity-10 hover:text-white hover:pl-5 @endif">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                    Kelola Kategori
                </a>

                <a href="{{ route('admin.gallery.index') }}"
                    class="flex items-center px-3 py-3 text-sm font-medium transition-all duration-200 rounded-lg group sm:px-4
                          @if(request()->routeIs('admin.gallery.*')) bg-white shadow-lg text-indigo-700 @else text-indigo-50 hover:bg-white hover:bg-opacity-10 hover:text-white hover:pl-5 @endif">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Kelola Galeri
                </a>

                <a href="{{ route('admin.bank-accounts.index') }}"
                    class="flex items-center px-3 py-3 text-sm font-medium transition-all duration-200 rounded-lg group sm:px-4
                          @if(request()->routeIs('admin.bank-accounts.*')) bg-white shadow-lg text-indigo-700 @else text-indigo-50 hover:bg-white hover:bg-opacity-10 hover:text-white hover:pl-5 @endif">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                    Kelola Rekening
                </a>

                <a href="{{ route('admin.payments.index') }}"
                    class="flex items-center px-3 py-3 text-sm font-medium transition-all duration-200 rounded-lg group sm:px-4
                          @if(request()->routeIs('admin.payments.*')) bg-white shadow-lg text-indigo-700 @else text-indigo-50 hover:bg-white hover:bg-opacity-10 hover:text-white hover:pl-5 @endif">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                    Pembayaran
                </a>

                <a href="{{ route('admin.users.index') }}"
                    class="flex items-center px-3 py-3 text-sm font-medium transition-all duration-200 rounded-lg group sm:px-4
                          @if(request()->routeIs('admin.users.*')) bg-white shadow-lg text-indigo-700 @else text-indigo-50 hover:bg-white hover:bg-opacity-10 hover:text-white hover:pl-5 @endif">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    Pengguna
                </a>

                <div class="pt-4 mt-4 border-t border-indigo-500 border-opacity-30">
                    <p class="px-3 mb-2 text-xs font-semibold tracking-wider text-indigo-200 uppercase sm:px-4">Analisis</p>

                    <a href="{{ route('admin.reports') }}"
                        class="flex items-center px-3 py-3 text-sm font-medium transition-all duration-200 rounded-lg group sm:px-4
                              @if(request()->routeIs('admin.reports')) bg-white shadow-lg text-indigo-700 @else text-indigo-50 hover:bg-white hover:bg-opacity-10 hover:text-white hover:pl-5 @endif">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Laporan
                    </a>

                    <a href="{{ route('admin.analysis.finance') }}"
                        class="flex items-center px-3 py-3 text-sm font-medium transition-all duration-200 rounded-lg group sm:px-4
                              @if(request()->routeIs('admin.analysis.finance')) bg-white shadow-lg text-indigo-700 @else text-indigo-50 hover:bg-white hover:bg-opacity-10 hover:text-white hover:pl-5 @endif">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                        Keuangan
                    </a>

                    <a href="{{ route('admin.analysis.transactions') }}"
                        class="flex items-center px-3 py-3 text-sm font-medium transition-all duration-200 rounded-lg group sm:px-4
                              @if(request()->routeIs('admin.analysis.transactions')) bg-white shadow-lg text-indigo-700 @else text-indigo-50 hover:bg-white hover:bg-opacity-10 hover:text-white hover:pl-5 @endif">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Transaksi
                    </a>
                </div>
            </nav>

            <!-- User Profile -->
            <div class="p-4 border-t border-indigo-700" x-data="{ profileOpen: false }">
                <div class="relative">
                    <button @click="profileOpen = !profileOpen"
                        class="flex items-center w-full px-4 py-3 space-x-3 transition-colors rounded-lg hover:bg-white hover:bg-opacity-10">
                        <div class="flex items-center justify-center w-10 h-10 text-indigo-600 bg-white rounded-full">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div class="flex-1 text-left">
                            <p class="text-sm font-medium text-white">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-indigo-200">Administrator</p>
                        </div>
                        <svg class="w-5 h-5 text-indigo-200 transition-transform"
                            :class="{ 'rotate-180': profileOpen }"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="profileOpen"
                        x-cloak
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        @click.away="profileOpen = false"
                        class="absolute bottom-full left-0 right-0 mb-2 bg-white rounded-lg shadow-lg z-50">
                        <a href="{{ route('home') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <svg class="inline w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Ke Beranda
                        </a>
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <svg class="inline w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Pengaturan
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full px-4 py-2 text-sm text-left text-red-600 hover:bg-gray-100">
                                <svg class="inline w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex flex-col flex-1 md:ml-64">
            <!-- Top Navigation Bar -->
            <header class="sticky top-0 z-30 bg-white border-b border-gray-200 shadow-sm">
                <div class="flex items-center justify-between h-16 px-4 sm:px-6">
                    <!-- Mobile menu button -->
                    <button @click="sidebarOpen = true"
                        class="text-gray-500 hover:text-gray-700 md:hidden">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    <!-- Page Title -->
                    <div class="flex-1 ml-4 md:ml-0">
                        <h2 class="text-xl font-semibold text-gray-800">
                            @yield('page-title', 'Dashboard')
                        </h2>
                    </div>

                    <!-- Right side items -->
                    <div class="flex items-center space-x-4">
                        <!-- Notifications -->
                        @php
                            $lastReadAt = auth()->user()->last_notification_read_at;
                            
                            // Hitung hanya notifikasi baru (setelah terakhir dibaca)
                            $notificationQuery = \App\Models\Order::where(function($q) {
                                $q->where('status', 'pending')
                                  ->orWhere('status', 'confirmed');
                            });
                            
                            if ($lastReadAt) {
                                $notificationQuery->where('created_at', '>', $lastReadAt);
                            }
                            
                            $notificationCount = $notificationQuery->count();
                        @endphp
                        <div x-data="{ open: false, hasNotification: {{ $notificationCount > 0 ? 'true' : 'false' }}, notifCount: {{ $notificationCount }} }" @click.away="open = false" class="relative">
                            
                            <button @click="open = !open; if(open && hasNotification) { fetch('{{ route('admin.notifications.mark-read') }}', { method: 'POST', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } }).then(response => { if(response.ok) { hasNotification = false; notifCount = 0; } }).catch(err => console.error('Error marking notifications as read:', err)); }" 
                                class="relative text-gray-500 transition-colors hover:text-gray-700 focus:outline-none">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                                <span x-show="hasNotification" x-cloak class="absolute -top-1 -right-1 flex items-center justify-center min-w-[20px] h-5 px-1 text-xs font-bold text-white bg-indigo-600 rounded-full">
                                    <span x-text="notifCount > 99 ? '99+' : notifCount"></span>
                                </span>
                            </button>

                            <!-- Dropdown Notifikasi -->
                            <div x-show="open"
                                x-cloak
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 transform scale-95"
                                x-transition:enter-end="opacity-100 transform scale-100"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 transform scale-100"
                                x-transition:leave-end="opacity-0 transform scale-95"
                                class="absolute right-0 z-50 w-80 mt-2 bg-white rounded-lg shadow-xl ring-1 ring-black ring-opacity-5">
                                
                                <!-- Header -->
                                <div class="px-4 py-3 border-b border-gray-200">
                                    <div class="flex items-center justify-between">
                                        <h3 class="text-sm font-semibold text-gray-900">Notifikasi</h3>
                                        <span x-show="hasNotification" x-cloak class="px-2 py-1 text-xs font-medium text-indigo-900 bg-indigo-100 rounded-full">
                                            <span x-text="notifCount"></span> Baru
                                        </span>
                                    </div>
                                </div>

                                <!-- Notification Items -->
                                <div class="max-h-96 overflow-y-auto">
                                    @php
                                        $recentOrders = \App\Models\Order::where(function($q) {
                                            $q->where('status', 'pending')
                                              ->orWhere('status', 'confirmed');
                                        })
                                            ->orderBy('created_at', 'desc')
                                            ->take(10)
                                            ->get();
                                    @endphp

                                    @forelse($recentOrders as $order)
                                        @php
                                            $isNew = !$lastReadAt || $order->created_at > $lastReadAt;
                                        @endphp
                                        <a href="{{ route('admin.orders.show', $order->id) }}" 
                                            class="block px-4 py-3 transition-colors hover:bg-gray-50 border-b border-gray-100 {{ $isNew ? 'bg-indigo-50' : '' }}">
                                            <div class="flex items-start">
                                                <div class="flex-shrink-0">
                                                    <div class="flex items-center justify-center w-10 h-10 rounded-full
                                                        @if($order->status === 'pending') bg-yellow-100
                                                        @elseif($order->status === 'confirmed') bg-blue-100
                                                        @endif">
                                                        <svg class="w-5 h-5 
                                                            @if($order->status === 'pending') text-yellow-600
                                                            @elseif($order->status === 'confirmed') text-blue-600
                                                            @endif" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="flex-1 ml-3">
                                                    <div class="flex items-center gap-2">
                                                        <p class="text-sm font-medium text-gray-900">
                                                            Pesanan #{{ $order->order_number }}
                                                        </p>
                                                        @if($isNew)
                                                            <span class="px-1.5 py-0.5 text-xs font-bold text-indigo-700 bg-indigo-200 rounded">BARU</span>
                                                        @endif
                                                    </div>
                                                    <p class="mt-1 text-xs text-gray-500">
                                                        {{ $order->customer_name }} - Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                                    </p>
                                                    <p class="mt-1 text-xs text-gray-400">
                                                        {{ $order->created_at->diffForHumans() }}
                                                    </p>
                                                </div>
                                                <span class="px-2 py-1 text-xs font-medium rounded-full
                                                    @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                                                    @elseif($order->status === 'confirmed') bg-blue-100 text-blue-800
                                                    @endif">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </div>
                                        </a>
                                    @empty
                                        <div class="px-4 py-8 text-center">
                                            <svg class="w-12 h-12 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                            </svg>
                                            <p class="mt-2 text-sm text-gray-500">Tidak ada notifikasi baru</p>
                                        </div>
                                    @endforelse
                                </div>

                                <!-- Footer -->
                                @if($recentOrders->count() > 0)
                                    <div class="px-4 py-3 border-t border-gray-200 bg-gray-50">
                                        <a href="{{ route('admin.orders.index') }}" 
                                            class="block text-sm font-medium text-center text-indigo-600 hover:text-indigo-700">
                                            Lihat Semua Pesanan
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Current Date -->
                        <div class="hidden text-sm text-gray-600 sm:block">
                            {{ now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main content -->
            <main class="flex-1 overflow-y-auto bg-gray-50">
                <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <!-- Success Notification (Auto-hide after 5 seconds) -->
                    @if (session('success'))
                    <div x-data="{ show: true }" 
                        x-show="show" 
                        x-init="setTimeout(() => show = false, 5000)"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform translate-y-2"
                        x-transition:enter-end="opacity-100 transform translate-y-0"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 transform translate-y-0"
                        x-transition:leave-end="opacity-0 transform translate-y-2"
                        class="p-4 mb-6 text-green-800 bg-green-100 border-l-4 border-green-500 rounded shadow-md">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span>{{ session('success') }}</span>
                            </div>
                            <button @click="show = false" class="text-green-700 hover:text-green-900 focus:outline-none">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    @endif

                    <!-- Error Notification (Auto-hide after 5 seconds) -->
                    @if (session('error'))
                    <div x-data="{ show: true }" 
                        x-show="show" 
                        x-init="setTimeout(() => show = false, 5000)"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform translate-y-2"
                        x-transition:enter-end="opacity-100 transform translate-y-0"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 transform translate-y-0"
                        x-transition:leave-end="opacity-0 transform translate-y-2"
                        class="p-4 mb-6 text-red-800 bg-red-100 border-l-4 border-red-500 rounded shadow-md">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                <span>{{ session('error') }}</span>
                            </div>
                            <button @click="show = false" class="text-red-700 hover:text-red-900 focus:outline-none">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    @endif

                    {{ $slot ?? '' }}
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    @stack('scripts')
</body>

</html>