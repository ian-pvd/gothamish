/**
 * Toggle Mobile Nav
 *
 * Enables slide out mobile nav menu and toggle button interactivity.
 */

const toggleMobileNav = () => {
  const menuToggle = document.getElementById('mobile-nav-toggle');
  const pageWrapper = document.getElementById('page');

  if ((menuToggle) && (pageWrapper)) {
    menuToggle.addEventListener('click', (e) => {
      pageWrapper.classList.toggle('toggle__mobile-nav--active');
      menuToggle.setAttribute(
        'aria-expanded',
        `${'true' !== menuToggle.getAttribute('aria-expanded')}`
      );
      e.preventDefault();
    });
  }
};

export default toggleMobileNav;
