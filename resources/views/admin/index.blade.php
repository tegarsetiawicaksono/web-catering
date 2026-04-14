@section('page-title', 'Dashboard')

<x-admin-layout>
    <!-- Welcome Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Selamat Datang, {{ Auth::user()->name }}! 👋</h1>
        <p class="text-gray-600">Berikut adalah ringkasan bisnis catering Anda hari ini</p>
    </div>

    <!-- Stats Overview Grid -->
    <div class="grid grid-cols-1 gap-6 mb-6 sm:grid-cols-2 lg:grid-cols-4">
        <!-- Total Orders -->
        <div class="relative overflow-hidden transition-transform duration-200 bg-white border border-gray-200 rounded-xl hover:shadow-lg hover:-translate-y-1">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center justify-center w-12 h-12 rounded-lg bg-gradient-to-br from-blue-500 to-blue-600">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                    <span class="px-2 py-1 text-xs font-medium text-blue-700 bg-blue-100 rounded-full">Semua</span>
                </div>
                <h3 class="mb-1 text-sm font-medium text-gray-600">Total Pesanan</h3>
                <p class="text-3xl font-bold text-gray-900">{{ \App\Models\Order::count() }}</p>
                <p class="mt-2 text-xs text-gray-500">
                    Keseluruhan pesanan masuk
                </p>
            </div>
            <div class="h-1 bg-gradient-to-r from-blue-500 to-blue-600"></div>
        </div>

        <!-- Monthly Revenue -->
        <div class="relative overflow-hidden transition-transform duration-200 bg-white border border-gray-200 rounded-xl hover:shadow-lg hover:-translate-y-1">
            <div class="p-4">
                @php
                    $compactRevenue = $yearlyRevenue >= 1000000000
                        ? number_format($yearlyRevenue / 1000000000, 1) . ' M'
                        : number_format($yearlyRevenue / 1000000, 1) . ' Jt';
                @endphp
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center justify-center w-12 h-12 rounded-lg bg-gradient-to-br from-green-500 to-green-600">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <span class="px-2 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-full">Tahun Ini</span>
                </div>
                <h3 class="mb-1 text-sm font-medium text-gray-600">Pendapatan</h3>
                <p class="text-2xl font-bold leading-tight text-gray-900">Rp {{ $compactRevenue }}</p>
                <p class="mt-1 text-xs text-gray-500">Ringkasan tahun berjalan</p>
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

    <!-- Recent Orders Table -->
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
</x-admin-layout>