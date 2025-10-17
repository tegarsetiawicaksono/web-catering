// Toggle Sidenav
function toggleSidenav() {
    const sidenav = document.getElementById('sidenav');
    sidenav.classList.toggle('translate-x-0');
}

// Toggle Search Overlay
function toggleSearch() {
    const searchOverlay = document.getElementById('searchOverlay');
    searchOverlay.classList.toggle('hidden');
    if (!searchOverlay.classList.contains('hidden')) {
        document.getElementById('searchInput').focus();
    }
}

// Close search when pressing Escape
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        document.getElementById('searchOverlay').classList.add('hidden');
    }
});