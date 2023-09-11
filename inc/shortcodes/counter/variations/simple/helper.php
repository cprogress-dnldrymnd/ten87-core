<?php

if ( ! function_exists( 'obsius_core_add_counter_variation_simple' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function obsius_core_add_counter_variation_simple( $variations ) {
		$variations['simple'] = esc_html__( 'Simple', 'obsius-core' );

		return $variations;
	}

	add_filter( 'obsius_core_filter_counter_layouts', 'obsius_core_add_counter_variation_simple' );
}
