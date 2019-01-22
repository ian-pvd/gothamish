# Gothamish Theme Core

This theme makes use of:
* Webpack
* CSS styles via SCSS
* Javascript via ES6 + Babel
* Linting via StyleLint & ESLint
* See Also: `../package.json` for a list of dev dependencies.

## Developer Quickstart

To begin making changes to this theme's styles and scripts, `cd` into the theme directory and run `npm i` to being installing the necessary dependencies. Once the install has completed, you can compile the site's assets using:
- `npm run build` to rebuild the site's assets from scratch for production
- `npm run watch` to watch for changes in the `./assets` folder and update the site's assets in your development environment using webpack livereload. 

## Files and Folder Architecture

This theme's front end files are all included within the `./assets` directory and modifications to scripts, styles, image assets, font assets, or config files should happen here.

**config** –  The configurations folder contains the webpack, asset version and stylelint configurations.

**src** – The source folder contains the eatable files which will be compiled by webpack to generate your front-end theme styles and scripts. 

**dist** – This folder contains the compiled assets that webpack has built from the contents of your `src` folder. You should not make changes to these files directly, they are minified and not human readable, and will be erased and rebuild each time the production build runs.

## Webpack

@ TODO — Detail webpack config settings.
See: `./config/webpack.config.js`

## Source Components & Entry Points

Each theme entry point has its own folder, and each folder contains an `index.js` file which imports the component styles and scripts.

Component **scripts** are stored in the `js/` folder for each component, and should be written as module exports.
Component **styles** can be found in the `scss/` folder, and are imported via an `index.scss` file. Each `index.scss` file should begin with importing the SCSS theme core files ([see below](#scss-theme-core)) to allow access to variables, theme options and mixins.
Component **images** for each component should be added to an `img/` folder.

### SCSS Theme Core

The styles for this theme are written in SCSS and leverage SCSS mixins, functions and variables. A set of helper functions, theme mixins and reusable values has been included in the `src/core` directory. These files do not output any CSS themselves, but are intended to be imported into each entry point when complied.

**Core files include:**
* Utilities - SCSS helper functions.
* Breakpoints – Sets default breakpoint sizes and includes a breakpoint shortcut mixin.
* Colors – Sets 32 default named colors and includes a color picker mixin.
* Layout – Reusable layout style mixins.
* Grid – A mixin for setting grid layouts.
* Z-Index – Default z-index values and a z-index shortcut mixin.
* Typography – Sets 3 default named font families and includes a font picker mixin.

### SCSS Theme Variables & Options

**The theme variables file** stores specific custom values used throughout this theme like primary colors, fonts, content width, spacing values, borders, etc.

**The theme options file** allows default values set in `core/scss` to be overwritten, and additional values to be added. This makes use of SCSS `map-merge()` to overwrite default maps with only the item keys and values that are being customized.

For example, to change a default color value, add the following in `_options.scss`:
```scss
$custom-colors: (
  green: seagreen,
);
$colors: map-merge($colors, $custom-colors);
```

### Theme Modules

These are lean and reusable SCSS for styling component markup used throughout the site. For example, post grids or newsletter signup forms which use the same markup but are displayed in different entry points.

Module files should be imported before entry point files so that they can be further customized for each view if necessary. For example:
```scss
// Load Theme Core
@import '../../core/scss/index.scss';

// Import Modules
@import '../../modules/menu/index.scss';

// Import Component Styles
@import 'component-menu';
```