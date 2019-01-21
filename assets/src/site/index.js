/**
 * Site Entry Point
 */

// Global Scripts
import toggleMobileNav from './js/toggleMobileNav';
import toggleNetworkList from './js/toggleNetworkList';
import loadWebFonts from './js/webFontLoader';

// Global Styles
import './scss/index.scss';

// Enable HMR
if (module.hot) {
  module.hot.accept();
}

// Enquue Site JS Modules
document.addEventListener('DOMContentLoaded', () => {
  toggleMobileNav();
  toggleNetworkList();
  loadWebFonts();
});
