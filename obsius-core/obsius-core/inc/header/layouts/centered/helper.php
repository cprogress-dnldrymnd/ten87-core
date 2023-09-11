<?php

if ( ! function_exists( 'obsius_core_add_centered_header_global_option' ) ) {
	/**
	 * This function set header type value for global header option map
	 */
	function obsius_core_add_centered_header_global_option( $header_layout_options ) {
		$header_layout_options['centered'] = array(
			'image' => OBSIUS_CORE_HEADER_LAYOUTS_URL_PATH . '/centered/assets/img/centered-header.png',
			'label' => esc_html__( 'Centered', 'obsius-core' ),
		);

		return $header_layout_options;
	}

	add_filter( 'obsius_core_filter_header_layout_option', 'obsius_core_add_centered_header_global_option' );
}

if ( ! function_exists( 'obsius_core_register_centered_header_layout' ) ) {
	/**
	 * Function which add header layout into global list
	 *
	 * @param array $header_layouts
	 *
	 * @return array
	 */
	function obsius_core_register_centered_header_layout( $header_layouts ) {
		$header_layouts['centered'] = 'ObsiusCore_Centered_Header';

		return $header_layouts;
	}

	add_filter( 'obsius_core_filter_register_header_layouts', 'obsius_core_register_centered_header_layout' );
}
