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
		'archive-css' => 'archive.9011c0.css',
		'archive-js' => 'archive.9011c0.js',
		'editor-css' => 'editor.9011c0.css',
		'editor-js' => 'editor.9011c0.js',
		'front-css' => 'front.9011c0.css',
		'front-js' => 'front.9011c0.js',
		'page-css' => 'page.9011c0.css',
		'page-js' => 'page.9011c0.js',
		'post-css' => 'post.9011c0.css',
		'post-js' => 'post.9011c0.js',
		'site-css' => 'site.9011c0.css',
		'site-js' => 'site.9011c0.js',
		'user-css' => 'user.9011c0.css',
		'user-js' => 'user.9011c0.js',
	);
	return ! empty( $assets[ $asset ] ) ? $assets[ $asset ] : false;
}
