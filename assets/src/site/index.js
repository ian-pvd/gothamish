/**
 * Site Entry Point
 */

// Global Scripts
import toggleMenuDisplay from './js/toggleMenuDisplay';
import loadWebFonts from './js/webFontLoader';

// Global Styles
import './scss/index.scss';

// Enable HMR
if (module.hot) {
  module.hot.accept();
}

// Enquue Site JS Modules
document.addEventListener('DOMContentLoaded', () => {
  toggleMenuDisplay('main-nav', 'page');
  toggleMenuDisplay('network-list', 'site-network-bar');
  loadWebFonts();
});
