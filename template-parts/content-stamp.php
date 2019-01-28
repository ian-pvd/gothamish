<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Gothamish
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post--stamp' ); ?>>

	<div class="post-thumbnail">
		<a class="post-thumbnail__link" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
		<?php
		// Post Media Icon.
		gotham_post_media_icon();

		// Stamp sized post thumbnail.
		if ( has_post_thumbnail() ) :
			the_post_thumbnail(
				'stamp',
				[
					'alt' => the_title_attribute(
						[
							'echo' => false,
						]
					),
				]
			);
		else :
			the_title();
		endif;
		?>
		</a>
	</div>

	<div class="entry-wrapper">

		<header class="entry-header">
			<?php
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

			if ( 'post' === get_post_type() ) :
				?>
				<div class="entry-meta">
					<?php
					gotham_posted_by();
					gotham_posted_on();
					?>
				</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-excerpt wp-content">
			<?php
				echo the_excerpt();
			?>
		</div><!-- .entry-content -->

	</div>

</article><!-- #post-<?php the_ID(); ?> -->
