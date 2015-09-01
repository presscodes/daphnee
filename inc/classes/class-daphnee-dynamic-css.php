<?php

class Daphnee_Dynamic_CSS extends Daphnee {

    /**
     * The main class constructor
     */
    public function __construct() {
        add_action( 'wp_enqueue_scripts', array( $this, 'footer_css' ) );
    }

    /**
     * Extra CSS needed for the footer if text needs to be white.
     */
    public function footer_css() {

    	if ( '#ffffff' == Daphnee_Customizer::max_readability( get_theme_mod( 'footer_background_color', '#333333' ) ) ) {
    		$style = '#colophon.site-footer{color:#fff;}#colophon.site-footer a{color:rgba(255,255,255,.8);}';
    		wp_add_inline_style( 'daphnee-style', $style );
    	}

    }

}
