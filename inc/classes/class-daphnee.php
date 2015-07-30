<?php

class Daphnee {

	private static $instance = null;

	public $layout;

	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new Daphnee();
		}
		return self::$instance;
	}

	public function __construct() {
		$this->layout   = new Daphnee_Layout();
	}

	public function load_template_partial( $template_part ) {
		$template = apply_filters( 'daphnee/template/' . $template_part, get_template_directory() . '/partials/' . $template_part . '.php' );
		if ( ! $template ) {
			return;
		}
		ob_start();
		load_template( $template );
		echo ob_get_clean();
	}
}
