document.addEventListener('DOMContentLoaded', function() {
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.nav-link');
    let lastKnownScrollPosition = 0;
    let ticking = false;

    function updateActiveSection() {
        const scrollPosition = window.scrollY + window.innerHeight / 3;
        
        // Find the current section
        let currentSection = null;
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionBottom = sectionTop + section.offsetHeight;
            
            if (scrollPosition >= sectionTop && scrollPosition < sectionBottom) {
                currentSection = section;
            }
        });

        // Update navigation
        if (currentSection) {
            const currentSectionId = currentSection.getAttribute('id');
            navLinks.forEach(link => {
                const href = link.getAttribute('href').substring(1); // Remove #
                
                if (href === currentSectionId) {
                    // Add active classes
                    link.classList.remove('hover:text-[#86765a]', 'transition');
                    link.classList.add('bg-[#86765a]', 'text-white', 'rounded-full', 'font-semibold');
                } else {
                    // Remove active classes
                    link.classList.remove('bg-[#86765a]', 'text-white', 'rounded-full', 'font-semibold');
                    link.classList.add('hover:text-[#86765a]', 'transition');
                }
            });
        }
    }

    // Smooth scroll to section when clicking nav links
    navLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const targetId = link.getAttribute('href');
            const targetSection = document.querySelector(targetId);
            if (targetSection) {
                targetSection.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });

    // Update active section on scroll with throttling
    document.addEventListener('scroll', function(e) {
        lastKnownScrollPosition = window.scrollY;

        if (!ticking) {
            window.requestAnimationFrame(function() {
                updateActiveSection();
                ticking = false;
            });

            ticking = true;
        }
    });

    // Initial check
    updateActiveSection();
});