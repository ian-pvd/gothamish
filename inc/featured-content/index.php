<?php
/**
 * Gothamish Featured Content functions.
 *
 * @package Gothamish
 */

/**
 * Featured posts function.
 *
 * Looks for Jetpack featured content posts first, and if there aren't
 * enough, backfills the results, first with sticky and then recent posts.
 *
 * @return mixed Featured posts.
 */
function gotham_featured_posts() {
	// Set cache key.
	$cache_key = 'featured-posts';

	// Check for cached featured posts.
	if ( ! $featured_posts = get_transient( $cache_key ) ) {

		// Set up featued post feeder arrays.
		$jetpack_featured = [];
		$recent_posts     = [];

		// First, check for Jetpack featured posts.
		if ( get_theme_support( 'featured-content' ) ) {
			// Get Featured Content from Jetpack.
			$jetpack_featured = apply_filters( 'gotham_get_featured_posts', [] );
		}

		// If there are less than three featured posts...
		if ( count( $jetpack_featured ) < 3 ) {

			// Collect featured post IDs to exclude duplicates.
			$exclude_ids = [];
			// Loop through the featurd posts and add them to the exclude array.
			if ( ! empty( $jetpack_featured ) ) {
				foreach ( $jetpack_featured as $key => $post_object ) {
					$exclude_ids[] = $post_object->ID;
				}
			}

			// Query for recent posts, excluding featured.
			$recent_posts = new WP_Query(
				[
					'no_found_rows'  => true,
					'post__not_in'   => $exclude_ids,
					'posts_per_page' => 3,
					'meta_query' => [
						[
							'key' => '_thumbnail_id',
						],
					],
				]
			);

			// Shift featured posts query to array.
			$recent_posts = $recent_posts->posts;
		}

		// Merge the results down to three posts.
		$merged_posts = array_slice( array_merge( $jetpack_featured, $recent_posts ), 0, 3 );
		// Put those post IDs into an array.
		$featured_ids = [];
		if ( ! empty( $merged_posts ) ) {
			foreach ( $merged_posts as $key => $post_object ) {
				$featured_ids[] = $post_object->ID;
			}
		}

		// New query to get final list of featured posts.
		$featured_posts = new WP_Query(
			[
				'ignore_sticky_posts' => true,
				'no_found_rows'       => true,
				'orderby'             => 'post__in',
				'post__in'            => $featured_ids,
				'posts_per_page'      => 3,
			]
		);

		// Now, stash the featured posts for 3hrs.
		set_transient( $cache_key, $featured_posts, 3 * HOUR_IN_SECONDS );
	}

	// Loop through featured posts with the tout template.
	while ( $featured_posts->have_posts() ) :
		$featured_posts->the_post();
		get_template_part( 'template-parts/content', 'tout' );
	endwhile;
}

/**
 * Deletes the cached featured post values.
 *
 * @param  int $post_id The ID of the post that was updated.
 */
function gotham_delete_featured_posts_cache( $post_id ) {
	// Whenever posts are saved, reset the featued posts cache.
	delete_transient( 'featured-posts' );
}
add_action( 'save_post', 'gotham_delete_featured_posts_cache' );
