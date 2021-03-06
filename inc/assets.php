<?php
/**
 * Manage static assets
 *
 * @package Gothamish
 */

/**
 * Enqueues theme styles and scripts
 */
function gotham_enqueue_assets() {
	if ( false !== strpos( get_site_url(), '.test' ) && true === get_query_var( 'webpack-dev', false ) ) {
		wp_enqueue_script(
			'webpack-dev',
			'https://localhost:8080/dist/site.js',
			[],
			'1.0',
			false
		);
	} else {
		/* Global Scripts & Styles */
		wp_enqueue_script( 'gotham-site-js', GOTHAM_URL . '/assets/dist/' . gotham_get_asset_version( 'site-js' ), [], '1.0', true );
		wp_enqueue_style( 'gotham-site-css', GOTHAM_URL . '/assets/dist/' . gotham_get_asset_version( 'site-css' ), [], '1.0' );

		/* Post Scrips & Styles */
		wp_enqueue_script( 'gotham-post-js', GOTHAM_URL . '/assets/dist/' . gotham_get_asset_version( 'post-js' ), [], '1.0', true );
		wp_enqueue_style( 'gotham-post-css', GOTHAM_URL . '/assets/dist/' . gotham_get_asset_version( 'post-css' ), [], '1.0' );

		/* Front Page Scripts & Styles */
		if ( is_front_page() ) {
			wp_enqueue_script( 'gotham-front-js', GOTHAM_URL . '/assets/dist/' . gotham_get_asset_version( 'front-js' ), [], '1.0', true );
			wp_enqueue_style( 'gotham-front-css', GOTHAM_URL . '/assets/dist/' . gotham_get_asset_version( 'front-css' ), [], '1.0' );
		}

		/* Page Scripts & Styles */
		if ( is_page() || is_archive() ) {
			wp_enqueue_script( 'gotham-page-js', GOTHAM_URL . '/assets/dist/' . gotham_get_asset_version( 'page-js' ), [], '1.0', true );
			wp_enqueue_style( 'gotham-page-css', GOTHAM_URL . '/assets/dist/' . gotham_get_asset_version( 'page-css' ), [], '1.0' );
		}

		/* Archive Scripts & Styles */
		if ( is_archive() || is_home() ) {
			wp_enqueue_script( 'gotham-archive-js', GOTHAM_URL . '/assets/dist/' . gotham_get_asset_version( 'archive-js' ), [], '1.0', true );
			wp_enqueue_style( 'gotham-archive-css', GOTHAM_URL . '/assets/dist/' . gotham_get_asset_version( 'archive-css' ), [], '1.0' );
		}

		/* User List & Archive */
		if ( is_author() || is_page( 'staff' ) ) {
			wp_enqueue_script( 'gotham-user-js', GOTHAM_URL . '/assets/dist/' . gotham_get_asset_version( 'user-js' ), [], '1.0', true );
			wp_enqueue_style( 'gotham-user-css', GOTHAM_URL . '/assets/dist/' . gotham_get_asset_version( 'user-css' ), [], '1.0' );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'gotham_enqueue_assets' );

/**
 * Enqueues WP content styles in the editor
 */
function gotham_enqueue_editor_styles() {
	// Add theme support for editor styles.
	add_theme_support( 'editor-styles' );

	// Enqueue wp content styles in the editor.
	add_editor_style( GOTHAM_URL . '/assets/dist/' . gotham_get_asset_version( 'editor-css' ) );
}
add_action( 'after_setup_theme', 'gotham_enqueue_editor_styles' );

/**
 * Removes WP scripts
 */
function gotham_dequeue_scripts() {
	wp_dequeue_style( 'jetpack-slideshow' );
	wp_dequeue_style( 'jetpack-carousel' );
}
add_action( 'wp_print_scripts', 'gotham_dequeue_scripts' );
