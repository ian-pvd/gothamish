<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Gothamish
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function gotham_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'gotham_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function gotham_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'gotham_pingback_header' );

/**
 * Customize Gutenberg supported features
 */
function gotham_setup_editor_features() {
	add_theme_support(
		'editor-color-palette',
		[
			[
				'name'  => __( 'Red', 'gotham' ),
				'slug'  => 'red',
				'color' => '#900',
			],
			[
				'name'  => __( 'Dark Gray', 'gotham' ),
				'slug'  => 'gray-dark',
				'color' => '#333',
			],
			[
				'name'  => __( 'Light Gray', 'gotham' ),
				'slug'  => 'gray-light',
				'color' => '#CCC',
			],
			[
				'name'  => __( 'Yellow', 'gotham' ),
				'slug'  => 'yellow',
				'color' => '#FFFF66CC',
			],
		]
	);

	add_theme_support( 'disable-custom-colors' );
}
add_action( 'after_setup_theme', 'gotham_setup_editor_features' );
