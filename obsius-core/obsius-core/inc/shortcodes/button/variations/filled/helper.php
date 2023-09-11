<?php

if ( ! function_exists( 'obsius_core_add_button_variation_filled' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function obsius_core_add_button_variation_filled( $variations ) {
		$variations['filled'] = esc_html__( 'Filled', 'obsius-core' );

		return $variations;
	}

	add_filter( 'obsius_core_filter_button_layouts', 'obsius_core_add_button_variation_filled' );
}
