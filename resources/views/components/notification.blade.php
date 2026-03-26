<!-- Notification Component -->

<!-- Notification Component -->
<div x-data="{
    show: false,
    notifications: [],
    timeout: null,
    init() {
        window.addEventListener('show-notification', (e) => {
            this.notifications.push({
                message: e.detail.message,
                type: e.detail.type || 'success',
                id: Date.now()
            });
            this.show = true;
            this.autoHide();
        });
    },
    autoHide() {
        if (this.timeout) clearTimeout(this.timeout);
        this.timeout = setTimeout(() => {
            this.notifications.shift();
            if (this.notifications.length === 0) this.show = false;
            else this.autoHide();
        }, 3000);
    },
    close(idx) {
        this.notifications.splice(idx, 1);
        if (this.notifications.length === 0) this.show = false;
    }
}"
    x-show="show && notifications.length"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-y-2"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 translate-y-2"
    class="fixed bottom-4 right-4 z-50 space-y-2 w-80 max-w-full"
    style="display: none;">
    <template x-for="(notif, idx) in notifications" :key="notif.id">
        <div class="text-white px-6 py-3 rounded-lg shadow-lg flex items-center space-x-3 relative"
             :class="notif.type === 'error' ? 'bg-red-500' : 'bg-green-500'">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" x-show="notif.type !== 'error'">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" x-show="notif.type === 'error'">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span x-text="notif.message"></span>
            <button @click="close(idx)" class="absolute top-2 right-2 text-white hover:text-gray-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </template>
</div>