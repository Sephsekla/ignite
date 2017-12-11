<?php
/**
 * ignition Theme Customizer
 *
 * @package ignition
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function ignition_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'ignition_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'ignition_customize_partial_blogdescription',
		) );
	}
}
add_action( 'customize_register', 'ignition_customize_register' );



function ignition_layout_options($wp_customize){

	//LAYOUT

	$wp_customize->add_section( 'ignition_layout' , array(
	    'title'      => 'Layout',
	    'priority'   => 30,
	) );

	//Sidebar

	$wp_customize->add_setting( 'sidebar' , array(
    'default'     => false,
    'transport'   => 'refresh',
) );

$wp_customize->add_control( 'sidebar_layout', array(
  'label' => 'Sidebar Position',
  'section' => 'ignition_layout',
  'settings' => 'sidebar',
  'type' => 'radio',
  'choices' => array(
    false => 'No sidebar',
    'left' => 'Left Sidebar',
		'right' => 'Right Sidebar',
  ),
) );

//Hamburger Menu

$wp_customize->add_setting( 'hamburger' , array(
	'default'     => false,
	'transport'   => 'refresh',
) );

$wp_customize->add_control( 'hamburger', array(
'label' => 'Show hamburger on desktop?',
'section' => 'ignition_layout',
'settings' => 'hamburger',
'type' => 'radio',
'choices' => array(
	false => 'Full menu on desktop',
	true => 'Hamburger on desktop',
),
) );

//Banner Image

$wp_customize->add_setting( 'banner' , array(
	'default'     => false,
	'transport'   => 'refresh',
) );

$wp_customize->add_control( 'banner', array(
'label' => 'Featured Image',
'section' => 'header_image',
'settings' => 'banner',
'type' => 'radio',
'choices' => array(
	false => 'Hide Image',
	'wide' => 'Full width banner',
	'narrow' => 'Image in content container',
),
) );


}

add_action( 'customize_register', 'ignition_layout_options' );



/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function ignition_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function ignition_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function ignition_customize_preview_js() {
	wp_enqueue_script( 'ignition-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'ignition_customize_preview_js' );
