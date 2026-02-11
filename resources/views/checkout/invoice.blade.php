@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <!-- Status Pesanan -->
        <div class="mb-8 text-center">
            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                <svg class="mr-2 h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                </svg>
                Menunggu Pembayaran
            </span>
        </div>

        <!-- Header Invoice -->
        <div class="border-b border-gray-200 pb-8 mb-8">
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Invoice #{{ $order->id }}</h1>
            <p class="text-sm text-gray-600">Tanggal Pemesanan: {{ $order->created_at ? $order->created_at->format('d F Y H:i') : '-' }}</p>
        </div>

        <!-- Informasi Pelanggan -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <div>
                <h2 class="text-lg font-medium text-gray-900 mb-4">Informasi Pelanggan</h2>
                <dl class="space-y-2">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Nama</dt>
                        <dd class="text-sm text-gray-900">{{ $order->customer_name }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Email</dt>
                        <dd class="text-sm text-gray-900">{{ $order->email }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">No. Telepon</dt>
                        <dd class="text-sm text-gray-900">{{ $order->phone }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Alamat Pengiriman</dt>
                        <dd class="text-sm text-gray-900">
                            {{ $order->street_address }}<br>
                            Kecamatan {{ $order->district }}, {{ $order->city }}<br>
                            {{ $order->province }}
                        </dd>
                    </div>
                </dl>
            </div>
            <div>
                <h2 class="text-lg font-medium text-gray-900 mb-4">Detail Acara</h2>
                <dl class="space-y-2">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Tanggal Acara</dt>
                        <dd class="text-sm text-gray-900">{{ $order->event_date ? \Carbon\Carbon::parse($order->event_date)->format('d F Y') : '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Waktu Acara</dt>
                        <dd class="text-sm text-gray-900">{{ $order->event_time }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Catatan Tambahan</dt>
                        <dd class="text-sm text-gray-900">{{ $order->notes ?: '-' }}</dd>
                    </div>
                </dl>
            </div>
        </div>

        <!-- Detail Pesanan -->
        <div class="mb-8">
            <h2 class="text-lg font-medium text-gray-900 mb-4">Detail Pesanan</h2>
            <div class="bg-gray-50 rounded-lg p-4">
                <div class="flow-root">
                    <dl class="-my-4 text-sm divide-y divide-gray-200">
                        <div class="py-4 flex items-center justify-between">
                            <dt class="text-gray-600">{{ $order->package_name }} ({{ $order->quantity }} porsi)</dt>
                            <dd class="font-medium text-gray-900">Rp {{ number_format($order->quantity * $order->package_price, 0, ',', '.') }}</dd>
                        </div>
                        <div class="py-4 flex items-center justify-between">
                            <dt class="text-base font-medium text-gray-900">Total Pembayaran</dt>
                            <dd class="text-base font-medium text-gray-900">Rp {{ number_format($order->total_price, 0, ',', '.') }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Instruksi Pembayaran -->
        <div class="bg-yellow-50 rounded-lg p-6">
            <h2 class="text-lg font-medium text-yellow-900 mb-4">Instruksi Pembayaran</h2>
            <div class="space-y-4">
                <p class="text-sm text-yellow-800">Silakan transfer ke rekening berikut:</p>
                <div class="bg-white rounded-md p-4 border border-yellow-200">
                    <p class="font-mono text-lg mb-1">BCA: 1234567890</p>
                    <p class="text-sm text-gray-600">a.n. Nina Sugiatni</p>
                </div>
                <p class="text-sm text-yellow-800">
                    Mohon transfer sesuai dengan total pembayaran dan kirimkan bukti transfer melalui WhatsApp ke nomor:
                    <a href="https://wa.me/6282227110771" class="font-medium underline">082227110771</a>
                </p>
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="mt-8 flex justify-end space-x-4">
            <a href="{{ route('orders.show', $order) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Lihat Detail Pesanan
            </a>
            <button onclick="window.print()" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Cetak Invoice
            </button>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    @media print {
        .no-print {
            display: none;
        }

        @page {
            margin: 0.5cm;
        }

        body {
            print-color-adjust: exact;
            -webkit-print-color-adjust: exact;
        }
    }
</style>
@endpush