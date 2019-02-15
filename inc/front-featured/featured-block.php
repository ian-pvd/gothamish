<?php
/**
 * Fron Featured content block.
 *
 * @package Gothamish
 */

/**
 * Display featured content block from a variety of configurations based
 * on feed page number.
 *
 * @param  integer $block_number The number of the block options to display.
 */
function gotham_front_featured_block( $block_number = 0 ) {
	// Block Config 0: Featured.
	$blocks[] = [
		'slug'       => 'gothamish-featured',
		'title'      => sprintf(
			/* translators: %s site logotype */
			__( 'Featured on %s', 'gothamish' ),
			gotham_logotype()
		),
		'query_args' => [
			'tag' => 'featured',
		],
	];
	// Block Config 1: Long Form.
	$blocks[] = [
		'slug'       => 'gothamish-long-form',
		'title'      => sprintf(
			/* translators: %s site logotype */
			__( 'Long Form on %s', 'gothamish' ),
			gotham_logotype()
		),
		'query_args' => [
			'tag' => 'long-form',
		],
	];
	// Block Config 2: Best Of.
	$blocks[] = [
		'slug'       => 'gothamish-best-of',
		'title'      => sprintf(
			/* translators: %s site logotype */
			__( 'Best of %s', 'gothamish' ),
			gotham_logotype()
		),
		'query_args' => [
			'tag' => 'best-of',
		],
	];

	// Get the block number (remaineder of page_num/total_blocks).
	$block_number--;
	$block_number = ( $block_number % count( $blocks ) );

	// Shift block config to $block variable.
	$block = $blocks[ $block_number ];

	// Default blocks query args.
	$blocks_args = [
		'posts_per_page'      => 3,
		'ignore_sticky_posts' => true,
	];

	// Merge featured block custom query.
	$blocks_args = array_merge( $blocks_args, $block['query_args'] );

	$block_posts = new WP_Query( $blocks_args );

	if ( $block_posts->have_posts() ) :
		?>
		<div class="featured-block featured-block--<?php echo esc_attr( $block['slug'] ); ?>">
			<h2 class="featured-block__title">
				<?php
					echo wp_kses(
						$block['title'],
						[
							'span' => [
								'class' => [],
							],
						]
					);
				?>
			</h2>
			<div class="featured-block__wrapper">

			<?php
			while ( $block_posts->have_posts() ) {
				$block_posts->the_post();
				get_template_part( 'template-parts/content', 'tout' );
			}

			?>
			</div>
		</div>
		<?php
	endif;

	unset( $block_posts );
}
