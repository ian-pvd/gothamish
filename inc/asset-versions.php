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
		'archive-css' => 'archive.css',
		'archive-js' => 'archive.js',
		'editor-css' => 'editor.css',
		'editor-js' => 'editor.js',
		'page-css' => 'page.css',
		'page-js' => 'page.js',
		'post-css' => 'post.css',
		'post-js' => 'post.js',
		'site-css' => 'site.css',
		'site-js' => 'site.js',
		'user-css' => 'user.css',
		'user-js' => 'user.js',
	);
	return ! empty( $assets[ $asset ] ) ? $assets[ $asset ] : false;
}
