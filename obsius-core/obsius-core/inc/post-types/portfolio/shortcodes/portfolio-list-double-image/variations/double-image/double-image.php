<?php

if ( ! function_exists( 'obsius_core_add_portfolio_list_double_image_variation_double_image' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function obsius_core_add_portfolio_list_double_image_variation_double_image( $variations ) {
		$variations['double-image'] = esc_html__( 'Double Image', 'obsius-core' );

		return $variations;
	}

	add_filter( 'obsius_core_filter_portfolio_list_double_image_layouts', 'obsius_core_add_portfolio_list_double_image_variation_double_image' );
}
