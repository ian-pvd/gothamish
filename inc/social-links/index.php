<?php
/**
 * Gothamish Social Links
 *
 * @package Gothamish
 */

/* Register Social Links Menu Location. */
register_nav_menus(
	[
		'social-links' => esc_html__( 'Social Links', 'gothamish' ),
	]
);

/**
 * Default social links menu settings via WP nav menu
 *
 * @param  bool $echo Whether to echo the menu or return it. Default true.
 */
function gotham_social_links( $echo = true ) {
	return wp_nav_menu(
		[
			'container'      => false,
			'menu_class'     => 'social-links social-links--blocks',
			'menu_id'        => 'social-links',
			'theme_location' => 'social-links',
			'link_before'    => '<span class="social-links__icon">',
			'link_after'     => '</span>',
			'echo'           => $echo,
		]
	);
}
