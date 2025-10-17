<x-app-layout>
    <div class="pt-24 pb-16">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-lg shadow-lg p-8">
                    <!-- Order Status -->
                    <div class="mb-8">
                        <div class="flex items-center justify-between mb-4">
                            <h1 class="text-3xl font-bold">Order #{{ $order->id }}</h1>
                            <span class="px-4 py-2 rounded-full font-semibold
                                {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                {{ $order->status === 'processing' ? 'bg-blue-100 text-blue-800' : '' }}
                                {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' : '' }}
                                {{ $order->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}"
                            >
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                        <p class="text-gray-600">Order dibuat: {{ $order->created_at->format('d M Y, H:i') }}</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Order Details -->
                        <div>
                            <h2 class="text-xl font-semibold mb-4">Detail Pesanan</h2>
                            <dl class="space-y-4">
                                <div>
                                    <dt class="text-sm font-medium text-gray-600">Nama</dt>
                                    <dd class="mt-1">{{ $order->name }}</dd>
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
                                    <dd class="mt-1">{{ $order->date->format('d M Y') }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-600">Alamat Pengiriman</dt>
                                    <dd class="mt-1">{{ $order->address }}</dd>
                                </div>
                                @if($order->note)
                                <div>
                                    <dt class="text-sm font-medium text-gray-600">Catatan</dt>
                                    <dd class="mt-1">{{ $order->note }}</dd>
                                </div>
                                @endif
                            </dl>
                        </div>

                        <!-- Order Items -->
                        <div>
                            <h2 class="text-xl font-semibold mb-4">Item Pesanan</h2>
                            <div class="space-y-4">
                                @foreach($order->items as $item)
                                <div class="flex justify-between items-start py-4 border-b">
                                    <div>
                                        <h3 class="font-medium">{{ $item['name'] }}</h3>
                                        <p class="text-gray-600">{{ $item['quantity'] }} pax</p>
                                    </div>
                                    <p class="font-medium">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</p>
                                </div>
                                @endforeach

                                <div class="flex justify-between items-center pt-4 font-bold">
                                    <span>Total</span>
                                    <span>Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="mt-8 pt-8 border-t flex justify-between">
                        <a href="/" class="text-gray-600 hover:text-gray-800">
                            ← Kembali ke Home
                        </a>
                        <div class="flex space-x-4">
                            @if($order->status === 'pending')
                            <button onclick="if(confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')) { /* TODO: Add cancel logic */ }"
                                    class="px-6 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                                Batalkan Pesanan
                            </button>
                            @endif
                            <a href="https://wa.me/6282227110771?text=Halo, saya ingin menanyakan tentang pesanan %23{{ $order->id }}"
                               target="_blank"
                               class="px-6 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">
                                Chat via WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>