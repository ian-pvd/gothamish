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

	// Set cache key.
	$cache_key = 'post_feed';
	// Check number of posts.
	$num_posts = is_int( $num_posts ) ? $num_posts : '3';

	// DEV.
	$args['category_name'] = ( ! empty( $args['category_name'] ) ) ? $args['category_name'] : '';

	// Check for cached featured posts.
	if ( WP_DEBUG OR ! $post_feed = get_transient( $cache_key ) ) {

		// Set up the Featured Posts feeder arrays.
		$jetpack_post_ids = [];
		$recent_post_ids  = [];

		// Query to backfill up to $num_posts recent posts...
		// That have thumbnails and excluding featured post IDs.
		$jetpack_post_ids = new WP_Query(
			[
				'no_found_rows'  => true,
				'posts_per_page' => ( $num_posts - count( $jetpack_post_ids ) ),
				'fields'         => 'ids',
				'category_name'  => $args['category_name'],
				'post__not_in'   => $posts_to_exclude,
				'meta_query' => [
					[
						'key' => '_thumbnail_id',
					],
				],
			]
		);

		// Shift featured posts query to an array of IDs.
		$jetpack_post_ids = $jetpack_post_ids->posts;

		// If there are less than three featured post IDs...
		if ( count( $jetpack_post_ids ) < $num_posts ) {

			// Query to backfill up to $num_posts recent posts...
			// That have thumbnails and excluding featured post IDs.
			$recent_post_ids = new WP_Query(
				[
					'no_found_rows'  => true,
					'post__not_in'   => array_merge( $posts_to_exclude, $jetpack_post_ids ),
					'posts_per_page' => ( $num_posts - count( $jetpack_post_ids ) ),
					'fields'         => 'ids',
					'category_name'  => $args['category_name'],
					// 'meta_query' => [
					// 	[
					// 		'key' => '_thumbnail_id',
					// 	],
					// ],
				]
			);

			// Shift featured posts query to an array of IDs.
			$recent_post_ids = $recent_post_ids->posts;
		}

		// Merge the results down to one array of three post IDs.
		$featured_post_ids = array_slice( array_merge( $jetpack_post_ids, $recent_post_ids ), 0, $num_posts );

		// New query to get final list of featured posts as WP post objects.
		$post_feed = new WP_Query(
			[
				'ignore_sticky_posts' => true,
				'no_found_rows'       => true,
				'orderby'             => 'post__in',
				'post__in'            => array_diff( $featured_post_ids, $posts_to_exclude ),
				'posts_per_page'      => $num_posts,
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
