@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 pt-16">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="text-center mb-8">
                <div class="bg-green-100 rounded-full h-20 w-20 flex items-center justify-center mx-auto mb-4">
                    <svg class="h-10 w-10 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Pesanan Berhasil!</h2>
                <p class="text-gray-600">Terima kasih telah memesan. Tim kami akan segera menghubungi Anda.</p>
            </div>

            <div class="border-t border-gray-200 pt-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Detail Pesanan</h3>
                <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Nomor Pesanan</dt>
                        <dd class="mt-1 text-sm text-gray-900">#{{ $order->id }}</dd>
                    </div>

                    <div>
                        <dt class="text-sm font-medium text-gray-500">Status</dt>
                        <dd class="mt-1 text-sm">
                            <span class="px-2 py-1 text-xs font-medium rounded-full
                                {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                {{ $order->status === 'confirmed' ? 'bg-blue-100 text-blue-800' : '' }}
                                {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' : '' }}
                                {{ $order->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </dd>
                    </div>

                    <div>
                        <dt class="text-sm font-medium text-gray-500">Nama Pemesan</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $order->customer_name }}</dd>
                    </div>

                    <div>
                        <dt class="text-sm font-medium text-gray-500">Email</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $order->email }}</dd>
                    </div>

                    <div>
                        <dt class="text-sm font-medium text-gray-500">Nomor Telepon</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $order->phone }}</dd>
                    </div>

                    <div>
                        <dt class="text-sm font-medium text-gray-500">Alamat</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ $order->street_address }}<br>
                            Kec. {{ $order->district }}<br>
                            {{ $order->city }}<br>
                            {{ $order->province }}
                        </dd>
                    </div>

                    <div>
                        <dt class="text-sm font-medium text-gray-500">Tanggal Acara</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $order->event_date ? \Carbon\Carbon::parse($order->event_date)->translatedFormat('l, d F Y') : '-' }}</dd>
                    </div>

                    <div>
                        <dt class="text-sm font-medium text-gray-500">Waktu Acara</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ \Carbon\Carbon::parse($order->event_time)->format('H:i') }} WIB</dd>
                    </div>

                    <div>
                        <dt class="text-sm font-medium text-gray-500">Order Dibuat</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $order->created_at->translatedFormat('l, d F Y - H:i') }} WIB</dd>
                    </div>

                    <div>
                        <dt class="text-sm font-medium text-gray-500">Metode Pembayaran</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ ucfirst($order->payment_method) }}</dd>
                    </div>
                </dl>
            </div>

            <div class="border-t border-gray-200 mt-6 pt-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Ringkasan Pesanan</h3>
                <div class="space-y-3">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Paket</span>
                        <span class="text-gray-900">{{ $order->package_name }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Jumlah Porsi</span>
                        <span class="text-gray-900">{{ $order->quantity }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Harga per Porsi</span>
                        <span class="text-gray-900">Rp {{ number_format($order->package_price, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-sm font-medium pt-3 border-t border-gray-200">
                        <span class="text-gray-900">Total</span>
                        <span class="text-gray-900">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            @if($order->payment_method === 'transfer')
            <div class="border-t border-gray-200 mt-6 pt-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Pembayaran</h3>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-sm text-gray-600 mb-3">Silakan transfer ke rekening berikut:</p>
                    <div class="space-y-2">
                        <div>
                            <p class="text-sm font-medium text-gray-900">Bank BCA</p>
                            <p class="text-sm text-gray-600">1234567890</p>
                            <p class="text-sm text-gray-600">a.n. Catering Kita</p>
                        </div>
                    </div>
                    <p class="mt-4 text-sm text-gray-600">
                        Mohon transfer sesuai dengan total pembayaran dan kirimkan bukti transfer
                        ke WhatsApp kami di <a href="https://wa.me/6282227110771" class="text-blue-600 hover:text-blue-800">082227110771</a>
                    </p>
                </div>
            </div>
            @endif

            <div class="mt-8 flex justify-end space-x-4">
                <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                    Kembali ke Beranda
                </a>
                @if($order->payment_method === 'transfer')
                <a href="https://wa.me/6282227110771?text=Halo, saya ingin konfirmasi pembayaran untuk pesanan %23{{ $order->id }}"
                   target="_blank"
                   class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700">
                    Konfirmasi Pembayaran
                </a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection