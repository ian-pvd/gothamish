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
		'post-css' => 'post.c1d24c.css',
		'post-js' => 'post.c1d24c.js',
		'site-css' => 'site.c1d24c.css',
		'site-js' => 'site.c1d24c.js',
	);
	return ! empty( $assets[ $asset ] ) ? $assets[ $asset ] : false;
}
