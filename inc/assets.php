<?php
/**
 * Manage static assets
 *
 * @package roundhouse
 */

/**
 * Enqueues theme styles and scripts
 */
function pvd_enqueue_assets() {
	if ( false !== strpos( get_site_url(), '.test' ) && true === get_query_var( 'webpack-dev', false ) ) {
		wp_enqueue_script(
			'webpack-dev',
			'https://localhost:8080/dist/site.js',
			[],
			null,
			false
		);
	} else {
		/* Global Scripts & Styles */
		wp_enqueue_script( 'pvd-site-js', PVD_URL . '/assets/dist/' . pvd_get_asset_version( 'site-js' ), [], '1.0', true );
		wp_enqueue_style( 'pvd-site-css', PVD_URL . '/assets/dist/' . pvd_get_asset_version( 'site-css' ), [], '1.0' );

		/* Post Scrips & Styles */
		wp_enqueue_script( 'pvd-post-js', PVD_URL . '/assets/dist/' . pvd_get_asset_version( 'post-js' ), [], '1.0', true );
		wp_enqueue_style( 'pvd-post-css', PVD_URL . '/assets/dist/' . pvd_get_asset_version( 'post-css' ), [], '1.0' );
	}
}
add_action( 'wp_enqueue_scripts', 'pvd_enqueue_assets' );

/**
 * Removes WP scripts
 */
function pvd_dequeue_scripts() {
	wp_dequeue_style( 'jetpack-slideshow' );
	wp_dequeue_style( 'jetpack-carousel' );
}
add_action( 'wp_print_scripts', 'pvd_dequeue_scripts' );
