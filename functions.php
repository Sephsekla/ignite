<?php
/**
 * ignition functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ignition
 */

if ( ! function_exists( 'ignition_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function ignition_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on ignition, use a find and replace
		 * to change 'ignition' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'ignition', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'ignition' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'ignition_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'ignition_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ignition_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'ignition_content_width', 640 );
}
add_action( 'after_setup_theme', 'ignition_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ignition_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'ignition' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'ignition' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'ignition_widgets_init' );

/**
 * Enqueue scripts and styles.
 */

 function bootstrap_scripts() {


 	wp_enqueue_style( 'bootstrap', "https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css");
wp_enqueue_script( 'popper',  'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js', '', '', true);
 	wp_enqueue_script( 'bootstrap',  'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js',array('jquery'), '', true);


 }

 add_action( 'wp_enqueue_scripts', 'bootstrap_scripts',2 );

function ignition_scripts() {


	wp_enqueue_script( 'jquery-mobile', get_template_directory_uri() . '/lib/jquery.mobile.custom/jquery.mobile.custom.min.js', array('jquery'), '1.4.5', true );

	wp_enqueue_script( 'theme-animations', get_template_directory_uri() . '/js/theme-animations.js', array(), filemtime(get_template_directory() . '/js/theme-animations.js'), true );

	wp_enqueue_script( 'jquery-masonry', '', array('jquery'));

	wp_enqueue_script( 'jquery-match-height', get_template_directory_uri() . '/lib/jquery.matchHeight.js', array('jquery'));


	wp_enqueue_script( 'isotope', 'https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js', array('jquery'));


	//See https://masonry.desandro.com/ for masonry setup details

	wp_enqueue_script( 'ignition-hoverfix', get_template_directory_uri() . '/js/hoverfix.js', array('jquery-mobile','jquery-masonry','isotope','jquery-match-height'), filemtime(get_template_directory() . '/js/hoverfix.js'), true );

	wp_enqueue_script( 'ignition-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'ignition-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );


	/*Ajax Load More*/

	wp_enqueue_script( 'ajax-loadmore', get_template_directory_uri() . '/js/ajax-loadmore.js', array('jquery-mobile','jquery-masonry','isotope','jquery-match-height','ignition-hoverfix'), filemtime(get_template_directory() . '/js/ajax-loadmore.js'), true );

global $wp_query;

if(isset($wp_query->query['paged'])){

	wp_localize_script( 'ajax-loadmore', 'ajaxpagination', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'query_vars' => json_encode( $wp_query->query ),
		'query_page' => $wp_query->query['paged']
	));

}

else{

	wp_localize_script( 'ajax-loadmore', 'ajaxpagination', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'query_vars' => json_encode( $wp_query->query ),
		'query_page' => 1
	));

}


//Fonts

wp_enqueue_script('fontawesome','https://use.fontawesome.com/300bc96cdf.js', '', '', true);

wp_enqueue_style( 'google-font', '//fonts.googleapis.com/css?family=Open+Sans:300,400,700' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	$position = get_theme_mod('sidebar');


	if($position=='left'){

		wp_enqueue_style( 'sidebar', get_template_directory_uri()."layouts/sidebar-content.css" );


	}

	if($position=='right'){

		wp_enqueue_style( 'sidebar', get_template_directory_uri()."/layouts/content-sidebar.css" );


	}

wp_enqueue_style( 'ignition-style', get_stylesheet_uri() );

}
add_action( 'wp_enqueue_scripts', 'ignition_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


//EXAMPLE CPT

add_action( 'init', 'codex_book_init' );
/**
 * Register a book post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function codex_book_init() {
	$labels = array(
		'name'               => _x( 'Books', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Book', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Books', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Book', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'book', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New Book', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New Book', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit Book', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View Book', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All Books', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search Books', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Books:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'No books found.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'No books found in Trash.', 'your-plugin-textdomain' )
	);

	$args = array(
		'labels'             => $labels,
                'description'        => __( 'Description.', 'your-plugin-textdomain' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'book' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	);

	register_post_type( 'book', $args );
}

// hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_book_taxonomies', 0 );

// create two taxonomies, genres and writers for the post type "book"
function create_book_taxonomies() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Genres', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Genre', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Genres', 'textdomain' ),
		'all_items'         => __( 'All Genres', 'textdomain' ),
		'parent_item'       => __( 'Parent Genre', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Genre:', 'textdomain' ),
		'edit_item'         => __( 'Edit Genre', 'textdomain' ),
		'update_item'       => __( 'Update Genre', 'textdomain' ),
		'add_new_item'      => __( 'Add New Genre', 'textdomain' ),
		'new_item_name'     => __( 'New Genre Name', 'textdomain' ),
		'menu_name'         => __( 'Genre', 'textdomain' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'genre' ),
	);

	register_taxonomy( 'genre', array( 'book' ), $args );

	// Add new taxonomy, NOT hierarchical (like tags)
	$labels = array(
		'name'                       => _x( 'Writers', 'taxonomy general name', 'textdomain' ),
		'singular_name'              => _x( 'Writer', 'taxonomy singular name', 'textdomain' ),
		'search_items'               => __( 'Search Writers', 'textdomain' ),
		'popular_items'              => __( 'Popular Writers', 'textdomain' ),
		'all_items'                  => __( 'All Writers', 'textdomain' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Writer', 'textdomain' ),
		'update_item'                => __( 'Update Writer', 'textdomain' ),
		'add_new_item'               => __( 'Add New Writer', 'textdomain' ),
		'new_item_name'              => __( 'New Writer Name', 'textdomain' ),
		'separate_items_with_commas' => __( 'Separate writers with commas', 'textdomain' ),
		'add_or_remove_items'        => __( 'Add or remove writers', 'textdomain' ),
		'choose_from_most_used'      => __( 'Choose from the most used writers', 'textdomain' ),
		'not_found'                  => __( 'No writers found.', 'textdomain' ),
		'menu_name'                  => __( 'Writers', 'textdomain' ),
	);

	$args = array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'writer' ),
	);

	register_taxonomy( 'writer', 'book', $args );
}

//Image Sizes

add_action( 'after_setup_theme', 'ignition_thumbnails' );
function ignition_thumbnails() {
    add_image_size( 'banner', 1600, 500, true );
		add_image_size( 'square', 900, 900, true );
		add_image_size( 'medium-crop', 900, 500, true );
		add_image_size( 'medium', 900, 500, false );

}

function RemoveAddMediaButtonsForNonAdmins(){
    if ( !current_user_can( 'manage_options' ) || true) {
        remove_action( 'media_buttons', 'media_buttons' );
    }
}
add_action('admin_head', 'RemoveAddMediaButtonsForNonAdmins');


//TESTING

add_shortcode('mgallery',function(){

	$images = get_post_meta(get_the_ID(),'gallery');

	$images = $images[0];

	return mgallery($images,false,true);


});
