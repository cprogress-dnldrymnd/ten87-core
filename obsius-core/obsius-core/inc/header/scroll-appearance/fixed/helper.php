<?php

if ( ! function_exists( 'obsius_core_add_fixed_header_option' ) ) {
	/**
	 * This function set header scrolling appearance value for global header option map
	 */
	function obsius_core_add_fixed_header_option( $options ) {
		$options['fixed'] = esc_html__( 'Fixed', 'obsius-core' );

		return $options;
	}

	add_filter( 'obsius_core_filter_header_scroll_appearance_option', 'obsius_core_add_fixed_header_option' );
}
