@section('page-title', 'Dashboard')

<x-admin-layout>
    <!-- Welcome Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Selamat Datang, {{ Auth::user()->name }}! 👋</h1>
        <p class="text-gray-600">Berikut adalah ringkasan bisnis catering Anda hari ini</p>
    </div>

    <!-- Stats Overview Grid -->
    <div class="grid grid-cols-1 gap-6 mb-6 sm:grid-cols-2 lg:grid-cols-4">
        <!-- Today's Orders -->
        <div class="relative overflow-hidden transition-transform duration-200 bg-white border border-gray-200 rounded-xl hover:shadow-lg hover:-translate-y-1">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center justify-center w-12 h-12 rounded-lg bg-gradient-to-br from-blue-500 to-blue-600">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                    <span class="px-2 py-1 text-xs font-medium text-blue-700 bg-blue-100 rounded-full">Hari Ini</span>
                </div>
                <h3 class="mb-1 text-sm font-medium text-gray-600">Total Pesanan</h3>
                <p class="text-3xl font-bold text-gray-900">{{ $todayOrders }}</p>
                <p class="mt-2 text-xs text-gray-500">
                    <span class="text-green-600">↑ 12%</span> dari kemarin
                </p>
            </div>
            <div class="h-1 bg-gradient-to-r from-blue-500 to-blue-600"></div>
        </div>

        <!-- Monthly Revenue -->
        <div class="relative overflow-hidden transition-transform duration-200 bg-white border border-gray-200 rounded-xl hover:shadow-lg hover:-translate-y-1">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center justify-center w-12 h-12 rounded-lg bg-gradient-to-br from-green-500 to-green-600">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <span class="px-2 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-full">Bulan Ini</span>
                </div>
                <h3 class="mb-1 text-sm font-medium text-gray-600">Pendapatan</h3>
                <p class="text-3xl font-bold text-gray-900">Rp {{ number_format($currentMonthRevenue / 1000000, 1) }}jt</p>
                <p class="mt-2 text-xs text-gray-500">
                    <span class="text-green-600">↑ 8%</span> dari bulan lalu
                </p>
            </div>
            <div class="h-1 bg-gradient-to-r from-green-500 to-green-600"></div>
        </div>

        <!-- Pending Orders -->
        <div class="relative overflow-hidden transition-transform duration-200 bg-white border border-gray-200 rounded-xl hover:shadow-lg hover:-translate-y-1">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center justify-center w-12 h-12 rounded-lg bg-gradient-to-br from-yellow-500 to-yellow-600">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <span class="px-2 py-1 text-xs font-medium text-yellow-700 bg-yellow-100 rounded-full">Menunggu</span>
                </div>
                <h3 class="mb-1 text-sm font-medium text-gray-600">Pesanan Pending</h3>
                <p class="text-3xl font-bold text-gray-900">{{ $pendingOrders }}</p>
                <p class="mt-2 text-xs text-gray-500">
                    Butuh konfirmasi segera
                </p>
            </div>
            <div class="h-1 bg-gradient-to-r from-yellow-500 to-yellow-600"></div>
        </div>

        <!-- Completed Orders -->
        <div class="relative overflow-hidden transition-transform duration-200 bg-white border border-gray-200 rounded-xl hover:shadow-lg hover:-translate-y-1">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center justify-center w-12 h-12 rounded-lg bg-gradient-to-br from-purple-500 to-purple-600">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <span class="px-2 py-1 text-xs font-medium text-purple-700 bg-purple-100 rounded-full">Selesai</span>
                </div>
                <h3 class="mb-1 text-sm font-medium text-gray-600">Total Selesai</h3>
                <p class="text-3xl font-bold text-gray-900">{{ \App\Models\Order::where('status', 'completed')->count() }}</p>
                <p class="mt-2 text-xs text-gray-500">
                    <span class="text-purple-600">98%</span> kepuasan pelanggan
                </p>
            </div>
            <div class="h-1 bg-gradient-to-r from-purple-500 to-purple-600"></div>
        </div>
    </div>

    <!-- Sales Charts -->
    <div class="grid grid-cols-1 gap-6 mb-6 lg:grid-cols-2">
        <!-- Monthly Sales Chart -->
        <div class="overflow-hidden bg-white border border-gray-200 rounded-xl">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Penjualan Per Bulan {{ $currentYear }}</h3>
                        <p class="text-sm text-gray-500">Grafik pesanan bulanan tahun ini</p>
                    </div>
                    <div class="flex items-center justify-center w-12 h-12 rounded-lg bg-gradient-to-br from-indigo-500 to-indigo-600">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <canvas id="monthlySalesChart" height="300"></canvas>
            </div>
        </div>

        <!-- Monthly Revenue Chart -->
        <div class="overflow-hidden bg-white border border-gray-200 rounded-xl">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Pendapatan Per Bulan {{ $currentYear }}</h3>
                        <p class="text-sm text-gray-500">Grafik pendapatan bulanan tahun ini</p>
                    </div>
                    <div class="flex items-center justify-center w-12 h-12 rounded-lg bg-gradient-to-br from-green-500 to-green-600">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <canvas id="monthlyRevenueChart" height="300"></canvas>
            </div>
        </div>
    </div>

    <!-- Yearly Comparison -->
    <div class="mb-6 overflow-hidden bg-white border border-gray-200 rounded-xl">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Perbandingan Tahunan</h3>
                    <p class="text-sm text-gray-500">Perbandingan penjualan 3 tahun terakhir</p>
                </div>
                <div class="flex items-center justify-center w-12 h-12 rounded-lg bg-gradient-to-br from-purple-500 to-purple-600">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-3">
                @foreach($yearlyData as $data)
                <div class="p-6 border border-gray-200 rounded-lg {{ $data['year'] == $currentYear ? 'bg-gradient-to-br from-indigo-50 to-purple-50 border-indigo-300' : 'bg-gray-50' }}">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="text-2xl font-bold {{ $data['year'] == $currentYear ? 'text-indigo-600' : 'text-gray-900' }}">
                            {{ $data['year'] }}
                        </h4>
                        @if($data['year'] == $currentYear)
                        <span class="px-2 py-1 text-xs font-semibold text-indigo-600 bg-indigo-100 rounded-full">Tahun Ini</span>
                        @endif
                    </div>
                    <div class="space-y-3">
                        <div>
                            <p class="text-sm text-gray-600">Total Pesanan</p>
                            <p class="text-2xl font-bold text-gray-900">{{ number_format($data['orders']) }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Total Pendapatan</p>
                            <p class="text-xl font-bold text-green-600">
                                Rp {{ number_format($data['revenue'] / 1000000, 1) }}jt
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <canvas id="yearlyComparisonChart" height="100"></canvas>
        </div>
    </div>

    <!-- Quick Actions & Recent Orders Grid -->
    <div class="grid grid-cols-1 gap-6 mb-6 lg:grid-cols-3">
        <!-- Quick Actions -->
        <div class="lg:col-span-1">
            <div class="overflow-hidden bg-white border border-gray-200 rounded-xl">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Aksi Cepat</h3>
                </div>
                <div class="p-6 space-y-3">
                    <a href="{{ route('admin.orders.index') }}"
                        class="flex items-center justify-between p-4 transition-colors border border-gray-200 rounded-lg hover:bg-indigo-50 hover:border-indigo-200 group">
                        <div class="flex items-center space-x-3">
                            <div class="flex items-center justify-center w-10 h-10 bg-indigo-100 rounded-lg group-hover:bg-indigo-200">
                                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <span class="font-medium text-gray-700">Lihat Semua Pesanan</span>
                        </div>
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>

                    <a href="{{ route('admin.payments.index') }}"
                        class="flex items-center justify-between p-4 transition-colors border border-gray-200 rounded-lg hover:bg-green-50 hover:border-green-200 group">
                        <div class="flex items-center space-x-3">
                            <div class="flex items-center justify-center w-10 h-10 bg-green-100 rounded-lg group-hover:bg-green-200">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <span class="font-medium text-gray-700">Verifikasi Pembayaran</span>
                        </div>
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>

                    <a href="{{ route('admin.reports') }}"
                        class="flex items-center justify-between p-4 transition-colors border border-gray-200 rounded-lg hover:bg-purple-50 hover:border-purple-200 group">
                        <div class="flex items-center space-x-3">
                            <div class="flex items-center justify-center w-10 h-10 bg-purple-100 rounded-lg group-hover:bg-purple-200">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <span class="font-medium text-gray-700">Lihat Laporan</span>
                        </div>
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Popular Packages -->
            <div class="mt-6 overflow-hidden bg-white border border-gray-200 rounded-xl">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Paket Terpopuler</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="flex items-center justify-center w-10 h-10 text-white bg-orange-500 rounded-lg">
                                <span class="text-sm font-bold">1</span>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">Paket Buffet Premium</p>
                                <p class="text-xs text-gray-500">145 pesanan</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="flex items-center justify-center w-10 h-10 text-white bg-gray-400 rounded-lg">
                                <span class="text-sm font-bold">2</span>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">Nasi Box Reguler</p>
                                <p class="text-xs text-gray-500">132 pesanan</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="flex items-center justify-center w-10 h-10 text-white bg-amber-700 rounded-lg">
                                <span class="text-sm font-bold">3</span>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">Tumpeng Komplit</p>
                                <p class="text-xs text-gray-500">98 pesanan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Orders -->
        <div class="lg:col-span-2">
            <div class="overflow-hidden bg-white border border-gray-200 rounded-xl">
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Pesanan Terbaru</h3>
                    <a href="{{ route('admin.orders.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-700">
                        Lihat Semua →
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Pesanan</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Pelanggan</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Total</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($recentOrders as $order)
                            <tr class="transition-colors hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex items-center justify-center w-10 h-10 mr-3 bg-indigo-100 rounded-lg">
                                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">#{{ $order->id }}</div>
                                            <div class="text-xs text-gray-500">{{ $order->package_name }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $order->customer_name }}</div>
                                    <div class="text-xs text-gray-500">{{ $order->event_date ? \Carbon\Carbon::parse($order->event_date)->format('d M Y') : '-' }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($order->status === 'pending')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <span class="w-1.5 h-1.5 mr-1.5 bg-yellow-400 rounded-full"></span>
                                        Pending
                                    </span>
                                    @elseif($order->status === 'confirmed')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <span class="w-1.5 h-1.5 mr-1.5 bg-green-400 rounded-full"></span>
                                        Dikonfirmasi
                                    </span>
                                    @elseif($order->status === 'completed')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        <span class="w-1.5 h-1.5 mr-1.5 bg-blue-400 rounded-full"></span>
                                        Selesai
                                    </span>
                                    @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        <span class="w-1.5 h-1.5 mr-1.5 bg-red-400 rounded-full"></span>
                                        {{ ucfirst($order->status) }}
                                    </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                                    <a href="{{ route('admin.orders.show', $order) }}"
                                        class="text-indigo-600 transition-colors hover:text-indigo-900">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                    <svg class="w-12 h-12 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                    </svg>
                                    Belum ada pesanan
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Dashboard script loaded');

            // Check if Chart is loaded
            if (typeof Chart === 'undefined') {
                console.error('Chart.js is not loaded!');
                return;
            }
            console.log('Chart.js loaded successfully');

            // Monthly Sales Chart
            const monthlySalesCtx = document.getElementById('monthlySalesChart');
            if (!monthlySalesCtx) {
                console.error('monthlySalesChart element not found!');
                return;
            }
            console.log('monthlySalesChart element found');

            // Log data
            const salesData = @json($monthlySales);
            console.log('Sales data:', salesData);

            // Create gradient for sales chart
            const salesGradient = monthlySalesCtx.getContext('2d').createLinearGradient(0, 0, 0, 300);
            salesGradient.addColorStop(0, 'rgba(99, 102, 241, 0.3)');
            salesGradient.addColorStop(1, 'rgba(99, 102, 241, 0.01)');

            const monthlySalesChart = new Chart(monthlySalesCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                    datasets: [{
                        label: 'Jumlah Pesanan',
                        data: @json($monthlySales),
                        backgroundColor: salesGradient,
                        borderColor: 'rgb(99, 102, 241)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointRadius: 6,
                        pointBackgroundColor: 'rgb(99, 102, 241)',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointHoverRadius: 8,
                        pointHoverBackgroundColor: 'rgb(99, 102, 241)',
                        pointHoverBorderColor: '#fff',
                        pointHoverBorderWidth: 3,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            padding: 12,
                            titleFont: {
                                size: 14
                            },
                            bodyFont: {
                                size: 13
                            },
                            callbacks: {
                                label: function(context) {
                                    return 'Pesanan: ' + context.parsed.y;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0,
                                font: {
                                    size: 12
                                }
                            },
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    size: 12
                                }
                            }
                        }
                    }
                }
            });

            // Monthly Revenue Chart
            const monthlyRevenueCtx = document.getElementById('monthlyRevenueChart');

            // Create gradient for revenue chart
            const revenueGradient = monthlyRevenueCtx.getContext('2d').createLinearGradient(0, 0, 0, 300);
            revenueGradient.addColorStop(0, 'rgba(34, 197, 94, 0.3)');
            revenueGradient.addColorStop(1, 'rgba(34, 197, 94, 0.01)');

            const monthlyRevenueChart = new Chart(monthlyRevenueCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                    datasets: [{
                        label: 'Pendapatan (Rp)',
                        data: @json($monthlyRevenueData),
                        backgroundColor: revenueGradient,
                        borderColor: 'rgb(34, 197, 94)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: 'rgb(34, 197, 94)',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 6,
                        pointHoverRadius: 8,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            padding: 12,
                            titleFont: {
                                size: 14
                            },
                            bodyFont: {
                                size: 13
                            },
                            callbacks: {
                                label: function(context) {
                                    return 'Pendapatan: Rp ' + context.parsed.y.toLocaleString('id-ID');
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return 'Rp ' + (value / 1000000).toFixed(1) + 'jt';
                                },
                                font: {
                                    size: 12
                                }
                            },
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    size: 12
                                }
                            }
                        }
                    }
                }
            });

            // Yearly Comparison Chart
            const yearlyComparisonCtx = document.getElementById('yearlyComparisonChart');
            const yearlyData = @json($yearlyData);

            const yearlyComparisonChart = new Chart(yearlyComparisonCtx, {
                type: 'bar',
                data: {
                    labels: yearlyData.map(d => d.year),
                    datasets: [{
                            label: 'Jumlah Pesanan',
                            data: yearlyData.map(d => d.orders),
                            backgroundColor: 'rgba(99, 102, 241, 0.8)',
                            borderColor: 'rgb(99, 102, 241)',
                            borderWidth: 2,
                            borderRadius: 6,
                            yAxisID: 'y',
                        },
                        {
                            label: 'Pendapatan (Juta Rupiah)',
                            data: yearlyData.map(d => d.revenue / 1000000),
                            backgroundColor: 'rgba(34, 197, 94, 0.8)',
                            borderColor: 'rgb(34, 197, 94)',
                            borderWidth: 2,
                            borderRadius: 6,
                            yAxisID: 'y1',
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        mode: 'index',
                        intersect: false,
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                            labels: {
                                usePointStyle: true,
                                padding: 15,
                                font: {
                                    size: 13,
                                    weight: '500'
                                }
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            padding: 12,
                            titleFont: {
                                size: 14
                            },
                            bodyFont: {
                                size: 13
                            },
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.datasetIndex === 0) {
                                        label += context.parsed.y + ' pesanan';
                                    } else {
                                        label += 'Rp ' + context.parsed.y.toFixed(1) + ' juta';
                                    }
                                    return label;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            type: 'linear',
                            display: true,
                            position: 'left',
                            beginAtZero: true,
                            ticks: {
                                precision: 0,
                                font: {
                                    size: 12
                                }
                            },
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            },
                            title: {
                                display: true,
                                text: 'Jumlah Pesanan',
                                font: {
                                    size: 12,
                                    weight: '600'
                                }
                            }
                        },
                        y1: {
                            type: 'linear',
                            display: true,
                            position: 'right',
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return 'Rp ' + value.toFixed(1) + 'jt';
                                },
                                font: {
                                    size: 12
                                }
                            },
                            grid: {
                                drawOnChartArea: false,
                            },
                            title: {
                                display: true,
                                text: 'Pendapatan (Juta)',
                                font: {
                                    size: 12,
                                    weight: '600'
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    size: 13,
                                    weight: '500'
                                }
                            }
                        }
                    }
                }
            });
        }); // End DOMContentLoaded
    </script>
    @endpush
</x-admin-layout>