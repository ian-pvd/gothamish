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
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'gotham' ); ?></a>

	<header id="masthead" class="site-header site-header--sticky">
		<div class="site-header__wrapper">
			<div class="site-header__branding">
				<?php
				the_custom_logo();
				if ( is_front_page() && is_home() ) :
					?>
					<h1 class="site-header__title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
				else :
					?>
					<p class="site-header__title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php
				endif;
				$gotham_description = get_bloginfo( 'description', 'display' );
				if ( $gotham_description || is_customize_preview() ) :
					?>
					<p class="site-header__description"><?php echo $gotham_description; /* WPCS: xss ok. */ ?></p>
				<?php endif; ?>
			</div><!-- .site-branding -->

			<nav id="site-navigation" class="site-header__navigation main-navigation main-navigation--priority-nav">
				<button id="mobile-nav-toggle" class="main-navigation__menu-toggle menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'gotham' ); ?></button>
				<?php
				wp_nav_menu(
					[
						'container_class' => 'main-navigation__primary-nav primary-nav',
						'menu_class'      => 'primary-nav__menu',
						'menu_id'         => 'primary-nav__menu',
						'theme_location'  => 'primary-nav',
					]
				);
				?>
			</nav><!-- #site-navigation -->
		</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
