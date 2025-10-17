<x-app-layout>
    <x-session-modal />

    <div class="p-6 sm">
        <!-- Heading dan Breadcrumb -->
        <div class="mb-6">
            <nav class="text-sm text-gray-500">
                <ol class="list-reset flex items-center space-x-2">
                    <li><a href="{{ route('admin.index') }}" class="hover:underline text-blue-600">Admin</a></li>
                    <li><span class="text-gray-400">></span></li>
                    <li class="text-gray-700 font-semibold">Dashboard</li>
                </ol>
                <h1 class="text-3xl font-bold text-gray-800 mt-2">Admin Dashboard</h1>
            </nav>
        </div>

        <div class="p-6 rounded-lg bg-white shadow-md border border-gray-200">
            <!-- Total User Berdasarkan Role -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                <div
                    class="flex items-center h-28 rounded-lg bg-white shadow-md border border-gray-200 p-4 hover:shadow-lg hover:scale-105 transition duration-300 ease-in-out">
                    <div class="text-blue-500 ml-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-warehouse-icon lucide-warehouse">
                            <path d="M18 21V10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1v11" />
                            <path
                                d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V8a2 2 0 0 1 1.132-1.803l7.95-3.974a2 2 0 0 1 1.837 0l7.948 3.974A2 2 0 0 1 22 8z" />
                            <path d="M6 13h12" />
                            <path d="M6 17h12" />
                        </svg>
                    </div>
                    <div class="ml-6">
                        <p class="text-2xl font-bold text-gray-800">{{ $gudangCount }}</p>
                        <p class="text-sm text-gray-500">Role Gudang</p>
                    </div>
                </div>
                <div
                    class="flex items-center h-28 rounded-lg bg-white shadow-md border border-gray-200 p-4 hover:shadow-lg hover:scale-105 transition duration-300 ease-in-out">
                    <div class="text-red-500 ml-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-truck-icon lucide-truck">
                            <path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2" />
                            <path d="M15 18H9" />
                            <path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.624l-3.48-4.35A1 1 0 0 0 17.52 8H14" />
                            <circle cx="17" cy="18" r="2" />
                            <circle cx="7" cy="18" r="2" />
                        </svg>
                    </div>
                    <div class="ml-6">
                        <p class="text-2xl font-bold text-gray-800">{{ $distributorCount }}</p>
                        <p class="text-sm text-gray-500">Role Distributor</p>
                    </div>
                </div>
                <div
                    class="flex items-center h-28 rounded-lg bg-white shadow-md border border-gray-200 p-4 hover:shadow-lg hover:scale-105 transition duration-300 ease-in-out">
                    <div class="text-yellow-500 ml-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-shovel-icon lucide-shovel">
                            <path d="M2 22v-5l5-5 5 5-5 5z" />
                            <path d="M9.5 14.5 16 8" />
                            <path d="m17 2 5 5-.5.5a3.53 3.53 0 0 1-5 0s0 0 0 0a3.53 3.53 0 0 1 0-5L17 2" />
                        </svg>
                    </div>
                    <div class="ml-6">
                        <p class="text-2xl font-bold text-gray-800">{{ $petaniCount }}</p>
                        <p class="text-sm text-gray-500">Role Petani</p>
                    </div>
                </div>
            </div>

            <!-- Diagram Lingkaran dan Permintaan Barang Terbaru -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Diagram Lingkaran -->
                <div
                    class="relative rounded-lg bg-white shadow-md border border-gray-200 p-6 hover:shadow-lg transition duration-300 ease-in-out">
                    <a href="{{ route('admin.stok-barang.index') }}">
                        <h2 class="text-lg font-semibold text-gray-700 mb-4 text-center">Total Barang Berdasarkan Jenis
                        </h2>
                    </a>
                    <div class="flex flex-col items-center justify-center h-48">
                        <div class="relative w-40 h-40 mx-auto">
                            <canvas id="barangChart" width="160" height="160"></canvas>
                            <!-- Label Tengah -->
                            <div
                                class="absolute inset-0 flex flex-col items-center justify-center text-center pointer-events-none gap-y-1">
                                <p class="text-2xl font-bold text-gray-800 leading-none">
                                    {{ number_format($totalStokBarang) }}</p>
                                <p class="text-xs text-gray-500 leading-none">Total Barang</p>
                            </div>
                        </div>
                        <!-- Legend Manual -->
                        <div class="mt-4 flex justify-center space-x-6 text-xs text-gray-700">
                            <div class="flex items-center space-x-2">
                                <span class="inline-block w-3 h-3 rounded-full bg-[#66BB6A]"></span>
                                <span>Pupuk ({{ number_format($pupukCount) }})</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="inline-block w-3 h-3 rounded-full bg-[#FFCA28]"></span>
                                <span>Bibit ({{ number_format($bibitCount) }})</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="inline-block w-3 h-3 rounded-full bg-[#EF5350]"></span>
                                <span>Obat ({{ number_format($obatCount) }})</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Permintaan Barang Terbaru -->
                <div
                    class="rounded-lg bg-white shadow-md border border-gray-200 p-6 hover:shadow-lg transition duration-300 ease-in-out">
                    <a href="{{ route('admin.permintaan-barang.index') }}">
                        <h2 class="text-lg font-semibold text-gray-700 mb-4">Permintaan Barang Terbaru</h2>
                    </a>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <tbody>
                                @forelse ($permintaanBarang as $permintaan)
                                    <tr
                                        class="border-b hover:bg-gray-100 hover:shadow-sm transition duration-200 ease-in-out">
                                        <td class="px-4 py-2 text-gray-900">
                                            {{ $permintaan->user->name ?? 'Tidak Diketahui' }}
                                        </td>
                                        <td class="px-4 py-2">
                                            {{ $permintaan->stokBarang->nama_barang ?? 'Tidak Diketahui' }}
                                        </td>
                                        <td class="px-4 py-2">
                                            {{ $permintaan->jumlah }}
                                        </td>
                                        <td class="px-4 py-2 text-gray-500">
                                            {{ $permintaan->status }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-4 py-2 text-center text-gray-500">Belum ada
                                            permintaan barang.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Distribusi Barang Terbaru -->
            <div
                class="rounded-lg bg-white shadow-md border border-gray-200 p-6 mb-6 hover:shadow-lg hover:scale-105 transition duration-300 ease-in-out">
                <a href="{{ route('admin.distribusi-barang.index') }}">
                    <h2 class="text-lg font-semibold text-gray-700 mb-4">Distribusi Barang Terbaru</h2>
                </a>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead>
                            <tr class="border-b bg-gray-100">
                                <th class="px-4 py-2 text-gray-700">Distributor</th>
                                <th class="px-4 py-2 text-gray-700">Permintaan</th>
                                <th class="px-4 py-2 text-gray-700">Status</th>
                                <th class="px-4 py-2 text-gray-700">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($distribusiBarang as $distribusi)
                                <tr
                                    class="border-b hover:bg-gray-100 hover:shadow-sm transition duration-200 ease-in-out">
                                    <td class="px-4 py-2 text-gray-900">
                                        {{ $distribusi->distributor->name ?? 'Tidak Diketahui' }}
                                    </td>
                                    <td class="px-4 py-2">
                                        {{ $distribusi->permintaanBarang->nama_barang ?? 'Tidak Diketahui' }}
                                    </td>
                                    <td class="px-4 py-2 text-gray-500">
                                        {{ ucfirst($distribusi->status) }}
                                    </td>
                                    <td class="px-4 py-2 text-gray-500">
                                        {{ $distribusi->created_at->format('d M Y') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-2 text-center text-gray-500">Belum ada
                                        distribusi
                                        barang.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('barangChart').getContext('2d');

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: [], // Kosongkan agar tidak muncul legend dari Chart.js
                datasets: [{
                    data: [{{ $pupukCount }}, {{ $bibitCount }}, {{ $obatCount }}],
                    backgroundColor: ['#66BB6A', '#FFCA28', '#EF5350'],
                    borderWidth: 0,
                    hoverOffset: 8
                }]
            },
            options: {
                cutout: '65%',
                responsive: true,
                plugins: {
                    legend: {
                        display: false // Legend bawaan dimatikan
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const value = context.parsed;
                                return `${value.toLocaleString()}`;
                            }
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>