<?php
/**
 * Gothamish ad display function.
 *
 * By default this theme calls `gotham_ad_display` to display an ad
 * placeholder. You can replace this function with a call to your favorite
 * ad provider to cuztomize ads on your site or disable it entirely via
 * gotham_get_options.
 *
 * @package Gothamish
 */

/**
 * Ad Slot function for displaying placeholder ad blocks.
 * Replace this with AdSense or DFP or whatever.
 *
 * @param  [string] $ad_position Theme location where the ad is displayed.
 * @param  [string] $ad_size Ad slot size in pixels.
 */
function gotham_display_ad( $ad_position = null, $ad_size = '300x250' ) {
	// If named ad position value set.
	if ( isset( $ad_position ) ) {
		$ad_position = 'ad-position--' . $ad_position;
	}

	// Check if theme should display ads.
	if ( ! gotham_get_option( 'display-ads' ) ) {
		// If not, leave an HTML comment.
		echo '<!-- ads display option disabled - ' . esc_attr( $ad_position ) . ' -->';
		return;
	}

	// Place single ad size for loop output.
	if ( ! is_array( $ad_size ) ) {
		$ad_size = [ $ad_size ];
	}

	// Open the ad display container.
	echo '<div class="ad ' . esc_attr( $ad_position ) . '">';

	foreach ( $ad_size as $slot => $dimensions ) {
		// Convert size string into an array of valid integers.
		$px_size = explode( 'x', $dimensions );

		// Ensure there are two values, and they're valid numbers.
		if ( isset( $px_size[0] ) && is_numeric( $px_size[0] ) && isset( $px_size[1] ) && is_numeric( $px_size[1] ) ) {
			$px_size[0] = (int) $px_size[0];
			$px_size[1] = (int) $px_size[1];

			// Are the numbers greater than zero?
			if ( ( 0 < $px_size[0] ) && ( 0 < $px_size[1] ) ) {
				// Display a different whitelist appeal based on px^2 ad size.
				if ( $px_size[0] * $px_size[1] >= 58000 ) {
					$ad_appeal =
						sprintf(
							'<div class="ad__appeal ad__appeal--text"><span>' . wp_kses(
								/* translators: %1$s blog name, %2$s donate link */
								__(
									'%1$s is reader supported local news. Please consider whitelisting ads on this site, or making a donation on our %2$s.',
									'gothamish'
								),
								[ 'a' => [ 'href' => [] ] ]
							) . '</span></div>',
							get_bloginfo( 'name' ),
							sprintf(
								'<a href="%1$s">%2$s</a>',
								esc_url( gotham_get_option( 'page-donate' ) ),
								esc_html__( 'support page', 'gothamish' )
							)
						);
				} else {
					$ad_appeal = sprintf(
						'<div class="ad__appeal ad__appeal--button"><span><a href="' . esc_url( gotham_get_option( 'page-donate' ) ) . '" class="link-button">%1$s</a></span></div>',
						__( 'Support Us', 'gothamish' )
					);
				}

				// Set up ad attributes.
				// Display size in px.
				$px_size = 'width:' . $px_size[0] . 'px;height:' . $px_size[1] . 'px;';

				// Is ad slot for a specific screen size?
				if ( ! is_int( $slot ) ) {
					$ad_view = 'ad-view--' . $slot;
				} else {
					$ad_view = 'ad-view--all';
				}

				// Display the ad.
				printf(
					'<div class="ad-view ' . esc_attr( $ad_view ) . ' ad-size--' . esc_attr( $dimensions ) . '" style="' . esc_attr( $px_size ) . '"><span class="ad__placeholder-text">%1$s</span><img class="ad__image" src="' . esc_url( 'https://source.unsplash.com/collection/1349357/' . $dimensions ) . '/">%2$s</div>',
					sprintf(
						'%1$s %2$s',
						esc_html__( 'Advertisement', 'gothamish' ),
						esc_html( $dimensions )
					),
					wp_kses(
						$ad_appeal,
						[
							'div'  =>
								[
									'class' => [],
								],
							'a'    => [
								'href'  => [],
								'class' => [],
							],
							'span' => [],
						]
					)
				);
			}
		} else {
			echo '<!-- Invalid Ad Slot Display Size: ' . esc_html( $dimensions ) . ' -->';
		}
	}

	// Close the ad display container.
	echo '</div>';
}
