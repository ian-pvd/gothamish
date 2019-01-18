<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Gothamish
 */

if ( ! function_exists( 'gotham_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function gotham_posted_on() {
		echo '<span class="entry-date">';

		$time_string = '<time class="entry-date__published entry-date__updated" datetime="%1$s">%2$s at %3$s</time>';

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_html( get_the_time() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'on %s', 'post date', 'gotham' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="entry-date__posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

		echo '</span>';

	}
endif;

if ( ! function_exists( 'gotham_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function gotham_posted_by() {
		if ( function_exists( 'coauthors_posts_links' ) ) {
			$byline = coauthors_posts_links( null, ' & ', null, null, false );
		} else {
			$byline = the_author_posts_link();
		}

		printf(
			'<span class="byline">%1$s %2$s</span>',
			esc_html__( 'By', 'gotham' ),
			wp_kses(
				$byline,
				[
					'a' => [
						'href'  => [],
						'title' => [],
						'class' => [],
						'rel'   => [],
					],
				]
			)
		);
	}
endif;

if ( ! function_exists( 'gotham_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function gotham_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'gotham' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'gotham' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'gotham' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'gotham' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'gotham' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'gotham_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function gotham_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<figure class="post-thumbnail">
				<div class="post-thumbnail__frame">
					<?php the_post_thumbnail(); ?>
				</div>

				<?php if ( get_the_post_thumbnail_caption() ) : ?>
				<figcaption class="post-thumbnail__caption"><?php echo esc_html( get_the_post_thumbnail_caption() ); ?></figcaption>
				<?php endif; ?>
			</figure><!-- .post-thumbnail -->

		<?php else : ?>

		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<?php
			the_post_thumbnail(
				'post-thumbnail',
				[
					'alt' => the_title_attribute(
						[
							'echo' => false,
						]
					),
				]
			);
			?>
		</a>

		<?php
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'gotham_post_banner' ) ) :
	/**
	 * Displays a special taxonomy banner for posts.
	 *
	 * If a post has a specific tag, display a banner above the post header.
	 */
	function gotham_post_banner() {
		// Get a list of the post tags.
		$post_tags = get_the_terms( get_the_ID(), 'post_tag' );

		// If list isn't empty...
		if ( ! empty( $post_tags ) ) {

			// Loop through the list.
			foreach ( $post_tags as $tag ) {
				// Check for specific post tags.
				switch ( $tag->slug ) {
					case 'best-of':
						$banner_type = $tag->slug;
						$banner_text = __(
							'Best of <span class="site-logotype"><span>Gotham</span>ish</span>',
							'gotham'
						);
						$banner_link = get_term_link( $tag );
						break;
					case 'gothamish-films':
						$banner_type = $tag->slug;
						$banner_text = __(
							'<span class="site-logotype"><span>Gotham</span>ish</span> Films',
							'gotham'
						);
						$banner_link = get_term_link( $tag );
						break;
				}

				// If a matching tag was found, stop searching.
				if ( isset( $banner_type ) && isset( $banner_text ) ) {
					// Display the tag.
					printf(
						'<a href="%3$s" class="post__banner post__banner--%1$s">%2$s</a>',
						sanitize_html_class( $banner_type ),
						wp_kses(
							$banner_text,
							[ 'span' => [ 'class' => [] ] ]
						),
						esc_url( $banner_link )
					);
					break;
				}
			}
		}
	}
endif;

if ( ! function_exists( 'gotham_posted_in' ) ) :
	/**
	 * Returns a top level category for the post.
	 *
	 * TODO: Explicitly set & retrieve primary category.
	 */
	function gotham_posted_in() {
		// Get a list of post categories.
		$post_categories = get_the_category();

		// Loop through the categories.
		foreach ( $post_categories as $category ) {
			// If we find a top level category, that isn't "uncategorized" ...
			if ( 0 === $category->parent && 'uncategorized' !== $category->slug ) {
				// Print the "posted in" info.
				printf(
					'<span>%1$s <a href="%2$s">%3$s</a></span>',
					esc_html__( 'in', 'gotham' ),
					esc_url( get_term_link( $category ) ),
					esc_html( $category->name )
				);
				// And then stop looking.
				break;
			}
		}
	}
endif;

if ( ! function_exists( 'gotham_digest_subscribe' ) ) :
	/**
	 * Displays a CTA to subscribe to the weekly food emails.
	 *
	 * TODO: Make this text editable via the admin.
	 */
	function gotham_digest_subscribe() {
		// Get a list of post categories.
		$post_categories = get_the_category();

		// Loop through the categories.
		foreach ( $post_categories as $category ) {
			// If we find the food category...
			if ( 'food' === $category->slug ) {
				// Print the subscribe CTA.
				printf(
					'<div class="entry-footer__digest-subscribe">' .
					/* translators: %s: Subscribe Link */
					esc_html__(
						'Want more like this? Get the tastiest food news, restaurant openings and more every Friday with the Gothamist Weekly Digest. %s',
						'gotham'
					) . '</div>',
					sprintf(
						'<a href="%2$s">%1$s</a>',
						esc_html__( 'Subscribe Today!', 'gotham' ),
						esc_url( '/newsletter' )
					)
				);

				// And then stop looking.
				break;
			}
		}
	}
endif;

if ( ! function_exists( 'gotham_donation_appeal' ) ) :
	/**
	 * Displays an appeal to donate.
	 *
	 * TODO: Make this text editable via the admin.
	 */
	function gotham_donation_appeal() {
		// Print the subscribe CTA.
		printf(
			'<div class="entry-footer__donation-appeal">' .
			wp_kses(
				/* translators: %s: Donate Link */
				__(
					'<span class="site-logotype"><span>Gotham</span>ish</span> is now part of %1$s, a nonprofit organization that relies on its members for support. You can help us by %2$s!  Your contribution supports more local, New York coverage from Gothamish. Thank you!',
					'gotham'
				),
				[ 'span' => [ 'class' => [] ] ]
			) . '</div>',
			sprintf(
				'<a href="%2$s" target="_blank">%1$s</a>',
				esc_html__( 'PVD Industrial', 'gotham' ),
				esc_url( 'https://ian.pvdind.com' )
			),
			sprintf(
				'<a href="%2$s">%1$s</a>',
				esc_html__( 'making a donation today', 'gotham' ),
				esc_url( '/donate' )
			)
		);
	}
endif;

if ( ! function_exists( 'gotham_footer_byline' ) ) :
	/**
	 * Displays author and contact info in the footer.
	 */
	function gotham_footer_byline() {
		echo '<div class="entry-footer__contact">';

		// Print the Author Info.
		if ( function_exists( 'coauthors_posts_links' ) ) {
			$byline = coauthors_posts_links( null, null, null, null, false );
		} else {
			$byline = the_author_posts_link();
		}

		printf(
			'<div class="entry-footer__contact-byline">%1$s %2$s</div>',
			esc_html__( 'Written by:', 'gotham' ),
			wp_kses(
				$byline,
				[
					'a' => [
						'href'  => [],
						'title' => [],
						'class' => [],
						'rel'   => [],
					],
				]
			)
		);

		// Print the contact & tips links.
		printf(
			'<div class="entry-footer__contact-links">' .
			/* translators: %s: Contact Link */
			esc_html__(
				'Contact the %1$s of this article or email %2$s with further questions, comments or tips.',
				'gotham'
			) . '</div>',
			sprintf(
				'<a href="%2$s">%1$s</a>',
				esc_html__( 'author', 'gotham' ),
				esc_url( '/authors' )
			),
			sprintf(
				'<a href="%2$s">%1$s</a>',
				esc_html( 'tips@gothamist.com' ),
				esc_url( 'mailto:tips@gothamist.com' )
			)
		);

		echo '</div>';
	}
endif;

if ( ! function_exists( 'gotham_jetpack_share' ) ) :
	/**
	 * Displays Jetpack Sharedaddy links.
	 */
	function gotham_jetpack_share() {
		if ( function_exists( 'sharing_display' ) ) {
			sharing_display( '', true );
		}
	}
endif;
