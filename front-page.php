<?php
/**
 * The front page template file
 *
 * Template Name: Front Page
 *
 * @package Gothamish
 */

get_header();
?>

	<div id="primary" class="content-area content-area--front-page">
		<main id="main" class="site-main">

			<?php get_template_part( 'template-parts/front', 'hero' ); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php
		// Front Page Hero Banner Ad Slot.
		gotham_display_ad(
			'front-hero',
			[
				'mobile'  => '320x50',
				'tablet'  => '468x60',
				'desktop' => '970x90',
			]
		);
		?>

	<div id="primary-feed" class="content-area content-area--post-feed">
		<?php get_template_part( 'template-parts/front', 'category-feeds' ); ?>
	</div>

	<?php if ( is_active_sidebar( 'front-recirc' ) ) : ?>

		<div id="network-feed" class="content-area content-area--front-recirc">
			<?php dynamic_sidebar( 'front-recirc' ); ?>
			<section class="front-recirc__donation-appeal">
				<?php
					printf(
						wp_kses(
							/* translators: 1: blog name, 2: site locale */
							__(
								'<p class="donation-appeal__text">%1$s is reader supported local news. Help us keep telling %2$s stories.</p>',
								'gotham'
							),
							[
								'span' => [
									'class' => [],
								],
								'p' => [
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
						'<a href="' . esc_url( '/donate' ) . '" class="link-button">%s</a>',
						esc_html__( 'Support Us!', 'gotham' )
					);
				?>
			</section>
		</div>

	<?php endif; ?>

<?php
get_footer();
