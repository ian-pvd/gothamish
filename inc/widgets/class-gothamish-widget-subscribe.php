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

		// Check for MailChimp fields
		// See: https://mailchimp.com/help/host-your-own-signup-forms/ for more info.
		$form_fields = [];
		if ( ! empty( $instance['form_action'] ) && ! empty( $instance['form_user_id'] ) && ! empty( $instance['form_list_id'] ) ) {
			$form_fields = [
				'action'  => $instance['form_action'],
				'user_id' => $instance['form_user_id'],
				'list_id' => $instance['form_list_id'],
			];
		}

		echo $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}

		// Widget Contents.
		echo '<div class="widget__wrapper" ' . $background_url . '>';
		echo '<div class="widget__site-logo">' . gotham_logotype() . '</div>';

		if ( ! empty( $form_fields ) ) {
			echo '
				<form action="' . esc_url( $form_fields['action'] ) . '" method="post" name="widget-subscribe-form" target="_blank">
					<input type="hidden" name="u" value="' . esc_attr( $form_fields['user_id'] ) . '">
					<input type="hidden" name="id" value="' . esc_attr( $form_fields['list_id'] ) . '">
					<h2>Subscribe to our mailing list</h2>
					<div class="field-group">
						<label class="screen-reader-text" for="EMAIL">Email Address</label>
						<input type="email" autocapitalize="off" autocorrect="off" name="MERGE0" id="MERGE0" value="" class="email" placeholder="Email Address">
					</div>
					<div>
						<input type="submit" value="Subscribe" name="subscribe" class="button">
					</div>
				</form>';
		} else {
			echo '<a href="' . esc_url( home_url( 'subscribe' ) ) . '" class="link-button">Subscribe</a>';
		}

		echo '</div><!-- .widget__wrapper -->';

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
		$title          = isset( $instance['title'] ) ? $instance['title'] : '';
		$background_url = isset( $instance['background_url'] ) ? $instance['background_url'] : '';
		$form_action    = isset( $instance['form_action'] ) ? $instance['form_action'] : '';
		$form_user_id   = isset( $instance['form_user_id'] ) ? $instance['form_user_id'] : '';
		$form_list_id   = isset( $instance['form_list_id'] ) ? $instance['form_list_id'] : '';
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
		<p style="margin: 2em 0 1em; padding-top: 1em; border-top: 1px solid #DDD; line-height: 1.667em;">
			This subscribe widget can display a MailChimp signup form. For more information on how to fill out these fields, see <a href="https://mailchimp.com/help/host-your-own-signup-forms/" target="_blank">Hosting Your Own Signup Forms</a> in the MailChimp Guides and Tutorials. If left blank, this widget will link to your <code>/subscribe</code> page.
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'form_action' ) ); ?>">
				<?php esc_html_e( 'Enter the form action (destination) URL here:' ); ?>
			</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'form_action' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'form_action' ) ); ?>" type="url" value="<?php echo esc_url( $form_action ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'form_user_id' ) ); ?>">
				<?php esc_html_e( 'Enter your MailChimp user ID here:' ); ?>
			</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'form_user_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'form_user_id' ) ); ?>" type="text" value="<?php echo esc_url( $form_user_id ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'form_list_id' ) ); ?>">
				<?php esc_html_e( 'Enter your mailing list ID here:' ); ?>
			</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'form_list_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'form_list_id' ) ); ?>" type="text" value="<?php echo esc_url( $form_list_id ); ?>" />
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
		$instance['form_action'] = sanitize_text_field( $new_instance['form_action'] );
		$instance['form_user_id'] = sanitize_text_field( $new_instance['form_user_id'] );
		$instance['form_list_id'] = sanitize_text_field( $new_instance['form_list_id'] );

		return $instance;
	}
}

add_action(
	'widgets_init',
	function() {
		register_widget( 'Gothamish_Widget_Subscribe' );
	}
);
