<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Gothamish
 */

// Get requested path.
global $wp;
$page_request = $wp->request;

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Page not found.', 'gothamish' ); ?></h1>
				</header><!-- .page-header -->

				<?php gotham_post_thumbnail(); ?>

				<div class="page-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location.', 'gothamish' ); ?></p>
					<p><?php esc_html_e( 'Maybe try one of the links below or a search?', 'gothamish' ); ?></p>

					<p>
						<a href="<?php echo( esc_url( gotham_get_page( 'contact' ) ) ); ?>">
							<?php echo esc_html__( 'Contact Us', 'gothamish' ); ?>
						</a>
					</p>

					<p>
						<?php
							echo wp_kses(
								sprintf(
									/* translators: %s request string */
									__( 'Search for "%s" on this site.', 'gothamish' ),
									'<a href="' . get_search_link( $page_request ) . '">' . $page_request . '</a>'
								),
								[
									'a' => [
										'href' => [],
									],
								]
							);
							?>
					</p>

					<p>
						<?php
							echo wp_kses(
								sprintf(
									/* translators: %s request string */
									__( 'Go back to the %s.', 'gothamish' ),
									'<a href="' . esc_url( get_home_url() ) . '">home page</a>'
								),
								[
									'a' => [
										'href' => [],
									],
								]
							);
							?>
					</p>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
