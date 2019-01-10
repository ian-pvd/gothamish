/**
 * Web Font Loader Config
 *
 * Loads web fonts via Google Fonts async
 */

import webFrontLoader from 'webfontloader';

function loadWebFonts() {
  webFrontLoader.load({
    google: {
      families: [
        'Archivo Narrow',
        'Open Sans:400,400i,700,700i',
        'Titillium Web:400,700',
      ],
    },
  });
}

export default loadWebFonts;
