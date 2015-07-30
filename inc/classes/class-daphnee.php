<?php

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
