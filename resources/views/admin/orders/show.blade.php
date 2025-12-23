@section('page-title', 'Detail Pesanan #' . $order->id)

<x-admin-layout>
    <!-- Header with Action Buttons -->
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('admin.orders.index') }}"
                        class="text-gray-600 transition-colors hover:text-gray-900">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </a>
                    <h1 class="text-2xl font-bold text-gray-900">Detail Pesanan #{{ $order->id }}</h1>
                    @if($order->status === 'pending')
                    <span class="inline-flex items-center px-3 py-1 text-xs font-medium text-yellow-800 bg-yellow-100 rounded-full">
                        <span class="w-1.5 h-1.5 mr-1.5 bg-yellow-500 rounded-full animate-pulse"></span>
                        Pending
                    </span>
                    @elseif($order->status === 'confirmed')
                    <span class="inline-flex items-center px-3 py-1 text-xs font-medium text-blue-800 bg-blue-100 rounded-full">
                        <span class="w-1.5 h-1.5 mr-1.5 bg-blue-500 rounded-full"></span>
                        Dikonfirmasi
                    </span>
                    @elseif($order->status === 'completed')
                    <span class="inline-flex items-center px-3 py-1 text-xs font-medium text-green-800 bg-green-100 rounded-full">
                        <span class="w-1.5 h-1.5 mr-1.5 bg-green-500 rounded-full"></span>
                        Selesai
                    </span>
                    @else
                    <span class="inline-flex items-center px-3 py-1 text-xs font-medium text-red-800 bg-red-100 rounded-full">
                        <span class="w-1.5 h-1.5 mr-1.5 bg-red-500 rounded-full"></span>
                        {{ ucfirst($order->status) }}
                    </span>
                    @endif
                </div>
                <p class="mt-1 text-sm text-gray-600">Dipesan pada {{ $order->created_at->format('d M Y, H:i') }}</p>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('orders.download-invoice', $order) }}"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 transition-colors bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Download Invoice
                </a>
                <a href="{{ route('orders.send-invoice', $order) }}"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-colors bg-green-600 rounded-lg hover:bg-green-700">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    Kirim ke WhatsApp
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <!-- Main Content -->
        <div class="space-y-6 lg:col-span-2">
            <!-- Customer Information -->
            <div class="overflow-hidden bg-white border border-gray-200 rounded-xl">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <div class="flex items-center">
                        <div class="flex items-center justify-center w-10 h-10 mr-3 bg-indigo-100 rounded-lg">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Informasi Pelanggan</h3>
                    </div>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div>
                            <label class="text-xs font-semibold tracking-wide text-gray-500 uppercase">Nama Lengkap</label>
                            <p class="mt-2 text-sm font-medium text-gray-900">{{ $order->customer_name }}</p>
                        </div>
                        <div>
                            <label class="text-xs font-semibold tracking-wide text-gray-500 uppercase">Email</label>
                            <p class="mt-2 text-sm text-gray-900">{{ $order->email }}</p>
                        </div>
                        <div>
                            <label class="text-xs font-semibold tracking-wide text-gray-500 uppercase">No. Telepon</label>
                            <p class="mt-2 text-sm font-medium text-gray-900">{{ $order->phone }}</p>
                        </div>
                        <div>
                            <label class="text-xs font-semibold tracking-wide text-gray-500 uppercase">Alamat Pengiriman</label>
                            <p class="mt-2 text-sm text-gray-700">{{ $order->address }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Details -->
            <div class="overflow-hidden bg-white border border-gray-200 rounded-xl">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <div class="flex items-center">
                        <div class="flex items-center justify-center w-10 h-10 mr-3 bg-green-100 rounded-lg">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Detail Pesanan</h3>
                    </div>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div>
                                <p class="text-xs font-semibold tracking-wide text-gray-500 uppercase">Paket yang Dipesan</p>
                                <p class="mt-1 text-lg font-bold text-gray-900">{{ $order->package_name }}</p>
                            </div>
                            <div class="flex items-center justify-center w-16 h-16 bg-white border-2 border-indigo-200 rounded-lg">
                                <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="p-4 border border-gray-200 rounded-lg">
                                <p class="text-xs font-semibold text-gray-500">Jumlah Porsi</p>
                                <p class="mt-2 text-2xl font-bold text-gray-900">{{ $order->quantity }}</p>
                                <p class="text-xs text-gray-500">porsi</p>
                            </div>
                            <div class="p-4 border border-gray-200 rounded-lg">
                                <p class="text-xs font-semibold text-gray-500">Harga per Porsi</p>
                                <p class="mt-2 text-2xl font-bold text-gray-900">
                                    Rp {{ number_format($order->total_price / $order->quantity, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="text-xs font-semibold tracking-wide text-gray-500 uppercase">Tanggal Event</label>
                                <p class="mt-2 text-sm font-medium text-gray-900">
                                    {{ $order->event_date ? \Carbon\Carbon::parse($order->event_date)->format('d F Y') : '-' }}
                                </p>
                            </div>
                            <div>
                                <label class="text-xs font-semibold tracking-wide text-gray-500 uppercase">Waktu Event</label>
                                <p class="mt-2 text-sm font-medium text-gray-900">
                                    {{ $order->event_time ?? 'Tidak ditentukan' }}
                                </p>
                            </div>
                        </div>

                        <div class="p-4 border-2 border-dashed border-gray-300 rounded-lg bg-gray-50">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-semibold text-gray-700">Total Pembayaran</span>
                                <span class="text-2xl font-bold text-indigo-600">
                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notes -->
            @if($order->notes)
            <div class="overflow-hidden bg-white border border-gray-200 rounded-xl">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <div class="flex items-center">
                        <div class="flex items-center justify-center w-10 h-10 mr-3 bg-yellow-100 rounded-lg">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Catatan Pesanan</h3>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-sm leading-relaxed text-gray-700">{{ $order->notes }}</p>
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6 lg:col-span-1">
            <!-- Update Status -->
            <div class="overflow-hidden bg-white border border-gray-200 rounded-xl">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-900">Update Status</h3>
                </div>
                <div class="p-6">
                    <form action="{{ route('admin.orders.update-status', $order) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PATCH')
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-700">Status Pesanan</label>
                            <select name="status"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>
                                    ⏳ Pending
                                </option>
                                <option value="confirmed" {{ $order->status === 'confirmed' ? 'selected' : '' }}>
                                    ✅ Dikonfirmasi
                                </option>
                                <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>
                                    🎉 Selesai
                                </option>
                                <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>
                                    ❌ Dibatalkan
                                </option>
                            </select>
                        </div>
                        <button type="submit"
                            class="flex items-center justify-center w-full px-4 py-3 text-sm font-semibold text-white transition-colors bg-indigo-600 rounded-lg hover:bg-indigo-700">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            Update Status
                        </button>
                    </form>
                </div>
            </div>

            <!-- Order Timeline -->
            <div class="overflow-hidden bg-white border border-gray-200 rounded-xl">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-900">Timeline</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="flex items-center justify-center w-8 h-8 mr-3 bg-green-100 rounded-full shrink-0">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-gray-900">Pesanan Dibuat</p>
                                <p class="text-xs text-gray-500">{{ $order->created_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>

                        @if($order->confirmed_at)
                        <div class="flex items-start">
                            <div class="flex items-center justify-center w-8 h-8 mr-3 bg-blue-100 rounded-full shrink-0">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-gray-900">Pesanan Dikonfirmasi</p>
                                <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($order->confirmed_at)->format('d M Y, H:i') }}</p>
                            </div>
                        </div>
                        @endif

                        @if($order->status === 'completed')
                        <div class="flex items-start">
                            <div class="flex items-center justify-center w-8 h-8 mr-3 rounded-full bg-purple-100 shrink-0">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-gray-900">Pesanan Selesai</p>
                                <p class="text-xs text-gray-500">{{ $order->updated_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="overflow-hidden bg-white border border-gray-200 rounded-xl">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-900">Aksi Cepat</h3>
                </div>
                <div class="p-6 space-y-3">
                    <a href="mailto:{{ $order->email }}"
                        class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-gray-700 transition-colors bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        Kirim Email
                    </a>
                    <a href="tel:{{ $order->phone }}"
                        class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-gray-700 transition-colors bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        Telepon
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>