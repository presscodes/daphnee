<?php

class Daphnee {

	private static $instance = null;

	public $layout;

	public $is_plus   = false;
	public $plus_link = 'https://presscodes.com';

	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new Daphnee();
		}
		return self::$instance;
	}

	public function __construct() {
		$this->layout   = new Daphnee_Layout();
		$this->is_plus();
	}

	public function load_template_partial( $template_part ) {
		$template = apply_filters( 'daphnee/template/' . $template_part, get_template_directory() . '/partials/' . $template_part . '.php' );
		if ( ! $template ) {
			return;
		}
		load_template( $template, false );
	}

	public function is_plus() {
		if ( class_exists( 'Daphnee_Plus' ) ) {
			$this->is_plus = true;
		}
	}

}
