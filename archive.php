<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Gothamish
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<header class="page__header page__header--archive">
				<h1 class="page__title page__title--category">
					<?php single_cat_title( '', true ); ?>
				</h1>

				<?php the_archive_description( '<div class="page__description">', '</div>' ); ?>
			</header><!-- .page-header -->

			<div class="post-list">

			<?php
			if ( have_posts() ) :

				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					get_template_part( 'template-parts/content' );

				endwhile;

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;
			?>

			</div><!-- .post-area -->

			<?php the_posts_pagination(); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
