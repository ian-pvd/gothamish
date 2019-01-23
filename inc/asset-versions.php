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
		'editor-css' => 'editor.dad779.css',
		'editor-js' => 'editor.dad779.js',
		'post-css' => 'post.dad779.css',
		'post-js' => 'post.dad779.js',
		'site-css' => 'site.dad779.css',
		'site-js' => 'site.dad779.js',
	);
	return ! empty( $assets[ $asset ] ) ? $assets[ $asset ] : false;
}
