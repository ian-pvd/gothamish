<?php
/**
 * Widget API: Gothamish_Widget_Best_Of class
 *
 * @package Gothamish
 */

/**
 * Class used to implement the Gothamish Best Of widget.
 *
 * @see WP_Widget
 */
class Gothamish_Widget_Best_Of extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_args = [
			'classname'   => 'widget--best-of',
			'description' => 'Displays Best of Gothamish posts.',
		];
		parent::__construct( 'gotham_best_of_widget', __( 'Best Of Widget', 'gothamish' ), $widget_args );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args Widget options array.
	 * @param array $instance The current widget instance.
	 */
	public function widget( $args, $instance ) {
		// Get the number of posts to show.
		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 3;
		if ( ! $number ) {
			$number = 3;
		}

		$best_of_posts = new WP_Query(
			[
				'posts_per_page'      => $number,
				'no_found_rows'       => true,
				'post_status'         => 'publish',
				'ignore_sticky_posts' => true,
				'tag'                 => 'best-of',
			]
		);

		if ( ! $best_of_posts->have_posts() ) {
			return;
		}

		echo $args['before_widget'];

		// Output special title banner.
		gotham_tag_banner( 'best-of' );
		?>

		<ul class="posts-list">

		<?php
		// Widget contents, loop of "best of" posts.
		while ( $best_of_posts->have_posts() ) :
			$best_of_posts->the_post();
			?>
			<li class="posts-list__item">
				<?php get_template_part( 'template-parts/content', 'tout' ); ?>
			</li>

		<?php endwhile; ?>

		</ul>

		<?php

		echo $args['after_widget'];
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options.
	 */
	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );

		// Widget field values.
		$title  = isset( $instance['title'] ) ? $instance['title'] : '';
		$number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 3;

		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
				<?php esc_html_e( 'Title:', 'gothamish' ); ?>

			</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of posts to show:', 'gothamish' ); ?></label>
		<input class="tiny-text" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="number" step="1" min="1" value="<?php echo esc_attr( $number ); ?>" size="3" /></p>
		<?php
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options.
	 * @param array $old_instance The previous options.
	 *
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$instance          = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );

		return $instance;
	}
}

add_action(
	'widgets_init',
	function() {
		register_widget( 'Gothamish_Widget_Best_Of' );
	}
);
