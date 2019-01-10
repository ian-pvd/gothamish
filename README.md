# roundhouse

A multimedia blog theme.

## How to Use This Theme

roundhouse is intended to be used as simple starter theme, which contains a minimal scaffold of templates and SCSS utilites for getting started, some sensible default styles and layout configurations, and a handful of useful but optional WP theme components which are disabled by default.

To use roundhouse, simply [download a copy of the theme](https://github.com/ian-pvd/roundhouse.git) into a new directory and start coding.

roundhouse is based on Automattic's [underscores](https://github.com/automattic/_s) theme.

## Theme Options

The roundhouse theme ships with an assortment of common, pre-built options for your theme's layouts, templates and metadata. Most of these are disabled by default. You can enable layout options by updating or adding matching CSS selector classes to your templates. Template options can be enabled by uncommenting include files in your `functions.php` file.

### Layout Options
1. Site Header: Sticky Header
2. Main Navigation: Priority Nav
3. Main Navigation: Top Level Nav
4. Main Navigation: Slide Out Mobile Nav
5. Site Content: Two Column Layout
6. Site Content: Single Column Layout

### Template Options
1. Post & Page: Advanced Featured Image Options

## Getting Set Up

1. Download a copy of the roundhouse theme:
    ```
    $ git clone https://github.com/ian-pvd/roundhouse.git your-project
    ```
2. Find and replace any instances of the roundhouse namespace.
    - Search for `'pvd'` (inside single quotations) to replace the text domain.
    - Replace `Text Domain: pvd` in `style.css` with your project's text domain.
    - Preform a case-sensative search for `pvd_` to replace all the function & variable names.
    - Perform a case-sensative search for `PVD_` to replace all the constant names.
    - Search for <code>&nbsp;roundhouse</code> (with a space before it) to capture DocBlocks.
    - Search for `pvd-` to capture prefixed handles.
3. Run `npm install` & `npm run build` in your project directory.
4. Assign some menus to the Primary Navigation and Footer Utilities menus.

## WordPress Theme Core

Rounhouse is a [WordPress theme](https://codex.wordpress.org/Theme_Development).

For more information, see the code comments in `index.php` and `functions.php`

## Front-End Development

This theme uses a webpack compiler to build front-end assets from SCSS & JS files. 

1. Run `npm run build` to generate minified JS and CSS asset bundles.
2. During development, you can use either `npm run watch` or `npm run dev` to enable live asset reloading in your browser.

Editable front-end files are stored in the `assets/src` folder. Built assets are stored in `assets/dist`. To view and make changes to the configuration, check the files in `assets/config`.

For more information, see `assets/readme.md`
