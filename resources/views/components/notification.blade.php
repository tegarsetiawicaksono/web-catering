<div x-data="{
    show: false,
    message: '',
    init() {
        window.addEventListener('show-notification', (e) => {
            this.message = e.detail.message;
            this.show = true;
            setTimeout(() => this.show = false, 3000);
        });
    }
}" 
    x-show="show"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform translate-y-2"
    x-transition:enter-end="opacity-100 transform translate-y-0"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 transform translate-y-0"
    x-transition:leave-end="opacity-0 transform translate-y-2"
    class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg"
    style="z-index: 50;"
>
    <span x-text="message"></span>
</div>