@extends('layouts.admin')

@section('content')
<div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-6">
        <div class="sm:flex sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Pengguna</h1>
                <p class="mt-1 text-sm text-gray-600">Kelola pengguna yang terdaftar di website</p>
            </div>
            <div class="mt-4 sm:mt-0">
                <div class="px-4 py-2 text-sm font-medium text-indigo-700 bg-indigo-100 rounded-lg">
                    Total: {{ $totalUsers }} Pengguna
                </div>
            </div>
        </div>
    </div>

    <!-- Users Table -->
    <div class="overflow-hidden bg-white rounded-lg shadow">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                            Nama
                        </th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                            Tanggal Daftar
                        </th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($users as $index => $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                {{ ($users->currentPage() - 1) * $users->perPage() + $index + 1 }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-10 h-10">
                                        <div class="flex items-center justify-center w-10 h-10 font-semibold text-white bg-indigo-600 rounded-full">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                {{ $user->email }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                {{ $user->created_at->format('d M Y, H:i') }}
                            </td>
                            <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                                <button 
                                    @click="$dispatch('open-user-detail', { user: {{ json_encode([
                                        'id' => $user->id,
                                        'name' => $user->name,
                                        'email' => $user->email,
                                        'phone' => $user->phone ?? '-',
                                        'address' => $user->address ?? '-',
                                        'role' => $user->is_admin ? 'Admin' : 'User',
                                        'created_at' => $user->created_at->format('d M Y, H:i'),
                                        'total_orders' => $user->orders()->count()
                                    ]) }} })"
                                    class="inline-flex items-center px-3 py-1.5 text-indigo-600 transition-colors duration-150 bg-indigo-100 rounded-lg hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    Lihat Detail
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                <svg class="w-12 h-12 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                <p class="text-sm">Belum ada pengguna terdaftar</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($users->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</div>

<!-- User Detail Modal -->
<div x-data="{ 
        open: false, 
        user: {} 
    }"
    @open-user-detail.window="open = true; user = $event.detail.user"
    @keydown.escape.window="open = false"
    x-show="open"
    x-cloak
    class="fixed inset-0 z-50 overflow-y-auto"
    aria-labelledby="modal-title" 
    role="dialog" 
    aria-modal="true">
    
    <!-- Background overlay -->
    <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div x-show="open"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            @click="open = false"
            class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" 
            aria-hidden="true">
        </div>

        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <!-- Modal panel -->
        <div x-show="open"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            
            <!-- Modal Header -->
            <div class="px-6 py-4 bg-gradient-to-r from-indigo-600 to-indigo-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-white" id="modal-title">
                        Detail Pengguna
                    </h3>
                    <button @click="open = false" 
                        class="text-indigo-200 transition-colors hover:text-white focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Modal Body -->
            <div class="px-6 py-5">
                <!-- User Avatar -->
                <div class="flex justify-center mb-6">
                    <div class="flex items-center justify-center w-20 h-20 text-2xl font-bold text-white bg-indigo-600 rounded-full">
                        <span x-text="user.name ? user.name.charAt(0).toUpperCase() : ''"></span>
                    </div>
                </div>

                <!-- User Information -->
                <div class="space-y-4">
                    <div class="pb-4 border-b border-gray-200">
                        <label class="block text-xs font-medium text-gray-500 uppercase">Nama Lengkap</label>
                        <p class="mt-1 text-sm font-medium text-gray-900" x-text="user.name"></p>
                    </div>

                    <div class="pb-4 border-b border-gray-200">
                        <label class="block text-xs font-medium text-gray-500 uppercase">Email</label>
                        <p class="mt-1 text-sm text-gray-900" x-text="user.email"></p>
                    </div>

                    <div class="pb-4 border-b border-gray-200">
                        <label class="block text-xs font-medium text-gray-500 uppercase">Nomor Telepon</label>
                        <p class="mt-1 text-sm text-gray-900" x-text="user.phone || '-'"></p>
                    </div>

                    <div class="pb-4 border-b border-gray-200">
                        <label class="block text-xs font-medium text-gray-500 uppercase">Role</label>
                        <span class="inline-flex items-center px-2.5 py-0.5 mt-1 rounded-full text-xs font-medium"
                            :class="user.role === 'Admin' ? 'bg-purple-100 text-purple-800' : 'bg-green-100 text-green-800'"
                            x-text="user.role">
                        </span>
                    </div>

                    <div class="pb-4 border-b border-gray-200">
                        <label class="block text-xs font-medium text-gray-500 uppercase">Alamat</label>
                        <p class="mt-1 text-sm text-gray-900" x-text="user.address || '-'"></p>
                    </div>

                    <div class="pb-4 border-b border-gray-200">
                        <label class="block text-xs font-medium text-gray-500 uppercase">Total Pesanan</label>
                        <p class="mt-1 text-sm font-medium text-gray-900" x-text="user.total_orders + ' pesanan'"></p>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase">Terdaftar Pada</label>
                        <p class="mt-1 text-sm text-gray-900" x-text="user.created_at"></p>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="px-6 py-4 bg-gray-50 sm:flex sm:flex-row-reverse">
                <button @click="open = false" 
                    type="button" 
                    class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    [x-cloak] { display: none !important; }
</style>
@endsection
