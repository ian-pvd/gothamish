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
	register_sidebar(
		[
			'name'          => esc_html__( 'Single Post Sidebar', 'gotham' ),
			'id'            => 'sidebar-single',
			'description'   => esc_html__( 'Add widgets here.', 'gotham' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		]
	);
}

add_action( 'widgets_init', 'gotham_widgets_init' );
