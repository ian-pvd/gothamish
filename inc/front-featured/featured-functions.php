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
	delete_transient( 'display_front_feed_featured_categories' );

	// Reset the front featured display value.
	delete_transient( 'display_front_feed_primary_feed' );
}
add_action( 'save_post', 'gotham_delete_front_featured_cache' );

/**
 * Determines if a front page feed section should be displayed.
 *
 * @param  string $section The seciton to check there are enough posts for.
 * @return bool       True to display else false.
 */
function gotham_has_front_feed_posts( $section ) {
	// Set cache key.
	$cache_key = 'display_front_feed_' . $section;

	// Check for cached value.
	if ( ! $display_front_feed = get_transient( $cache_key ) ) {
		// Default minimum posts required to display is 1.
		$min_posts = 1;
		// For the Feature Categories section, it's 4.
		if ( 'featured_categories' === $section ) {
			$min_posts = 4;
		}
		// Set default return.
		$display_front_feed = true;
		// Get primary tags.
		$primary_categories = gotham_get_option( 'primary-categories' );
		// for each tag...
		foreach ( $primary_categories as $key ) {
			// Get tag object.
			$display_category = get_category_by_slug( $key );
			// Check tag count.
			if ( $min_posts >= $display_category->count ) {
				// If minimum not met, set display false.
				$display_front_feed = false;
			}
		}
		// Cache value.
		set_transient( $cache_key, $display_front_feed, 24 * HOUR_IN_SECONDS );
	}

	return $display_front_feed;
}
