document.addEventListener('alpine:init', () => {
    Alpine.store('cart', {
        items: [],
        
        init() {
            // Load cart from localStorage if exists
            const savedCart = localStorage.getItem('cart');
            if (savedCart) {
                this.items = JSON.parse(savedCart);
            }
        },

        add(id, name, price, minOrder = 50) {
            const existingItem = this.items.find(item => item.id === id);
            
            if (existingItem) {
                existingItem.quantity += minOrder;
            } else {
                this.items.push({
                    id,
                    name,
                    price,
                    quantity: minOrder
                });
            }

            this.saveToStorage();
            this.showNotification('Item berhasil ditambahkan ke keranjang');
        },

        remove(id) {
            this.items = this.items.filter(item => item.id !== id);
            this.saveToStorage();
            this.showNotification('Item berhasil dihapus dari keranjang');
        },

        updateQuantity(id, quantity) {
            const item = this.items.find(item => item.id === id);
            if (item) {
                item.quantity = quantity;
                this.saveToStorage();
            }
        },

        getTotal() {
            return this.items.reduce((total, item) => total + (item.price * item.quantity), 0);
        },

        getCount() {
            return this.items.reduce((count, item) => count + item.quantity, 0);
        },

        clear() {
            this.items = [];
            this.saveToStorage();
        },

        saveToStorage() {
            localStorage.setItem('cart', JSON.stringify(this.items));
        },

        showNotification(message) {
            const event = new CustomEvent('show-notification', {
                detail: { message }
            });
            window.dispatchEvent(event);
        }
    });
});