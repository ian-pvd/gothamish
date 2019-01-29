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
			<div class="site-info site-info__copyright copyright">
				<span class="copyright__year">&copy; <?php echo esc_html( date( 'Y' ) ); ?></span>
				<span class="copyright__author">
					<a href="<?php echo esc_html( get_bloginfo( 'url' ) ); ?>"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a>.
				</span>
				<?php esc_html_e( 'All rights reserved.', 'gotham' ); ?>
			</div><!-- .site-info -->
			<div class="site-info site-info__terms-privacy terms-privacy">
				<a href="<?php echo esc_url( get_site_url() . '/terms' ); ?>"><?php esc_html_e( 'Terms of Use', 'gotham' ); ?></a> &amp;
				<a href="<?php echo esc_url( get_site_url() . '/privacy' ); ?>"><?php esc_html_e( 'Privacy Policy', 'gotham' ); ?></a>
			</div>
			<?php if ( has_nav_menu( 'utilities' ) ) : ?>
				<div class="site-footer__utilities">
					<?php
					wp_nav_menu(
						[
							'container_class' => 'site-footer__utilities-menu footer-utilities',
							'menu_class'      => 'footer-utilities__menu',
							'menu_id'         => 'footer-utilities__menu',
							'theme_location'  => 'footer-utilities',
						]
					);
					?>
				</div>
			<?php endif; ?>
		</div><!-- .site-footer__wrapper -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
