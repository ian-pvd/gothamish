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
	// Featured posts args.
	$featured_posts = new WP_Query(
		[
			'posts_per_page' => 3,
			'no_found_rows'  => true,
		]
	);

	if ( ! $featured_posts->have_posts() ) {
		return;
	}

	// Widget contents, loop of "best of" posts.
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
