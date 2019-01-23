/**
 * Site Entry Point
 */

// Global Scripts
import toggleMobileMenu from './js/toggleMobileMenu';
import loadWebFonts from './js/webFontLoader';

// Global Styles
import './scss/index.scss';

// Enable HMR
if (module.hot) {
  module.hot.accept();
}

// Enquue Site JS Modules
document.addEventListener('DOMContentLoaded', () => {
  toggleMobileMenu('main-nav', 'page');
  toggleMobileMenu('network-list', 'site-network-bar');
  loadWebFonts();
});
