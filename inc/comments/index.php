<?php
/**
 * PVD Disable Comments Functions
 *
 * Customize or disable theme comments options
 *
 * @package Gothamish
 */

if ( ! function_exists( 'gotham_disable_comments' ) ) :
	/**
	 * Disables comments for all post types
	 */
	function gotham_disable_comments() {
		foreach ( get_post_types() as $post_type ) {
			if ( post_type_supports( $post_type, 'comments' ) ) {
				remove_post_type_support( $post_type, 'comments' );
				remove_post_type_support( $post_type, 'trackbacks' );
			}
		}
	}
endif;
add_action( 'admin_init', 'gotham_disable_comments' );

/**
 * Close comments on the front-end
 */
add_filter( 'comments_open', '__return_false', 20, 2 );
add_filter( 'pings_open', '__return_false', 20, 2 );

/**
 * Hide existing comments
 */
add_filter( 'comments_array', '__return_empty_array', 10, 2 );
