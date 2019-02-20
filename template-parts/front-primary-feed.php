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

// Get number of posts to display per primary feed page.
$primary_feed_posts = gotham_get_option( 'primary-feed-posts' );

// Get max number of feed pages to display.
$max_feed_pages = gotham_get_option( 'max-feed-pages' );

// Get primary categories from theme options.
$primary_categories = gotham_get_option( 'primary-categories' );

// Get list post IDs to excluded that have already been displayed.
$exclude_displayed_post_ids = gotham_get_exclude_displayed_post_ids();

// Set up a more_posts? variable to prevent showing empty pages.
$more_posts = true;

// While we're not a the the max # of pages, and there are still posts to display...
while ( $primary_feed_page <= $max_feed_pages && $more_posts ) :
	?>

	<div class="primary-feed__page primary-feed__page--<?php echo esc_attr( str_pad( $primary_feed_page, 2, '0', STR_PAD_LEFT ) ); ?>">
		<div class="content-area content-area--primary-feed content-area--post-feed">
			<?php
			foreach ( $primary_categories as $category ) :
				$category = get_category_by_slug( $category );

				$primary_feed_category = new WP_Query(
					[
						'category_name'  => $category->slug,
						'paged'          => $primary_feed_page,
						'post__not_in'   => $exclude_displayed_post_ids,
						'posts_per_page' => 6,
					]
				);
				?>

				<div class="post-feed__column">
					<h2 class="post-feed__category-title">
						<a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>" title="<?php echo esc_attr( $category->name ); ?>">
							<?php echo esc_html( $category->name ); ?>
						</a>
					</h2>
					<?php
					if ( isset( $primary_feed_category ) && $primary_feed_category->have_posts() ) {
						while ( $primary_feed_category->have_posts() ) {
							$primary_feed_category->the_post();
							get_template_part( 'template-parts/content', 'tout' );
						}

						// If this page is the max # pages...
						if ( (int) $primary_feed_category->max_num_pages === $primary_feed_page ) {
							// Destroy "more posts?" value.
							$more_posts = false;
						}

						// Clean up this page of primary feed posts.
						unset( $primary_feed_category );
					}
					?>
				</div>

			<?php endforeach; ?>
		</div>

		<?php
		// If there will be another page of feed posts...
		if ( ( $primary_feed_page + 1 ) <= $max_feed_pages && $more_posts ) {
			// Display a Featured Content Block.
			gotham_front_featured_block( $primary_feed_page );
		}
		?>

	</div>

	<?php $primary_feed_page++; ?>

<?php endwhile; ?>

<a href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ); ?>" class="primary-feed__blog-link link-button" title="<?php echo esc_attr( sprintf( /* translators: %s blog name */ __( 'Read more posts from the %s blog archive.', 'gothamish' ), get_option( 'blogname', 'gothamish' ) ) ); ?>">
	<?php esc_html_e( 'Read More', 'gothamish' ); ?>
</a>
