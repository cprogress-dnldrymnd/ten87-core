<?php

class ObsiusCore_Google_Map_Shortcode_Elementor extends ObsiusCore_Elementor_Widget_Base {

	public function __construct( array $data = [], $args = null ) {
		$this->set_shortcode_slug( 'obsius_core_google_map' );

		parent::__construct( $data, $args );
	}
}

obsius_core_register_new_elementor_widget( new ObsiusCore_Google_Map_Shortcode_Elementor() );
