<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan - Rejosari Catering</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 600;
        }

        .status-pending {
            background-color: #FEF3C7;
            color: #92400E;
        }

        .status-verified {
            background-color: #DBEAFE;
            color: #1E40AF;
        }

        .status-processing {
            background-color: #E0E7FF;
            color: #4338CA;
        }

        .status-completed {
            background-color: #D1FAE5;
            color: #065F46;
        }

        .status-cancelled {
            background-color: #FEE2E2;
            color: #991B1B;
        }
    </style>
</head>

<body class="bg-gray-50">
    @include('partials.navbar')

    <div class="container mx-auto px-4 py-8 mt-20">
        <div class="max-w-6xl mx-auto">
            <!-- Header -->
            <div class="mb-8 bg-gradient-to-r from-orange-500 to-orange-600 rounded-xl shadow-lg p-6 text-white">
                <h1 class="text-3xl font-bold mb-2">Riwayat Pesanan</h1>
                <p class="text-orange-100">Lihat status dan detail pesanan Anda</p>
            </div>

            @if($orders->isEmpty())
            <!-- Empty State -->
            <div class="bg-white rounded-xl shadow-lg p-12 text-center">
                <div class="bg-gradient-to-br from-orange-100 to-orange-200 rounded-full p-6 w-32 h-32 flex items-center justify-center mx-auto mb-6">
                    <svg class="w-16 h-16 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Belum Ada Pesanan</h3>
                <p class="text-gray-600 mb-6">Anda belum memiliki riwayat pesanan. Mulai pesan catering terbaik untuk acara Anda!</p>
                <a href="/#menu" class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-semibold rounded-lg hover:from-orange-600 hover:to-orange-700 transition-all duration-200 shadow-md">
                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Jelajahi Menu
                </a>
            </div>
            @else
            <!-- Orders List -->
            <div class="space-y-4">
                @foreach($orders as $order)
                <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300" x-data="{ expanded: false }">
                    <!-- Order Header -->
                    <div class="p-6 cursor-pointer" @click="expanded = !expanded">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                            <div class="flex-1 mb-4 md:mb-0">
                                <div class="flex items-start justify-between mb-2">
                                    <div>
                                        <h3 class="text-lg font-bold text-gray-900">
                                            Order #{{ $order->id }}
                                        </h3>
                                        <p class="text-sm text-gray-500 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            {{ $order->created_at->format('d M Y, H:i') }}
                                        </p>
                                    </div>
                                    <div class="md:hidden">
                                        @php
                                        $statusClass = match($order->payment_status) {
                                        'pending' => 'status-pending',
                                        'verified' => 'status-verified',
                                        'paid' => 'status-verified',
                                        'completed' => 'status-completed',
                                        'cancelled' => 'status-cancelled',
                                        default => 'status-pending'
                                        };
                                        $statusText = match($order->payment_status) {
                                        'pending' => 'Menunggu Pembayaran',
                                        'verified' => 'Terverifikasi',
                                        'paid' => 'Dibayar',
                                        'completed' => 'Selesai',
                                        'cancelled' => 'Dibatalkan',
                                        default => 'Pending'
                                        };
                                        @endphp
                                        <span class="status-badge {{ $statusClass }}">
                                            {{ $statusText }}
                                        </span>
                                    </div>
                                </div>

                                <div class="space-y-1">
                                    <p class="text-gray-700">
                                        <span class="font-medium">Acara:</span>
                                        {{ \Carbon\Carbon::parse($order->event_date)->format('d M Y') }}
                                    </p>
                                    <p class="text-gray-700">
                                        <span class="font-medium">Lokasi:</span>
                                        {{ $order->district }}, {{ $order->city }}
                                    </p>
                                    @if($order->items && is_array($order->items))
                                    <p class="text-gray-700">
                                        <span class="font-medium">Menu:</span>
                                        {{ count($order->items) }} item
                                    </p>
                                    @endif
                                </div>
                            </div>

                            <div class="hidden md:flex items-center space-x-6">
                                <div class="text-right">
                                    <p class="text-sm text-gray-500 mb-1">Total</p>
                                    <p class="text-xl font-bold text-gray-900">
                                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                    </p>
                                </div>
                                @php
                                $statusClass = match($order->payment_status) {
                                'pending' => 'status-pending',
                                'verified' => 'status-verified',
                                'paid' => 'status-verified',
                                'completed' => 'status-completed',
                                'cancelled' => 'status-cancelled',
                                default => 'status-pending'
                                };
                                $statusText = match($order->payment_status) {
                                'pending' => 'Menunggu Pembayaran',
                                'verified' => 'Terverifikasi',
                                'paid' => 'Dibayar',
                                'completed' => 'Selesai',
                                'cancelled' => 'Dibatalkan',
                                default => 'Pending'
                                };
                                @endphp
                                <span class="status-badge {{ $statusClass }}">
                                    {{ $statusText }}
                                </span>
                                <svg class="w-5 h-5 text-gray-400 transition-transform duration-200"
                                    :class="{ 'rotate-180': expanded }"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>

                            <!-- Mobile Total & Toggle -->
                            <div class="md:hidden flex items-center justify-between mt-4 pt-4 border-t border-gray-100">
                                <div>
                                    <p class="text-sm text-gray-500">Total</p>
                                    <p class="text-xl font-bold text-gray-900">
                                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                    </p>
                                </div>
                                <button class="text-orange-500 font-medium flex items-center">
                                    <span x-text="expanded ? 'Tutup' : 'Lihat Detail'"></span>
                                    <svg class="w-5 h-5 ml-1 transition-transform duration-200"
                                        :class="{ 'rotate-180': expanded }"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Order Details (Expandable) -->
                    <div x-show="expanded"
                        x-collapse
                        class="border-t border-gray-200 bg-gradient-to-br from-gray-50 to-orange-50">
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Customer Info -->
                                <div class="bg-white rounded-lg shadow-sm p-4 border-l-4 border-orange-400">
                                    <h4 class="font-bold text-gray-900 mb-3 flex items-center">
                                        <svg class="w-5 h-5 text-orange-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        Informasi Pemesan
                                    </h4>
                                    <div class="space-y-2 text-sm">
                                        <p><span class="text-gray-500">Nama:</span> <span class="font-medium">{{ $order->customer_name }}</span></p>
                                        <p><span class="text-gray-500">Email:</span> <span class="font-medium">{{ $order->email }}</span></p>
                                        <p><span class="text-gray-500">Telepon:</span> <span class="font-medium">{{ $order->phone }}</span></p>
                                    </div>
                                </div>

                                <!-- Delivery Info -->
                                <div class="bg-white rounded-lg shadow-sm p-4 border-l-4 border-orange-400">
                                    <h4 class="font-bold text-gray-900 mb-3 flex items-center">
                                        <svg class="w-5 h-5 text-orange-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        Alamat Pengiriman
                                    </h4>
                                    <div class="space-y-2 text-sm">
                                        <p class="font-medium">{{ $order->street_address }}</p>
                                        <p class="text-gray-600">
                                            {{ $order->district }}, {{ $order->city }}<br>
                                            {{ $order->province }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Order Items -->
                                @if($order->items && is_array($order->items))
                                <div class="md:col-span-2 bg-white rounded-lg shadow-sm p-4 border-l-4 border-orange-400">
                                    <h4 class="font-bold text-gray-900 mb-3 flex items-center">
                                        <svg class="w-5 h-5 text-orange-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        Detail Menu
                                    </h4>
                                    <div class="bg-white rounded-lg overflow-hidden">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Menu</th>
                                                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Harga</th>
                                                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                                                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Subtotal</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-200">
                                                @foreach($order->items as $item)
                                                <tr>
                                                    <td class="px-4 py-3 text-sm text-gray-900">{{ $item['name'] ?? 'N/A' }}</td>
                                                    <td class="px-4 py-3 text-sm text-gray-900 text-right">
                                                        Rp {{ number_format($item['price'] ?? 0, 0, ',', '.') }}
                                                    </td>
                                                    <td class="px-4 py-3 text-sm text-gray-900 text-right">
                                                        {{ $item['quantity'] ?? 0 }} porsi
                                                    </td>
                                                    <td class="px-4 py-3 text-sm font-medium text-gray-900 text-right">
                                                        Rp {{ number_format(($item['price'] ?? 0) * ($item['quantity'] ?? 0), 0, ',', '.') }}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @endif

                                <!-- Payment Status Info -->
                                <div class="md:col-span-2 bg-white rounded-lg shadow-sm p-4 border-l-4 border-orange-400">
                                    <h4 class="font-bold text-gray-900 mb-3 flex items-center">
                                        <svg class="w-5 h-5 text-orange-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                        </svg>
                                        Status Pembayaran
                                    </h4>
                                    @if($order->latestPaymentVerification)
                                        @if($order->latestPaymentVerification->status === 'pending')
                                        <div class="flex items-center space-x-3 bg-yellow-50 p-4 rounded-lg">
                                            <div class="flex-shrink-0">
                                                <svg class="w-8 h-8 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="font-medium text-gray-900">⏳ Bukti Pembayaran Sedang Diverifikasi</p>
                                                <p class="text-sm text-gray-600">Admin sedang memverifikasi bukti pembayaran Anda. Mohon tunggu beberapa saat.</p>
                                                <a href="{{ route('orders.show', $order) }}" class="text-sm text-orange-600 hover:text-orange-700 font-medium mt-1 inline-block">Lihat Detail Bukti →</a>
                                            </div>
                                        </div>
                                        @elseif($order->latestPaymentVerification->status === 'verified')
                                        <div class="flex items-center space-x-3 bg-green-50 p-4 rounded-lg">
                                            <div class="flex-shrink-0">
                                                <svg class="w-8 h-8 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="font-medium text-gray-900">✓ Pembayaran Terverifikasi</p>
                                                <p class="text-sm text-gray-600">Pembayaran Anda telah diverifikasi. Pesanan sedang diproses.</p>
                                                <a href="{{ route('orders.show', $order) }}" class="text-sm text-orange-600 hover:text-orange-700 font-medium mt-1 inline-block">Lihat Detail Pesanan →</a>
                                            </div>
                                        </div>
                                        @else
                                        <div class="flex items-center space-x-3 bg-red-50 p-4 rounded-lg">
                                            <div class="flex-shrink-0">
                                                <svg class="w-8 h-8 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="font-medium text-gray-900">✗ Pembayaran Ditolak</p>
                                                <p class="text-sm text-gray-600">{{ $order->latestPaymentVerification->verification_notes ?? 'Mohon upload ulang bukti pembayaran yang valid.' }}</p>
                                                <a href="{{ route('orders.show', $order) }}" class="text-sm text-orange-600 hover:text-orange-700 font-medium mt-1 inline-block">Upload Bukti Baru →</a>
                                            </div>
                                        </div>
                                        @endif
                                    @else
                                        <div class="flex items-center space-x-3 bg-orange-50 p-4 rounded-lg">
                                            <div class="flex-shrink-0">
                                                <svg class="w-8 h-8 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="font-medium text-gray-900">⚠️ Belum Upload Bukti Pembayaran</p>
                                                <p class="text-sm text-gray-600">Silakan upload bukti pembayaran untuk memproses pesanan Anda</p>
                                                <a href="{{ route('orders.show', $order) }}" class="inline-block mt-2 px-4 py-2 bg-orange-500 text-white text-sm font-medium rounded-lg hover:bg-orange-600 transition">Upload Bukti Sekarang →</a>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                @if($order->notes)
                                <div class="md:col-span-2 bg-white rounded-lg shadow-sm p-4 border-l-4 border-orange-400">
                                    <h4 class="font-bold text-gray-900 mb-3 flex items-center">
                                        <svg class="w-5 h-5 text-orange-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                        </svg>
                                        Catatan
                                    </h4>
                                    <p class="text-sm text-gray-600 bg-gray-50 rounded p-3">{{ $order->notes }}</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>

    <script>
        // Alpine.js collapse directive
        document.addEventListener('alpine:init', () => {
            Alpine.directive('collapse', (el, {
                expression
            }, {
                effect,
                evaluateLater
            }) => {
                let duration = 300;
                let isOpen = evaluateLater(expression);

                effect(() => {
                    isOpen(value => {
                        if (value) {
                            el.style.height = 'auto';
                            let height = el.offsetHeight;
                            el.style.height = '0px';
                            el.style.overflow = 'hidden';
                            el.style.transition = `height ${duration}ms ease`;

                            requestAnimationFrame(() => {
                                el.style.height = height + 'px';
                            });

                            setTimeout(() => {
                                el.style.height = 'auto';
                                el.style.overflow = 'visible';
                            }, duration);
                        } else {
                            el.style.height = el.offsetHeight + 'px';
                            el.style.overflow = 'hidden';
                            el.style.transition = `height ${duration}ms ease`;

                            requestAnimationFrame(() => {
                                el.style.height = '0px';
                            });
                        }
                    });
                });
            });
        });
    </script>
</body>

</html>