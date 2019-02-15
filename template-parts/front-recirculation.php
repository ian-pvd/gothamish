<?php
/**
 * Front Page: Category feeds.
 *
 * Template part for displaying the primary category post feeds.
 *
 * @package Gothamish
 */

?>

<?php dynamic_sidebar( 'front-recirc' ); ?>

<section class="front-recirc__donation-appeal">
<?php
	printf(
		wp_kses(
			/* translators: 1: blog name, 2: site locale */
			__(
				'<p class="donation-appeal__text">%1$s is reader supported local news. Help us keep telling %2$s stories.</p>',
				'gothamish'
			),
			[
				'span' => [
					'class' => [],
				],
				'p'    => [
					'class' => [],
				],
			]
		),
		wp_kses(
			gotham_logotype(),
			[
				'span' => [
					'class' => [],
				],
			]
		),
		esc_html( gotham_get_option( 'site-location', 'New York' ) )
	);

	printf(
		'<a href="' . esc_url( '/donate' ) . '" class="donation-appeal__link-button link-button">%s</a>',
		esc_html__( 'Support Us!', 'gothamish' )
	);
	?>
</section>

