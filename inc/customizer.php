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
		'description' => __( 'Configure your layout options', 'daphnee' ),
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
				'element'  => '#content.row, #masthead .row',
				'property' => 'max-width',
				'units'    => 'px',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '#content.row, #masthead .row',
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
				'element'  => 'body #primary, header#masthead',
				'property' => 'font-size',
				'units'    => 'em',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => 'body #primary, header#masthead',
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
				'element'  => 'body #secondary',
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
				'sanitize_callback' => array( 'Daphnee_Customizer', 'h1_sanitize_size' ),
			),
			array(
				'element'           => 'h2',
				'property'          => 'font-size',
				'units'             => 'em',
				'sanitize_callback' => array( 'Daphnee_Customizer', 'h2_sanitize_size' ),
			),
			array(
				'element'           => 'h3',
				'property'          => 'font-size',
				'units'             => 'em',
				'sanitize_callback' => array( 'Daphnee_Customizer', 'h3_sanitize_size' ),
			),
			array(
				'element'           => 'h4',
				'property'          => 'font-size',
				'units'             => 'em',
				'sanitize_callback' => array( 'Daphnee_Customizer', 'h4_sanitize_size' ),
			),
			array(
				'element'           => 'h5',
				'property'          => 'font-size',
				'units'             => 'em',
				'sanitize_callback' => array( 'Daphnee_Customizer', 'h5_sanitize_size' ),
			),
			array(
				'element'           => 'h6',
				'property'          => 'font-size',
				'units'             => 'em',
				'sanitize_callback' => array( 'Daphnee_Customizer', 'h6_sanitize_size' ),
			),
		),
	) );

	if ( ! Daphnee()->is_plus ) {
		Kirki::add_field( 'daphnee', array(
			'type'        => 'custom',
			'settings'    => 'headers_typography_plus',
			'label'       => '',
			'section'     => 'typography_headers',
			'default'     => Daphnee_Customizer::update_info_wrapper( __( 'Plus Options', 'daphnee' ), __( 'Get extra options for headers typography: Font family, separate font-size & font-weight per header (h1, h2, h3, h4, h5 & h6)', 'daphnee' ) ),
			'priority'    => 99,
		) );
	}

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
				'element'  => 'a, a:visited, a:hover',
				'property' => 'color',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => 'a, a:visited, a:hover',
				'function' => 'css',
				'property' => 'color',
			)
		)
	) );

	Kirki::add_field( 'daphnee', array(
		'type'        => 'color',
		'settings'    => 'buttons_color',
		'label'       => __( 'Buttons Color', 'daphnee' ),
		'description' => __( 'Select the main color for buttons', 'daphnee' ),
		'default'     => '#C2185B',
		'section'     => 'colors',
		'output'      => array(
			array(
				'element'  => 'button, input[type="button"], input[type="reset"], input[type="submit"]',
				'property' => 'background-color',
			),
			array(
				'element'           => 'button, input[type="button"], input[type="reset"], input[type="submit"]',
				'property'          => 'color',
				'sanitize_callback' => array( 'Daphnee_Customizer', 'max_readability' ),
			),
		),
	) );

	Kirki::add_field( 'daphnee', array(
		'type'        => 'color-alpha',
		'settings'    => 'menu_color',
		'label'       => __( 'Menu Color', 'daphnee' ),
		'description' => __( 'Select the menu color', 'daphnee' ),
		'default'     => '#000000',
		'section'     => 'colors',
		'output'      => array(
			array(
				'element'  => 'button.menu-toggle',
				'property' => 'background-color',
			),
			array(
				'element'           => 'button.menu-toggle .dashicons',
				'property'          => 'color',
				'sanitize_callback' => array( 'Daphnee_Customizer', 'max_readability' ),
			),
			array(
				'element'  => '#site-navigation.main-navigation',
				'property' => 'background-color',
			),
			array(
				'element'           => '#site-navigation.main-navigation a',
				'property'          => 'color',
				'sanitize_callback' => array( 'Daphnee_Customizer', 'max_readability' ),
			),
		),
	) );

	/*******************************
	 * HEADER SECTION & OPTIONS
	 ******************************/
	Kirki::add_section( 'header', array(
		'title'       => __( 'Header', 'daphnee' ),
		'description' => __( 'Configure your header options' ),
		'priority'    => 40,
	) );

	Kirki::add_field( 'daphnee', array(
		'type'        => 'slider',
		'settings'    => 'header_height',
		'label'       => __( 'Header Height', 'daphnee' ),
		'description' => __( 'Select the height for the header.', 'daphnee' ),
		'section'     => 'header',
		'default'     => 10,
		'priority'    => 15,
		'choices'     => array(
			'min'  => 1,
			'max'  => 100,
			'step' => 1
		),
		'output'      => array(
			array(
				'element'  => '#masthead',
				'property' => 'min-height',
				'units'    => 'vh',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '#masthead',
				'function' => 'css',
				'property' => 'min-height',
				'units'    => 'vh',
			),
		),
	) );

	if ( ! Daphnee()->is_plus ) {
		Kirki::add_field( 'daphnee', array(
			'type'        => 'custom',
			'settings'    => 'plus_headers_info',
			'label'       => '',
			'section'     => 'header',
			'default'     => Daphnee_Customizer::update_info_wrapper( __( 'Plus Options', 'daphnee' ), __( 'The plus pack includes many additional headers for your site!', 'Avada' ) ),
			'priority'    => 99,
		) );
	}

	/*******************************
	* HEADER IMAGE OPTIONS
	******************************/

	Kirki::add_field( 'daphnee', array(
		'type'        => 'color-alpha',
		'settings'    => 'header_color',
		'label'       => __( 'Header Color', 'daphnee' ),
		'section'     => 'header_image',
		'default'     => '#ffffff',
		'priority'    => 1,
		'output'      => array(
			array(
				'element'  => '#masthead',
				'property' => 'background-color',
				'units'    => '',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '#masthead',
				'function' => 'css',
				'property' => 'background-color',
				'units'    => '',
			),
		)
	) );

	Kirki::add_field( 'daphnee', array(
		'type'      => 'select',
		'settings'  => 'header_image_repeat',
		'label'     => __( 'Header Image Repeat', 'daphnee' ),
		'section'   => 'header_image',
		'default'   => 'no-repeat',
		'priority'  => 20,
		'choices'   => array(
			'initial'   => __( 'Initial', 'daphnee' ),
			'inherit'   => __( 'Inherit', 'daphnee' ),
			'repeat'    => __( 'Repeat', 'daphnee' ),
			'no-repeat' => __( 'No repeat', 'daphnee' ),
			'repeat-x'  => __( 'Repeat-X', 'daphnee' ),
			'repeat-y'  => __( 'Repeat-Y', 'daphnee' ),
		),
		'output'    => array(
			array(
				'element'  => '#masthead',
				'property' => 'background-repeat',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '#masthead',
				'function' => 'css',
				'property' => 'background-repeat',
			),
		),
	) );

	Kirki::add_field( 'daphnee', array(
		'type'      => 'select',
		'settings'  => 'header_image_size',
		'label'     => __( 'Header Image Size', 'daphnee' ),
		'section'   => 'header_image',
		'default'   => 'cover',
		'priority'  => 30,
		'choices'   => array(
			'initial'   => __( 'Initial', 'daphnee' ),
			'inherit'   => __( 'Inherit', 'daphnee' ),
			'cover'     => __( 'Cover', 'daphnee' ),
			'contain '  => __( 'Contain', 'daphnee' ),
			'auto'      => __( 'Auto', 'daphnee' ),
		),
		'output' => array(
			array(
				'element'  => '#masthead',
				'property' => 'background-size',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '#masthead',
				'function' => 'css',
				'property' => 'background-size',
			),
		)
	) );

	Kirki::add_field( 'daphnee', array(
		'type'      => 'select',
		'settings'  => 'header_image_attach',
		'label'     => __( 'Header Image Attachment', 'daphnee' ),
		'section'   => 'header_image',
		'default'   => 'scroll',
		'priority'  => 40,
		'choices'   => array(
			'initial'   => __( 'Initial', 'daphnee' ),
			'inherit'   => __( 'Inherit', 'daphnee' ),
			'scroll'    => __( 'Scroll', 'daphnee' ),
			'fixed '    => __( 'Fixed', 'daphnee' ),
		),
		'output' => array(
		  'element'  => '#masthead',
		  'property' => 'background-attachment',
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '#masthead',
				'function' => 'css',
				'property' => 'background-attachment',
			),
		)
	) );

	Kirki::add_field( 'daphnee', array(
		'type'      => 'select',
		'settings'  => 'header_image_position',
		'label'     => __( 'Header Image Position', 'daphnee' ),
		'section'   => 'header_image',
		'default'   => 'center-center',
		'priority'  => 40,
		'choices'   => array(
			'left-top'      => __( 'Left Top', 'daphnee' ),
				'left-center'   => __( 'Left Center', 'daphnee' ),
				'left-bottom'   => __( 'Left Bottom', 'daphnee' ),
				'right-top'     => __( 'Right Top', 'daphnee' ),
				'right-center'  => __( 'Right Center', 'daphnee' ),
				'right-bottom'  => __( 'Right Bottom', 'daphnee' ),
				'center-top'    => __( 'Center Top', 'daphnee' ),
				'center-center' => __( 'Center Center', 'daphnee' ),
				'center-bottom' => __( 'Center Bottom', 'daphnee' ),
		),
		'output'    => array(
			array(
				'element'  => '#masthead',
				'property' => 'background-position',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '#masthead',
				'function' => 'css',
				'property' => 'background-position',
			),
		)
	) );

	/*******************************
	 * FOOTER
	 ******************************/
	Kirki::add_section( 'footer', array(
		'title'       => __( 'Footer', 'daphnee' ),
		'priority'    => 80,
	) );

	Kirki::add_field( 'daphnee', array(
		'type'     => 'slider',
		'section'  => 'footer',
		'settings' => 'footer_widget_areas',
		'label'    => __( 'Number of Footer widget areas', 'daphnee' ),
		'default'  => '3',
		'choices'  => array(
			'min'  => '1',
			'max'  => '4',
			'step' => '1',
		),
	) );

	Kirki::add_field( 'daphnee', array(
		'type'        => 'background',
		'settings'    => 'footer_background',
		'label'       => __( 'Footer Background', 'daphnee' ),
		'section'     => 'footer',
		'default'     => array(
			'color'    => '#333333',
			'image'    => '',
			'repeat'   => 'no-repeat',
			'size'     => 'cover',
			'attach'   => 'fixed',
			'position' => 'center-center',
		),
		'priority'    => 50,
		'output'      => '#colophon.site-footer',
	) );

	Kirki::add_field( 'daphnee', array(
		'type'     => 'number',
		'section'  => 'footer',
		'settings' => 'footer_top_border_width',
		'label'    => __( 'Footer top border width', 'daphnee' ),
		'default'  => '2',
		'priority' => 55,
		'output'   => array(
			array(
				'element'  => 'footer.site-footer',
				'property' => 'border-top-width',
				'units'    => 'px',
			),
	  ),
	) );

	Kirki::add_field( 'daphnee', array(
		'type'     => 'select',
		'section'  => 'footer',
		'settings' => 'footer_top_border_style',
		'label'    => __( 'Footer top border style', 'daphnee' ),
		'default'  => 'dotted',
		'priority' => 60,
		'choices'  => array(
			'dotted' => 'dotted',
			'solid'  => 'solid',
			'double' => 'double',
			'dashed' => 'dashed',
		),
		'output'   => array(
			array(
				'element'  => 'footer.site-footer',
				'property' => 'border-top-style',
			),
	  ),
	) );

	Kirki::add_field( 'daphnee', array(
		'type'     => 'color',
		'section'  => 'footer',
		'settings' => 'footer_top_border_color',
		'label'    => __( 'Footer top border style', 'daphnee' ),
		'default'  => '#ffffff',
		'priority' => 65,
		'output'   => array(
			array(
				'element'  => 'footer.site-footer',
				'property' => 'border-top-color',
			),
	  ),
	) );

	if ( ! Daphnee()->is_plus ) {
		Kirki::add_field( 'daphnee', array(
			'type'        => 'custom',
			'settings'    => 'remove_copyright',
			'label'       => '',
			'section'     => 'footer',
			'default'     => '<div class="plus-info-control"><h3>' . __( 'Plus Options', 'daphnee' ) . '</h3><p><a class="daphnee-plus-link" target="_blank" href="' . Daphnee()->plus_link . '">' . __( 'Upgrade to Plus', 'daphnee' ) . '</a> and remove or edit the copyright link on your footer.</p></div>',
			'priority'    => 100,
		) );
	}

	/*******************************
	 * BLOG SECTION & OPTIONS
	 ******************************/
	Kirki::add_section( 'blog', array(
		'title'       => __( 'Blog', 'daphnee' ),
		'description' => __( 'Configure your blog options', 'daphnee' ),
		'priority'    => 80,
	) );

	Kirki::add_field( 'daphnee', array(
		'type'        => 'radio-buttonset',
		'settings'    => 'post_length',
		'label'       => __( 'Post length in archives', 'daphnee' ),
		'section'     => 'blog',
		'default'     => 1,
		'priority'    => 10,
		'choices'     => array(
			1 => __( 'Excerpt', 'daphnee' ),
			2 => __( 'Full Post', 'daphnee' ),
		),
	) );

	Kirki::add_field( 'daphnee', array(
		'type'     => 'slider',
		'section'  => 'blog',
		'settings' => 'post_excerpt_length',
		'label'    => __( 'Excerpt length in words', 'daphnee' ),
		'default'  => '40',
		'choices'  => array(
			'min'  => '10',
			'max'  => '200',
			'step' => '1',
		),
		'required' => array(
			array(
				'setting'  => 'post_length',
				'operator' => '==',
				'value'    => 1,
			)
		)
	) );

	/*******************************
	 * FEATURED IMAGES
	 ******************************/
	Kirki::add_section( 'featured_images', array(
		'title'       => __( 'Featured Images', 'daphnee' ),
		'priority'    => 90,
	) );

	$post_types         = array();
	$post_types_objects = get_post_types( array( 'public' => true ), 'objects' );
	foreach ( $post_types_objects as $post_type ) {
		$post_types[ $post_type->name ] = $post_type->labels->name;
	}

	Kirki::add_field( 'daphnee', array(
		'type'        => 'multicheck',
		'label'       => __( 'Enable featured images per post-type', 'daphnee' ),
		'section'     => 'featured_images',
		'settings'    => 'featured_image_post_types',
		'description' => __( 'Please note that featured images will only be shown if the post type supports them and the post has a featured image.', 'daphnee' ),
		'default'     => array( 'post' ),
		'choices'     => $post_types
	) );

	/*******************************
	 * SOCIAL LINKS
	 ******************************/
	Kirki::add_section( 'social_links', array(
		'title'       => __( 'Social Links', 'daphnee' ),
		'priority'    => 100,
	) );

	Kirki::add_field( '', array(
	'label'    => __( 'Social Links', 'kirki' ),
	'settings' => 'social_links',
	'type'     => 'repeater',
	'section'  => 'social_links',
	'default'  => array(),
	'fields'   => array(
		'label' => array(
			'type'     => 'select',
			'label'    => 'Social Network',
			'default'  => '',
			'choices'  => array(
			 	'' => __('choose one', 'daphnee'),
			 	'twitter' => 'Twitter',
			 	'facebook' => 'Facebook',
			 	'google' => 'Google',
			 	'pinterest' => 'Pinterest',
				'foursquare' => 'Foursquare',
				'yahoo' => 'Yahoo',
				'skype' => 'Skype',
				'yelp' => 'Yelp',
				'feedburner' => 'Feedburner',
				'linkedin' => 'LinkedIn',
				'viadeo' => 'Viadeo',
				'xing' => 'Xing',
				'myspace' => 'Myspace',
				'soundcloud' => 'Soundcloud',
				'spotify' => 'Spotify',
				'grooveshark' => 'Grooveshark',
				'lastfm' => 'LastFM',
				'youtube' => 'YouTube',
				'vimeo' => 'Vimeo',
				'dailymotion' => 'Dailymotion',
				'vine' => 'Vine',
				'flickr' => 'Flickr',
				'500px' => '500px',
				'instagram' => 'Instagram',
				'wordpress' => 'WordPress',
				'tumblr' => 'Tumblr',
				'blogger' => 'Blogger',
				'technorati' => 'Technorati',
				'reddit' => 'Reddit',
				'dribbble' => 'Dribbble',
				'stumbleupon' => 'StumbleUpon',
				'digg' => 'Digg',
				'envato' => 'Envato',
				'behance' => 'Behance',
				'delicious' => 'Delicious',
				'deviantart' => 'Deviantart',
				'forrst' => 'Forrst',
				'playstore' => 'Playstore',
				'zerply' => 'Zerply',
				'wikipedia' => 'Wikipedia',
				'apple' => 'Apple',
				'flattr' => 'Flattr',
				'github' => 'Github',
				'chimein' => 'Chimein',
				'friendfeed' => 'Friendfeed',
				'newsvine' => 'Newsvine',
				'identica' => 'Identica',
				'bebo' => 'Bebo',
				'zynga' => 'Zynga',
				'steam' => 'Steam',
				'xbox' => 'Xbox',
				'windows' => 'Windows',
				'outlook' => 'Outlook',
				'coderwall' => 'Coderwall',
				'tripadvisor' => 'Tripadvisor',
				'appnet' => 'Appnet',
				'goodreads' => 'Goodreads',
				'tripit' => 'Tripit',
				'lanyrd' => 'Lanyrd',
				'slideshare' => 'Slideshare',
				'buffer' => 'Buffer',
				'rss' => 'RSS',
				'vkontakte' => 'Vkontakte',
				'disqus' => 'Disqus',
				'houzz' => 'Houzz',
				'mail' => 'Mail',
				'patreon' => 'Patreon',
				'paypal' => 'Paypal',
				'playstation' => 'Playstation',
				'smugmug' => 'Smugmug',
				'swarm' => 'Swarm',
				'triplej' => 'Triplej',
				'yammer' => 'Yammer',
				'stackoverflow' => 'Stackoverflow',
				'drupal' => 'Drupal',
				'odnoklassniki' => 'Odnoklassniki',
				'android' => 'Android',
				'meetup' => 'Meetup',
				'persona' => 'Persona',
				'amazon' => 'Amazon',
				'ello' => 'Ello',
				'mixcloud' => 'Mixcloud',
				'8tracks' => '8tracks',
				'twitch' => 'Twitch',
				'airbnb' => 'Airbnb',
			)
		),
		'link' => array(
			'type'     => 'text',
			'label'    => 'URL',
			'default'  => 'https://'
		),
	)
	) );

}

function daphnee_add_featured_image( $content ) {
	global $post;
	$enabled_post_types = get_theme_mod( 'featured_image_post_types', array( 'post' ) );
	if ( is_singular() && in_array( $post->post_type, $enabled_post_types ) ) {
		$content = get_the_post_thumbnail ( $post->ID, 'full' ) . $content;
	}
	return $content;
}
add_filter( 'the_content', 'daphnee_add_featured_image' );


function daphnee_add_plus_link() {
	if ( ! Daphnee()->is_plus ) {
		$link   = '<a class="daphnee-plus-link" target="_blank" href="' . Daphnee()->plus_link . '">' . __( 'Upgrade to Plus', 'daphnee' ) . '</a>';
		$script = '$(\'' . $link . '\').appendTo( "li#accordion-section-themes .accordion-section-title" )';
		echo '<script>jQuery(document).ready(function($) { "use strict"; ' . $script . '});</script>';
	}
}
add_action( 'customize_controls_print_footer_scripts', 'daphnee_add_plus_link' );
