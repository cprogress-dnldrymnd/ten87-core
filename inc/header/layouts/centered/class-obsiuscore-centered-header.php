<?php

class ObsiusCore_Centered_Header extends ObsiusCore_Header {
	private static $instance;

	public function __construct() {
		$this->set_layout( 'centered' );
		$this->default_header_height = 150;

		parent::__construct();
	}

	/**
	 * @return ObsiusCore_Centered_Header
	 */
	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}
}
