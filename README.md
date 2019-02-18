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
- Highlight content at the top of the home page simply by tagging it with "featured" using Jetpack's [Featured Content](https://jetpack.com/support/featured-content/) option.

## Installation
To start using this theme, download or clone a copy of the theme to your `wp-content/themes` directory. Once it has been added, open your site's admin panel and go to `Appearance > Themes` and click "Activate" to use the Gothamish theme.

## Theme Setup

### Reading Options & Static Front Page
To use the custom home page template:
1. Create a "Home" page and apply the "Front Page" template for the "Template" option.
2. Create a "Blog" page.
3. Under `Settings` -> `Reading`, change the "Your homepage displays" option to "A static page" and set the home page to "Home" and posts page to "Blog"

### Pages:
This theme contains links that will display conditionally in templates if matching page slugs are found. To take advantage of these links:
1. Create a "Privacy Policy" page at `privacy` and assign it as the Privacy Policy page under `Settings` -> `Privacy`.
2. Create a "Terms & Conditions" page at `terms`.
3. Create a "Support Us" page at `donate`.
4. Create a "Subscribe" page at `subscribe`.
4. Create a "Staff" page at `staff` and apply the "Staff Page" template.
    - Staff page will display users grouped by role: Editor, Author & Contributor. Admin accounts have been deliberately excluded from displaying on the front end.
    - Only user accounts with first & last names set will display. This is to prevent internal / utility accounts from displaying.
    - To display a special job title for a user (ie: Editor-in-Chief, Co-Founder), you can add it to the "Gothamish Staff Title" field.

### Sidebars:
- Single Post Sidebar: The default sidebar used throughout the site on posts.
- Page Content Sidebar: A shorter sidebar intented for shorter page content.
- Front Page Hero Sidebar: A sidebar that's displayed at the top of the home page next to the featured content.
- Front Page Recirculation Sidebar: An optional widget area for including an RSS widget to display posts from another network on the home page.

### Widgets:
- Ads Widget - Leverages the theme's ad placeholder function to display one of several different sized ads in a sidebar.
- Best of Gothamish Widget - A widget which displays an adjustible number of recent posts tagged with `best-of`.
- Gothamish Films Widget - A widget which displays the most recent post tagged with `gothamish-films`.
- Subscribe Widget - A widget which displays either a link to the subscribe page, or can be configured to display a MailChimp subscribe form.

### Menus:
1. Create and assign a main navigation menu for the Primary Navigation location.
2. (Recommended) Create and assign a list of social media profile links for the Social Links location.
3. (Recommended) Create a menu for primary page links and assign it to the Front Page Hero Sidebar using a navigation menu widget.
4. (Optional) Create and assign a list of partner network sites for the Site Networks location.
5. (Optional) Create and assign a list of utility page links for the Footer Utilities menu location.

### Logotype:
To display a custom logotype using the blog name (ie: **Gotham**ish), set your blog name to a single word that ends in '-ish'. For example: **Detroit**ish, **Seattle**ish, or **Oakland**ish.

## Development
This theme front-end is built with SCSS and modern JavaScript, and is compiled using webpack. For more information, please see the [Theme Development Readme](./assets/README.md).

## License
Gothamish is licensed under the [GNU General Public License v2.0](https://github.com/ian-pvd/gothamish/blob/master/LICENSE).
