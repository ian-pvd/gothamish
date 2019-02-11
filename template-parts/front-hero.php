<?php
/**
 * Front Page: Hero Section
 *
 * Template part for displaying the hero section.
 *
 * @package Gothamish
 */

?>

<div class="front-page__hero-section hero-section">
	<div class="hero-section__featured-posts featured-posts">
		<?php gotham_featured_posts( 3 ); ?>
	</div>
	<?php get_sidebar(); ?>
</div>
