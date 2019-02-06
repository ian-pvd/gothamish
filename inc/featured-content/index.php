<?php
/**
 * Gothamish Featured Content functions.
 *
 * @package Gothamish
 */

/**
 * Featured posts function.
 *
 * @return mixed Featured posts.
 */
function gotham_featured_posts() {
	// Set cache key.
	$cache_key = 'featured-posts';

	// Check for cached featured posts.
	if ( ! $featured_posts = get_transient( $cache_key ) ) {

		// First, check for Jetpack featured posts.
		if ( get_theme_support( 'featured-content' ) ) {
			// Get Featured Content from Jetpack.
			$jetpack_featured = apply_filters( 'gotham_get_featured_posts', [] );
		} else {
			$jetpack_featured = [];
		}

		// Determine what to do with the results.
		if ( count( $jetpack_featured ) < 3 ) {

			// Collect IDs to exclude duplicates.
			$duplicate_ids = [];

			// If no jetpack featured, or less than 3 found, check for more.
			if ( ! empty( $jetpack_featured ) ) {
				foreach ( $jetpack_featured as $key => $post_object ) {
					$duplicate_ids[] = $post_object->ID;
				}
			}

			// Featured posts args.
			$recent_posts = new WP_Query(
				[
					'no_found_rows'  => true,
					'post__not_in'   => $duplicate_ids,
					'posts_per_page' => 3,
				]
			);

			// Shift featured posts query to array.
			$recent_posts = $recent_posts->posts;

		} else {
			$recent_posts = [];
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

		// Featured posts args.
		$featured_posts = new WP_Query(
			[
				'no_found_rows'  => true,
				'post__in'       => $featured_ids,
				'posts_per_page' => 3,
				'orderby'        => 'post__in',
			]
		);

		// TODO: Stash the featured posts.
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
	delete_transient( 'featured-posts' );
}
add_action( 'save_post', 'gotham_delete_featured_posts_cache' );
