<?php

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
