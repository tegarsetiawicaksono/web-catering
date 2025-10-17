document.addEventListener('DOMContentLoaded', function() {
    // Handle navigation
    document.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href && href.includes('#')) {
                e.preventDefault();
                const section = href.split('#')[1];
                window.location.href = '/' + (section ? '#' + section : '');
            }
        });
    });
});