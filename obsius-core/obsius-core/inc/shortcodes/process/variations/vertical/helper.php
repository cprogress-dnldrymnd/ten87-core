<?php

if ( ! function_exists( 'obsius_core_add_process_variation_vertical' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function obsius_core_add_process_variation_vertical( $variations ) {
		$variations['vertical'] = esc_html__( 'Vertical', 'obsius-core' );

		return $variations;
	}

	add_filter( 'obsius_core_filter_process_layouts', 'obsius_core_add_process_variation_vertical' );
}
