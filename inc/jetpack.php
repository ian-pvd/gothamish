<?php
/**
 * Jetpack Compatibility File
 *
 * @link https://jetpack.com/
 *
 * @package Gothamish
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 * See: https://jetpack.com/support/content-options/
 */
function gotham_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support(
		'infinite-scroll',
		[
			'container' => 'main',
			'render'    => 'gotham_infinite_scroll_render',
			'footer'    => 'page',
		]
	);

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );

	// Add theme support for Content Options.
	add_theme_support(
		'jetpack-content-options',
		[
			'post-details'    =>
				[
					'stylesheet' => 'gotham-post-css',
					'date'       => '.entry-date',
					'categories' => '.entry-category',
					'tags'       => '.entry-footer__tags',
					'author'     => '.byline',
				],
			'featured-images' =>
				[
					'archive' => true,
					'post'    => true,
					'page'    => true,
				],
		]
	);
}
add_action( 'after_setup_theme', 'gotham_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function gotham_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) :
			get_template_part( 'template-parts/content', 'search' );
		else :
			get_template_part( 'template-parts/content' );
		endif;
	}
}

/**
 * Customize Jetpack Sharedaddy links.
 */
function gotham_jetpack_sharing() {

	remove_filter( 'the_content', 'sharing_display', 19 );
	remove_filter( 'the_excerpt', 'sharing_display', 19 );

	if ( class_exists( 'Jetpack_Likes' ) ) {
		remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
	}
}
add_action( 'loop_start', 'gotham_jetpack_sharing' );

