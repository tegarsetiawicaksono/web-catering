<x-admin-layout>
    <div class="space-y-6">
        <!-- Filter Date -->
        <div class="bg-white shadow rounded-lg p-4">
            <form action="{{ route('admin.reports') }}" method="GET" class="flex space-x-4">
                <div class="flex-1">
                    <label for="start_date" class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                    <input type="date" name="start_date" id="start_date" value="{{ $startDate->format('Y-m-d') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>
                <div class="flex-1">
                    <label for="end_date" class="block text-sm font-medium text-gray-700">Tanggal Akhir</label>
                    <input type="date" name="end_date" id="end_date" value="{{ $endDate->format('Y-m-d') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>
                <div class="flex items-end">
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-indigo-700">
                        Filter
                    </button>
                </div>
            </form>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div class="bg-white shadow rounded-lg p-4">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Ringkasan Pesanan</h3>
                <dl class="grid grid-cols-1 gap-4">
                    @foreach($ordersByStatus as $status => $count)
                    <div class="flex justify-between py-2 border-b">
                        <dt class="text-sm font-medium text-gray-600">{{ ucfirst($status) }}</dt>
                        <dd class="text-sm font-semibold text-gray-900">{{ $count }}</dd>
                    </div>
                    @endforeach
                    <div class="flex justify-between pt-2">
                        <dt class="text-sm font-medium text-gray-900">Total Pendapatan</dt>
                        <dd class="text-sm font-bold text-green-600">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</dd>
                    </div>
                </dl>
            </div>

            <div class="bg-white shadow rounded-lg p-4">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Paket Terpopuler</h3>
                <ul class="space-y-4">
                    @foreach($popularPackages as $package)
                    <li class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">{{ $package->package_name }}</span>
                        <span class="text-sm font-semibold text-gray-900">{{ $package->total }} pesanan</span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Detailed Orders -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
                <h3 class="text-lg font-medium text-gray-900">Detail Pesanan</h3>
                <a href="#" onclick="window.print()" class="text-sm text-indigo-600 hover:text-indigo-900">
                    Download Laporan
                </a>
            </div>

            <!-- Desktop Table -->
            <div class="hidden md:block">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pelanggan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Paket</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($orders as $order)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#{{ $order->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $order->created_at->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $order->customer_name }}</div>
                                    <div class="text-sm text-gray-500">{{ $order->email }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $order->package_name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $order->quantity }} porsi
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 text-xs font-semibold rounded-full
                                    @if($order->status === 'pending') text-yellow-800 bg-yellow-100
                                    @elseif($order->status === 'confirmed') text-green-800 bg-green-100
                                    @elseif($order->status === 'completed') text-blue-800 bg-blue-100
                                    @else text-red-800 bg-red-100 @endif">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Mobile Card View -->
            <div class="block md:hidden divide-y divide-gray-200">
                @foreach($orders as $order)
                <div class="p-4 hover:bg-gray-50 transition-colors">
                    <div class="flex justify-between items-start mb-3">
                        <div>
                            <span class="text-base font-bold text-gray-900">#{{ $order->id }}</span>
                            <p class="text-xs text-gray-500 mt-1">{{ $order->created_at->format('d M Y, H:i') }}</p>
                        </div>
                        <span class="inline-flex px-2.5 py-1 text-xs font-semibold rounded-full
                            @if($order->status === 'pending') text-yellow-800 bg-yellow-100
                            @elseif($order->status === 'confirmed') text-green-800 bg-green-100
                            @elseif($order->status === 'completed') text-blue-800 bg-blue-100
                            @else text-red-800 bg-red-100 @endif">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>

                    <div class="space-y-3">
                        <div>
                            <p class="text-sm font-semibold text-gray-900">{{ $order->customer_name }}</p>
                            <p class="text-xs text-gray-500">{{ $order->email }}</p>
                        </div>

                        <div class="bg-gray-50 p-3 rounded-lg">
                            <p class="text-xs text-gray-500 mb-1">Paket Pesanan</p>
                            <p class="text-sm font-medium text-gray-900">{{ $order->package_name }}</p>
                            <p class="text-xs text-gray-600 mt-1">Jumlah: {{ $order->quantity }} porsi</p>
                        </div>

                        <div class="flex justify-between items-center pt-3 border-t border-gray-200">
                            <p class="text-xs font-medium text-gray-500">Total Pembayaran</p>
                            <p class="text-lg font-bold text-indigo-600">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-admin-layout>