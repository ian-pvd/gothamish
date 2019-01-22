<?php
/**
 * Gothamish Ads
 *
 * @package Gothamish
 */

/**
 * Ad Slot function for displaying placeholder ad blocks.
 * Replace this with AdSense or DFP or whatever.
 *
 * @param  [string] $ad_size Ad slot size in pixels.
 */
function gotham_ad_slot( $ad_size = '300x250' ) {
	// Place single ad size for loop output.
	if ( ! is_array( $ad_size ) ) {
		$ad_size = [ $ad_size ];
	}

	// Open the ad display container.
	echo '<div class="ad">';

	foreach ( $ad_size as $slot => $dimensions ) {
		// Convert size string into an array of valid integers.
		$px_size = explode( 'x', $dimensions );

		// If there are two values, ensure they're valid numbers.
		if ( is_numeric( $px_size[0] ) && is_numeric( $px_size[1] ) ) {
			$px_size[0] = (int) $px_size[0];
			$px_size[1] = (int) $px_size[1];

			// Are the numbers greater than zero?
			if ( ( 0 < $px_size[0] ) && ( 0 < $px_size[1] ) ) {
				// Set up ad attributes.
				// Display size in px.
				$px_size = 'width:' . $px_size[0] . 'px;height:' . $px_size[1] . 'px;';

				// Is ad slot for a specific screen size?
				if ( ! is_int( $slot ) ) {
					$ad_slot = 'ad-slot--' . $slot;
				} else {
					$ad_slot = 'ad-slot--all';
				}

				// Display the ad.
				echo '<div class="ad-slot ' . esc_attr( $ad_slot ) . ' ad-size--' . esc_attr( $dimensions ) . '" style="' . esc_attr( $px_size ) . '"><span class="ad__text">Advertisement ' . esc_html( $dimensions ) . '</span><img class="ad__image" src="' . esc_url( 'https://source.unsplash.com/random/' . $dimensions ) . '" /></div>';
			}
		} else {
			echo '<!-- Invalid Ad Slot Display Size: ' . esc_html( $dimensions ) . ' -->';
		}
	}

	// Close the ad display container.
	echo '</div>';
}
