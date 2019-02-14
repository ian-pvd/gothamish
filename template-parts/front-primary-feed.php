<?php
/**
 * Front Page: Primary Feed
 *
 * Template part for displaying the primary feed pages.
 *
 * @package Gothamish
 */

?>

<div class="primary-feed__page">
	<div class="content-area content-area--primary-feed content-area--post-feed">
	<?php
	// Get primary categories from theme options.
	$primary_categories = gotham_get_option( 'primary-categories' );
	// Excluded posts are set in the featured posts function.
	global $exclude_displayed_post_ids;
	// If there is a cache of featued posts, this variable won't have be set.
	if ( empty( $exclude_displayed_post_ids ) ) {
		// If empty, try checking for the cached featued posts.
		if ( $featured_post_cache_ids = get_transient( 'featured_posts' ) ) {
			// Shift the cached feated posts to an array.
			$featured_post_cache_ids = $featured_post_cache_ids->posts;
			// Reset the excluded posts as an empty array.
			$exclude_displayed_post_ids = [];
			// Loop through the array.
			foreach ( $featured_post_cache_ids as $displayed_post ) {
				// Add each featured post ID from the cache to the excluded posts list.
				$exclude_displayed_post_ids[] = $displayed_post->ID;
			}
		} else {
			// Assume no excluded posts are set.
			$exclude_displayed_post_ids = [];
		}
	}

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
