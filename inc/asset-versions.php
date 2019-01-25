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
		'archive-css' => 'archive.8aea42.css',
		'archive-js' => 'archive.8aea42.js',
		'editor-css' => 'editor.8aea42.css',
		'editor-js' => 'editor.8aea42.js',
		'post-css' => 'post.8aea42.css',
		'post-js' => 'post.8aea42.js',
		'site-css' => 'site.8aea42.css',
		'site-js' => 'site.8aea42.js',
	);
	return ! empty( $assets[ $asset ] ) ? $assets[ $asset ] : false;
}
