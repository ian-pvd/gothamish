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
		'archive-css' => 'archive.3920eb.css',
		'archive-js' => 'archive.3920eb.js',
		'editor-css' => 'editor.3920eb.css',
		'editor-js' => 'editor.3920eb.js',
		'front-css' => 'front.3920eb.css',
		'front-js' => 'front.3920eb.js',
		'page-css' => 'page.3920eb.css',
		'page-js' => 'page.3920eb.js',
		'post-css' => 'post.3920eb.css',
		'post-js' => 'post.3920eb.js',
		'site-css' => 'site.3920eb.css',
		'site-js' => 'site.3920eb.js',
		'user-css' => 'user.3920eb.css',
		'user-js' => 'user.3920eb.js',
	);
	return ! empty( $assets[ $asset ] ) ? $assets[ $asset ] : false;
}
