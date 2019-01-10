/**
 * Site Entry Point
 */

// Global Scripts
import toggleMobileNav from './js/toggleMobileNav';

// Global Styles
import './scss/index.scss';

// Enable HMR
if (module.hot) {
  module.hot.accept();
}

// Enquue Site JS Modules
document.addEventListener('DOMContentLoaded', () => {
  toggleMobileNav();
});
