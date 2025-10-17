<div x-data="{ 
    open: false,
    init() {
        this.$watch('open', value => {
            if (value) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        });
        
        this.$watch('$store.cart.items', () => {}, { deep: true });
    }
}"
    @open-cart.window="open = true"
    @keydown.escape.window="open = false"
>
    <!-- Backdrop -->
    <div x-show="open"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="open = false"
         class="fixed inset-0 bg-black bg-opacity-50 z-40"
    ></div>

    <!-- Cart Panel -->
    <div x-show="open"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="translate-x-full"
         class="fixed top-0 right-0 h-full w-full sm:w-96 bg-white shadow-lg z-50"
    >
        <!-- Header -->
        <div class="p-4 border-b flex justify-between items-center">
            <h2 class="text-lg font-semibold">Keranjang Belanja</h2>
            <button @click="open = false" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Cart Items -->
        <div class="px-4 py-2 overflow-y-auto" style="height: calc(100vh - 180px);">
            <template x-if="$store.cart.items.length === 0">
                <div class="flex flex-col items-center justify-center h-full text-gray-500">
                    <svg class="w-16 h-16 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <p>Keranjang belanja kosong</p>
                </div>
            </template>

            <template x-for="item in $store.cart.items" :key="item.id">
                <div class="flex items-center py-4 border-b">
                    <div class="flex-grow">
                        <h3 x-text="item.name" class="font-medium"></h3>
                        <div class="flex items-center mt-2">
                            <button @click="item.quantity > 50 && $store.cart.updateQuantity(item.id, item.quantity - 50)" 
                                    class="text-gray-500 hover:text-gray-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                </svg>
                            </button>
                            <span x-text="item.quantity" class="mx-3 w-12 text-center"></span>
                            <button @click="$store.cart.updateQuantity(item.id, item.quantity + 50)"
                                    class="text-gray-500 hover:text-gray-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-medium" x-text="'Rp ' + (item.price * item.quantity).toLocaleString('id-ID')"></p>
                        <button @click="$store.cart.remove(item.id)" 
                                class="text-red-500 hover:text-red-700 mt-2">
                            Hapus
                        </button>
                    </div>
                </div>
            </template>
        </div>

        <!-- Footer -->
        <div class="absolute bottom-0 left-0 right-0 border-t bg-white p-4">
            <div class="flex justify-between items-center mb-4">
                <span class="font-medium">Total</span>
                <span class="font-bold text-lg" x-text="'Rp ' + $store.cart.getTotal().toLocaleString('id-ID')"></span>
            </div>
            <a href="/checkout" 
               class="block w-full bg-[#86765a] text-white text-center py-3 rounded-lg hover:bg-[#6d5e48] transition-colors">
                Lanjutkan ke Pembayaran
            </a>
        </div>
    </div>
</div>