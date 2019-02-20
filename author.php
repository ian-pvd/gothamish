<?php
/**
 * The template for displaying author profiles
 *
 * @package Gothamish
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<header class="page__header page__header--author">
				<?php get_template_part( 'template-parts/user' ); ?>
			</header><!-- .page-header -->

			<?php if ( have_posts() ) : ?>

				<div class="post-list">

				<?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					get_template_part( 'template-parts/content' );

				endwhile;
				?>

			</div><!-- .post-area -->

			<?php endif; ?>

			<?php the_posts_pagination( [ 'mid_size' => 5 ] ); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
