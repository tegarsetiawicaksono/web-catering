/**
 * Auto-refresh CSRF token untuk mencegah 419 Page Expired
 * Terutama penting untuk mobile browser
 */

// Refresh CSRF token setiap 10 menit
if (typeof window !== 'undefined') {
    setInterval(async function () {
        try {
            const response = await fetch('/refresh-csrf', {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            if (response.ok) {
                const data = await response.json();

                // Update semua CSRF token di page
                document.querySelectorAll('input[name="_token"]').forEach(input => {
                    input.value = data.csrf_token;
                });

                // Update meta tag
                const metaTag = document.querySelector('meta[name="csrf-token"]');
                if (metaTag) {
                    metaTag.setAttribute('content', data.csrf_token);
                }

                console.log('CSRF token refreshed');
            }
        } catch (error) {
            console.error('Failed to refresh CSRF token:', error);
        }
    }, 600000); // 10 menit

    // Handle form submission errors
    document.addEventListener('DOMContentLoaded', function () {
        // Auto-focus pada error messages
        const errorMessages = document.querySelectorAll('.alert-error, [role="alert"]');
        if (errorMessages.length > 0) {
            errorMessages[0].scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    });
}
