<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Gothamish
 */

// Set up template variables.
$title_class = 'page__title';

if ( is_category() ) {
	$title_class .= ' page__title--category';
}

if ( is_tag() ) {
	// Retreive object for currently querried tag.
	$tag_archive = get_queried_object();
}

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<header class="page__header page__header--archive">
				<?php
				if ( is_tag() ) {
					gotham_tag_banner( $tag_archive->slug );
				}

				the_archive_title( '<h1 class=" ' . $title_class . ' ">', '</h1>' );
				the_archive_description( '<div class="page__description">', '</div>' );
				?>
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
