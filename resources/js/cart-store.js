document.addEventListener('alpine:init', () => {
    Alpine.store('cart', {
        items: [],
        isAuthenticated: false,

        init() {
            this.isAuthenticated = document.querySelector('meta[name="user-authenticated"]')?.content === 'true';

            if (this.isAuthenticated) {
                this.loadFromServer();
            } else {
                const savedCart = localStorage.getItem('cart');
                if (savedCart) {
                    this.items = JSON.parse(savedCart);
                }
            }
        },

        async loadFromServer() {
            try {
                const response = await fetch('/api/cart', {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });

                if (response.ok) {
                    const data = await response.json();
                    this.items = data.items || [];
                }
            } catch (error) {
                console.error('Failed to load cart from server:', error);
                const savedCart = localStorage.getItem('cart');
                if (savedCart) {
                    this.items = JSON.parse(savedCart);
                }
            }
        },

        async add(id, name, price, quantity = 100) {
            const existingItem = this.items.find(item => item.id === id);

            if (existingItem) {
                existingItem.quantity += quantity;
                this.showNotification(`${name} (${quantity} porsi) ditambahkan ke keranjang`);
            } else {
                this.items.push({
                    id,
                    name,
                    price,
                    quantity
                });
                this.showNotification(`${name} (${quantity} porsi) ditambahkan ke keranjang`);
            }

            await this.saveCart();
        },

        async remove(id) {
            this.items = this.items.filter(item => item.id !== id);
            await this.saveCart();
            this.showNotification('Item berhasil dihapus dari keranjang');
        },

        async updateQuantity(id, quantity) {
            const item = this.items.find(item => item.id === id);
            if (item) {
                item.quantity = quantity;
                await this.saveCart();
            }
        },

        getTotal() {
            return this.items.reduce((total, item) => total + (item.price * item.quantity), 0);
        },

        getCount() {
            return this.items.reduce((count, item) => count + item.quantity, 0);
        },

        async clear() {
            this.items = [];
            await this.saveCart();
        },

        async saveCart() {
            if (this.isAuthenticated) {
                try {
                    await fetch('/api/cart', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content,
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ items: this.items })
                    });
                } catch (error) {
                    console.error('Failed to save cart to server:', error);
                }
            } else {
                localStorage.setItem('cart', JSON.stringify(this.items));
            }
        },

        saveToStorage() {
            this.saveCart();
        },

        showNotification(message) {
            const event = new CustomEvent('show-notification', {
                detail: { message }
            });
            window.dispatchEvent(event);
        }
    });
});
