<?php
/**
 * Gothamish featured categories function.
 *
 * @package Gothamish
 */

/**
 * Featured categories post feed function.
 *
 * Displays top posts from the theme's featured categories.
 *
 * @param int   $num_posts Number of posts to return.
 * @param array $args Options array.
 * @return mixed Featured category posts.
 */
function gotham_featured_categories_feed( $num_posts, $args = [] ) {
	// Set cache key to default or specific category.
	$cache_key = ( ! empty( $args['category_name'] ) ) ? 'featured_category_feed_' . $args['category_name'] : 'featured_category_feed';

	// Check number of posts.
	$num_posts = is_int( $num_posts ) ? $num_posts : '4';

	// Check for cached featured posts.
	if ( ! $featured_category_feed = get_transient( $cache_key ) ) {

		// Set up the Featured Category feeder array.
		$recent_post_ids = [];

		// Excluded posts are set in the featured posts function.
		global $exclude_displayed_post_ids;
		// If there is a cache of featued posts, this variable won't have be set.
		if ( empty( $exclude_displayed_post_ids ) ) {
			// If empty, try checking for the cached featued posts.
			if ( $featured_post_cache_ids = get_transient( 'featured_posts' ) ) {
				// Shift the cached feated posts to an array.
				$featured_post_cache_ids = $featured_post_cache_ids->posts;
				// Reset the excluded posts as an empty array.
				$exclude_displayed_post_ids = [];
				// Loop through the array.
				foreach ( $featured_post_cache_ids as $displayed_post ) {
					// Add each featured post ID from the cache to the excluded posts list.
					$exclude_displayed_post_ids[] = $displayed_post->ID;
				}
			} else {
				// Assume no excluded posts are set.
				$exclude_displayed_post_ids = [];
			}
		}

		// If no category set, default filter to none.
		$args['category_name'] = ( ! empty( $args['category_name'] ) ) ? $args['category_name'] : '';

		// New query to get featured category posts.
		$featured_category_feed = new WP_Query(
			[
				'no_found_rows'  => true,
				'post__not_in'   => $exclude_displayed_post_ids,
				'posts_per_page' => $num_posts,
				'category_name'  => $args['category_name'],
			]
		);

		// Now, stash the featured category posts for 3hrs.
		set_transient( $cache_key, $featured_category_feed, 3 * HOUR_IN_SECONDS );
	}

	if ( $featured_category_feed->have_posts() ) {
		// Loop through featured category posts with the tout template.
		while ( $featured_category_feed->have_posts() ) {
			$featured_category_feed->the_post();
			get_template_part( 'template-parts/content', 'tout' );
		}
	}
}
