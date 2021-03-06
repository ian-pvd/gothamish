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
				'name'  => __( 'Red', 'gothamish' ),
				'slug'  => 'red',
				'color' => '#900',
			],
			[
				'name'  => __( 'Dark Gray', 'gothamish' ),
				'slug'  => 'gray-dark',
				'color' => '#333',
			],
			[
				'name'  => __( 'Light Gray', 'gothamish' ),
				'slug'  => 'gray-light',
				'color' => '#CCC',
			],
			[
				'name'  => __( 'Yellow', 'gothamish' ),
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
		$title = sprintf( __( 'Articles tagged "%s"', 'gothamish' ), single_tag_title( '', false ) );
	} elseif ( is_author() ) {
		/* translators: Author archive title. 1: Author name */
		$title = sprintf( __( 'Author: %s', 'gothamish' ), get_the_author() );
	} elseif ( is_year() ) {
		/* translators: Yearly archive title. 1: Year */
		$title = sprintf( __( 'Year: %s', 'gothamish' ), get_the_date( _x( 'Y', 'yearly archives date format', 'gothamish' ) ) );
	} elseif ( is_month() ) {
		/* translators: Monthly archive title. 1: Month name and year */
		$title = sprintf( __( 'Month: %s', 'gothamish' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'gothamish' ) ) );
	} elseif ( is_day() ) {
		/* translators: Daily archive title. 1: Date */
		$title = sprintf( __( 'Day: %s', 'gothamish' ), get_the_date( _x( 'F j, Y', 'daily archives date format', 'gothamish' ) ) );
	} elseif ( is_post_type_archive() ) {
		/* translators: Post type archive title. 1: Post type name */
		$title = sprintf( __( 'Archives: %s', 'gothamish' ), post_type_archive_title( '', false ) );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: Taxonomy term archive title. 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = sprintf( __( '%1$s: %2$s', 'gothamish' ), $tax->labels->singular_name, single_term_title( '', false ) );
	} else {
		$title = __( 'Archives', 'gothamish' );
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
	$fields['gotham_instagram'] = __( 'Instagram', 'gothamish' );
	$fields['gotham_twitter']   = __( 'Twitter', 'gothamish' );

	// Return updated fields.
	return $fields;
}
add_filter( 'user_contactmethods', 'gotham_user_social_fields' );
