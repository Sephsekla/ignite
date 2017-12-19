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

function display_logo(string $html){

if(get_theme_mod('logo-svg')){

	$html = sprintf( '<a href="%1$s" class="custom-logo-link" rel="home" itemprop="url">%2$s</a>',
	            esc_url( home_url( '/' ) ),
	            file_get_contents(get_stylesheet_directory_uri()."/inc/logo.svg")
	        );
return $html;
}

else{

return $html;

}

}

add_filter('get_custom_logo','display_logo',100,1);

/*Ajax Load More*/

add_action( 'wp_ajax_nopriv_ajax_pagination', 'my_ajax_pagination' );
add_action( 'wp_ajax_ajax_pagination', 'my_ajax_pagination' );

function my_ajax_pagination() {
	$query_vars = json_decode( stripslashes( $_POST['query_vars'] ), true );
	$query_page = json_decode( stripslashes( $_POST['query_page'] ), true );

	    $query_vars['paged'] = $query_page;


	    $posts = new WP_Query( $query_vars );
	    $GLOBALS['wp_query'] = $posts;

			//print_r($GLOBALS['wp_query']);


	    if( ! $posts->have_posts() ) {
	        get_template_part( 'content', 'none' );
	    }



	    else {
	        while ( $posts->have_posts() ) {
	            $posts->the_post();
							get_template_part( 'template-parts/content', 'masonry' );
	        }
	    }


	    die();
}
