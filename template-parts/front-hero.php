<?php
/**
 * Front Page: Hero Section
 *
 * Template part for displaying the hero section.
 *
 * @package Gothamish
 */

/**
 * Featured posts function.
 *
 * @return mixed Featured posts.
 */
function gotham_featured_posts() {
	// TODO: Check for cached featured posts.
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

	// Loop through featured posts with the tout template.
	while ( $featured_posts->have_posts() ) :
		$featured_posts->the_post();
		get_template_part( 'template-parts/content', 'tout' );
	endwhile;
}
?>

<div class="front-page__hero-section hero-section">
	<div class="hero-section__featured-posts featured-posts">
			<?php gotham_featured_posts(); ?>
	</div>
	<?php get_sidebar(); ?>
</div>
