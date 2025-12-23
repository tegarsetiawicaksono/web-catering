@section('page-title', 'Manajemen Pesanan')

<x-admin-layout>
    <!-- Page Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Manajemen Pesanan</h1>
        <p class="text-gray-600">Kelola semua pesanan catering dari pelanggan</p>
    </div>

    <!-- Filters and Search -->
    <div class="mb-6 overflow-hidden bg-white border border-gray-200 rounded-xl">
        <div class="p-6">
            <form method="GET" action="{{ route('admin.orders.index') }}" class="space-y-4" x-data="{ showAdvanced: false }">
                <!-- Basic Search -->
                <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
                    <div class="md:col-span-2">
                        <label class="block mb-2 text-sm font-medium text-gray-700">Cari Pesanan</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <input type="text"
                                name="search"
                                value="{{ request('search') }}"
                                class="w-full py-2 pl-10 pr-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                placeholder="Cari berdasarkan nama, email, atau ID...">
                        </div>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">Status</label>
                        <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Dikonfirmasi</option>
                            <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Selesai</option>
                            <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                    </div>

                    <div class="flex items-end space-x-2">
                        <button type="submit"
                            class="flex items-center justify-center flex-1 px-6 py-2 font-medium text-white transition-colors bg-indigo-600 rounded-lg hover:bg-indigo-700">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            Filter
                        </button>
                        <a href="{{ route('admin.orders.index') }}"
                            class="flex items-center justify-center px-6 py-2 font-medium text-gray-700 transition-colors bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                            Reset
                        </a>
                    </div>
                </div>

                <!-- Advanced Filters Toggle -->
                <button type="button"
                    @click="showAdvanced = !showAdvanced"
                    class="flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-700">
                    <span x-text="showAdvanced ? 'Sembunyikan Filter Lanjutan' : 'Tampilkan Filter Lanjutan'"></span>
                    <svg class="w-4 h-4 ml-1 transition-transform"
                        :class="{ 'rotate-180': showAdvanced }"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- Advanced Filters -->
                <div x-show="showAdvanced"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 -translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="grid grid-cols-1 gap-4 pt-4 border-t border-gray-200 md:grid-cols-3"
                    style="display: none;">
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">Tanggal Dari</label>
                        <input type="date"
                            name="date_from"
                            value="{{ request('date_from') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">Tanggal Sampai</label>
                        <input type="date"
                            name="date_to"
                            value="{{ request('date_to') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">Urutkan</label>
                        <select name="sort" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Terlama</option>
                            <option value="highest" {{ request('sort') === 'highest' ? 'selected' : '' }}>Nilai Tertinggi</option>
                            <option value="lowest" {{ request('sort') === 'lowest' ? 'selected' : '' }}>Nilai Terendah</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Orders Stats Summary -->
    <div class="grid grid-cols-2 gap-4 mb-6 md:grid-cols-4">
        <div class="p-4 bg-white border border-gray-200 rounded-lg">
            <p class="text-sm text-gray-600">Total Pesanan</p>
            <p class="text-2xl font-bold text-gray-900">{{ $orders->total() }}</p>
        </div>
        <div class="p-4 bg-white border border-yellow-200 rounded-lg bg-yellow-50">
            <p class="text-sm text-yellow-800">Pending</p>
            <p class="text-2xl font-bold text-yellow-900">{{ \App\Models\Order::where('status', 'pending')->count() }}</p>
        </div>
        <div class="p-4 bg-white border border-blue-200 rounded-lg bg-blue-50">
            <p class="text-sm text-blue-800">Dikonfirmasi</p>
            <p class="text-2xl font-bold text-blue-900">{{ \App\Models\Order::where('status', 'confirmed')->count() }}</p>
        </div>
        <div class="p-4 bg-white border border-green-200 rounded-lg bg-green-50">
            <p class="text-sm text-green-800">Selesai</p>
            <p class="text-2xl font-bold text-green-900">{{ \App\Models\Order::where('status', 'completed')->count() }}</p>
        </div>
    </div>

    <!-- Orders Table -->
    <div class="overflow-hidden bg-white border border-gray-200 rounded-xl">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase">
                            Pesanan
                        </th>
                        <th class="px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase">
                            Pelanggan
                        </th>
                        <th class="px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase">
                            Tanggal Event
                        </th>
                        <th class="px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase">
                            Total
                        </th>
                        <th class="px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase">
                            Status
                        </th>
                        <th class="px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($orders as $order)
                    <tr class="transition-colors hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="flex items-center justify-center w-10 h-10 mr-3 bg-indigo-100 rounded-lg shrink-0">
                                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm font-bold text-gray-900">#{{ $order->id }}</div>
                                    <div class="text-xs text-gray-500">{{ $order->package_name }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ $order->customer_name }}</div>
                            <div class="text-xs text-gray-500">{{ $order->email }}</div>
                            <div class="text-xs text-gray-500">{{ $order->phone }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">
                                {{ $order->event_date ? \Carbon\Carbon::parse($order->event_date)->format('d M Y') : '-' }}
                            </div>
                            <div class="text-xs text-gray-500">
                                {{ $order->event_time ?? '-' }}
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm font-bold text-gray-900 whitespace-nowrap">
                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
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
                        </td>
                        <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                            <a href="{{ route('admin.orders.show', $order) }}"
                                class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-indigo-600 transition-colors bg-indigo-50 rounded-lg hover:bg-indigo-100">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                            <p class="text-lg font-medium text-gray-900">Tidak ada pesanan ditemukan</p>
                            <p class="text-sm text-gray-500">Coba ubah filter atau kata kunci pencarian Anda</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($orders->hasPages())
        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
            {{ $orders->links() }}
        </div>
        @endif
    </div>
</x-admin-layout>