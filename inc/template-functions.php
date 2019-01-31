<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Gothamish
 */

/**
 * Gothamish Theme Hooks.
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
	if ( ! is_active_sidebar( 'sidebar-single' ) ) {
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

/**
 * Filters the default archive titles.
 *
 * @return string The archive title.
 */
function gotham_get_the_archive_title() {
	if ( is_category() ) {
		/* translators: Category archive title. 1: Category name */
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		/* translators: Tag archive title. 1: Tag name */
		$title = sprintf( __( 'Articles tagged "%s"' ), single_tag_title( '', false ) );
	} elseif ( is_author() ) {
		/* translators: Author archive title. 1: Author name */
		$title = sprintf( __( 'Author: %s' ), get_the_author() );
	} elseif ( is_year() ) {
		/* translators: Yearly archive title. 1: Year */
		$title = sprintf( __( 'Year: %s' ), get_the_date( _x( 'Y', 'yearly archives date format' ) ) );
	} elseif ( is_month() ) {
		/* translators: Monthly archive title. 1: Month name and year */
		$title = sprintf( __( 'Month: %s' ), get_the_date( _x( 'F Y', 'monthly archives date format' ) ) );
	} elseif ( is_day() ) {
		/* translators: Daily archive title. 1: Date */
		$title = sprintf( __( 'Day: %s' ), get_the_date( _x( 'F j, Y', 'daily archives date format' ) ) );
	} elseif ( is_post_type_archive() ) {
		/* translators: Post type archive title. 1: Post type name */
		$title = sprintf( __( 'Archives: %s' ), post_type_archive_title( '', false ) );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: Taxonomy term archive title. 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = sprintf( __( '%1$s: %2$s' ), $tax->labels->singular_name, single_term_title( '', false ) );
	} else {
		$title = __( 'Archives' );
	}

	return esc_html( $title );
}
add_filter( 'get_the_archive_title', 'gotham_get_the_archive_title' );

/**
 * Update user social media meta fields.
 *
 * @param  array $fields WordPress user meta fields.
 * @return array The updated meta fields.
 */
function gotham_user_social_fields( $fields ) {

	// RIP AIM <3.
	unset( $fields['aim'] );
	unset( $fields['jabber'] );
	unset( $fields['yim'] );

	// Add current networks.
	$fields['instagram'] = __( 'Instagram', 'gotham' );
	$fields['twitter']   = __( 'Twitter', 'gotham' );

	// Return updated fields.
	return $fields;
}
add_filter( 'user_contactmethods', 'gotham_user_social_fields' );

/**
 * Gothamish Helper Functions
 */

/**
 * Distills a url or @name down to a string handle for social network links.
 *
 * @param  string $social_link The user supplied social link.
 * @return string              The filtered social link.
 */
function gotham_social_handle( $social_link ) {
	// If the string is empty, don't bother.
	if ( ! isset( $social_link ) ) {
		return;
	}

	// Strip tags.
	$social_link = wp_strip_all_tags( $social_link );

	// Trim whitespace.
	$social_link = trim( $social_link );

	// Remove Trailing Slash.
	$social_link = trim( $social_link, '/' );

	// Break possible url up into '/' sections.
	$social_link = explode( '/', $social_link );

	// Use the last section of the URL.
	$social_link = $social_link[ count( $social_link ) - 1 ];

	// Trim the '@' character.
	$social_link = ltrim( $social_link, '@' );

	return $social_link;
}
