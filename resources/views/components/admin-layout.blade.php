@props(['title' => null])

<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Admin Panel' }} - {{ config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="h-full bg-gray-50" x-data="{ sidebarOpen: false, openNotif: false }">
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
        <aside class="fixed inset-y-0 left-0 z-50 w-64 flex flex-col bg-gradient-to-b from-indigo-800 to-indigo-900 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out"
            :class="{ 'translate-x-0': sidebarOpen }">

            <!-- Logo -->
            <div class="flex items-center justify-between h-16 px-6 bg-indigo-900 bg-opacity-50">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3">
                    <div class="flex items-center justify-center w-10 h-10 bg-white rounded-lg">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-lg font-bold text-white">Rejosari Catering</h1>
                        <p class="text-xs text-indigo-200">Admin Panel</p>
                    </div>
                </a>
                <button @click="sidebarOpen = false" class="text-white md:hidden">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center px-4 py-3 text-sm font-medium transition-colors rounded-lg group
                          @if(request()->routeIs('admin.dashboard')) bg-white bg-opacity-20 text-white @else text-indigo-100 hover:bg-white hover:bg-opacity-10 hover:text-white @endif">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Dashboard
                </a>

                <a href="{{ route('admin.orders.index') }}"
                    class="flex items-center px-4 py-3 text-sm font-medium transition-colors rounded-lg group
                          @if(request()->routeIs('admin.orders.*')) bg-white bg-opacity-20 text-white @else text-indigo-100 hover:bg-white hover:bg-opacity-10 hover:text-white @endif">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    Pesanan
                </a>

                <a href="{{ route('admin.menus.index') }}"
                    class="flex items-center px-4 py-3 text-sm font-medium transition-colors rounded-lg group
                          @if(request()->routeIs('admin.menus.*')) bg-white bg-opacity-20 text-white @else text-indigo-100 hover:bg-white hover:bg-opacity-10 hover:text-white @endif">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Kelola Menu
                </a>

                <a href="{{ route('admin.gallery.index') }}"
                    class="flex items-center px-4 py-3 text-sm font-medium transition-colors rounded-lg group
                          @if(request()->routeIs('admin.gallery.*')) bg-white bg-opacity-20 text-white @else text-indigo-100 hover:bg-white hover:bg-opacity-10 hover:text-white @endif">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Kelola Galeri
                </a>

                <a href="{{ route('admin.payment-verifications.index') }}"
                    class="flex items-center px-4 py-3 text-sm font-medium transition-colors rounded-lg group
                          @if(request()->routeIs('admin.payment-verifications.*')) bg-white bg-opacity-20 text-white @else text-indigo-100 hover:bg-white hover:bg-opacity-10 hover:text-white @endif">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Verifikasi Pembayaran
                </a>

                <a href="{{ route('admin.reports') }}"
                    class="flex items-center px-4 py-3 text-sm font-medium transition-colors rounded-lg group
                          @if(request()->routeIs('admin.reports')) bg-white bg-opacity-20 text-white @else text-indigo-100 hover:bg-white hover:bg-opacity-10 hover:text-white @endif">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    Laporan
                </a>

                <!-- Divider for Analysis Section -->
                <div class="pt-4 mt-4 border-t border-indigo-700">
                    <p class="px-4 mb-2 text-xs font-semibold tracking-wider text-indigo-300 uppercase">Analisis</p>
                </div>

                <a href="{{ route('admin.analysis.finance') }}"
                    class="flex items-center px-4 py-3 text-sm font-medium transition-colors rounded-lg group
                          @if(request()->routeIs('admin.analysis.finance')) bg-white bg-opacity-20 text-white @else text-indigo-100 hover:bg-white hover:bg-opacity-10 hover:text-white @endif">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Keuangan
                </a>

                <a href="{{ route('admin.analysis.transactions') }}"
                    class="flex items-center px-4 py-3 text-sm font-medium transition-colors rounded-lg group
                          @if(request()->routeIs('admin.analysis.transactions')) bg-white bg-opacity-20 text-white @else text-indigo-100 hover:bg-white hover:bg-opacity-10 hover:text-white @endif">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    Transaksi
                </a>
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
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        @click.away="profileOpen = false"
                        class="absolute bottom-full left-0 right-0 mb-2 bg-white rounded-lg shadow-lg"
                        style="display: none;">
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
        <div class="flex flex-col flex-1 w-full md:ml-64">
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
                            {{ $title ?? 'Dashboard' }}
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
                                            <svg class="mx-auto w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                            </svg>
                                            <p class="mt-2 text-sm text-gray-500">Tidak ada pesanan baru</p>
                                        </div>
                                    @endforelse
                                </div>

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
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>

    @if(session('success'))
    <script>
        window.addEventListener('DOMContentLoaded', function () {
            window.dispatchEvent(new CustomEvent('show-notification', {
                detail: {
                    message: @json(session('success')),
                    type: 'success'
                }
            }));
        });
    </script>
    @endif

    @if(session('error'))
    <script>
        window.addEventListener('DOMContentLoaded', function () {
            window.dispatchEvent(new CustomEvent('show-notification', {
                detail: {
                    message: @json(session('error')),
                    type: 'error'
                }
            }));
        });
    </script>
    @endif

    @stack('scripts')
    <x-notification />
</body>

</html>