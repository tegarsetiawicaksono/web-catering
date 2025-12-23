<!-- Cart - Only show for authenticated users -->
@auth
<div class="relative" x-data="cart">
  <button @click="toggleCart" class="relative p-2 hover:bg-gray-100 rounded-full group">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 group-hover:text-[#86765a]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
    </svg>
    <span x-show="itemCount > 0"
      x-text="itemCount"
      class="absolute -top-2 -right-1 bg-orange-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
    </span>
  </button>

  <!-- Cart Dropdown -->
  <div x-show="isOpen"
    @click.away="isOpen = false"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 scale-95"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-100"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-95"
    class="absolute right-0 mt-2 w-72 sm:w-96 bg-white rounded-lg shadow-xl border border-gray-200 z-50">

    <!-- Cart Header -->
    <div class="p-2 sm:p-4 border-b border-gray-200">
      <div class="flex justify-between items-center">
        <h3 class="text-base sm:text-lg font-semibold text-gray-800">Keranjang</h3>
        <span x-text="itemCount + ' item'" class="text-gray-500"></span>
      </div>
    </div>

    <!-- Cart Items -->
    <div class="p-4 max-h-96 overflow-y-auto">
      <template x-if="items.length === 0">
        <div class="text-center py-8">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
          </svg>
          <p class="mt-4 text-gray-500">Keranjang masih kosong</p>
        </div>
      </template>

      <template x-for="item in items" :key="item.id">
        <div class="flex items-center py-2 sm:py-4 border-b border-gray-100">
          <img :src="item.image || '{{ asset('foto/buffet.jpg') }}'" class="w-12 h-12 sm:w-16 sm:h-16 rounded-lg object-cover">
          <div class="flex-1 ml-2 sm:ml-4">
            <h4 x-text="item.name" class="font-medium text-sm sm:text-base text-gray-800"></h4>
            <p x-text="item.category" class="text-xs sm:text-sm text-gray-500"></p>
            <div class="flex items-center mt-2">
              <button @click="decrementItem(item)" class="text-gray-500 hover:text-orange-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
                </svg>
              </button>
              <span x-text="item.quantity" class="mx-3 w-8 text-center"></span>
              <button @click="incrementItem(item)" class="text-gray-500 hover:text-orange-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
              </button>
              <span x-text="formatPrice(item.price * item.quantity)" class="ml-auto font-medium"></span>
            </div>
          </div>
          <button @click="removeItem(item)" class="ml-4 text-gray-400 hover:text-red-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
          </button>
        </div>
      </template>
    </div>

    <!-- Cart Footer -->
    <template x-if="items.length > 0">
      <div class="p-4 border-t border-gray-200">
        <div class="flex justify-between items-center mb-4">
          <span class="text-gray-600">Total</span>
          <span x-text="formatPrice(total)" class="text-lg font-bold text-gray-800"></span>
        </div>
        <a href="https://wa.me/6282227110771?text=Halo, saya ingin memesan:"
          target="_blank"
          class="block w-full bg-[#86765a] text-white text-center py-3 rounded-lg font-medium hover:bg-[#6d5e48] transition-colors">
          Checkout via WhatsApp
        </a>
      </div>
    </template>
  </div>
</div>
@endauth