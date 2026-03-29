@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Kelola Urutan Kategori</h1>
        <p class="text-gray-600 mt-2">Atur urutan tampilan kategori di halaman utama</p>
    </div>

    @if (session('success'))
        <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg text-green-800">
            ✓ {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($categories as $index => $category)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $index + 1 }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <span class="font-semibold">{{ $category->nama }}</span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ Str::limit($category->deskripsi, 50) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                            <div class="flex justify-center gap-2">
                                @if ($index > 0)
                                    <form action="{{ route('admin.ordering.categories.update-order', $category) }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="direction" value="up">
                                        <button type="submit" class="inline-flex items-center px-3 py-2 bg-blue-500 text-white text-xs font-medium rounded hover:bg-blue-600" title="Naik">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12" />
                                            </svg>
                                        </button>
                                    </form>
                                @else
                                    <button disabled class="inline-flex items-center px-3 py-2 bg-gray-300 text-gray-500 text-xs font-medium rounded cursor-not-allowed" title="Naik">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12" />
                                        </svg>
                                    </button>
                                @endif

                                @if ($index < count($categories) - 1)
                                    <form action="{{ route('admin.ordering.categories.update-order', $category) }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="direction" value="down">
                                        <button type="submit" class="inline-flex items-center px-3 py-2 bg-blue-500 text-white text-xs font-medium rounded hover:bg-blue-600" title="Turun">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6" />
                                            </svg>
                                        </button>
                                    </form>
                                @else
                                    <button disabled class="inline-flex items-center px-3 py-2 bg-gray-300 text-gray-500 text-xs font-medium rounded cursor-not-allowed" title="Turun">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6" />
                                        </svg>
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-600">
                            Tidak ada kategori
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
