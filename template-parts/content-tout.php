<?php
/**
 * Template part for displaying post touts (featured image and title)
 *
 * @package Gothamish
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
	</header><!-- .entry-header -->

	<?php the_post_thumbnail(); ?>

</article><!-- #post-<?php the_ID(); ?> -->
