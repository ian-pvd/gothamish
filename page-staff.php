<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Gothamish
 */

// Staff sections.
$staff_roles = [
	'editor'      => [
		'title' => 'Editors',
	],
	'author'      => [
		'title' => 'Authors',
	],
	'contributor' => [
		'title' => 'Contributors',
	],
];

get_header();
?>

	<div id="primary" class="content-area content-area--staff">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			// Display any introductory page content for the staff page.
			get_template_part( 'template-parts/content', 'page' );

			echo '<div class="staff">';

			foreach ( $staff_roles as $staff_role => $value ) {
				// Start the staff page list wrapper.
				echo '<div class="staff-group staff-group--' . esc_attr( $staff_role ) . '">';
				echo '<h2 class="staff-group__role-title">' . esc_html( $value['title'] ) . '</h2>';
				// Output the list.
				gotham_staff_list( [ 'role' => $staff_role ] );
				// Close the list wrapper.
				echo '</div>';
			}

			echo '</div>';

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
