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
			<div class="site-info copyright">
				<span class="copyright__year">&copy; <?php echo esc_html( date( 'Y' ) ); ?></span>
				<span class="copyright__author">
					<a href="<?php echo esc_html( get_bloginfo( 'url' ) ); ?>"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a>.
				</span>
				<?php esc_html_e( 'All rights reserved.', 'gotham' ); ?>
			</div><!-- .site-info -->
		</div><!-- .site-footer__wrapper -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
