# Gothamish

Gothamish is a WordPress theme about New York.

![Gothamish Theme Preview](https://gothamish.press/wp-content/uploads/2019/01/gothamish-preview.png)
[View Full Preview](https://gothamish.press/wp-content/uploads/2019/01/gothamish-preview-full.png)

Gothamish is built on PVD Industrial's [roundhouse](https://github.com/ian-pvd/roundhouse) theme.

## Features
- Gutenberg Ready – Includes font-end display and editor preview styles for WordPress content using the new Gutenberg editor.
- Ad Slot Placeholders – Easily replace function calls to `inc/ads/index.php` with function calls to your favourite ad provider to monetize your sites content.
- Partner Sites Menu – Enable the Site Networks menu to display a list of partner networks and a "Support Us" donate button at the top of the site.
- Tag Highlight Banners – Draw attention to special content tags like "Best of" or "Films" with a post banner that displays at the top of single posts, post archives and above taxonomy widgets.

## Installation
To start using this theme, download or clone a copy of the theme to your `wp-content/themes` directory. Once it has been added, open your site's admin panel and go to `Appearance > Themes` and click "Activate" to use the Gothamish theme.

## Theme Setup
**Menus:**
1. Create and assign a main navigation menu for the Primary Navigation location.
2. (Recommended) Create a menu for primary page links and assign it to the Front Page Hero Sidebar using a navigation menu widget.
3. (Recommended) Create and assign a list of social media profile links for the Social Links location.
2. (Optional) Create and assign a list of partner network sites for the Site Networks location.
3. (Optional) Create and assign a list of utility page links for the Footer Utilities menu location.

**Pages:**
1. Create a "Privacy Policy" page at `/privacy`.
2. Create a "Terms & Conditions" page at `/terms`.
3. Create a "Support Us" page at `/donate`.
4. Create a "Staff" page at `/staff`.
    - Staff page will display users grouped by role: Editor, Author & Contributor. Admin accounts have been deliberately excluded from displaying on the front end.
    - Only user accounts with first & last names set will display. This is to prevent internal / utility accounts from displaying.
    - To display a special job title for a user (ie: Editor-in-Chief, Co-Founder), you can add it to the "Gothamish Staff Title" field.

**Logotype:**

To display a custom logotype using the blog name (ie: **Gotham**ish), set your blog name to a single word that ends in '-ish'. For example: **Detroit**ish, **Seattle**ish, or **Oakland**ish.

## Style & Layout Options
This theme contains modifier styles which can be enabled or disabled to change various component layouts.
- Site Header Layout – Choose between the traditional centred logo/logotype, or use enable the `--logo-left` option to use a left aligned logo with a right aligned nav display.
- Site Content Layout – Enable the `--single-column` option to view site content in a centred single column layout on desktop.

## Development
This theme front-end is built with SCSS and modern JavaScript, and is compiled using webpack. For more information, please see the [Theme Development Readme](./assets/README.md).

## License
Gothamish is licensed under the [GNU General Public License v2.0](https://github.com/ian-pvd/gothamish/blob/master/LICENSE).
