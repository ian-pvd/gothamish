<?php
/**
 * The template for displaying a list of authors.
 *
 * NOTE: User accounts must be part of the Editor, Author or Contributor
 * roles to be displayed. Admin accounts have been deliberately excluded
 * from displaying on the front end.
 *
 * Template Name: Staff Page
 *
 * @package Gothamish
 */

// Default staff sections.
$staff_groups = [
	'editor'      => [
		'title' => __( 'Editorial Staff', 'gothamish' ),
	],
	'author'      => [
		'title' => __( 'Authors', 'gothamish' ),
	],
	'contributor' => [
		'title' => __( 'Contributors', 'gothamish' ),
	],
];

// Get a staff count to ensure there are users for each role.
$staff_count = count_users();
// Filter the default staff groups.
foreach ( $staff_groups as $group => $value ) {
	// If a group has no members, it wont be in the staff count array.
	if ( ! isset( $staff_count['avail_roles'][ $group ] ) ) {
		// So remove it from the staff group array.
		unset( $staff_groups[ $group ] );
	}
}

get_header();
?>

	<div id="primary" class="content-area content-area--staff">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			// Display any introductory page content for the staff page.
			get_template_part( 'template-parts/content', 'page' );

			// If there are authors, editors or contributors to display.
			if ( ! empty( $staff_groups ) ) :
				?>

			<div class="staff">

				<?php
				foreach ( $staff_groups as $group => $value ) :
					// Start the staff page list wrapper.
					?>

					<div class="staff-group staff-group--<?php echo esc_attr( $group ); ?>">
						<h2 class="staff-group__role-title"><?php echo esc_html( $value['title'] ); ?></h2>

						<?php
						// Output the list.
						gotham_staff_list( [ 'role' => $group ] );
						// Close the list wrapper.
						?>

					</div>

					<?php
				endforeach;
				?>

			</div>

				<?php
			endif;

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
