<?php

class ObsiusCore_Preview_Product_Slider_Shortcode_Elementor extends ObsiusCore_Elementor_Widget_Base {

	public function __construct( array $data = [], $args = null ) {
		$this->set_shortcode_slug( 'obsius_core_preview_product_slider' );

		parent::__construct( $data, $args );
	}
}

if ( qode_framework_is_installed( 'woocommerce' ) ) {
	obsius_core_register_new_elementor_widget( new ObsiusCore_Preview_Product_Slider_Shortcode_Elementor() );
}
