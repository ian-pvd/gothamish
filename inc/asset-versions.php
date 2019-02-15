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
		'archive-css' => 'archive.b04b63.css',
		'archive-js' => 'archive.b04b63.js',
		'editor-css' => 'editor.b04b63.css',
		'editor-js' => 'editor.b04b63.js',
		'front-css' => 'front.b04b63.css',
		'front-js' => 'front.b04b63.js',
		'page-css' => 'page.b04b63.css',
		'page-js' => 'page.b04b63.js',
		'post-css' => 'post.b04b63.css',
		'post-js' => 'post.b04b63.js',
		'site-css' => 'site.b04b63.css',
		'site-js' => 'site.b04b63.js',
		'user-css' => 'user.b04b63.css',
		'user-js' => 'user.b04b63.js',
	);
	return ! empty( $assets[ $asset ] ) ? $assets[ $asset ] : false;
}
