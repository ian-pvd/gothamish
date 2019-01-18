<?php
/**
 * Get the version for a given asset.
 *
 * @NOTE
 * - This file is written with a node build script.
 * - Do not edit this file by hand.
 * - See: ./assets/config/asset-versions.js
 *
 * @param string $asset The asset name.
 * @return string The asset version.
 */
function gotham_get_asset_version( $asset ) {
	$assets = array(
		'post-css' => 'post.9cb078.css',
		'post-js' => 'post.9cb078.js',
		'site-css' => 'site.9cb078.css',
		'site-js' => 'site.9cb078.js',
	);
	return ! empty( $assets[ $asset ] ) ? $assets[ $asset ] : false;
}
