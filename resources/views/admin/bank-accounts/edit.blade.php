<x-admin-layout>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit Rekening Bank</h1>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.bank-accounts.update', $bankAccount) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="bank_name" class="block text-sm font-medium text-gray-700 mb-2">Nama Bank *</label>
                <input type="text"
                    name="bank_name"
                    id="bank_name"
                    value="{{ old('bank_name', $bankAccount->bank_name) }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('bank_name') border-red-500 @enderror"
                    placeholder="Contoh: BCA, Mandiri, BNI"
                    required>
                @error('bank_name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="account_number" class="block text-sm font-medium text-gray-700 mb-2">Nomor Rekening *</label>
                <input type="text"
                    name="account_number"
                    id="account_number"
                    value="{{ old('account_number', $bankAccount->account_number) }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('account_number') border-red-500 @enderror"
                    placeholder="1234567890"
                    required>
                @error('account_number')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="account_holder" class="block text-sm font-medium text-gray-700 mb-2">Atas Nama *</label>
                <input type="text"
                    name="account_holder"
                    id="account_holder"
                    value="{{ old('account_holder', $bankAccount->account_holder) }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('account_holder') border-red-500 @enderror"
                    placeholder="Nama pemilik rekening"
                    required>
                @error('account_holder')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox"
                        name="is_active"
                        value="1"
                        {{ old('is_active', $bankAccount->is_active) ? 'checked' : '' }}
                        class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <span class="ml-2 text-sm text-gray-700">Aktifkan rekening ini</span>
                </label>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                    Update
                </button>
                <a href="{{ route('admin.bank-accounts.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</x-admin-layout>