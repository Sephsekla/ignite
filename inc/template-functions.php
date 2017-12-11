<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package ignition
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function ignition_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

$position = get_theme_mod('sidebar');

if ( $position ) {
	$classes[] = 'sidebar-'.$position;


}

$hamburger = get_theme_mod('hamburger');

if ( $hamburger ) {
	$classes[] = 'has_burger';
}

else{
	$classes[] = 'no_burger';
}

	return $classes;
}
add_filter( 'body_class', 'ignition_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function ignition_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'ignition_pingback_header' );




if(get_theme_mod('banner')=='narrow'){

	add_filter('the_content',function($content){return get_the_post_thumbnail(get_the_id()).$content;},10);


}
