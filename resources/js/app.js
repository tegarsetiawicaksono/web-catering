import './bootstrap';
import Alpine from 'alpinejs';
import './cart-store';
import './csrf-refresh';

window.Alpine = Alpine;
Alpine.start();

// Add CSRF token to all AJAX requests
let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found');
}
