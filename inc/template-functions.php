<?php
/**
 * Gothamish theme helper functions.
 *
 * @package Gothamish
 */

if ( ! function_exists( 'gotham_social_handle' ) ) :
	/**
	 * Distills a url or @name down to a string handle for social network links.
	 *
	 * @param  string $social_link The user supplied social link.
	 * @return string              The filtered social link.
	 */
	function gotham_social_handle( $social_link ) {
		// If the string is empty, don't bother.
		if ( ! isset( $social_link ) ) {
			return;
		}

		// Strip tags.
		$social_link = wp_strip_all_tags( $social_link );

		// Trim whitespace.
		$social_link = trim( $social_link );

		// Remove Trailing Slash.
		$social_link = trim( $social_link, '/' );

		// Break possible url up into '/' sections.
		$social_link = explode( '/', $social_link );

		// Use the last section of the URL.
		$social_link = $social_link[ count( $social_link ) - 1 ];

		// Trim the '@' character.
		$social_link = ltrim( $social_link, '@' );

		return $social_link;
	}
endif;

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
			'site-network'       => 'PVD Industrial',
			'site-city'          => 'New York',
			'primary-categories' => [
				'news',
				'arts-entertainment',
				'food',
			],
		];

		if ( ! empty( $theme_options[ $option ] ) ) {
			$value = $theme_options[ $option ];
		}

		return $value;
	}
endif;
