<?php

if ( ! function_exists( 'obsius_core_add_button_variation_textual' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function obsius_core_add_button_variation_textual( $variations ) {
		$variations['textual'] = esc_html__( 'Textual', 'obsius-core' );

		return $variations;
	}

	add_filter( 'obsius_core_filter_button_layouts', 'obsius_core_add_button_variation_textual' );
}
