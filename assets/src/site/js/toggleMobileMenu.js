/**
 * Toggle Mobile Nav
 *
 * Enables slide out mobile nav menu and toggle button interactivity.
 */

const toggleMobileMenu = (menuID, wrapperID) => {
  const menuToggle = document.getElementById(`${menuID}-toggle`);
  const pageWrapper = document.getElementById(wrapperID);

  if ((menuToggle) && (pageWrapper)) {
    menuToggle.addEventListener('click', (e) => {
      pageWrapper.classList.toggle(`toggle__${menuID}--active`);
      menuToggle.setAttribute(
        'aria-expanded',
        `${'true' !== menuToggle.getAttribute('aria-expanded')}`
      );
      e.preventDefault();
    });
  }
};

export default toggleMobileMenu;
