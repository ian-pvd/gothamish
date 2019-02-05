<?php
/**
 * Template part for displaying post touts (featured image and title)
 *
 * @package Gothamish
 */

// Default image size for touts.
$image_size = 'tout';
// Reset default to use theme featured thumbnail size.
if ( is_front_page() ) {
	$image_size = null;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post--tout' ); ?>>
	<a class="post__link-wrapper" href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
		<header class="post__header">
			<?php the_title( sprintf( '<h3 class="post__title">', '</h3>' ) ); ?>
		</header><!-- .post__header -->

		<?php the_post_thumbnail( $image_size ); ?>
	</a>
</article><!-- #post-<?php the_ID(); ?> -->
