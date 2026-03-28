/**
 * main.js - Kageo Foods Component Loader & Interaction
 */

document.addEventListener('DOMContentLoaded', () => {
    // 1. Load the Header
    const headerPlaceholder = document.getElementById('header-placeholder');
    if (headerPlaceholder) {
        fetch('components/header.php')
            .then(response => response.text())
            .then(data => {
                headerPlaceholder.innerHTML = data;
                // After header is loaded, initialize the mobile menu toggle
                
            });
   

    // 2. Load the Footer
    const footerPlaceholder = document.getElementById('footer-placeholder');
    if (footerPlaceholder) {
        fetch('components/footer.php')
            .then(response => response.text())
            .then(data => {
                footerPlaceholder.innerHTML = data;
            });
    }
});

/**
 * Logic for the mobile hamburger menu
 */
function initMobileMenu() {
    const menuToggle = document.querySelector('#mobile-menu');
    const navLinks = document.querySelector('.nav-links');

    if (menuToggle) {
        menuToggle.addEventListener('click', () => {
            // Toggles the 'active' class on both the button and the menu
            menuToggle.classList.toggle('is-active');
            navLinks.classList.toggle('active');
        });
    }
}