@extends('layouts.app')

@section('content')
<div class="pt-24 pb-16">
    <div class="container mx-auto px-4">
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
            <div class="bg-white rounded-lg shadow-lg p-8">
                <!-- Order Status -->
                <div class="mb-8">
                    <div class="flex items-center justify-between mb-4">
                        <h1 class="text-3xl font-bold">Order #{{ $order->id }}</h1>
                        <span class="px-4 py-2 rounded-full font-semibold
                                {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                {{ $order->status === 'processing' ? 'bg-blue-100 text-blue-800' : '' }}
                                {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' : '' }}
                                {{ $order->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                    <p class="text-gray-600">Order dibuat: {{ $order->created_at ? $order->created_at->format('d M Y, H:i') : '-' }}</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Order Details -->
                    <div>
                        <h2 class="text-xl font-semibold mb-4">Detail Pesanan</h2>
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
                                <dd class="mt-1">{{ $order->address }}</dd>
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
                        <h2 class="text-xl font-semibold mb-4">Item Pesanan</h2>
                        <div class="space-y-4">
                            @if($order->items)
                            @foreach($order->items as $item)
                            <div class="flex justify-between items-start py-4 border-b">
                                <div>
                                    <h3 class="font-medium">{{ $item['name'] }}</h3>
                                    <p class="text-gray-600">{{ $item['quantity'] }} pax</p>
                                </div>
                                <p class="font-medium">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</p>
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
                    @if($order->status === 'pending' && $order->payment_status !== 'paid')
                    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                        <h3 class="text-lg font-semibold mb-4">Upload Bukti Pembayaran</h3>
                        <form action="{{ route('payment.verify', $order) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Bank Pengirim</label>
                                    <input type="text" name="bank_name" class="w-full rounded-md border-gray-300" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Rekening Pengirim</label>
                                    <input type="text" name="account_number" class="w-full rounded-md border-gray-300" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pemilik Rekening</label>
                                    <input type="text" name="account_name" class="w-full rounded-md border-gray-300" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah Transfer</label>
                                    <input type="number" name="amount" class="w-full rounded-md border-gray-300" value="{{ $order->total_price }}" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Referensi Transfer</label>
                                    <input type="text" name="transfer_receipt_number" class="w-full rounded-md border-gray-300" required>
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
                                    Upload Bukti Pembayaran
                                </button>
                            </div>
                        </form>
                    </div>
                    @endif

                    <!-- Invoice Actions -->
                    @if($order->status !== 'cancelled')
                    <div class="flex justify-center space-x-4 mb-6">
                        <a href="{{ route('orders.download-invoice', $order) }}"
                            class="inline-flex items-center px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Download Invoice PDF
                        </a>
                        <a href="{{ route('orders.send-invoice', $order) }}"
                            class="inline-flex items-center px-6 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8 0-.29.02-.58.07-.86.01-.06.02-.12.03-.17.33-1.84 1.29-3.47 2.72-4.6.52-.41 1.09-.75 1.71-1.02.47-.2.95-.35 1.45-.47.34-.1.68-.16 1.02-.22.17-.03.33-.08.5-.1.18-.02.37-.02.56-.02s.37 0 .56.02c.17.02.33.07.5.1.34.06.68.12 1.02.22.5.12.98.27 1.45.47.62.27 1.19.61 1.71 1.02 1.43 1.13 2.39 2.76 2.72 4.6.01.05.02.11.03.17.05.28.07.57.07.86 0 4.41-3.59 8-8 8z" />
                                <path d="M17.45 14.63c-.15-.23-.53-.4-1.08-.62-.55-.22-3.26-1.61-3.77-1.79s-.87-.28-1.24.28-1.43 1.79-1.75 2.16c-.32.37-.65.42-1.2.14s-2.35-.87-4.47-2.76c-1.65-1.47-2.77-3.29-3.09-3.84-.32-.55-.03-.85.24-1.12.25-.25.55-.65.83-.97s.37-.55.55-.92c.18-.37.09-.7-.05-.97s-1.24-3-1.7-4.11c-.45-1.08-.91-.93-1.24-.95-.32-.02-.69-.02-1.06-.02s-.97.14-1.48.69c-.51.55-1.93 1.89-1.93 4.62 0 2.73 1.98 5.37 2.26 5.74.28.37 3.94 6.01 9.54 8.44 1.33.58 2.37.93 3.18 1.19 1.34.43 2.56.37 3.52.22.64-.1 3.44-1.41 3.93-2.76s.49-2.52.34-2.76z" />
                            </svg>
                            Kirim Invoice ke WhatsApp
                        </a>
                    </div>
                    @endif

                    <!-- Navigation Actions -->
                    <div class="flex justify-between items-center">
                        <a href="/" class="text-gray-600 hover:text-gray-800">
                            ← Kembali ke Home
                        </a>
                        <div class="flex space-x-4">
                            @if($order->status === 'pending')
                            <form action="{{ route('orders.cancel', $order) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit"
                                    onclick="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')"
                                    class="px-6 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                                    Batalkan Pesanan
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>
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