<?php

class ObsiusCore_Fullscreen_Search extends ObsiusCore_Search {
	private static $instance;

	public function __construct() {
		parent::__construct();
		add_action( 'obsius_action_page_footer_template', array( $this, 'load_template' ), 11 ); //after footer
	}

	/**
	 * @return ObsiusCore_Fullscreen_Search
	 */
	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function load_template() {
		if ( is_active_widget( false, false, 'obsius_core_search_opener' ) ) {
			obsius_core_template_part( 'search/layouts/' . $this->get_search_layout(), 'templates/' . $this->get_search_layout() );
		}
	}
}
