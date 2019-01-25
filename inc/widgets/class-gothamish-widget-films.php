<?php
/**
 * Widget API: Gothamish_Widget_Films class
 *
 * @package Gothamish
 */

/**
 * Class used to implement the Gothamish Films widget.
 *
 * @see WP_Widget
 */
class Gothamish_Widget_Films extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_args = [
			'classname'   => 'widget--gothamish-films',
			'description' => 'Displays a Gothamish Films post.',
		];
		parent::__construct( 'gotham_films_widget', __( 'Gothamish Films Widget', 'gotham' ), $widget_args );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args Widget options array.
	 * @param array $instance The current widget instance.
	 */
	public function widget( $args, $instance ) {
		$films_post = new WP_Query(
			[
				'posts_per_page'      => 1,
				'no_found_rows'       => true,
				'post_status'         => 'publish',
				'ignore_sticky_posts' => true,
				'tag'                 => 'gothamish-films',
			]
		);

		if ( ! $films_post->have_posts() ) {
			return;
		}

		echo $args['before_widget'];

		// Output special title banner.
		gotham_tag_banner( 'gothamish-films' );

		// Widget contents, loop of 1 films post.
		while ( $films_post->have_posts() ) :
			$films_post->the_post();

			get_template_part( 'template-parts/content', 'tout' );

		endwhile;

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
		$title = isset( $instance['title'] ) ? $instance['title'] : '';

		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
				<?php esc_html_e( 'Title:', 'gotham' ); ?>

			</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
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
		register_widget( 'Gothamish_Widget_Films' );
	}
);
