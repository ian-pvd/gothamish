<?php
/**
 * The sidebar containing the widget area for pages
 *
 * @package Gothamish
 */

if ( ! is_active_sidebar( 'sidebar-page' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area widget-area--sidebar-page">
	<?php dynamic_sidebar( 'sidebar-page' ); ?>
</aside><!-- #secondary -->
