<?php
/**
 * Register widget areas.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 *
 * @package Gothamish
 */

/**
 * Registers sidebar and widget areas for the Gothamish theme.
 */
function gotham_widgets_init() {
	/**
	 * Single Post Sidebar
	 */
	register_sidebar(
		[
			'name'          => esc_html__( 'Single Post Sidebar', 'gothamish' ),
			'id'            => 'sidebar-single',
			'description'   => esc_html__( 'Add widgets for the article sidebar here.', 'gothamish' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget__title">',
			'after_title'   => '</h2>',
		]
	);
	/**
	 * Page Content Sidebar
	 */
	register_sidebar(
		[
			'name'          => esc_html__( 'Page Content Sidebar', 'gothamish' ),
			'id'            => 'sidebar-page',
			'description'   => esc_html__( 'Add widgets for the page sidebar here.', 'gothamish' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget__title">',
			'after_title'   => '</h2>',
		]
	);
	/**
	 * Front Hero Sidebar
	 */
	register_sidebar(
		[
			'name'          => esc_html__( 'Front Page Hero Sidebar', 'gothamish' ),
			'id'            => 'front-hero',
			'description'   => esc_html__( 'Add widgets for the front page sidebar here.', 'gothamish' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget__title">',
			'after_title'   => '</h2>',
		]
	);
	/**
	 * Front Recirculation Sidebar
	 */
	register_sidebar(
		[
			'name'          => esc_html__( 'Front Page Recirculation Sidebar', 'gothamish' ),
			'id'            => 'front-recirc',
			'description'   => esc_html__( 'Add an RSS widget here to display network content on the front page.', 'gothamish' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget__title">',
			'after_title'   => '</h2>',
		]
	);
}

add_action( 'widgets_init', 'gotham_widgets_init' );
