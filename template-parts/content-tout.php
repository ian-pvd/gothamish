<?php
/**
 * Template part for displaying post touts (featured image and title)
 *
 * @package Gothamish
 */

// Default image size for touts.
$image_size = 'gotham_tout';
// Check if front page tout.
if ( is_front_page() ) {
	// If so, check for global is hero value.
	global $gotham_is_hero_post;
	if ( $gotham_is_hero_post ) {
		// Use special thumbnail size for hero tout.
		$image_size = [ 1312, 1312 ];
	}
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post--tout' ); ?>>
	<a class="post__link-wrapper" href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
		<header class="post__header">
			<?php the_title( sprintf( '<h3 class="post__title">', '</h3>' ) ); ?>
		</header><!-- .post__header -->

		<div class="post__thumbnail-frame">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( $image_size ); ?>
		<?php endif; ?>
		</div>
	</a>
</article><!-- #post-<?php the_ID(); ?> -->
