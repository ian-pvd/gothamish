<?php
/**
 * Widget API: Gothamish_Widget_RSS class
 *
 * @package Gothamish
 */

/**
 * Class for extending the default WordPress RSS widget.
 *
 * @see  WP_Widget
 */
class Gothamish_Widget_RSS extends WP_Widget_RSS {
	/**
	 * Outputs custom content for the Gothamish RSS widget.
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current RSS widget instance.
	 */
	public function widget( $args, $instance ) {
		if ( isset( $instance['error'] ) && $instance['error'] ) {
			return;
		}

		$url = ! empty( $instance['url'] ) ? $instance['url'] : '';

		while ( stristr( $url, 'http' ) !== $url ) {
			$url = substr( $url, 1 );
		}

		if ( empty( $url ) ) {
			return;
		}

		// self-url destruction sequence.
		if ( in_array( untrailingslashit( $url ), array( site_url(), home_url() ) ) ) {
			return;
		}

		$rss   = fetch_feed( $url );
		$title = $instance['title'];
		$desc  = '';
		$link  = '';

		if ( ! is_wp_error( $rss ) ) {
			$desc = esc_attr( strip_tags( @html_entity_decode( $rss->get_description(), ENT_QUOTES, get_option( 'blog_charset' ) ) ) );
			if ( empty( $title ) ) {
				$title = strip_tags( $rss->get_title() );
			}
			$link = strip_tags( $rss->get_permalink() );
			while ( stristr( $link, 'http' ) !== $link ) {
				$link = substr( $link, 1 );
			}
		}

		if ( empty( $title ) ) {
			$title = ! empty( $desc ) ? $desc : __( 'Unknown Feed' );
		}

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$url = wp_strip_all_tags( $url );
		$icon = includes_url( 'images/rss.png' );
		if ( $title ) {
			$title = '<a class="rsswidget" href="' . esc_url( $url ) . '"><img class="rss-widget-icon" style="border:0" width="14" height="14" src="' . esc_url( $icon ) . '" alt="RSS" /></a> <a class="rsswidget" href="' . esc_url( $link ) . '">' . esc_html( $title ) . '</a>';
		}

		echo $args['before_widget'];
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		gotham_widget_rss_output( $rss, $instance );
		echo $args['after_widget'];

		if ( ! is_wp_error( $rss ) ) {
			$rss->__destruct();
		}
		unset( $rss );
	}
}

/**
 * Custom function to display the RSS entries in a list.
 *
 * @param string|array|object $rss RSS url.
 * @param array $args Widget arguments.
 */
function gotham_widget_rss_output( $rss, $args = array() ) {
	if ( is_string( $rss ) ) {
		$rss = fetch_feed( $rss );
	} elseif ( is_array( $rss ) && isset( $rss['url'] ) ) {
		$args = $rss;
		$rss = fetch_feed( $rss['url'] );
	} elseif ( ! is_object( $rss ) ) {
		return;
	}

	if ( is_wp_error( $rss ) ) {
		if ( is_admin() || current_user_can( 'manage_options' ) ) {
			echo '<p><strong>' . esc_html__( 'RSS Error:', 'gothamish' ) . '</strong> ' . $rss->get_error_message() . '</p>';
		}
		return;
	}

	$default_args = [
		'show_author'  => 0,
		'show_date'    => 0,
		'show_summary' => 0,
		'items'        => 0,
	];
	$args = wp_parse_args( $args, $default_args );

	$items = (int) $args['items'];
	if ( $items < 1 || 20 < $items ) {
		$items = 10;
	}
	$show_summary = (int) $args['show_summary'];
	$show_author  = (int) $args['show_author'];
	$show_date    = (int) $args['show_date'];
	// RSS widgets are old, adding options to widget admin forms isn't necissary.
	$show_image = true;

	if ( ! $rss->get_item_quantity() ) {
		echo '<ul><li>' . esc_html__( 'An error has occurred, which probably means the feed is down. Try again later.', 'gothamish' ) . '</li></ul>';
		$rss->__destruct();
		unset( $rss );
		return;
	}

	echo '<ul>';
	foreach ( $rss->get_items( 0, $items ) as $item ) {
		$link = $item->get_link();
		while ( stristr( $link, 'http' ) != $link ) {
			$link = substr( $link, 1 );
		}
		$link = esc_url( strip_tags( $link ) );

		$title = esc_html( trim( strip_tags( $item->get_title() ) ) );
		if ( empty( $title ) ) {
			$title = __( 'Untitled' );
		}

		$desc = @html_entity_decode( $item->get_description(), ENT_QUOTES, get_option( 'blog_charset' ) );
		$desc = esc_attr( wp_trim_words( $desc, 25, ' [&hellip;]' ) );

		$summary = '';
		if ( $show_summary ) {
			$summary = $desc;

			// Change existing [...] to [&hellip;].
			if ( '[...]' == substr( $summary, -5 ) ) {
				$summary = substr( $summary, 0, -5 ) . '[&hellip;]';
			}

			$summary = '<div class="rssSummary">' . esc_html( $summary ) . '</div>';
		}

		$date = '';
		if ( $show_date ) {
			$date = $item->get_date( 'U' );

			if ( $date ) {
				$date = ' <span class="rss-date">' . date_i18n( get_option( 'date_format' ), $date ) . '</span>';
			}
		}

		$author = '';
		if ( $show_author ) {
			$author = $item->get_author();
			if ( is_object( $author ) ) {
				$author = $author->get_name();
				$author = ' <cite>' . esc_html( strip_tags( $author ) ) . '</cite>';
			}
		}

		$image = '';
		if ( $show_image ) {
			// Get Open Graph image for RSS link.
			$image = OpenGraph::fetch( $link );
			// If object returned...
			if ( is_object( $image ) ) {
				// Shift to image URL in Open Graph object.
				$image = $image->image;
				// If the image field isn't empty...
				if ( ! empty( $image ) ) {
					// Add it to an image tag.
					$image = '<img src="' . $image . '" class="rsswidget__image">';
				}
			}
			if ( '' !== $link ) {
				$image = '<a href="' . $link . '" class="rsswidget__image-frame">' . $image . '</a>';
			} else {
				$image = '<div class="rsswidget__image-frame">' . $image . '</div>';
			}
		}

		if ( '' === $link ) {
			echo "<li>$title{$date}{$summary}{$author}</li>";
		} elseif ( $show_summary ) {
			echo "<li>$image<a class='rsswidget' href='$link'>$title</a>{$date}{$summary}{$author}</li>";
		} else {
			echo "<li><a class='rsswidget' href='$link'>$title</a>{$date}{$author}</li>";
		}
	}
	echo '</ul>';
	$rss->__destruct();
	unset( $rss );
}

add_action(
	'widgets_init',
	function() {
		unregister_widget( 'WP_Widget_RSS' );
		register_widget( 'Gothamish_Widget_RSS' );
	}
);
