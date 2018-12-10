<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package crumbs
 * @since 1.0.0
 */

if ( ! is_active_sidebar( 'sidebar-footer' ) ) {
	return;
}
?>

<aside id="tertiary" class="widget-area" role="complementary">
	<div class="container">
		<?php dynamic_sidebar( 'sidebar-footer' ); ?>
	</div>
</aside><!-- #secondary -->
