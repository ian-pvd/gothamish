<?php
/**
 * Template part for displaying a user profile.
 *
 * @package Gothamish
 */

global $staff;

// Get user account data and user meta info.
$user_data = get_userdata( $staff->ID );
$user_meta = get_user_meta( $staff->ID );

// Author Posts Link.
$author_link = get_author_posts_url( $staff->ID );

// Staff Photo URL.
$staff_photo = get_avatar_url( $staff->ID, [ 'size' => 300 ] );

// Build social media links array.
$social_links = [
	'articles'  => [
		'name' => __( 'Articles', 'gotham' ),
		'link' => $author_link,
	],
	'email'     => [
		'name' => __( 'Email', 'gotham' ),
		'link' => 'mailto:' . $user_data->user_email,
	],
	'website'   => [
		'name' => __( 'Website', 'gotham' ),
		'link' => $user_data->user_url,
	],
	'twitter'   => [
		'name' => __( 'Twitter', 'gotham' ),
		'link' => isset( $user_meta['twitter'][0] ) ? 'https://twitter.com/' . gotham_social_handle( $user_meta['twitter'][0] ) : null,
	],
	'instagram' => [
		'name' => __( 'Instagram', 'gotham' ),
		'link' => isset( $user_meta['instagram'][0] ) ? 'https://instagram.com/' . gotham_social_handle( $user_meta['instagram'][0] ) : null,
	],
];
?>

<article class="user user--<?php echo esc_attr( $user_data->user_nicename ); ?>">
	<figure class="user__portrait">
		<?php if ( is_archive() ) : ?>
			<img src="<?php echo esc_url( $staff_photo ); ?>" />
		<?php else : ?>
			<a href="<?php echo esc_url( $author_link ) ?>"><img src="<?php echo esc_url( $staff_photo ); ?>" /></a>
		<?php endif; ?>
	</figure>
	<main class="user__info">
		<?php if ( is_archive() ) : ?>
			<h2 class="user__name"><?php echo esc_html( $staff->display_name ); ?></h2>
		<?php else : ?>
			<h3 class="user__name"><a href="<?php echo esc_url( $author_link ) ?>"><?php echo esc_html( $staff->display_name ); ?></a></h3>
		<?php endif; ?>

		<?php if ( ! empty( $user_meta['description'][0] ) ) : ?>
		<div class="user__bio">
			<?php echo esc_textarea( $user_meta['description'][0] ); ?>
		</div>
		<?php endif; ?>

		<ul class="user__social-links">
			<?php
			foreach ( $social_links as $social => $value ) :
				if ( ! empty( $value['link'] ) ) :
					?>
				<li class="user__social-link-item user__social-link-item--<?php echo esc_attr( $social ); ?>"><a href="<?php echo esc_url( $value['link'] ); ?>"><?php echo esc_html( $value['name'] ); ?></a></li>
					<?php
				endif;
				endforeach;
			?>
		</ul>
	</main>
</article>
