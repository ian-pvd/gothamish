<?php
/**
 * Gothamish Front Featued theme helper functions.
 *
 * @package Gothamish
 */

/**
 * Deletes the cached Front Featured post values.
 *
 * @param  int $post_id The ID of the post that was updated.
 */
function gotham_delete_front_featured_cache( $post_id ) {
	// Whenever posts are saved...
	// Reset the featued posts cache.
	delete_transient( 'featured_posts' );

	// Reset the default featured category cache.
	delete_transient( 'featured_category_feed' );

	// Get primary categories from theme options.
	$primary_categories = gotham_get_option( 'primary-categories' );
	if ( is_array( $primary_categories ) ) {
		// Loop through each featured category and reset.
		foreach ( $primary_categories as $category_slug ) {
			delete_transient( 'featured_category_feed_' . $category_slug );
		}
	}

	// Reset the front featured display value.
	delete_transient( 'display_front_feed' );
}
add_action( 'save_post', 'gotham_delete_front_featured_cache' );

/**
 * Determines if a front page feed section should be displayed.
 *
 * @return bool       True to display else false.
 */
function gotham_has_front_feed_posts() {
	// Check for cached value.
	if ( ! $display_front_feed = get_transient( 'display_front_feed' ) ) {
		// Set default return.
		$display_feed = true;
		// Get primary tags.
		$primary_categories = gotham_get_option( 'primary-categories' );
		// for each tag...
		foreach ( $primary_categories as $key ) {
			// Get tag object.
			$display_category = get_category_by_slug( $key );
			// Check tag count.
			if ( 1 > $display_category->count ) {
				// if any < 1, set display false.
				$display_front_feed = false;
			}
		}
		// Cache value.
		set_transient( 'display_front_feed', $display_front_feed, 24 * HOUR_IN_SECONDS );
	}

	return $display_front_feed;
}
