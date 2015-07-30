<?php
/**
 * Daphnee Theme Customizer
 *
 * @package Daphnee
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function daphnee_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'daphnee_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function daphnee_customize_preview_js() {
	wp_enqueue_script( 'daphnee_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'daphnee_customize_preview_js' );

/**
 * Add some custom CSS to the customizer screen.
 */
function daphnee_customizer_css() { ?>
	<style>
	#customize-control-layout.customize-control-radio-image .image.ui-buttonset label {
		max-width: 29%;
	}
	#customize-control-layout.customize-control-radio-image .image.ui-buttonset label img {
		width: 100%;
		height: auto;
	}
	</style>
	<?php
}
add_action( 'customize_controls_print_styles', 'daphnee_customizer_css' );

/**
 * Check that Kirki exists before proceeding
 */
if ( class_exists( 'Kirki' ) ) {

	/**
	 * Add the configuration for the Daphnee Theme
	 */
	Kirki::add_config( 'daphnee', array(
		'capability'  => 'edit_theme_options',
		'option_type' => 'theme_mod',
	) );

	/**
	 * Add the "layout" section
	 */
	Kirki::add_section( 'layout', array(
		'title'       => __( 'Layout', 'daphnee' ),
		'description' => __( 'Configure your layout options' ),
	) );

	Kirki::add_field( 'daphnee', array(
	    'type'        => 'radio-image',
	    'settings'    => 'layout',
	    'label'       => __( 'Layout', 'daphnee' ),
	    'section'     => 'layout',
	    'default'     => '',
	    'priority'    => 10,
	    'choices'     => array(
	        'full-screen'   => trailingslashit( get_template_directory_uri() ) . 'inc/kirki/assets/images/1c.png',
			'left-sidebar'  => trailingslashit( get_template_directory_uri() ) . 'inc/kirki/assets/images/2cl.png',
			'right-sidebar' => trailingslashit( get_template_directory_uri() ) . 'inc/kirki/assets/images/2cr.png',
	    ),
	) );

	Kirki::add_field( 'daphnee', array(
		'type'        => 'slider',
		'settings'    => 'site_max_width',
		'label'       => __( 'Max Width', 'daphnee' ),
		'description' => __( 'Select the max-width for the main content area.', 'daphnee' ),
		'section'     => 'layout',
		'default'     => 1020,
		'priority'    => 15,
		'choices'     => array(
			'min'  => 420,
			'max'  => 1600,
			'step' => 1
		),
		'output'      => array(
			'element'  => '#content.row',
			'property' => 'max-width',
			'units'    => 'px',
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
	        array(
	            'element'  => '#content.row',
	            'function' => 'css',
	            'property' => 'max-width',
				'units'    => 'px',
	        ),
		),
	) );

	Kirki::add_field( 'daphnee', array(
		'type'        => 'radio-buttonset',
		'settings'    => 'sidebar_width',
		'label'       => __( 'Sidebar Width (1-12 columns)', 'daphnee' ),
		'section'     => 'layout',
		'default'     => '4',
		'priority'    => 10,
		'choices'     => array(
			'3' => __( 'Narrow', 'daphnee' ),
			'4' => __( 'Default', 'daphnee' ),
			'5' => __( 'Wide', 'daphnee' ),
		),
		'required'    => array(
			array(
				'setting'  => 'layout',
				'operator' => '!=',
				'value'    => 'full-screen',
			)
		)
	) );

}
