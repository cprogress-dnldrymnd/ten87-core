<?php

class ObsiusCore_Instagram_List_Shortcode_Elementor extends ObsiusCore_Elementor_Widget_Base {

	public function __construct( array $data = [], $args = null ) {
		$this->set_shortcode_slug( 'obsius_core_instagram_list' );

		parent::__construct( $data, $args );
	}
}

if ( qode_framework_is_installed( 'instagram' ) ) {
	obsius_core_register_new_elementor_widget( new ObsiusCore_Instagram_List_Shortcode_Elementor() );
}
