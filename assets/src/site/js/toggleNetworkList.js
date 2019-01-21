/**
 * Toggle Network List
 *
 * Toggles display of drop down networks list on mobile.
 */

const toggleNetworkList = () => {
  const menuToggle = document.getElementById('network-list-toggle');
  const listWrapper = document.getElementById('site-network-bar');

  if ((menuToggle) && (listWrapper)) {
    menuToggle.addEventListener('click', (e) => {
      listWrapper.classList.toggle('toggle__network-list--active');
      menuToggle.setAttribute(
        'aria-expanded',
        `${'true' !== menuToggle.getAttribute('aria-expanded')}`
      );
      e.preventDefault();
    });
  }
};

export default toggleNetworkList;
