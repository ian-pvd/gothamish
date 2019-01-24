<?php
/**
 * Widget API: Gothamish_Widget_Recent_Posts class
 *
 * @package Gothamish
 */

/**
 * Class used to implement the Ads widget.
 *
 * @see WP_Widget
 */
class Gothamish_Widget_Recent_Posts extends WP_Widget_Recent_Posts {
	/**
	 * Customizes the output for the WP Recent Posts widget.
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Recent Posts widget instance.
	 */
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Posts' );

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number ) {
			$number = 5;
		}

		/**
		 * Filters the arguments for the Recent Posts widget.
		 *
		 * @param array $args     An array of arguments used to retrieve the recent posts.
		 * @param array $instance Array of settings for the current widget.
		 */
		$recent_posts = new WP_Query(
			apply_filters(
				'widget_posts_args',
				[
					'posts_per_page'      => $number,
					'no_found_rows'       => true,
					'post_status'         => 'publish',
					'ignore_sticky_posts' => true,
				],
				$instance
			)
		);

		if ( ! $recent_posts->have_posts() ) {
			return;
		}
		?>

		<?php echo $args['before_widget']; ?>

		<?php
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		?>

		<ul class="recent-posts__list">
			<?php while ( $recent_posts->have_posts() ) :
				$recent_posts->the_post();
				?>
				<li class="recent-posts__list-item">
					<?php get_template_part( 'template-parts/content', 'tout' ); ?>
				</li>
			<?php endwhile; ?>
		</ul>

		<?php
		echo $args['after_widget'];
	}

	/**
	 * Overrides the settings form for the WP Recent Posts widget.
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$title  = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
		<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" /></p>
		<?php
	}
}

add_action(
	'widgets_init',
	function() {
		unregister_widget( 'WP_Widget_Recent_Posts' );
		register_widget( 'Gothamish_Widget_Recent_Posts' );
	}
);
