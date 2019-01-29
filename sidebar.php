<?php
/**
 * The sidebar containing the widget area for posts
 *
 * @package Gothamish
 */

if ( ! is_active_sidebar( 'sidebar-single' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area widget-area--sidebar-single">
	<?php dynamic_sidebar( 'sidebar-single' ); ?>
</aside><!-- #secondary -->
