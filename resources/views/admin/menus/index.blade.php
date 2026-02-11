<x-admin-layout>
    <div class="p-4 sm:p-6 lg:p-8">
        <!-- Header -->
        <div class="mb-6 sm:flex sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Kelola Menu</h1>
                <p class="mt-1 text-sm text-gray-600">Tambah, edit, dan hapus menu catering</p>
            </div>
            <div class="mt-4 sm:mt-0">
                <a href="{{ route('admin.menus.create') }}"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-lg shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Menu
                </a>
            </div>
        </div>

        <!-- Success Message -->
        @if(session('success'))
        <div class="p-4 mb-6 text-green-800 bg-green-100 border border-green-200 rounded-lg">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                {{ session('success') }}
            </div>
        </div>
        @endif

        <!-- Filter Kategori -->
        <div class="mb-6">
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('admin.menus.index') }}"
                    class="px-4 py-2 text-sm font-medium rounded-lg {{ !request('kategori') ? 'bg-indigo-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
                    Semua
                </a>
                <a href="{{ route('admin.menus.index', ['kategori' => 'buffet']) }}"
                    class="px-4 py-2 text-sm font-medium rounded-lg {{ request('kategori') === 'buffet' ? 'bg-indigo-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
                    Buffet
                </a>
                <a href="{{ route('admin.menus.index', ['kategori' => 'tumpeng']) }}"
                    class="px-4 py-2 text-sm font-medium rounded-lg {{ request('kategori') === 'tumpeng' ? 'bg-indigo-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
                    Tumpeng
                </a>
                <a href="{{ route('admin.menus.index', ['kategori' => 'nasibox']) }}"
                    class="px-4 py-2 text-sm font-medium rounded-lg {{ request('kategori') === 'nasibox' ? 'bg-indigo-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
                    Nasi Box
                </a>
                <a href="{{ route('admin.menus.index', ['kategori' => 'snack']) }}"
                    class="px-4 py-2 text-sm font-medium rounded-lg {{ request('kategori') === 'snack' ? 'bg-indigo-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
                    Snack
                </a>
            </div>
        </div>

        <!-- Desktop Table -->
        <div class="hidden md:block overflow-hidden bg-white rounded-lg shadow">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Menu</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Kategori</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Harga</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Min Order</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($menus as $menu)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    @if($menu->gambar)
                                    <img src="{{ asset('foto/' . $menu->gambar) }}" alt="{{ $menu->nama }}"
                                        class="object-cover w-12 h-12 mr-4 rounded-lg">
                                    @else
                                    <div class="flex items-center justify-center w-12 h-12 mr-4 bg-gray-200 rounded-lg">
                                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    @endif
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $menu->nama }}</div>
                                        <div class="text-sm text-gray-500">{{ Str::limit($menu->deskripsi, 50) }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex px-2 text-xs font-semibold leading-5 rounded-full
                                    {{ $menu->kategori === 'buffet' ? 'text-blue-800 bg-blue-100' : '' }}
                                    {{ $menu->kategori === 'tumpeng' ? 'text-green-800 bg-green-100' : '' }}
                                    {{ $menu->kategori === 'nasibox' ? 'text-yellow-800 bg-yellow-100' : '' }}
                                    {{ $menu->kategori === 'snack' ? 'text-purple-800 bg-purple-100' : '' }}">
                                    {{ ucfirst($menu->kategori) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                Rp {{ number_format($menu->harga, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                {{ $menu->min_order }} porsi
                            </td>
                            <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                                <div class="flex items-center space-x-3">
                                    <a href="{{ route('admin.menus.edit', $menu) }}"
                                        class="text-indigo-600 hover:text-indigo-900">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus menu ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                <svg class="w-12 h-12 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Belum ada menu
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Mobile Card View -->
        <div class="block md:hidden space-y-4">
            @forelse($menus as $menu)
            <div class="overflow-hidden bg-white rounded-lg shadow">
                <div class="p-4">
                    <div class="flex items-start space-x-4">
                        @if($menu->gambar)
                        <img src="{{ asset('foto/' . $menu->gambar) }}" alt="{{ $menu->nama }}"
                            class="object-cover w-20 h-20 rounded-lg">
                        @else
                        <div class="flex items-center justify-center w-20 h-20 bg-gray-200 rounded-lg">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        @endif
                        <div class="flex-1">
                            <div class="flex items-start justify-between">
                                <div>
                                    <h3 class="text-base font-semibold text-gray-900">{{ $menu->nama }}</h3>
                                    <span class="inline-flex px-2 py-1 mt-1 text-xs font-semibold rounded-full
                                        {{ $menu->kategori === 'buffet' ? 'text-blue-800 bg-blue-100' : '' }}
                                        {{ $menu->kategori === 'tumpeng' ? 'text-green-800 bg-green-100' : '' }}
                                        {{ $menu->kategori === 'nasibox' ? 'text-yellow-800 bg-yellow-100' : '' }}
                                        {{ $menu->kategori === 'snack' ? 'text-purple-800 bg-purple-100' : '' }}">
                                        {{ ucfirst($menu->kategori) }}
                                    </span>
                                </div>
                            </div>
                            <p class="mt-2 text-sm text-gray-600">{{ Str::limit($menu->deskripsi, 60) }}</p>
                            <div class="flex items-center justify-between mt-3">
                                <div>
                                    <p class="text-lg font-bold text-indigo-600">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>
                                    <p class="text-xs text-gray-500">Min. {{ $menu->min_order }} porsi</p>
                                </div>
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.menus.edit', $menu) }}"
                                        class="px-3 py-1.5 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus menu ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1.5 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="p-12 text-center text-gray-500 bg-white rounded-lg shadow">
                <svg class="w-12 h-12 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Belum ada menu
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $menus->links() }}
        </div>
    </div>
</x-admin-layout>