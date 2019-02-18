<?php
/**
 * Front Page: Featured Categories
 *
 * Template part for displaying the primary category post feeds.
 *
 * @package Gothamish
 */

// Get primary categories from theme options.
$primary_categories = gotham_get_option( 'primary-categories' );
?>

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
		<?php gotham_featured_categories_feed( 4, [ 'category_name' => $category->slug ] ); ?>
	</div>

<?php endforeach; ?>
