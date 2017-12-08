<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Ignite
 */

$position = get_theme_mod('sidebar');

if ( ! is_active_sidebar( 'sidebar-1' ) || !$position) {
	return;
}





?>

<aside id="secondary" class="widget-area">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
 
