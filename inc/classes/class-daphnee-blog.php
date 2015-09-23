<?php

class Daphnee_Blog {

	public function __construct() {
		add_filter( 'excerpt_more', array( $this,'new_excerpt_more' ) );
		add_filter( 'excerpt_length', array( $this, 'custom_excerpt_length' ), 999 );
	}

	public function new_excerpt_more( $more ) {
		return ' <a class="read-more" href="' . get_permalink( get_the_ID() ) . '">' . __( 'Read More', 'daphnee' ) . '</a>';
	}

	public function custom_excerpt_length( $length ) {
		return get_theme_mod( 'post_excerpt_length', '40' );
	}

}
