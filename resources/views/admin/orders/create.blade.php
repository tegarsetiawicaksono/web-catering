@section('page-title', 'Buat Pesanan Manual')

<x-admin-layout>
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Buat Pesanan Manual</h1>
            <p class="text-gray-600">Masukkan pesanan custom dari admin dan langsung buat nota/invoice.</p>
        </div>
        <a href="{{ route('admin.orders.index') }}"
            class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 transition-colors bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
            Kembali ke Pesanan
        </a>
    </div>

    @if ($errors->any())
        <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4">
            <p class="mb-2 text-sm font-semibold text-red-800">Terdapat kesalahan input:</p>
            <ul class="list-disc pl-5 text-sm text-red-700">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.orders.store') }}" class="space-y-6" id="manual-order-form">
        @csrf

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
            <div class="overflow-hidden rounded-xl border border-gray-200 bg-white">
                <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
                    <h2 class="text-lg font-semibold text-gray-900">Informasi Pelanggan</h2>
                </div>
                <div class="space-y-4 p-6">
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">Nama Pelanggan</label>
                        <input type="text" name="customer_name" value="{{ old('customer_name') }}" required
                            class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">No. Telepon</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" required
                            class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">Provinsi</label>
                        <input type="text" name="province" value="{{ old('province') }}" required
                            class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">Kota/Kabupaten</label>
                        <input type="text" name="city" value="{{ old('city') }}" required
                            class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">Kecamatan</label>
                        <input type="text" name="district" value="{{ old('district') }}" required
                            class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">Alamat Lengkap</label>
                        <textarea name="street_address" rows="3" required
                            class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">{{ old('street_address') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="overflow-hidden rounded-xl border border-gray-200 bg-white">
                <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
                    <h2 class="text-lg font-semibold text-gray-900">Informasi Pesanan</h2>
                </div>
                <div class="space-y-4 p-6">
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">Tanggal Event</label>
                        <input type="date" name="event_date" value="{{ old('event_date') }}" required
                            class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">Waktu Event</label>
                        <input type="time" name="event_time" value="{{ old('event_time') }}" required
                            class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <label class="mb-1 block text-sm font-medium text-gray-700">Metode Pembayaran</label>
                            <select name="payment_method" required
                                class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                                <option value="transfer" {{ old('payment_method', 'transfer') === 'transfer' ? 'selected' : '' }}>Transfer</option>
                                <option value="cash" {{ old('payment_method') === 'cash' ? 'selected' : '' }}>Cash</option>
                            </select>
                        </div>
                        <div>
                            <label class="mb-1 block text-sm font-medium text-gray-700">Status Awal</label>
                            <select name="status" required
                                class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                                <option value="pending" {{ old('status', 'pending') === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ old('status') === 'confirmed' ? 'selected' : '' }}>Terverifikasi</option>
                                <option value="completed" {{ old('status') === 'completed' ? 'selected' : '' }}>Selesai</option>
                                <option value="cancelled" {{ old('status') === 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">Catatan</label>
                        <textarea name="notes" rows="4"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">{{ old('notes') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="overflow-hidden rounded-xl border border-gray-200 bg-white">
            <div class="flex items-center justify-between border-b border-gray-200 bg-gray-50 px-6 py-4">
                <h2 class="text-lg font-semibold text-gray-900">Item Pesanan</h2>
                <button type="button" id="add-item"
                    class="inline-flex items-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-indigo-700">
                    Tambah Item
                </button>
            </div>

            <div class="p-6">
                <div id="items-wrapper" class="space-y-3"></div>

                <div class="mt-6 rounded-lg border border-indigo-100 bg-indigo-50 p-4">
                    <div class="flex items-center justify-between text-sm text-gray-700">
                        <span>Total Porsi</span>
                        <span id="summary-qty" class="font-semibold text-gray-900">0</span>
                    </div>
                    <div class="mt-2 flex items-center justify-between text-lg">
                        <span class="font-semibold text-gray-800">Total Harga</span>
                        <span id="summary-total" class="font-bold text-indigo-700">Rp 0</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit"
                class="inline-flex items-center rounded-lg bg-green-600 px-6 py-3 text-sm font-semibold text-white transition-colors hover:bg-green-700">
                Simpan Pesanan Manual
            </button>
        </div>
    </form>

    <template id="item-template">
        <div class="item-row grid grid-cols-1 gap-3 rounded-lg border border-gray-200 p-4 md:grid-cols-12">
            <div class="md:col-span-5">
                <label class="mb-1 block text-xs font-medium text-gray-600">Nama Item</label>
                <input type="text" data-field="name" required
                    class="item-name w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
            </div>
            <div class="md:col-span-2">
                <label class="mb-1 block text-xs font-medium text-gray-600">Qty</label>
                <input type="number" min="1" data-field="quantity" required
                    class="item-qty w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
            </div>
            <div class="md:col-span-3">
                <label class="mb-1 block text-xs font-medium text-gray-600">Harga Satuan</label>
                <input type="number" min="0" data-field="price" required
                    class="item-price w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
            </div>
            <div class="md:col-span-2">
                <label class="mb-1 block text-xs font-medium text-gray-600">Aksi</label>
                <button type="button"
                    class="remove-item w-full rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-sm font-medium text-red-700 hover:bg-red-100">
                    Hapus
                </button>
            </div>
        </div>
    </template>

    <script>
        (function() {
            const wrapper = document.getElementById('items-wrapper');
            const addButton = document.getElementById('add-item');
            const template = document.getElementById('item-template');
            const totalQtyEl = document.getElementById('summary-qty');
            const totalPriceEl = document.getElementById('summary-total');

            const oldItems = @json(old('items', []));

            function formatRupiah(value) {
                return 'Rp ' + Number(value || 0).toLocaleString('id-ID');
            }

            function updateIndexes() {
                const rows = wrapper.querySelectorAll('.item-row');
                rows.forEach((row, index) => {
                    row.querySelector('[data-field="name"]').setAttribute('name', `items[${index}][name]`);
                    row.querySelector('[data-field="quantity"]').setAttribute('name', `items[${index}][quantity]`);
                    row.querySelector('[data-field="price"]').setAttribute('name', `items[${index}][price]`);
                });
            }

            function recalculateSummary() {
                let totalQty = 0;
                let totalPrice = 0;

                wrapper.querySelectorAll('.item-row').forEach((row) => {
                    const qty = parseInt(row.querySelector('.item-qty').value || '0', 10);
                    const price = parseInt(row.querySelector('.item-price').value || '0', 10);
                    totalQty += Number.isNaN(qty) ? 0 : qty;
                    totalPrice += (Number.isNaN(qty) ? 0 : qty) * (Number.isNaN(price) ? 0 : price);
                });

                totalQtyEl.textContent = String(totalQty);
                totalPriceEl.textContent = formatRupiah(totalPrice);
            }

            function addRow(item = {}) {
                const fragment = template.content.cloneNode(true);
                const row = fragment.querySelector('.item-row');

                row.querySelector('.item-name').value = item.name || '';
                row.querySelector('.item-qty').value = item.quantity || '';
                row.querySelector('.item-price').value = item.price || '';

                row.querySelector('.remove-item').addEventListener('click', () => {
                    row.remove();
                    updateIndexes();
                    recalculateSummary();
                });

                row.querySelectorAll('input').forEach((input) => {
                    input.addEventListener('input', recalculateSummary);
                });

                wrapper.appendChild(fragment);
                updateIndexes();
                recalculateSummary();
            }

            addButton.addEventListener('click', () => addRow());

            if (Array.isArray(oldItems) && oldItems.length > 0) {
                oldItems.forEach((item) => addRow(item));
            } else {
                addRow();
            }
        })();
    </script>
</x-admin-layout>
