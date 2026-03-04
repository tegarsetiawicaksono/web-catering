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
                        Terverifikasi
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
                        <div class="md:col-span-2">
                            <label class="text-xs font-semibold tracking-wide text-gray-500 uppercase">Alamat Pengiriman</label>
                            <p class="mt-2 text-sm text-gray-700">
                                {{ $order->street_address }}<br>
                                Kecamatan {{ $order->district }}, {{ $order->city }}<br>
                                {{ $order->province }}
                            </p>
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

            <!-- Payment Verification Section -->
            @if($order->payment_method === 'cash')
            <!-- Cash Payment Notice -->
            <div class="overflow-hidden bg-gradient-to-br from-green-50 to-emerald-50 border-2 border-green-200 rounded-xl">
                <div class="px-6 py-4 border-b border-green-200 bg-gradient-to-r from-green-100 to-emerald-100">
                    <div class="flex items-center">
                        <div class="flex items-center justify-center w-10 h-10 mr-3 bg-green-500 rounded-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">💵 Pembayaran Tunai (Cash)</h3>
                    </div>
                </div>
                <div class="p-6">
                    <div class="bg-white p-4 rounded-lg border border-green-200 space-y-3">
                        <div class="flex items-center gap-3">
                            <div class="flex items-center justify-center w-10 h-10 bg-green-100 rounded-full">
                                <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-900">Pembayaran saat pengiriman</p>
                                <p class="text-xs text-gray-600">Customer akan membayar tunai kepada driver</p>
                            </div>
                        </div>
                        <div class="pt-3 border-t border-green-100">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Total yang harus dibayar:</span>
                                <span class="text-xl font-bold text-green-700">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3 mt-3">
                            <div class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-yellow-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                <div>
                                    <p class="text-xs font-semibold text-yellow-800">Catatan untuk Admin:</p>
                                    <p class="text-xs text-yellow-700 mt-1">Pastikan driver membawa uang kembalian yang cukup. Total pembayaran akan dikonfirmasi setelah pengiriman.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @elseif($order->latestPaymentVerification)
            <!-- Transfer Payment Verification -->
            <div class="overflow-hidden bg-white border border-gray-200 rounded-xl">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="flex items-center justify-center w-10 h-10 mr-3 bg-blue-100 rounded-lg">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900">Bukti Pembayaran</h3>
                        </div>
                        @if($order->latestPaymentVerification->status === 'pending')
                        <span class="px-3 py-1 text-xs font-medium text-yellow-800 bg-yellow-100 rounded-full">Menunggu Verifikasi</span>
                        @elseif($order->latestPaymentVerification->status === 'verified')
                        <span class="px-3 py-1 text-xs font-medium text-green-800 bg-green-100 rounded-full">Terverifikasi</span>
                        @else
                        <span class="px-3 py-1 text-xs font-medium text-red-800 bg-red-100 rounded-full">Ditolak</span>
                        @endif
                    </div>
                </div>
                <div class="p-6">
                    <!-- Payment Type Badge -->
                    @if($order->latestPaymentVerification->payment_type === 'dp')
                    <div class="mb-4 p-3 bg-blue-50 border-l-4 border-blue-500 rounded">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <p class="text-sm font-bold text-blue-900">Pembayaran DP ({{ $order->dp_percentage }}%)</p>
                                <p class="text-xs text-blue-700">Sisa pembayaran: Rp {{ number_format($order->remaining_amount, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                    @elseif($order->latestPaymentVerification->payment_type === 'remaining')
                    <div class="mb-4 p-3 bg-purple-50 border-l-4 border-purple-500 rounded">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-sm font-bold text-purple-900">Pembayaran Pelunasan</p>
                        </div>
                    </div>
                    @else
                    <div class="mb-4 p-3 bg-green-50 border-l-4 border-green-500 rounded">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <p class="text-sm font-bold text-green-900">Pembayaran Lunas (Full Payment)</p>
                        </div>
                    </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Payment Details -->
                        <div class="space-y-3">
                            <div>
                                <label class="text-xs font-semibold tracking-wide text-gray-500 uppercase">Bank Pengirim</label>
                                <p class="mt-1 text-sm font-medium text-gray-900">{{ $order->latestPaymentVerification->bank_name }}</p>
                            </div>
                            <div>
                                <label class="text-xs font-semibold tracking-wide text-gray-500 uppercase">No. Rekening</label>
                                <p class="mt-1 text-sm font-medium text-gray-900">{{ $order->latestPaymentVerification->account_number }}</p>
                            </div>
                            <div>
                                <label class="text-xs font-semibold tracking-wide text-gray-500 uppercase">Nama Pemilik</label>
                                <p class="mt-1 text-sm font-medium text-gray-900">{{ $order->latestPaymentVerification->account_name }}</p>
                            </div>
                            <div>
                                <label class="text-xs font-semibold tracking-wide text-gray-500 uppercase">Jumlah Transfer</label>
                                <p class="mt-1 text-lg font-bold text-green-600">Rp {{ number_format($order->latestPaymentVerification->amount, 0, ',', '.') }}</p>
                            </div>
                            <div>
                                <label class="text-xs font-semibold tracking-wide text-gray-500 uppercase">Tanggal Transfer</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $order->latestPaymentVerification->transfer_date->format('d M Y, H:i') }}</p>
                            </div>
                            @if($order->latestPaymentVerification->transfer_receipt_number)
                            <div>
                                <label class="text-xs font-semibold tracking-wide text-gray-500 uppercase">No. Referensi</label>
                                <p class="mt-1 text-sm font-mono text-gray-900">{{ $order->latestPaymentVerification->transfer_receipt_number }}</p>
                            </div>
                            @endif
                        </div>

                        <!-- Payment Proof Image -->
                        <div>
                            <label class="text-xs font-semibold tracking-wide text-gray-500 uppercase mb-2 block">Bukti Transfer</label>
                            <a href="{{ Storage::url($order->latestPaymentVerification->payment_proof) }}" target="_blank" class="block group">
                                <div class="relative overflow-hidden rounded-lg border-2 border-gray-300 group-hover:border-blue-500 transition-colors">
                                    <img src="{{ Storage::url($order->latestPaymentVerification->payment_proof) }}"
                                        alt="Bukti Transfer"
                                        class="w-full h-auto group-hover:opacity-90 transition-opacity">
                                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 transition-all flex items-center justify-center">
                                        <svg class="w-12 h-12 text-white opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                                        </svg>
                                    </div>
                                </div>
                            </a>
                            <p class="mt-2 text-xs text-gray-500 text-center">Klik untuk memperbesar</p>
                        </div>
                    </div>

                    @if($order->latestPaymentVerification->status === 'rejected' && $order->latestPaymentVerification->verification_notes)
                    <div class="mt-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                        <p class="text-sm font-semibold text-red-800">Catatan Penolakan:</p>
                        <p class="text-sm text-red-700 mt-1">{{ $order->latestPaymentVerification->verification_notes }}</p>
                    </div>
                    @endif

                    <!-- Admin Actions for Verification -->
                    @if($order->latestPaymentVerification->status === 'pending')
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <form action="{{ route('admin.payment-verifications.verify', $order) }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Aksi Verifikasi</label>
                                <div class="flex gap-3">
                                    <button type="submit" name="action" value="verify"
                                        class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Verifikasi Pembayaran
                                    </button>
                                    <button type="button" onclick="document.getElementById('reject-form').classList.toggle('hidden')"
                                        class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        Tolak Pembayaran
                                    </button>
                                </div>
                            </div>
                            <div id="reject-form" class="hidden">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Alasan Penolakan</label>
                                <textarea name="notes" rows="3" class="w-full rounded-lg border-gray-300" placeholder="Masukkan alasan penolakan..."></textarea>
                                <button type="submit" name="action" value="reject"
                                    class="mt-2 w-full inline-flex items-center justify-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                                    Konfirmasi Penolakan
                                </button>
                            </div>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
            @endif

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
                                    ✅ Terverifikasi
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