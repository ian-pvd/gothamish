<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Gothamish
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post--list' ); ?>>
	<?php
		gotham_tag_banner();
	?>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				gotham_posted_by();
				gotham_posted_in();
				gotham_posted_on();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php gotham_post_thumbnail(); ?>

	<div class="entry-excerpt wp-content">
		<?php the_excerpt(); ?>
	</div><!-- .entry-excerpt -->

</article><!-- #post-<?php the_ID(); ?> -->
