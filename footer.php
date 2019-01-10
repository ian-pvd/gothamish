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
			<nav id="footer-navigation" class="site-footer__navigation footer-navigation">
				<?php
				wp_nav_menu(
					[
						'container_class' => 'footer-navigation__utilities-menu utilities-menu',
						'menu_class'     => 'utilities-menu__menu',
						'menu_id'        => 'utilities-menu__menu',
						'theme_location' => 'utilities-menu',
					]
				);
				?>
			</nav>
			<div class="site-info copyright">
				<span class="copyright__author">
					<a href="<?php echo esc_html( get_bloginfo( 'url' ) ); ?>"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a>
				</span>
				<span class="copyright__year"><?php echo esc_html( date( 'Y' ) ); ?></span>
			</div><!-- .site-info -->
		</div><!-- .site-footer__wrapper -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
