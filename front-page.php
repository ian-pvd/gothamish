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

		<div id="network-feed" class="content-area content-area--recirc">
			<?php dynamic_sidebar( 'front-recirc' ); ?>
		</div>

	<?php endif; ?>

<?php
get_footer();
