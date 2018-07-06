<?php

/**
 * Registers options with the default WP Theme Customizer
 * Use this file to customise options, remove or add controls.
 * $wp_customize calls go in this document.
 */
function tcx_register_theme_customizer( $wp_customize ) {

  // Uncomment the below lines to remove the default customize sections 

 // $wp_customize->remove_section('title_tagline');
 // $wp_customize->remove_section('colors');
 // $wp_customize->remove_section('static_front_page');
 // $wp_customize->remove_section('nav');
 
 // Remove dafulat backgroup image upload option section
 $wp_customize->remove_section('background_image');

 // Uncomment the below lines to remove the default controls
 // $wp_customize->remove_control('blogdescription');
  
 // Uncomment the following to change the default section titles
 // $wp_customize->get_section('colors')->title = __( 'Theme Colors' );
 // $wp_customize->get_section('background_image')->title = __( 'Images' );

	$wp_customize->add_setting(
		'tcx_link_color',
		array(
			'default'     => '#000000',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'   => 'postMessage'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'link_color',
			array(
			    'label'      => 'Link Color',
			    'section'    => 'colors',
			    'settings'   => 'tcx_link_color'
			)
		)
	);

	/*-----------------------------------------------------------*
	 * Defining our own 'Display Options' section
	 *-----------------------------------------------------------*/

	$wp_customize->add_section(
		'tcx_display_options',
		array(
			'title'     => 'Display Options',
			'priority'  => 200
		)
	);

	$wp_customize->add_setting(
		'tcx_toggle_sticky2',
		array(
			'default'    		=> 'true',
			//'sanitize_callback' => 'sanitize_options',
			'transport'          => 'postMessage'
		)
	);

	$wp_customize->add_control(
		'tcx_toggle_sticky2',
		array(
			'section'   => 'tcx_display_options',
			'label'     => 'Disable Sticky Header',
			'type'      => 'checkbox'
		)
	);

	/* Display Telephone Number */
	// Does not show if empty
	// Use this in the template to output this setting: echo get_theme_mod( 'tcx_telephone_number_text' );
	$wp_customize->add_setting(
		'tcx_telephone_number_text',
		array(
			'default'            => '',
			//'sanitize_callback'  => 'tcx_sanitize_tel',
			'transport'          => 'postMessage'
		)
	);
	
	$wp_customize->add_control(
		'tcx_telephone_number_text',
		array(
			'section'  => 'tcx_display_options',
			'label'    => 'Telephone Number',
			'type'     => 'text'
		)
	);

	
	/* Display Email */
	// Does not show if empty
	// Use this in the template to output this setting: echo get_theme_mod( 'tcx_email_text' );
	$wp_customize->add_setting(
		'tcx_email_text',
		array(
			'default'            => '',
			//'sanitize_callback'  => 'tcx_sanitize_tel',
			'transport'          => 'postMessage'
		)
	);
	
	$wp_customize->add_control(
		'tcx_email_text',
		array(
			'section'  => 'tcx_display_options',
			'label'    => 'Email',
			'type'     => 'textarea'
		)
	);
	
	
	
	/* Display Disclaimer Text */
	// Does not show if empty
	// Use this in the template to output this setting: echo get_theme_mod( 'tcx_disclaimer_text' );
	$wp_customize->add_setting(
		'tcx_disclaimer_text',
		array(
			'default'            => '',
			'transport'          => 'postMessage'
		)
	);

	$wp_customize->add_control(
		'tcx_disclaimer_text',
		array(
			'section'  => 'tcx_display_options',
			'label'    => 'Disclaimer Text',
			'type'     => 'textarea'
		)
	);

	/*-----------------------------------------------------------*
	 * Defining our own 'Advanced Options' section
	 *-----------------------------------------------------------*/

	$wp_customize->add_section(
		'tcx_advanced_options',
		array(
			'title'     => 'Advanced Options',
			'priority'  => 201
		)
	);

	/* Background Image */
	$wp_customize->add_setting(
		'tcx_background_image',
		array(
		    'default'      => '',
		    'sanitize_callback' => 'esc_url_raw',
		    'transport'    => 'postMessage'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'tcx_background_image',
			array(
			    'label'    => 'Background Image',
			    'settings' => 'tcx_background_image',
			    'section'  => 'tcx_advanced_options'
			)
		)
	);

} // end tcx_register_theme_customizer
add_action( 'customize_register', 'tcx_register_theme_customizer' );


// Logo upload	
function themename_custom_logo_setup() {
    $defaults = array(
        // 'height'      => 100,
        // 'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
    );
    add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'themename_custom_logo_setup' );


/**
 * Sanitizes the incoming input and returns it prior to serialization.
 *
 * @param      string    $input    The string to sanitize
 * @return     string              The sanitized string
 */
function tcx_toggle_sticky( $input ) {
	return strip_tags( stripslashes( $input ) );
} // end tcx_toggle_sticky

/**
 * Writes styles out the `<head>` element of the page based on the configuration options
 * saved in the Theme Customizer.
 */
function tcx_customizer_css() {
?>
	 <style type="text/css">
	     a { color: <?php echo get_theme_mod( 'tcx_link_color' ); ?>; }
	 </style>
<?php
		
} // end tcx_customizer_css


		if( false === get_theme_mod( 'tcx_toggle_sticky2' ) ) {
			// Run code to add sticky class
			add_filter( 'body_class','my_body_classes' );
			function my_body_classes( $classes ) {
			 
			    $classes[] = 'sticky';
			     
			    return $classes;
			     
			}
		} // end if

add_action( 'wp_head', 'tcx_customizer_css' );

/**
 * Registers the Theme Customizer Preview with WordPress.
 *
 */
function tcx_customizer_live_preview() {

	wp_enqueue_script(
		'tcx-theme-customizer',
		get_template_directory_uri() . '/js/theme-customizer.js',
		array( 'jquery', 'customize-preview' ),
		'1.0.0',
		true
	);

} // end tcx_customizer_live_preview
add_action( 'customize_preview_init', 'tcx_customizer_live_preview' );
