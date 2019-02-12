<?php
/**
 * Gothamish Front Featued theme hook to reset a list of transient caches.
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
}
add_action( 'save_post', 'gotham_delete_front_featured_cache' );
