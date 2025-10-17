// Navigation handler
function handleNavigation(section) {
    // Get current route
    const currentRoute = window.location.pathname;
    
    // If we're already on home page, just scroll to section
    if (currentRoute === '/' || currentRoute === '/home') {
        const element = document.getElementById(section);
        if (element) {
            element.scrollIntoView({ behavior: 'smooth' });
        }
    } else {
        // If we're on another page, redirect to home with hash
        window.location.href = '/#' + section;
    }
}