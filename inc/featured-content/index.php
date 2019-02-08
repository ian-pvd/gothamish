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

		// Set up the Featured Posts feeder arrays.
		$jetpack_post_ids = [];
		$recent_post_ids  = [];

		// First, check for Jetpack featured posts.
		if ( get_theme_support( 'featured-content' ) ) {
			// Get Featured Content from Jetpack.
			$jetpack_posts = apply_filters( 'gotham_get_featured_posts', [] );

			// Loop through the featurd posts to collect featured post IDs.
			if ( ! empty( $jetpack_posts ) ) {
				foreach ( $jetpack_posts as $key => $jetpack_post ) {
					// Only include featured posts with thumbnails.
					if ( has_post_thumbnail( $jetpack_post->ID ) ) {
						$jetpack_post_ids[] = $jetpack_post->ID;
					}
				}
			}

			// Clean up this featured post array.
			unset( $jetpack_posts );
		}

		// If there are less than three featured post IDs...
		if ( count( $jetpack_post_ids ) < 3 ) {

			// Query to backfill up to 3 recent posts...
			// That have thumbnails and excluding featured post IDs.
			$recent_post_ids = new WP_Query(
				[
					'no_found_rows'  => true,
					'post__not_in'   => $jetpack_post_ids,
					'posts_per_page' => ( 3 - count( $jetpack_post_ids ) ),
					'fields'         => 'ids',
					'meta_query' => [
						[
							'key' => '_thumbnail_id',
						],
					],
				]
			);

			// Shift featured posts query to an array of IDs.
			$recent_post_ids = $recent_post_ids->posts;
		}

		// Merge the results down to one array of three post IDs.
		$featured_post_ids = array_slice( array_merge( $jetpack_post_ids, $recent_post_ids ), 0, 3 );

		// New query to get final list of featured posts as WP post objects.
		$featured_posts = new WP_Query(
			[
				'ignore_sticky_posts' => true,
				'no_found_rows'       => true,
				'orderby'             => 'post__in',
				'post__in'            => $featured_post_ids,
				'posts_per_page'      => 3,
			]
		);

		// Now, stash the featured posts for 3hrs.
		set_transient( $cache_key, $featured_posts, 3 * HOUR_IN_SECONDS );
	}

	if ( $featured_posts->have_posts() ) {
		// Loop through featured posts with the tout template.
		while ( $featured_posts->have_posts() ) {
			$featured_posts->the_post();
			get_template_part( 'template-parts/content', 'tout' );
		}
	}
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
