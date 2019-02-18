<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Gothamish
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="site-footer__wrapper">
			<?php
			if ( has_nav_menu( 'utilities' ) ) :
				wp_nav_menu(
					[
						'container_class' => 'site-footer__utilities-menu footer-utilities',
						'menu_class'      => 'footer-utilities__menu',
						'menu_id'         => 'footer-utilities__menu',
						'theme_location'  => 'utilities',
					]
				);
			endif;
			?>
			<div class="site-info site-info__copyright copyright">
				<span class="copyright__year">&copy; <?php echo esc_html( date( 'Y' ) ); ?></span>
				<span class="copyright__author">
					<a href="<?php echo esc_html( home_url() ); ?>"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a>.
				</span>
				<?php esc_html_e( 'All rights reserved.', 'gothamish' ); ?>
			</div><!-- .site-info -->
			<div class="site-info site-info__terms-privacy terms-privacy">
				<?php if ( gotham_get_page( 'terms' ) ) : ?>
				<span class="site-info__terms"><a href="<?php echo esc_url( gotham_get_page( 'terms' ) ); ?>"><?php esc_html_e( 'Terms of Use', 'gothamish' ); ?></a></span>
				<?php endif; ?>

				<?php if ( get_privacy_policy_url() ) : ?>
				<span class="site-info__privacy"><a href="<?php echo esc_url( get_privacy_policy_url() ); ?>"><?php esc_html_e( 'Privacy Policy', 'gothamish' ); ?></a></span>
				<?php endif; ?>
			</div>
		</div><!-- .site-footer__wrapper -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
