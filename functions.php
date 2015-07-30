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
}
endif; // daphnee_setup
add_action( 'after_setup_theme', 'daphnee_setup' );

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
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'daphnee_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function daphnee_scripts() {
	wp_enqueue_style( 'daphnee-style', get_stylesheet_uri() );

	wp_enqueue_script( 'daphnee-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'daphnee-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'daphnee_scripts' );

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

class Daphnee {

	private static $instance = null;

	public $template;
	public $layout;

	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new Daphnee();
		}
		return self::$instance;
	}

	public function __construct() {
		$this->template = new Daphnee_Template();
		$this->layout   = new Daphnee_Layout();
	}
}

class Daphnee_Template {

	public function head() {
		ob_start(); ?>
		<head>
			<meta charset="<?php bloginfo( 'charset' ); ?>">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="profile" href="http://gmpg.org/xfn/11">
			<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
			<?php wp_head(); ?>
		</head>
		<?php
		echo apply_filters( 'daphnee/template/head', ob_get_clean() );
	}

	public function header() {
		ob_start(); ?>
		<header id="masthead" class="site-header" role="banner">
			<div class="site-branding">
				<?php if ( is_front_page() && is_home() ) : ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php else : ?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php endif; ?>
				<p class="site-description"><?php bloginfo( 'description' ); ?></p>
			</div><!-- .site-branding -->
			<?php
			/**
			 * The main navigation
			 */
			$this->navigation();
			?>
		</header><!-- #masthead -->
		<?php
		echo apply_filters( 'daphnee/template/header', ob_get_clean() );
	}

	public function navigation() {
		ob_start(); ?>
		<nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'daphnee' ); ?></button>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
		</nav><!-- #site-navigation -->
		<?php
		echo apply_filters( 'daphnee/template/navigation', ob_get_clean() );
	}

	public function sidebar() {
		ob_start(); ?>
		<div id="secondary" class="widget-area <?php echo Daphnee()->layout->sidebar_columns(); ?>" role="complementary">
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</div><!-- #secondary -->
		<?php
		echo apply_filters( 'daphnee/template/sidebar', ob_get_clean() );
	}

	public function content_header( $context = 'singular', $post_type = 'post' ) {
		if ( 'singular' == $context ) {
			if ( 'page' == $post_type ) {
				ob_start(); ?>
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header><!-- .entry-header -->
				<?php
			} else {
				ob_start(); ?>
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

					<div class="entry-meta">
						<?php daphnee_posted_on(); ?>
					</div><!-- .entry-meta -->
				</header><!-- .entry-header -->
				<?php
			}
		} elseif ( '404' == $context ) {
			ob_start(); ?>
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'daphnee' ); ?></h1>
			</header><!-- .page-header -->
			<?php
		} elseif ( 'archive' == $context ) {
			ob_start(); ?>
			<header class="entry-header">
				<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

				<?php if ( 'post' == get_post_type() ) : ?>
				<div class="entry-meta">
					<?php daphnee_posted_on(); ?>
				</div><!-- .entry-meta -->
				<?php endif; ?>
			</header><!-- .entry-header -->
			<?php
		}
		echo apply_filters( 'daphnee/template/content_header', ob_get_clean() );
	}
	public function content_main( $context = 'singular', $post_type = 'post' ) {
		if ( '404' == $context ) {
			ob_start(); ?>
			<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
				<p><?php printf( wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'daphnee' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
			<?php elseif ( is_search() ) : ?>
				<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'daphnee' ); ?></p>
				<?php get_search_form(); ?>
			<?php else : ?>
				<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'daphnee' ); ?></p>
				<?php get_search_form(); ?>
			<?php endif; ?>
			<?php
		} elseif ( 'singular' == $context ) {
			ob_start(); ?>
			<?php the_content(); ?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'daphnee' ),
					'after'  => '</div>',
				) );
			?>
			<?php
		} elseif ( 'archive' == $context ) {
			ob_start(); ?>
			<?php
				the_content( sprintf(
					/* translators: %s: Name of current post. */
					wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'daphnee' ), array( 'span' => array( 'class' => array() ) ) ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );
			?>

			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'daphnee' ),
					'after'  => '</div>',
				) );
			?>
			<?php
		}
		echo apply_filters( 'daphnee/template/content_main', ob_get_clean() );

	}
	public function content_footer( $context = 'singular', $post_type = 'post' ) {
		ob_start(); ?>
		<?php daphnee_entry_footer(); ?>
		<?php
		echo apply_filters( 'daphnee/template/content_footer', ob_get_clean() );
	}

	public function footer() {
		ob_start(); ?>
		<footer id="colophon" class="site-footer row" role="contentinfo">
			<div class="site-info col_12">
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'daphnee' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'daphnee' ), 'WordPress' ); ?></a>
				<span class="sep"> | </span>
				<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'daphnee' ), 'daphnee', '<a href="https://press.codes" rel="designer">PressCodes Team</a>' ); ?>
			</div><!-- .site-info -->
		</footer><!-- #colophon -->
		<?php
		echo apply_filters( 'daphnee/template/footer', ob_get_clean() );
	}

}

class Daphnee_Layout {

	public function main_content_columns() {
		return 'col_9';
	}

	public function sidebar_columns() {
		return 'col_3';
	}

}

function Daphnee() {
	return Daphnee::get_instance();
}
