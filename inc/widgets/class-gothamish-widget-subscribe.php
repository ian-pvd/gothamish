<?php
/**
 * Widget API: Gothamish_Widget_Subscribe class
 *
 * @package Gothamish
 */

/**
 * Class used to implement the Subscribe widget.
 *
 * @see WP_Widget
 */
class Gothamish_Widget_Subscribe extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_args = [
			'classname'   => 'widget--gotham-subscribe',
			'description' => 'Gothamish Subscribe widget.',
		];
		parent::__construct( 'gotham_subscribe_widget', __( 'Subscribe Widget', 'gotham' ), $widget_args );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args Widget options array.
	 * @param array $instance The current widget instance.
	 */
	public function widget( $args, $instance ) {
		// Check for background image URL value.
		$background_url = ! empty( $instance['background_url'] ) ? $instance['background_url'] : null;
		// Parse url.
		while ( stristr( $background_url, 'http' ) !== $background_url ) :
			$background_url = substr( $background_url, 1 );
		endwhile;
		// Background URL widget attribute.
		if ( $background_url ) {
			$background_url = 'style="' . esc_attr( 'background-image: url(' . esc_url( $background_url ) . ');' ) . '"';
		}

		echo $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}

		// Widget Contents.
		echo '<div class="widget__wrapper" ' . $background_url . '>';
		echo '<div class="widget__site-logo">' . gotham_logotype() . '</div>';
		// TODO: Replace this echo statement with WP content block.
		echo '<!-- Begin Mailchimp Signup Form -->
			<div id="mc_embed_signup">
			<form action="#" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
			    <div id="mc_embed_signup_scroll">
				<h2>Subscribe to our mailing list</h2>
			<div class="indicates-required"><span class="asterisk">*</span> indicates required</div>
			<div class="mc-field-group">
				<label for="mce-EMAIL">Email Address  <span class="asterisk">*</span>
			</label>
				<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
			</div>
				<div id="mce-responses" class="clear">
					<div class="response" id="mce-error-response" style="display:none"></div>
					<div class="response" id="mce-success-response" style="display:none"></div>
				</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
			    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" tabindex="-1" value=""></div>
			    <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
			    </div>
			</form>
			</div>

			<!--End mc_embed_signup-->';
		echo '</div>';

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
		$background_url = isset( $instance['background_url'] ) ? $instance['background_url'] : '';
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
				<?php esc_html_e( 'Title:', 'gotham' ); ?>

			</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'background_url' ) ); ?>">
				<?php esc_html_e( 'Enter a background image URL here:' ); ?>
			</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'background_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'background_url' ) ); ?>" type="url" value="<?php echo esc_url( $background_url ); ?>" />
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
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['background_url'] = sanitize_text_field( $new_instance['background_url'] );

		return $instance;
	}
}

add_action(
	'widgets_init',
	function() {
		register_widget( 'Gothamish_Widget_Subscribe' );
	}
);
