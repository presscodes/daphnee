<?php

class Daphnee_Layout {

	public function __construct() {
		$this->remove_sidebar_on_fullwidth();
		add_action( 'wp_enqueue_scripts', array( $this, 'left_sidebar_css' ) );
	}

	public function main_content_columns() {
		if ( 'full-screen' == get_theme_mod( 'layout', 'right-sidebar' ) ) {
			return 'col_12';
		} else {
			return 'col_' . ( 12 - intval( get_theme_mod( 'sidebar_width', 3 ) ) );
		}
	}

	public function sidebar_columns() {
		if ( 'full-screen' == get_theme_mod( 'layout', 'right-sidebar' ) ) {
			return null;;
		} else {
			return 'col_' . intval( get_theme_mod( 'sidebar_width', 3 ) );
		}
	}

	public function remove_sidebar_on_fullwidth() {
		if ( 'full-screen' == get_theme_mod( 'layout', 'right-sidebar' ) ) {
			add_filter( 'daphnee/template/sidebar', '__return_false' );
		}
	}

	public function left_sidebar_css() {
		$css = '';
		if ( 'left-sidebar' == get_theme_mod( 'layout', 'right-sidebar' ) ) {
			$css = '#primary{order:2}';
		}
		wp_add_inline_style( 'daphnee-style', $css );
	}

}
