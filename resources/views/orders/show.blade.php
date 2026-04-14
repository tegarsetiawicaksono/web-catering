@extends('layouts.app')

@section('content')
<div class="pt-24 pb-16">
    <div class="container mx-auto px-3 sm:px-4">
        <div class="max-w-4xl mx-auto">
            @if (session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                {{ session('success') }}
            </div>
            @endif

            @if (session('error'))
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                {{ session('error') }}
            </div>
            @endif

            @if($order)
            <div class="bg-white rounded-lg shadow-lg p-4 sm:p-6 md:p-8">
                <!-- Order Status -->
                <div class="mb-6 sm:mb-8">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 sm:gap-0 mb-4">
                        <h1 class="text-xl sm:text-2xl md:text-3xl font-bold">Order #{{ $order->id }}</h1>
                        @php
                        $statusClass = match($order->status) {
                            'pending' => 'bg-yellow-100 text-yellow-800',
                            'confirmed' => 'bg-blue-100 text-blue-800',
                            'processing' => 'bg-indigo-100 text-indigo-800',
                            'completed' => 'bg-green-100 text-green-800',
                            'cancelled' => 'bg-red-100 text-red-800',
                            default => 'bg-gray-100 text-gray-800'
                        };
                        $statusText = match($order->status) {
                            'pending' => 'Menunggu Pembayaran',
                            'confirmed' => 'Terverifikasi',
                            'processing' => 'Diproses',
                            'completed' => 'Selesai',
                            'cancelled' => 'Dibatalkan',
                            default => ucfirst($order->status)
                        };
                        @endphp
                        <span class="px-3 sm:px-4 py-1 sm:py-2 rounded-full font-semibold text-sm sm:text-base w-fit {{ $statusClass }}">
                            {{ $statusText }}
                        </span>
                    </div>
                    <p class="text-gray-600">Order dibuat: {{ $order->created_at ? $order->created_at->format('d M Y, H:i') : '-' }}</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8">
                    <!-- Order Details -->
                    <div>
                        <h2 class="text-lg sm:text-xl font-semibold mb-3 sm:mb-4">Detail Pesanan</h2>
                        <dl class="space-y-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-600">Nama</dt>
                                <dd class="mt-1">{{ $order->customer_name }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-600">Email</dt>
                                <dd class="mt-1">{{ $order->email }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-600">No. Telepon</dt>
                                <dd class="mt-1">{{ $order->phone }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-600">Tanggal Acara</dt>
                                <dd class="mt-1">{{ $order->event_date ? \Carbon\Carbon::parse($order->event_date)->format('d M Y') : '-' }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-600">Alamat Pengiriman</dt>
                                <dd class="mt-1">
                                    {{ $order->street_address }}<br>
                                    Kecamatan {{ $order->district }}, {{ $order->city }}<br>
                                    {{ $order->province }}
                                </dd>
                            </div>
                            @if($order->notes)
                            <div>
                                <dt class="text-sm font-medium text-gray-600">Catatan</dt>
                                <dd class="mt-1">{{ $order->notes }}</dd>
                            </div>
                            @endif
                        </dl>
                    </div>

                    <!-- Order Items -->
                    <div>
                        <h2 class="text-lg sm:text-xl font-semibold mb-3 sm:mb-4">Item Pesanan</h2>
                        <div class="space-y-4">
                            @if($order->items)
                            @foreach($order->items as $item)
                            <div class="flex justify-between items-start py-3 sm:py-4 border-b gap-2">
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-medium text-sm sm:text-base break-words">{{ $item['name'] }}</h3>
                                    <p class="text-gray-600 text-xs sm:text-sm">{{ $item['quantity'] }} pax</p>
                                </div>
                                <p class="font-medium text-sm sm:text-base whitespace-nowrap ml-2">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</p>
                            </div>
                            @endforeach
                            @else
                            <div class="py-4 text-gray-500 text-center">
                                <p>{{ $order->package_name }} - {{ $order->quantity }} porsi</p>
                                <p class="font-medium mt-2">Total: Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                            </div>
                            @endif

                            <div class="flex justify-between items-center pt-4 font-bold">
                                <span>Total</span>
                                <span>Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="mt-8 pt-8 border-t">
                    <!-- Payment Upload Section -->
                    @if($order->status === 'pending' && !$order->latestPaymentVerification)
                        @if($order->payment_method === 'cash')
                        <!-- Cash Payment Notice - Upload Required -->
                        <div class="bg-gradient-to-br from-amber-50 to-yellow-50 p-6 rounded-lg shadow-md mb-6 border-2 border-amber-300">
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0">
                                    <div class="w-16 h-16 bg-gradient-to-br from-amber-500 to-yellow-500 rounded-full flex items-center justify-center">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-xl font-bold text-gray-900 mb-2">⚠️ Pembayaran Tunai (Cash)</h3>
                                    <p class="text-gray-700 mb-3">
                                        <strong>PENTING:</strong> Untuk menghindari orderan fiktif, Anda <strong>wajib upload bukti pembayaran DP atau Lunas</strong> minimal 7 hari sebelum tanggal acara.
                                    </p>
                                    <div class="bg-white p-4 rounded-lg border border-amber-300 space-y-2">
                                        <div class="flex items-center gap-2 text-sm text-gray-700">
                                            <svg class="w-5 h-5 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                            </svg>
                                            <span><strong>Batas Upload:</strong> {{ $order->event_date->copy()->subDays(7)->format('d M Y') }} (7 hari sebelum acara)</span>
                                        </div>
                                        <div class="flex items-center gap-2 text-sm text-gray-700">
                                            <svg class="w-5 h-5 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/>
                                                <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd" />
                                            </svg>
                                            <span><strong>Minimal DP 50%:</strong> Rp {{ number_format($order->total_price * 0.5, 0, ',', '.') }}</span>
                                        </div>
                                        <div class="flex items-center gap-2 text-sm text-gray-700">
                                            <svg class="w-5 h-5 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                            </svg>
                                            <span>Total yang harus dibayar: <strong class="text-lg text-amber-700">Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong></span>
                                        </div>
                                    </div>
                                    <div class="mt-4 p-3 bg-red-50 border border-red-200 rounded-lg">
                                        <p class="text-sm text-red-800 font-semibold">
                                            🚫 Pesanan yang tidak melakukan konfirmasi pembayaran sampai batas waktu akan dibatalkan secara otomatis.
                                        </p>
                                    </div>
                                    <p class="text-sm text-gray-600 mt-3">
                                        📅 <strong>Tanggal Event:</strong> {{ $order->event_date->format('d M Y') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- Upload Form untuk Cash (sama seperti transfer) -->
                        @endif
                        
                        @if($order->payment_method !== 'skip_for_now')
                        <!-- Transfer Payment Upload Form -->
                    <div class="bg-white p-4 sm:p-6 rounded-lg shadow-md mb-6">
                        <h3 class="text-base sm:text-lg font-semibold mb-3 sm:mb-4">Upload Bukti Pembayaran</h3>
                        <form action="{{ route('payment.verify', $order) }}" method="POST" enctype="multipart/form-data" class="space-y-4" x-data="{
                            paymentType: 'full',
                            totalPrice: {{ $order->total_price }},
                            dpPercentage: 50,
                            get dpAmount() {
                                return Math.round(this.totalPrice * (this.dpPercentage / 100));
                            },
                            get paymentAmount() {
                                return this.paymentType === 'dp' ? this.dpAmount : this.totalPrice;
                            }
                        }">
                            @csrf
                            
                            <!-- Payment Type Selection -->
                            <div class="bg-gradient-to-r from-orange-50 to-amber-50 p-4 rounded-lg border-2 border-orange-200">
                                <label class="block text-sm font-semibold text-gray-900 mb-3">Pilih Jenis Pembayaran</label>
                                <div class="space-y-3">
                                    <label class="flex items-start p-3 border-2 rounded-lg cursor-pointer transition-all" 
                                           :class="paymentType === 'full' ? 'border-orange-500 bg-white shadow-md' : 'border-gray-300 bg-white hover:border-orange-300'">
                                        <input type="radio" name="payment_type" value="full" class="mt-1" x-model="paymentType" required>
                                        <div class="ml-3 flex-1">
                                            <div class="font-semibold text-gray-900">💳 Bayar Lunas (Full Payment)</div>
                                            <div class="text-sm text-gray-600 mt-1">
                                                Bayar penuh sekarang: <span class="font-bold text-orange-600">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                                            </div>
                                            <div class="text-xs text-green-600 mt-1">✓ Langsung selesai, tidak perlu bayar lagi</div>
                                        </div>
                                    </label>
                                    
                                    <label class="flex items-start p-3 border-2 rounded-lg cursor-pointer transition-all" 
                                           :class="paymentType === 'dp' ? 'border-orange-500 bg-white shadow-md' : 'border-gray-300 bg-white hover:border-orange-300'">
                                        <input type="radio" name="payment_type" value="dp" class="mt-1" x-model="paymentType">
                                        <div class="ml-3 flex-1">
                                            <div class="font-semibold text-gray-900">🎯 Bayar DP (Down Payment) 50%</div>
                                            <div class="text-sm text-gray-600 mt-1">
                                                Bayar DP dulu: <span class="font-bold text-orange-600" x-text="'Rp ' + dpAmount.toLocaleString('id-ID')"></span>
                                            </div>
                                            <div class="text-xs text-blue-600 mt-1">
                                                ℹ️ Sisa pembayaran <span x-text="'Rp ' + (totalPrice - dpAmount).toLocaleString('id-ID')"></span> dibayar sebelum event
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Bank Transfer Anda</label>
                                    <input type="text" 
                                           name="bank_name" 
                                           class="w-full rounded-md border-gray-300 bg-gray-50 font-semibold" 
                                           value="{{ $order->payment_method }}" 
                                           readonly
                                           required>
                                    <p class="text-xs text-blue-600 mt-1">✓ Otomatis dari metode pembayaran yang dipilih</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Rekening Pengirim</label>
                                    <input type="text" name="account_number" class="w-full rounded-md border-gray-300" placeholder="Nomor rekening Anda" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pemilik Rekening</label>
                                    <input type="text" name="account_name" class="w-full rounded-md border-gray-300" placeholder="Nama Anda di rekening" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah Transfer</label>
                                    <input type="number" 
                                           name="amount" 
                                           class="w-full rounded-md border-gray-300 bg-gray-50 font-semibold" 
                                           :value="paymentAmount" 
                                           readonly>
                                    <p class="text-xs text-gray-500 mt-1" x-show="paymentType === 'dp'">
                                        Otomatis sesuai DP 50% dari total harga
                                    </p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Referensi Transfer <span class="text-gray-500 text-xs">(Opsional)</span></label>
                                    <input type="text" name="transfer_receipt_number" class="w-full rounded-md border-gray-300">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Transfer</label>
                                    <input type="datetime-local" name="transfer_date" class="w-full rounded-md border-gray-300" required>
                                </div>
                            </div>
                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Bukti Transfer (Max 2MB)</label>
                                <input type="file" name="payment_proof" accept="image/*" class="w-full" required>
                                <p class="mt-1 text-sm text-gray-500">Format yang diterima: JPG, PNG, JPEG. Pastikan bukti transfer terlihat jelas.</p>
                            </div>
                            <div class="mt-6">
                                <button type="submit" class="w-full bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition-colors">
                                    <span x-show="paymentType === 'full'">Upload Bukti Pembayaran Lunas</span>
                                    <span x-show="paymentType === 'dp'">Upload Bukti DP</span>
                                </button>
                            </div>
                        </form>
                    </div>
                    @endif
                    @endif

                    <!-- Payment Verification Status -->
                    @if($order->latestPaymentVerification)
                    <div class="bg-white p-4 sm:p-6 rounded-lg shadow-md mb-6">
                        <!-- Payment Type Badge -->
                        @if($order->latestPaymentVerification->payment_type === 'dp')
                        <div class="mb-4 p-3 bg-blue-50 border border-blue-200 rounded-lg">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="text-sm font-semibold text-blue-900">Pembayaran DP ({{ $order->dp_percentage }}%)</p>
                            </div>
                        </div>
                        @elseif($order->latestPaymentVerification->payment_type === 'full')
                        <div class="mb-4 p-3 bg-green-50 border border-green-200 rounded-lg">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <p class="text-sm font-semibold text-green-900">Pembayaran Lunas</p>
                            </div>
                        </div>
                        @endif

                        <!-- Bukti Pembayaran yang Diupload -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <p class="text-sm text-gray-600">Bank: <span class="font-semibold text-gray-900">{{ $order->latestPaymentVerification->bank_name }}</span></p>
                                <p class="text-sm text-gray-600">No. Rekening: <span class="font-semibold text-gray-900">{{ $order->latestPaymentVerification->account_number }}</span></p>
                                <p class="text-sm text-gray-600">Nama: <span class="font-semibold text-gray-900">{{ $order->latestPaymentVerification->account_name }}</span></p>
                                <p class="text-sm text-gray-600">Jumlah: <span class="font-semibold text-gray-900">Rp {{ number_format($order->latestPaymentVerification->amount, 0, ',', '.') }}</span></p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 mb-2">Bukti Transfer:</p>
                                <a href="{{ Storage::url($order->latestPaymentVerification->payment_proof) }}" target="_blank" class="block">
                                    <img src="{{ Storage::url($order->latestPaymentVerification->payment_proof) }}" alt="Bukti Transfer" class="w-full max-w-xs rounded-lg border border-gray-300 hover:opacity-80 transition-opacity">
                                </a>
                            </div>
                        </div>

                        @if($order->latestPaymentVerification->status === 'rejected' && $order->latestPaymentVerification->verification_notes)
                        <div class="mt-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                            <p class="text-sm text-red-800"><strong>Catatan Penolakan:</strong> {{ $order->latestPaymentVerification->verification_notes }}</p>
                        </div>
                        @endif
                    </div>
                    @elseif(in_array($order->status, ['confirmed', 'completed']))
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 p-4 sm:p-6 rounded-lg shadow-md mb-6 border-2 border-green-200">
                        <div class="flex items-center gap-3">
                            <svg class="w-8 h-8 text-green-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <div class="flex-1">
                                <h3 class="text-lg font-bold text-green-900">✅ Pembayaran Sudah Dikonfirmasi</h3>
                                <p class="text-sm text-green-700 mt-1">Pesanan Anda telah dikonfirmasi dan sedang diproses oleh tim kami.</p>
                                @if($order->paid_at)
                                <p class="text-xs text-green-600 mt-2">Dikonfirmasi pada: {{ $order->paid_at->format('d M Y, H:i') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Remaining Payment Alert (if DP verified) -->
                    @if($order->payment_status === 'dp_paid' && $order->remaining_amount > 0)
                    <div class="bg-gradient-to-r from-orange-50 to-amber-50 p-4 sm:p-6 rounded-lg shadow-md mb-6 border-2 border-orange-300">
                        <div class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-orange-600 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div class="flex-1">
                                <h3 class="text-lg font-bold text-gray-900 mb-2">⚠️ Sisa Pembayaran Belum Lunas</h3>
                                <div class="space-y-2 text-sm">
                                    <p><span class="text-gray-600">Total Harga:</span> <span class="font-bold text-gray-900">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span></p>
                                    <p><span class="text-gray-600">DP Dibayar ({{ $order->dp_percentage }}%):</span> <span class="font-bold text-green-600">Rp {{ number_format($order->paid_amount, 0, ',', '.') }}</span></p>
                                    <div class="pt-2 border-t border-orange-200">
                                        <p><span class="text-gray-600">Sisa Pembayaran:</span> <span class="font-bold text-xl text-orange-600">Rp {{ number_format($order->remaining_amount, 0, ',', '.') }}</span></p>
                                    </div>
                                </div>
                                <p class="mt-3 text-sm text-orange-700 bg-orange-100 p-2 rounded">
                                    💡 <strong>Penting:</strong> Harap lunasi sisa pembayaran sebelum tanggal event ({{ $order->event_date->format('d/m/Y') }})
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Upload Remaining Payment Form -->
                    <div class="bg-white p-4 sm:p-6 rounded-lg shadow-md mb-6">
                        <h3 class="text-base sm:text-lg font-semibold mb-3 sm:mb-4">Upload Bukti Pelunasan</h3>
                        <form action="{{ route('payment.verify', $order) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                            @csrf
                            <input type="hidden" name="payment_type" value="remaining">
                            
                            <div class="bg-blue-50 p-3 rounded-lg mb-4">
                                <p class="text-sm text-blue-900">
                                    <strong>Jumlah yang harus dibayar:</strong> 
                                    <span class="text-lg font-bold text-blue-700">Rp {{ number_format($order->remaining_amount, 0, ',', '.') }}</span>
                                </p>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Bank Transfer Anda</label>
                                    <input type="text" 
                                           name="bank_name" 
                                           class="w-full rounded-md border-gray-300 bg-gray-50 font-semibold" 
                                           value="{{ $order->payment_method }}" 
                                           readonly
                                           required>
                                    <p class="text-xs text-blue-600 mt-1">✓ Otomatis dari metode pembayaran yang dipilih</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Rekening Pengirim</label>
                                    <input type="text" name="account_number" class="w-full rounded-md border-gray-300" placeholder="Nomor rekening Anda" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pemilik Rekening</label>
                                    <input type="text" name="account_name" class="w-full rounded-md border-gray-300" placeholder="Nama Anda di rekening" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah Transfer</label>
                                    <input type="number" 
                                           name="amount" 
                                           class="w-full rounded-md border-gray-300 bg-gray-50 font-semibold" 
                                           value="{{ $order->remaining_amount }}" 
                                           readonly>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Referensi Transfer <span class="text-gray-500 text-xs">(Opsional)</span></label>
                                    <input type="text" name="transfer_receipt_number" class="w-full rounded-md border-gray-300">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Transfer</label>
                                    <input type="datetime-local" name="transfer_date" class="w-full rounded-md border-gray-300" required>
                                </div>
                            </div>
                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Bukti Transfer Pelunasan (Max 2MB)</label>
                                <input type="file" name="payment_proof" accept="image/*" class="w-full" required>
                                <p class="mt-1 text-sm text-gray-500">Format yang diterima: JPG, PNG, JPEG. Pastikan bukti transfer terlihat jelas.</p>
                            </div>
                            <div class="mt-6">
                                <button type="submit" class="w-full bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600 transition-colors font-semibold">
                                    Upload Bukti Pelunasan
                                </button>
                            </div>
                        </form>
                    </div>
                    @endif

                    <!-- Invoice Actions - Tampil setelah upload -->
                    @if($order->latestPaymentVerification)
                    <div class="flex flex-col sm:flex-row justify-center gap-3 sm:gap-4 mb-6">
                        <a href="{{ route('orders.download-invoice', $order) }}"
                            class="inline-flex items-center justify-center px-4 sm:px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors text-sm sm:text-base">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Download Invoice PDF
                        </a>
                        <a href="{{ route('orders.send-invoice', $order) }}"
                            class="inline-flex items-center justify-center px-4 sm:px-6 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors text-sm sm:text-base">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8 0-.29.02-.58.07-.86.01-.06.02-.12.03-.17.33-1.84 1.29-3.47 2.72-4.6.52-.41 1.09-.75 1.71-1.02.47-.2.95-.35 1.45-.47.34-.1.68-.16 1.02-.22.17-.03.33-.08.5-.1.18-.02.37-.02.56-.02s.37 0 .56.02c.17.02.33.07.5.1.34.06.68.12 1.02.22.5.12.98.27 1.45.47.62.27 1.19.61 1.71 1.02 1.43 1.13 2.39 2.76 2.72 4.6.01.05.02.11.03.17.05.28.07.57.07.86 0 4.41-3.59 8-8 8z" />
                                <path d="M17.45 14.63c-.15-.23-.53-.4-1.08-.62-.55-.22-3.26-1.61-3.77-1.79s-.87-.28-1.24.28-1.43 1.79-1.75 2.16c-.32.37-.65.42-1.2.14s-2.35-.87-4.47-2.76c-1.65-1.47-2.77-3.29-3.09-3.84-.32-.55-.03-.85.24-1.12.25-.25.55-.65.83-.97s.37-.55.55-.92c.18-.37.09-.7-.05-.97s-1.24-3-1.7-4.11c-.45-1.08-.91-.93-1.24-.95-.32-.02-.69-.02-1.06-.02s-.97.14-1.48.69c-.51.55-1.93 1.89-1.93 4.62 0 2.73 1.98 5.37 2.26 5.74.28.37 3.94 6.01 9.54 8.44 1.33.58 2.37.93 3.18 1.19 1.34.43 2.56.37 3.52.22.64-.1 3.44-1.41 3.93-2.76s.49-2.52.34-2.76z" />
                            </svg>
                            Kirim Invoice ke WhatsApp
                        </a>
                    </div>
                    @endif

                    <!-- Navigation Actions -->
                    <div class="flex flex-col sm:flex-row justify-between items-stretch sm:items-center gap-3 sm:gap-0">
                        <a href="/" class="text-gray-600 hover:text-gray-800 text-sm sm:text-base text-center sm:text-left">
                            ← Kembali ke Home
                        </a>
                        <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">
                            @if($order->status === 'pending')
                                @php
                                    $eventDate = \Carbon\Carbon::parse($order->event_date)->startOfDay();
                                    $now = \Carbon\Carbon::now()->startOfDay();
                                    $daysUntilEvent = $now->diffInDays($eventDate, false);
                                    // Cannot cancel if already paid DP (has any payment verification)
                                    $canCancel = $daysUntilEvent >= 3 && !$order->latestPaymentVerification;
                                @endphp
                                
                                @if($canCancel)
                                <form action="{{ route('orders.cancel', $order) }}" method="POST" class="inline" x-data="{ showConfirm: false }">
                                    @csrf
                                    <button type="submit"
                                        @click.prevent="if(confirm('⚠️ PERHATIAN!\n\nApakah Anda yakin ingin membatalkan pesanan ini?\n\n📋 Kebijakan Pembatalan:\n- Pesanan yang sudah bayar DP tidak dapat dibatalkan\n- Jika tidak konfirmasi pembayaran dalam 3 hari, pesanan otomatis batal\n\nLanjutkan pembatalan?')) { $el.closest('form').submit(); }"
                                        class="w-full sm:w-auto px-4 sm:px-6 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors text-sm sm:text-base flex items-center justify-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        Batalkan Pesanan
                                    </button>
                                </form>
                                @else
                                <div class="bg-gray-100 px-4 sm:px-6 py-2 rounded-lg text-sm text-gray-600 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                    <span>
                                        @if($daysUntilEvent < 3)
                                            Pembatalan ditutup (H-{{ $daysUntilEvent }})
                                        @else
                                            Hubungi admin untuk pembatalan
                                        @endif
                                    </span>
                                </div>
                                @endif
                            @endif
                        </div>
                    </div>
                    
                    <!-- Cancellation Policy Info -->
                    @if($order->status === 'pending')
                    <div class="mt-6 bg-blue-50 border-l-4 border-blue-400 p-4 rounded">
                        <div class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div class="flex-1">
                                <h4 class="font-semibold text-blue-900 mb-2">📋 Kebijakan Pembatalan</h4>
                                <ul class="text-sm text-blue-800 space-y-1">
                                    <li class="flex items-start gap-2">
                                        <span class="text-blue-600 mt-0.5">•</span>
                                        <span>Pembatalan <strong>hanya dapat dilakukan minimal 3 hari</strong> sebelum tanggal event</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <span class="text-blue-600 mt-0.5">•</span>
                                        <span>Pesanan yang <strong>sudah bayar DP tidak dapat dibatalkan</strong></span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <span class="text-blue-600 mt-0.5">•</span>
                                        <span><strong>Jika tidak ada konfirmasi pembayaran selama 3 hari</strong>, pesanan dianggap dibatalkan</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <span class="text-blue-600 mt-0.5">•</span>
                                        <span>Untuk pembatalan darurat atau kurang dari H-3, <strong>hubungi admin via WhatsApp</strong></span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <span class="text-blue-600 mt-0.5">•</span>
                                        <span>Tanggal event Anda: <strong>{{ $order->event_date->format('d M Y') }}</strong> 
                                            @php
                                                $eventDate = \Carbon\Carbon::parse($order->event_date)->startOfDay();
                                                $now = \Carbon\Carbon::now()->startOfDay();
                                                $daysUntilEvent = $now->diffInDays($eventDate, false);
                                            @endphp
                                            ({{ $daysUntilEvent }} hari lagi)
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                @else
                <div class="bg-white rounded-lg shadow-lg p-8">
                    <div class="text-center text-gray-600">
                        <p class="text-xl mb-4">Pesanan tidak ditemukan</p>
                        <a href="/" class="text-blue-500 hover:text-blue-600">← Kembali ke Home</a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    @endsection

    @push('scripts')
    <script>
        console.log('Order Data:', {
            !!json_encode($order) !!
        });
    </script>
    @endpush