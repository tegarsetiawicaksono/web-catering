document.addEventListener('alpine:init', () => {
    Alpine.data('search', () => ({
        isOpen: false,
        searchQuery: '',
        menuItems: {
            'prasmanan': [
                { 
                    id: 'prasmanan-standard',
                    name: 'Paket Prasmanan Standard', 
                    price: 35000,
                    minOrder: 50,
                    description: 'Menu prasmanan lengkap 7 item', 
                    category: 'Prasmanan',
                    image: '/foto/buffet/standard.jpg'
                },
                { 
                    id: 'prasmanan-premium',
                    name: 'Paket Prasmanan Premium', 
                    price: 45000,
                    minOrder: 50,
                    description: 'Menu prasmanan lengkap 10 item', 
                    category: 'Prasmanan',
                    image: '/foto/buffet/premium.jpg'
                }
            ],
            'tumpeng': [
                { 
                    id: 'tumpeng-mini',
                    name: 'Tumpeng Mini', 
                    price: 250000,
                    minOrder: 1,
                    description: 'Untuk 7-10 orang', 
                    category: 'Tumpeng',
                    image: '/foto/tumpeng/mini.jpg'
                },
                { 
                    id: 'tumpeng-regular',
                    name: 'Tumpeng Regular', 
                    price: 450000,
                    minOrder: 1,
                    description: 'Untuk 15-20 orang', 
                    category: 'Tumpeng',
                    image: '/foto/tumpeng/regular.jpg'
                }
            ],
            'nasi-box': [
                { 
                    id: 'nasibox-basic',
                    name: 'Nasi Box Basic', 
                    price: 25000,
                    minOrder: 20,
                    description: '4 item menu', 
                    category: 'Nasi Box',
                    image: '/foto/nasibox/basic.jpg'
                },
                { 
                    id: 'nasibox-premium',
                    name: 'Nasi Box Premium', 
                    price: 35000,
                    minOrder: 20,
                    description: '6 item menu', 
                    category: 'Nasi Box',
                    image: '/foto/nasibox/premium.jpg'
                }
            ],
            'snack': [
                { 
                    id: 'snack-mini',
                    name: 'Snack Box Mini', 
                    price: 15000,
                    minOrder: 20,
                    description: '3 macam snack', 
                    category: 'Snack',
                    image: '/foto/snack/mini.jpg'
                },
                { 
                    id: 'snack-complete',
                    name: 'Snack Box Complete', 
                    price: 25000,
                    minOrder: 20,
                    description: '5 macam snack', 
                    category: 'Snack',
                    image: '/foto/snack/complete.jpg'
                }
            ]
        },
        
        results: [],
        
        search() {
            const query = this.searchQuery.toLowerCase();
            this.results = [];
            
            if (query.length === 0) return;

            Object.values(this.menuItems).forEach(category => {
                category.forEach(item => {
                    if (item.name.toLowerCase().includes(query) || 
                        item.category.toLowerCase().includes(query) ||
                        item.description.toLowerCase().includes(query)) {
                        this.results.push(item);
                    }
                });
            });
        },

        formatPrice(price) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(price);
        },

        addToCart(item) {
            document.dispatchEvent(new CustomEvent('add-to-cart', {
                detail: {
                    id: item.id,
                    name: item.name,
                    price: item.price,
                    minOrder: item.minOrder,
                    category: item.category,
                    image: item.image
                }
            }));
            this.isOpen = false;
            this.searchQuery = '';
        },

        scrollToMenu(category) {
            const section = document.getElementById('menu');
            if (section) {
                section.scrollIntoView({ behavior: 'smooth' });
                this.isOpen = false;
                this.searchQuery = '';
            }
        }
    }));
});