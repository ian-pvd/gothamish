<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Gothamish
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site site--mobile-nav">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'gothamish' ); ?></a>

	<?php
	if ( has_nav_menu( 'network-list' ) ) {
		gotham_network_list();
	}
	?>

	<?php
		// Site Header Leaderboard Ad Slot.
		gotham_display_ad(
			'site-header',
			[
				'mobile'  => '320x50',
				'tablet'  => '468x60',
				'desktop' => '970x90',
			]
		);
		?>

	<header id="masthead" class="site-header">
		<div class="site-header__wrapper">
			<div class="site-header__branding">
				<?php
				the_custom_logo();

				$gotham_description = get_bloginfo( 'description', 'display' );

				if ( $gotham_description ) {
					$logo_link_title = $gotham_description;
				} else {
					$logo_link_title = get_bloginfo( 'name' );
				}

				if ( is_front_page() && is_home() ) :
					?>
					<h1 class="site-header__title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_html( $logo_link_title ); ?>" rel="home"><?php echo gotham_logotype(); ?></a></h1>
					<?php
				else :
					?>
					<p class="site-header__title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_html( $logo_link_title ); ?>" rel="home"><?php echo gotham_logotype(); ?></a></p>
					<?php
				endif;
				?>
			</div><!-- .site-branding -->

			<?php if ( has_nav_menu( 'primary-nav' ) ) : ?>

				<nav id="site-navigation" class="site-header__navigation main-navigation">
					<button id="main-nav-toggle" class="main-navigation__menu-toggle menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'gothamish' ); ?></button>
					<?php
					// Add search bar to nav before menu.
					$menu_prefix_markup = get_search_form( false );

					// Check for social links to add to nav after menu.
					$menu_suffix_markup = null;
					if ( has_nav_menu( 'social-links' ) ) {
						$menu_suffix_markup = gotham_social_links( false );
					}

					wp_nav_menu(
						[
							'container_class' => 'main-navigation__primary-nav primary-nav',
							'menu_class'      => 'primary-nav__menu',
							'menu_id'         => 'primary-nav__menu',
							'theme_location'  => 'primary-nav',
							'items_wrap'      => $menu_prefix_markup . '<ul id="%1$s" class="%2$s">%3$s</ul>' . $menu_suffix_markup,
						]
					);
					?>
				</nav><!-- #site-navigation -->

			<?php endif; ?>

			<div class="site-header__utilities">

				<?php if ( has_nav_menu( 'social-links' ) ) : ?>
				<div class="site-header__social-links">
					<?php gotham_social_links(); ?>
				</div>
				<?php endif; ?>

				<div class="site-header__search-form">
				<?php get_search_form(); ?>
				</div>
			</div>
		</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
