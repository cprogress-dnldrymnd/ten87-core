<?php

class ObsiusCore_Process_Shortcode_Elementor extends ObsiusCore_Elementor_Widget_Base {

	function __construct( array $data = [], $args = null ) {
		$this->set_shortcode_slug( 'obsius_core_process' );

		parent::__construct( $data, $args );
	}
}

obsius_core_register_new_elementor_widget( new ObsiusCore_Process_Shortcode_Elementor() );
