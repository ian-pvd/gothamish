<?php
/**
 * roundhouse Feature Image
 *
 * Theme handler functions
 *
 * @package roundhouse
 */

function pvd_get_featured_image_format() {
	$featured_image_format = get_post_meta( get_the_ID(), 'featured_image_format', true );
	return $featured_image_format;
}

function pvd_get_featured_image_options() {
	$featured_image_options = [
		'image_layouts' => true, // This theme supports image layouts (v2 - array to filter supported layouts)
		'image_alignment' => true, // This theme supports image alignment
		'image_effects' => true, // This theme supports image effects (v2 - array to filter supported effects)
		'show_empty' => true, // This theme has fallback/watermark styles for empty featured image frames.
		'show_captions' => true // Do not show media library image captions for featured images.
	];
	return $featured_image_options;
}
