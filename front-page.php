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
		<?php
			// TODO: Move to theme options.
			$primary_categories = [
				'news',
				'arts',
				'food',
			];
			?>
		<?php
		foreach ( $primary_categories as $category ) :
			$category_title = get_category_by_slug( $category );
			$category_title = $category_title->name;
			?>
			<div class="post-feed__column">
				<h2 class="post-feed__category-title"><?php echo esc_html( $category_title ); ?></h2>
				<?php gotham_post_feed( 4, [ 'category_name' => $category ] ); ?>
			</div>
		<?php endforeach; ?>
	</div>

	<div id="network-feed" class="content-area content-area--network-feed">
		NETWORK FEED
	</div>

<?php
get_footer();
