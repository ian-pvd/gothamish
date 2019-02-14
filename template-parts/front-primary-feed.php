<?php
/**
 * Front Page: Primary Feed
 *
 * Template part for displaying the primary feed pages.
 *
 * @package Gothamish
 */

// Get primary categories from theme options.
$primary_categories = gotham_get_option( 'primary-categories' );

// Get list post IDs to excluded that have already been displayed.
$exclude_displayed_post_ids = gotham_get_exclude_displayed_post_ids();
?>

<div class="primary-feed__page">
	<div class="content-area content-area--primary-feed content-area--post-feed">
	<?php

	foreach ( $primary_categories as $category ) :
		$category = get_category_by_slug( $category );
		?>

		<div class="post-feed__column">
			<h2 class="post-feed__category-title">
				<a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>" title="<?php echo esc_attr( $category->name ); ?>">
					<?php echo esc_html( $category->name ); ?>
				</a>
			</h2>
			<?php
			$primary_feed[ $category->slug ] = new WP_Query(
				[
					'post__not_in'  => $exclude_displayed_post_ids,
					'category_name' => $category->slug,
				]
			);

			// TODO: If statement should wrap the parent div, not post display.
			// OR: this region should be able to display a posts not found message.
			if ( $primary_feed[ $category->slug ]->have_posts() ) {
				while ( $primary_feed[ $category->slug ]->have_posts() ) {
					$primary_feed[ $category->slug ]->the_post();
					get_template_part( 'template-parts/content', 'tout' );
				}
			}
			?>
		</div>
	<?php endforeach; ?>
	</div>

	<div class="featured-block featured-block--gothamist-featured">
		<h2 class="featured-block__title">Featured on <?php echo gotham_logotype(); ?></h2>
		<div class="featured-block__wrapper">
		<?php
			$featured_block['gothamist-featured'] = new WP_Query(
				[
					'posts_per_page'      => 3,
					'ignore_sticky_posts' => true,
				]
			);

			// TODO: If statement should wrap the parent div, not post display.
			// OR: this region should be able to display a posts not found message.
			if ( $featured_block['gothamist-featured']->have_posts() ) {
				while ( $featured_block['gothamist-featured']->have_posts() ) {
					$featured_block['gothamist-featured']->the_post();
					get_template_part( 'template-parts/content', 'tout' );
				}
			}
			?>
		</div>
	</div>

</div>
