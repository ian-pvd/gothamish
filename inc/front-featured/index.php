<?php
/**
 * Gothamish Front Featured Content functions.
 *
 * @package Gothamish
 */

// Load Front Featured posts module.
require_once GOTHAM_PATH . '/inc/front-featured/featured-posts.php';

// Load Front Featured Category Feeds module.
require_once GOTHAM_PATH . '/inc/front-featured/featured-categories-feed.php';

// Load Front Featured Content cache reset hook.
require_once GOTHAM_PATH . '/inc/front-featured/delete-front-featured-cache.php';


function gotham_front_featured_block( $block_number = 0 ) {
	// Block Config: Featured.
	$blocks[] = [
		'slug' => 'gothamist-featured',
		'title' => 'Featured on Gothamish',
		'query_args' => [
			'tag' => 'featured',
		],
	];
	// Block Config: Long Form.
	$blocks[] = [
		'slug' => 'gothamist-long-form',
		'title' => 'Long Form on Gothamish',
		'query_args' => [
			'tag' => 'long-form',
		],
	];
	// Block Config: Best Of.
	$blocks[] = [
		'slug' => 'gothamist-best-of',
		'title' => 'Best of Gothamish',
		'query_args' => [
			'tag' => 'best-of',
		],
	];

	// Get the block number (remaineder of page_num/total_blocks).
	$block_number--;
	$block_number = ( $block_number % count( $blocks ) );

	// Shift block config to $block variable.
	$block = $blocks[ $block_number ];

	// Default blocks args.
	$blocks_args = [
		'posts_per_page'      => 3,
		'ignore_sticky_posts' => true,
	];

	// Merge featured block custom query.
	$blocks_args = array_merge( $blocks_args, $block['query_args'] );

	$block_posts[ $block['slug'] ] = new WP_Query( $blocks_args );

	if ( $block_posts[ $block['slug'] ]->have_posts() ) :
		?>
		<div class="featured-block featured-block--<?php echo esc_attr( $block['slug'] ); ?>">
			<h2 class="featured-block__title"><?php echo $block['title']; ?></h2>
			<div class="featured-block__wrapper">

			<?php
			while ( $block_posts[ $block['slug'] ]->have_posts() ) {
				$block_posts[ $block['slug'] ]->the_post();
				get_template_part( 'template-parts/content', 'tout' );
			}

			?>
			</div>
		</div>
		<?php
	endif;

	unset( $block_posts[ $block['slug'] ] );
}
