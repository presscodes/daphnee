<?php
/**
 * Daphnee functions and definitions
 *
 * @package Daphnee
 */

if ( ! function_exists( 'daphnee_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function daphnee_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Daphnee, use a find and replace
	 * to change 'daphnee' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'daphnee', get_template_directory() . '/languages' );

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
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'daphnee' ),
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

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'daphnee_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	/*
	 * Enable support for Jetpack's site-logo
	 * See http://jetpack.me/support/site-logo/
	 *
	 * Use filter 'jetpack_the_site_logo' to change output
	 * https://github.com/Automattic/jetpack/blob/master/modules/theme-tools/site-logo/inc/functions.php#L140
	 *
	 */
	add_theme_support( 'site-logo', array(
    'header-text' => array(
      'site-title',
      'site-description',
      ),
    'size' => 'medium',
	)	);

}
endif; // daphnee_setup
add_action( 'after_setup_theme', 'daphnee_setup' );

/**
 * Activate the Site Logo plugin.
 *
 * @uses current_theme_supports()
 * @since 3.2
 */
function jetpack_site_logo_init() {
	// Only load our code if our theme declares support, and the standalone plugin is not activated.
	if ( current_theme_supports( 'site-logo' ) && ! class_exists( 'Site_Logo', false ) ) {
		// Load our class for namespacing.
		require( get_template_directory() . '/inc/jetpack/site-logo/class-site-logo.php' );
		// Load template tags.
		require( get_template_directory() . '/inc/jetpack/site-logo/functions.php' );
		// Load backwards-compatible template tags.
		require( get_template_directory() . '/inc/jetpack/site-logo/compat.php' );
	}
}
add_action( 'init', 'jetpack_site_logo_init' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function daphnee_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'daphnee_content_width', 640 );
}
add_action( 'after_setup_theme', 'daphnee_content_width', 0 );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function daphnee_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'daphnee' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	$footer_widget_areas = get_theme_mod( 'footer_widget_areas', '3' );
	for ( $i = 1; $i <= $footer_widget_areas; $i++ ) {
		register_sidebar( array(
			'name'          => sprintf( esc_html__( 'Footer Widget Area %s', 'daphnee' ), $i ),
			'id'            => 'footer-' . $i,
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}
}
add_action( 'widgets_init', 'daphnee_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function daphnee_scripts() {
	wp_enqueue_style( 'daphnee-style', get_stylesheet_uri() );

	wp_enqueue_style( 'socicon', get_template_directory_uri() . '/assets/css/socicon.css', false );

	wp_enqueue_script( 'daphnee-navigation', get_template_directory_uri() . '/js/navigation.js', array( 'jquery' ), '20120206', true );

	wp_enqueue_script( 'daphnee-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'daphnee_scripts' );

if ( ! class_exists('Kirki') ) {
	require get_template_directory() . '/inc/kirki/kirki.php';
}

require get_template_directory() . '/inc/classes/class-daphnee.php';
require get_template_directory() . '/inc/classes/class-daphnee-layout.php';
require get_template_directory() . '/inc/classes/class-daphnee-customizer.php';
require get_template_directory() . '/inc/classes/class-daphnee-dynamic-css.php';
require get_template_directory() . '/inc/classes/class-daphnee-social.php';
require get_template_directory() . '/inc/classes/class-daphnee-blog.php';

function Daphnee() {
	return Daphnee::get_instance();
}
$customizer  = new Daphnee_Customizer();
$dynamic_css = new Daphnee_Dynamic_CSS();
$social      = new Daphnee_Social();
$blog        = new Daphnee_Blog();

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load the Widgets-dropdown-addon class
 */
require get_template_directory() . '/inc/classes/class-daphnee-widget-dropdown-addon.php';

/**
 * Load Replacement widget for recent posts
 */
require get_template_directory() . '/inc/classes/class-daphnee-widget-recent-posts.php';

/**
 * Load tha theme hooks.
 * https://github.com/zamoose/themehookalliance
 */
include( 'inc/tha-theme-hooks.php' );

// Declare support for all hook types
add_theme_support( 'tha_hooks', array( 'all' ) );

/**
 * Replace some default widgets with our custom ones.
 */
function daphnee_register_widgets() {
    // Replace the "Recent Posts" widget
    unregister_widget( 'WP_Widget_Recent_Posts' );
    register_widget( 'Daphnee_Widget_Recent_Posts' );
}
add_action( 'widgets_init', 'daphnee_register_widgets', 15 );

/**
 * Add "width" to all our widgets
 */
$widget_widths = new Daphnee_Widget_Dropdown_Addon( array(
	'id'      => 'daphnee_widget_width',
	'label'   => __( 'Width', 'daphnee' ),
	'default' => 12,
	'choices' => array(
		12 => array( 'label' => __( 'Full', 'daphnee' ),       'classes' => 'col_12' ),
		3  => array( 'label' => __( '1 Quarter', 'daphnee' ),  'classes' => 'col_3' ),
		4  => array( 'label' => __( '1 Third', 'daphnee' ),    'classes' => 'col_4' ),
		6  => array( 'label' => __( 'Half', 'daphnee' ),       'classes' => 'col_6' ),
		8  => array( 'label' => __( '3 quarters', 'daphnee' ), 'classes' => 'col_8' ),
		9  => array( 'label' => __( '2 Thirds', 'daphnee' ),   'classes' => 'col_9' ),
	),
) );
