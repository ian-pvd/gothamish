<?php
/**
 * The template for displaying tag archive pages
 *
 * @package Gothamish
 */

// Retreive object for currently querried tag.
$tag_archive = get_queried_object();

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<header class="page__header page__header--archive">
				<?php gotham_tag_banner( $tag_archive->slug ); ?>

				<h1 class="page__title">
				<?php
					printf(
						'%1$s "%2$s"',
						esc_html__( 'Articles tagged', 'gotham' ),
						single_tag_title( '', false )
					);
					?>
				</h1>

				<?php the_archive_description( '<div class="page__description">', '</div>' ); ?>
			</header><!-- .page__header -->

			<div class="post-list post-list--stamp">
			<?php
			if ( have_posts() ) :

				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					get_template_part( 'template-parts/content', 'stamp' );

				endwhile;

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;
			?>

			</div><!-- .post-list -->

			<?php the_posts_pagination(); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();