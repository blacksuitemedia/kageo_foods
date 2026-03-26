/**
 * main.js - Kageo Foods Component Loader & Interaction
 */

document.addEventListener('DOMContentLoaded', () => {
    // 1. Load the Header Safely
    const headerPlaceholder = document.getElementById('header-placeholder');
    if (headerPlaceholder) {
        fetch('components/header.php')
            .then(response => response.text())
            .then(data => {
                headerPlaceholder.innerHTML = data;
                // After header is loaded, initialize the mobile menu toggle
                initMobileMenu();
            })
            .catch(err => console.error("Header load failed:", err));
    }

    // 2. Load the Footer Safely
    const footerPlaceholder = document.getElementById('footer-placeholder');
    if (footerPlaceholder) {
        fetch('components/footer.php')
            .then(response => response.text())
            .then(data => {
                footerPlaceholder.innerHTML = data;
            })
            .catch(err => console.error("Footer load failed:", err));
    }
});

/**
 * Logic for the mobile hamburger menu & animations
 */
function initMobileMenu() {
    const menuToggle = document.querySelector('#mobile-menu');
    const navLinks = document.querySelector('.nav-links');

    if (menuToggle && navLinks) {
        menuToggle.addEventListener('click', function() {
            // 1. Toggles the 'is-active' class on the hamburger (turns it into an X)
            this.classList.toggle('is-active');
            
            // 2. Toggles the 'active' class on the menu (makes it slide/appear)
            navLinks.classList.toggle('active');
            
            // 3. Optional: Prevent scrolling when menu is open
            if (navLinks.classList.contains('active')) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = 'initial';
            }
        });

        // Close menu if a link is clicked (useful for one-page navigation)
        document.querySelectorAll('.nav-links a').forEach(link => {
            link.addEventListener('click', () => {
                menuToggle.classList.remove('is-active');
                navLinks.classList.remove('active');
                document.body.style.overflow = 'initial';
            });
        });
    }
}