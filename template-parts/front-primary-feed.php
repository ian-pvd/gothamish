<?php
/**
 * Front Page: Primary Feed
 *
 * Template part for displaying the primary feed pages.
 *
 * @package Gothamish
 */

// Current Primary Feed page.
$primary_feed_page = 1;

// Max number of feed pages to display.
$max_feed_pages = 20; // DEV get_option( 'posts_per_page' );

// Get primary categories from theme options.
$primary_categories = gotham_get_option( 'primary-categories' );

// Get list post IDs to excluded that have already been displayed.
$exclude_displayed_post_ids = gotham_get_exclude_displayed_post_ids();

// DEV
$more_posts = [];
foreach ( $primary_categories as $key ) {
	$more_posts[ $key ] = true;
}

while ( $primary_feed_page <= $max_feed_pages && ! empty( $more_posts ) ) :
	?>

	<div class="primary-feed__page primary-feed__page--<?php echo esc_attr( str_pad( $primary_feed_page, 3, '0', STR_PAD_LEFT ) ); ?>">
		<div class="content-area content-area--primary-feed content-area--post-feed">
			<?php
			foreach ( $primary_categories as $category ) :
				$category = get_category_by_slug( $category );

				if ( isset( $more_posts[ $category->slug ] ) ) {
					$primary_feed[ $category->slug ] = new WP_Query(
						[
							'post__not_in'  => $exclude_displayed_post_ids,
							'category_name' => $category->slug,
							'paged'         => $primary_feed_page,
						]
					);
				}
				?>

				<div class="post-feed__column">
					<h2 class="post-feed__category-title">
						<a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>" title="<?php echo esc_attr( $category->name ); ?>">
							<?php echo esc_html( $category->name ); ?>
						</a>
					</h2>
					<?php
					if ( isset( $primary_feed[ $category->slug ] ) && $primary_feed[ $category->slug ]->have_posts() ) {
						while ( $primary_feed[ $category->slug ]->have_posts() ) {
							$primary_feed[ $category->slug ]->the_post();
							get_template_part( 'template-parts/content', 'tout' );
						}

						// If this page is the max # pages...
						if ( (int) $primary_feed[ $category->slug ]->max_num_pages === $primary_feed_page ) {
							// Destroy "more posts?" value.
							unset( $more_posts[ $category->slug ] );
						}

						// Clean up this page of primary feed posts.
						unset( $primary_feed[ $category->slug ] );
					} else {
						// And that's why you always leave a note.
						echo '<!-- No more posts for this category. -->';
					}
					?>
				</div>

			<?php endforeach; ?>
		</div>

		<?php
		// If there are still posts.
		if ( ! empty( $more_posts ) ) {
			// Display a Featured Content Block.
			gotham_front_featured_block( $primary_feed_page );
		}
		?>

	</div>

	<?php $primary_feed_page++; ?>

<?php endwhile; ?>
