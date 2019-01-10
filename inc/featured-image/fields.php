<?php
/**
 * Gothamish Feature Image
 *
 * Fieldmanager fields config
 *
 * @package Gothamish
 */

/**
 *	- Feature Image Treatment
 *		- v1: Feature Image Type: Full, Wide, Large, Standard
 *			- Full: Full bleed, 100% width & height
 *			- Wide: 100% site max width (1600ish?), 16:9 aspect
 *			- Large: 100% page width (primary+sidebar)
 *			- Standard: 100% content width, as post content
 *		- v2: Add checkbox options for treatments
 *			- Contrast Boost
 *			- Grayscale
 *			- Vignette
 *			- Add these as individual classes (.feature--grayscale)
 */
function gotham_fm_group_feature_image() {
	$fm = new Fieldmanager_Group( [
		'name' => 'featured_image_format',
		'children' => [
			'layout' => new Fieldmanager_Select( [
				'limit' => 1,
				'label' => __( 'Image Layout', 'gotham' ),
				'attributes' => [
					'style' => 'width: 100%',
				],
				'datasource' => new Fieldmanager_Datasource( [
					'options' => [
						'full' => 'Full',
						'wide' => 'Wide',
						'large' => 'Large',
						'standard' => 'Standard',
					],
				] ),
				'default_value' => 'standard',
				'description' => __( '<ul><li>Fullbleed: 100% viewport width & height.</li><li>Wide: 100% site max width, 16:9 ratio.</li><li>Large: 100% page width, 3:2 ratio.</li><li>Standard: Post width, as post content.</li></ul>', 'gotham' ),
				'escape' => [ 'description' => 'wp_kses_post' ],
			] ),
			'align' => new Fieldmanager_Select( [
				'limit' => 1,
				'label' => __( 'Image Alignment', 'gotham' ),
				'attributes' => [
					'style' => 'width: 100%',
				],
				'datasource' => new Fieldmanager_Datasource( [
					'options' => [
						'top' => 'Top',
						'middle' => 'Middle',
						'bottom' => 'Bottom',
					],
				] ),
				'default_value' => 'top',
				'description' => __( 'Vertical photo alignment, if cropped.', 'gotham' ),
			] ),
			'effects' => new Fieldmanager_Checkboxes( [
				'label' => __( 'Image Effects', 'gotham' ),
				'datasource' => new Fieldmanager_Datasource( [
					'options' => [
						'grayscale' => 'Grayscale',
						'high-contrast' => 'High Contrast',
						'vignette' => 'Vignette',
						'darken' => 'Darken'
					],
				] ),
			] ),
		],
	] );

	$fm->add_meta_box(
		__( 'Featured Image Format', 'gotham' ),
		[ 'post', 'page' ],
		'side',
		'core'
	);
}

add_action( 'fm_post_post', 'gotham_fm_group_feature_image' );
