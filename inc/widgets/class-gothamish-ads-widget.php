<?php
/**
 * Widget API: Gothamish_Ads_Widget class
 *
 * @package Gothamish
 */

/**
 * Class used to implement the Ads widget.
 *
 * @see WP_Widget
 */
class Gothamish_Ads_Widget extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_args = [
			'classname'   => 'gotham_ads_widget',
			'description' => 'Gothamish Ads widget.',
		];
		parent::__construct( 'gotham_ads_widget', __( 'Ads Widget', 'gotham' ), $widget_args );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args Widget options array.
	 * @param array $instance The current widget instance.
	 */
	public function widget( $args, $instance ) {
		// Ad position generic value.
		$ad_position = 'sidebar';

		echo $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];

			// White title is set, set ad position value.
			$ad_position = sanitize_title( $instance['title'] );
		}

		// Widget Contents.
		if ( '0' !== $instance['ad_size'] ) {
			gotham_ad_slot( $ad_position, $instance['ad_size'] );
		} else {
			gotham_ad_slot( $ad_position );
		}

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
		$title   = isset( $instance['title'] ) ? $instance['title'] : '';
		$ad_size = isset( $instance['ad_size'] ) ? $instance['ad_size'] : '';

		// Ad Sizes Options Array.
		$sizes = [ '300x250', '300x600' ];
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
				<?php esc_html_e( 'Title:', 'gotham' ); ?>

			</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'ad_size' ) ); ?>"><?php esc_html_e( 'Select Ad Size:', 'gotham' ); ?></label>
			<select id="<?php echo esc_attr( $this->get_field_id( 'ad_size' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'ad_size' ) ); ?>">
				<option value="0"><?php esc_html_e( '&mdash; Select &mdash;', 'gotham' ); ?></option>
				<?php foreach ( $sizes as $size ) : ?>
					<option value="<?php echo esc_attr( $size ); ?>" <?php selected( $ad_size, $size ); ?>>
						<?php echo esc_html( $size ); ?>
					</option>
				<?php endforeach; ?>
			</select>
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
		$instance            = $old_instance;
		$instance['title']   = sanitize_text_field( $new_instance['title'] );
		$instance['ad_size'] = sanitize_text_field( $new_instance['ad_size'] );

		return $instance;
	}
}

add_action(
	'widgets_init',
	function() {
		register_widget( 'Gothamish_Ads_Widget' );
	}
);
