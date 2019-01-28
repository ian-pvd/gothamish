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
		'archive-css' => 'archive.6a9025.css',
		'archive-js' => 'archive.6a9025.js',
		'editor-css' => 'editor.6a9025.css',
		'editor-js' => 'editor.6a9025.js',
		'post-css' => 'post.6a9025.css',
		'post-js' => 'post.6a9025.js',
		'site-css' => 'site.6a9025.css',
		'site-js' => 'site.6a9025.js',
	);
	return ! empty( $assets[ $asset ] ) ? $assets[ $asset ] : false;
}
