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
			// The name of the site's parent network.
			'site-network' => 'PVD Industrial',
			// Site parent network URL.
			'network-url' => 'https://pvdindustrial.com',
			// The location the blog covers.
			'site-location' => __( 'New York', 'gotham' ),
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

if ( ! function_exists( 'gotham_get_exclude_displayed_post_ids' ) ) :
	/**
	 * Checks for an array of post IDs that have already been displayed,
	 * so that they can be excluded from WP Queries.
	 *
	 * @return array List of posts IDs to exclude.
	 */
	function gotham_get_exclude_displayed_post_ids() {
		// Excluded posts are set in the featured posts function.
		global $exclude_displayed_post_ids;
		// If there is a cache of featued posts, this variable won't have be set.
		if ( empty( $exclude_displayed_post_ids ) ) {
			// If empty, try checking for the cached featued posts.
			if ( $featured_post_cache_ids = get_transient( 'featured_posts' ) ) {
				// Shift the cached feated posts to an array.
				$featured_post_cache_ids = $featured_post_cache_ids->posts;
				// Reset the excluded posts as an empty array.
				$exclude_displayed_post_ids = [];
				// Loop through the array.
				foreach ( $featured_post_cache_ids as $displayed_post ) {
					// Add each featured post ID from the cache to the excluded posts list.
					$exclude_displayed_post_ids[] = $displayed_post->ID;
				}
			} else {
				// Assume no excluded posts are set.
				$exclude_displayed_post_ids = [];
			}
		}

		return $exclude_displayed_post_ids;
	}
endif;
