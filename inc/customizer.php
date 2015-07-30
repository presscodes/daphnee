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
	.customize-control-slider input[type="text"] {
		background: transparent;
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

	/*******************************
	 * LAYOUT SECTION & OPTIONS
	 ******************************/
	Kirki::add_section( 'layout', array(
		'title'       => __( 'Layout', 'daphnee' ),
		'description' => __( 'Configure your layout options' ),
		'priority'    => 10,
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
			array(
				'element'  => '#content.row',
				'property' => 'max-width',
				'units'    => 'px',
			),
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

	/*******************************
	 * TYPOGRAPHY PANEL, SECTION & OPTIONS
	 ******************************/
	Kirki::add_panel( 'typography', array(
		'priority' => 11,
		'title'       => __( 'Typography', 'daphnee' ),
		'description' => __( 'Typography options for this site', 'daphnee' ),
	) );

	Kirki::add_section( 'typography_base', array(
		'title'       => __( 'Base Typography', 'daphnee' ),
		'description' => __( 'Edit the global typography options for your site', 'dephnee' ),
		'panel'       => 'typography',
	) );

	Kirki::add_section( 'typography_headers', array(
		'title'       => __( 'Headers Typography', 'daphnee' ),
		'description' => __( 'Edit the headers typography options for your site', 'dephnee' ),
		'panel'       => 'typography',
	) );

	Kirki::add_field( 'daphnee', array(
		'type'        => 'slider',
		'settings'    => 'base_font_size',
		'label'       => __( 'Font Size', 'daphnee' ),
		'description' => __( 'Select the base font-size for your site. (The value below is in em\'s)', 'dephnee' ),
		'section'     => 'typography_base',
		'default'     => 1,
		'priority'    => 1,
		'choices'     => array(
			'min'  => .6,
			'max'  => 3,
			'step' => .01
		),
		'output'      => array(
			array(
				'element'  => 'body',
				'property' => 'font-size',
				'units'    => 'em',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
	        array(
	            'element'  => 'body',
	            'function' => 'css',
	            'property' => 'font-size',
				'units'    => 'em',
	        ),
		),
	) );

	Kirki::add_field( 'daphnee', array(
		'type'        => 'slider',
		'settings'    => 'base_font_size_side',
		'label'       => __( 'Sidebar Base Font Size', 'daphnee' ),
		'description' => __( 'Select the base font-size for your site. (The value below is in em\'s)', 'dephnee' ),
		'section'     => 'typography_base',
		'default'     => .9,
		'priority'    => 1,
		'choices'     => array(
			'min'  => .6,
			'max'  => 3,
			'step' => .01
		),
		'output'      => array(
			array(
				'element'  => 'body #secondary',
				'property' => 'font-size',
				'units'    => 'em',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
	        array(
	            'element'  => 'body',
	            'function' => 'css',
	            'property' => 'font-size',
				'units'    => 'em',
	        ),
		),
	) );

	Kirki::add_field( 'daphnee', array(
	    'type'     => 'select2',
	    'settings'  => 'base_font_family',
	    'label'    => __( 'Font Family', 'daphnee' ),
	    'section'  => 'typography_base',
	    'default'  => 'Roboto',
	    'priority' => 20,
	    'choices'  => Kirki_Fonts::get_font_choices(),
	    'output' => array(
	        'element'  => 'body',
	        'property' => 'font-family',
	    ),
	) );

	Kirki::add_field( 'daphnee', array(
	    'type'     => 'multicheck',
	    'settings'  => 'base_font_subsets',
	    'label'    => __( 'Google-Font subsets', 'daphnee' ),
	    'description' => __( 'The subsets used from Google\'s API.', 'daphnee' ),
	    'section'  => 'typography_base',
	    'default'  => 'all',
	    'priority' => 22,
	    'choices'  => Kirki_Fonts::get_google_font_subsets(),
	    'output' => array(
			array(
		        'element'  => 'body',
		        'property' => 'font-subset',
		    ),
		),
	) );

	Kirki::add_field( 'daphnee', array(
	    'type'     => 'slider',
	    'settings'  => 'base_typography_font_weight',
	    'label'    => __( 'Font Weight', 'daphnee' ),
	    'section'  => 'typography_base',
	    'default'  => 300,
	    'priority' => 24,
	    'choices'  => array(
	        'min'  => 100,
	        'max'  => 900,
	        'step' => 100,
	    ),
	    'output' => array(
			array(
		        'element'  => 'body',
		        'property' => 'font-weight',
		    ),
		),
	) );

	Kirki::add_field( 'daphnee', array(
		'type'        => 'slider',
		'settings'    => 'headers_font_size',
		'label'       => __( 'Font Size', 'daphnee' ),
		'description' => __( 'Select the base font-size for your site. This is the font-size of <h4> elements. The others are automatically calculated based on this value (the value below is in em\'s)', 'dephnee' ),
		'section'     => 'typography_headers',
		'default'     => 1,
		'priority'    => 1,
		'choices'     => array(
			'min'  => .6,
			'max'  => 3,
			'step' => .01
		),
		'output'      => array(
			array(
				'element'           => 'h1',
				'property'          => 'font-size',
				'units'             => 'em',
				'sanitize_callback' => 'daphnee_h1_sanitize_size'
			),
			array(
				'element'           => 'h2',
				'property'          => 'font-size',
				'units'             => 'em',
				'sanitize_callback' => 'daphnee_h2_sanitize_size'
			),
			array(
				'element'           => 'h3',
				'property'          => 'font-size',
				'units'             => 'em',
				'sanitize_callback' => 'daphnee_h3_sanitize_size'
			),
			array(
				'element'           => 'h4',
				'property'          => 'font-size',
				'units'             => 'em',
				'sanitize_callback' => 'daphnee_h4_sanitize_size'
			),
			array(
				'element'           => 'h5',
				'property'          => 'font-size',
				'units'             => 'em',
				'sanitize_callback' => 'daphnee_h5_sanitize_size'
			),
			array(
				'element'           => 'h6',
				'property'          => 'font-size',
				'units'             => 'em',
				'sanitize_callback' => 'daphnee_h6_sanitize_size'
			),
		),
	) );

	/*******************************
	 * COLORS
	 ******************************/
	Kirki::add_field( 'daphnee', array(
		'type'        => 'color',
		'settings'    => 'links_color',
		'label'       => __( 'Links Color', 'daphnee' ),
		'description' => __( 'Select the main color for your site\s links', 'daphnee' ),
		'default'     => '#00BCD4',
		'section'     => 'colors',
		'output'      => array(
			array(
				'element'  => 'a, a:visited',
				'property' => 'color',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => 'a, a:visited',
				'function' => 'css',
				'property' => 'color',
			)
		)
	) );

}

function daphnee_h1_sanitize_size( $value ) {
	return ( 2 * $value );
}

function daphnee_h2_sanitize_size( $value ) {
	return ( 1.5 * $value );
}

function daphnee_h3_sanitize_size( $value ) {
	return ( 1.17 * $value );
}

function daphnee_h4_sanitize_size( $value ) {
	return ( 1 * $value );
}

function daphnee_h5_sanitize_size( $value ) {
	return ( .83 * $value );
}

function daphnee_h6_sanitize_size( $value ) {
	return ( .67 * $value );
}
