<?php
/**
 * Gothamish theme options array.
 *
 * @package Gothamish
 */

if ( ! function_exists( 'gotham_get_option' ) ) :
	/**
	 * Returns a theme value for the requested option.
	 *
	 * @param  string  $option  Name of option to be returned.
	 * @param  boolean $default Default value to return if option not found.
	 * @return mixed           Value for the option.
	 */
	function gotham_get_option( $option, $default = false ) {

		$option = trim( $option );
		if ( empty( $option ) ) {
			return false;
		}

		// Start with theme value set to default.
		$value = $default;

		// An array of hardcoded theme options.
		$theme_options = [
			// The name of the site's parent network.
			'site-network' => 'PVD Industrial',
			// Site parent network URL.
			'network-url' => 'https://pvdindustrial.com',
			// The location the blog covers.
			'site-location' => __( 'New York', 'gotham' ),
			// Tips EMail Address.
			'tips-email' => 'tips@gothamish.press',
			// Category slugs for the home page post feeds.
			'primary-categories' => [
				'news',
				'arts',
				'food',
			],
			// Toggle display advertisments.
			'display-ads' => true,
			// Max number of feed pages to display on front page.
			'max_feed_pages' => 9,
		];

		if ( ! empty( $theme_options[ $option ] ) ) {
			$value = $theme_options[ $option ];
		}

		return $value;
	}
endif;
