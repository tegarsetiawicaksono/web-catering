@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Keranjang Belanja</h1>
            @if($cartItems->count() > 0)
            <form action="{{ route('cart.clear') }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 hover:text-red-800">
                    Kosongkan Keranjang
                </button>
            </form>
            @endif
        </div>

        @if($cartItems->count() > 0)
            <div class="space-y-6">
                @foreach($cartItems as $item)
                    <div class="flex items-center justify-between border-b border-gray-200 pb-4">
                        <div class="flex-1">
                            <h3 class="text-lg font-medium text-gray-900">{{ $item->package_name }}</h3>
                            <p class="mt-1 text-sm text-gray-500">Rp {{ number_format($item->price, 0, ',', '.') }}/porsi</p>
                        </div>
                        
                        <div class="flex items-center space-x-4">
                            <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1"
                                       class="w-20 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <button type="submit" class="ml-2 text-sm text-blue-600 hover:text-blue-800">
                                    Update
                                </button>
                            </form>
                            
                            <form action="{{ route('cart.destroy', $item->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach

                <div class="mt-8">
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <div class="flex justify-between text-base font-medium text-gray-900">
                            <p>Total</p>
                            <p>Rp {{ number_format($cartItems->sum(function($item) {
                                return $item->price * $item->quantity;
                            }), 0, ',', '.') }}</p>
                        </div>
                        <p class="mt-0.5 text-sm text-gray-500">Pengiriman akan dihitung saat checkout</p>
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('checkout.index') }}"
                           class="w-full flex justify-center items-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-blue-600 hover:bg-blue-700">
                            Lanjutkan ke Pembayaran
                        </a>
                        <div class="mt-6 text-center">
                            <a href="{{ route('menu.index') }}" class="text-sm text-blue-600 hover:text-blue-500">
                                Lanjutkan Belanja
                                <span aria-hidden="true"> &rarr;</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Keranjang Kosong</h3>
                <p class="mt-1 text-sm text-gray-500">Mulai belanja untuk menambahkan item ke keranjang.</p>
                <div class="mt-6">
                    <a href="{{ route('menu.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                        Lihat Menu
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection