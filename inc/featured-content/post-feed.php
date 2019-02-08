<?php
/**
 * Gothamish post feed functions.
 *
 * @package Gothamish
 */

/**
 * Post feeds function.
 *
 * Looks for featured posts first, backfills the results.
 *
 * @param int   $num_posts Number of posts to return.
 * @param array $args Options array.
 * @return mixed Featured posts.
 */
function gotham_post_feed( $num_posts, $args = [] ) {
	global $posts_to_exclude;
	if ( empty( $posts_to_exclude ) ) {
		$posts_to_exclude = get_transient( 'posts_to_exclude' ) ? get_transient( 'posts_to_exclude' ) : [];
	}

	// Set cache key.
	// TODO: Category name value might not always be set.
	$cache_key = 'post_feed_' . $args['category_name'];
	// Check number of posts.
	$num_posts = is_int( $num_posts ) ? $num_posts : '3';

	// DEV.
	$args['category_name'] = ( ! empty( $args['category_name'] ) ) ? $args['category_name'] : '';

	// Check for cached featured posts.
	if ( ! $post_feed = get_transient( $cache_key ) ) {

		// Set up the Featured Posts feeder arrays.
		$recent_post_ids  = [];

		// New query to get final list of featured posts as WP post objects.
		$post_feed = new WP_Query(
			[
				'ignore_sticky_posts' => true,
				'no_found_rows'       => true,
				'orderby'             => 'post__in',
				'post__not_in'        => $posts_to_exclude,
				'posts_per_page'      => $num_posts,
				'category_name'       => $args['category_name'],
			]
		);

		// Now, stash the featured posts for 3hrs.
		set_transient( $cache_key, $post_feed, 3 * HOUR_IN_SECONDS );
	}

	if ( $post_feed->have_posts() ) {
		// Loop through featured posts with the tout template.
		while ( $post_feed->have_posts() ) {
			$post_feed->the_post();
			get_template_part( 'template-parts/content', 'tout' );
		}
	}
}

/**
 * Deletes the cached featured post values.
 *
 * @param  int $post_id The ID of the post that was updated.
 */
// function gotham_delete_featured_posts_cache( $post_id ) {
	// Whenever posts are saved, reset the featued posts cache.
	// delete_transient( 'featured_posts' );
// }
// add_action( 'save_post', 'gotham_delete_featured_posts_cache' );
