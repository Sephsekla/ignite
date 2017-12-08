<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Ignite
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function ignite_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

$position = get_theme_mod('sidebar');

if ( $position ) {
	$classes[] = 'sidebar-'.$position;
}

	return $classes;
}
add_filter( 'body_class', 'ignite_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function ignite_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'ignite_pingback_header' );
