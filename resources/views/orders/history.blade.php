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
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Riwayat Pesanan</h1>
                <p class="text-gray-600">Lihat status dan detail pesanan Anda</p>
            </div>

            @if($orders->isEmpty())
            <!-- Empty State -->
            <div class="bg-white rounded-lg shadow-sm p-12 text-center">
                <svg class="mx-auto h-24 w-24 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum Ada Pesanan</h3>
                <p class="text-gray-600 mb-6">Anda belum memiliki riwayat pesanan</p>
                <a href="/#menu" class="inline-flex items-center px-6 py-3 bg-orange-500 text-white font-semibold rounded-lg hover:bg-orange-600 transition">
                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Lihat Menu
                </a>
            </div>
            @else
            <!-- Orders List -->
            <div class="space-y-4">
                @foreach($orders as $order)
                <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200" x-data="{ expanded: false }">
                    <!-- Order Header -->
                    <div class="p-6 cursor-pointer" @click="expanded = !expanded">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                            <div class="flex-1 mb-4 md:mb-0">
                                <div class="flex items-start justify-between mb-2">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">
                                            Order #{{ $order->id }}
                                        </h3>
                                        <p class="text-sm text-gray-500">
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
                        class="border-t border-gray-100">
                        <div class="p-6 bg-gray-50">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Customer Info -->
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-3">Informasi Pemesan</h4>
                                    <div class="space-y-2 text-sm">
                                        <p><span class="text-gray-500">Nama:</span> <span class="font-medium">{{ $order->customer_name }}</span></p>
                                        <p><span class="text-gray-500">Email:</span> <span class="font-medium">{{ $order->email }}</span></p>
                                        <p><span class="text-gray-500">Telepon:</span> <span class="font-medium">{{ $order->phone }}</span></p>
                                    </div>
                                </div>

                                <!-- Delivery Info -->
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-3">Alamat Pengiriman</h4>
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
                                <div class="md:col-span-2">
                                    <h4 class="font-semibold text-gray-900 mb-3">Detail Menu</h4>
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
                                <div class="md:col-span-2 bg-white rounded-lg p-4">
                                    <h4 class="font-semibold text-gray-900 mb-3">Status Pembayaran</h4>
                                    <div class="flex items-center space-x-3">
                                        @if($order->payment_status === 'pending')
                                        <div class="flex-shrink-0">
                                            <svg class="w-8 h-8 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-900">Menunggu Pembayaran</p>
                                            <p class="text-sm text-gray-600">Silakan lakukan pembayaran untuk memproses pesanan Anda</p>
                                        </div>
                                        @elseif($order->payment_status === 'verified' || $order->payment_status === 'paid')
                                        <div class="flex-shrink-0">
                                            <svg class="w-8 h-8 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-900">Pembayaran Terverifikasi</p>
                                            <p class="text-sm text-gray-600">Pesanan Anda sedang diproses</p>
                                        </div>
                                        @elseif($order->payment_status === 'completed')
                                        <div class="flex-shrink-0">
                                            <svg class="w-8 h-8 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-900">Pesanan Selesai</p>
                                            <p class="text-sm text-gray-600">Terima kasih telah menggunakan layanan kami</p>
                                        </div>
                                        @elseif($order->payment_status === 'cancelled')
                                        <div class="flex-shrink-0">
                                            <svg class="w-8 h-8 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-900">Pesanan Dibatalkan</p>
                                            <p class="text-sm text-gray-600">Pesanan ini telah dibatalkan</p>
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                @if($order->notes)
                                <div class="md:col-span-2">
                                    <h4 class="font-semibold text-gray-900 mb-2">Catatan</h4>
                                    <p class="text-sm text-gray-600 bg-white rounded-lg p-3">{{ $order->notes }}</p>
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