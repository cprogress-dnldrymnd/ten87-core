<?php

if ( ! function_exists( 'obsius_core_filter_portfolio_list_double_image_double_image_overlay' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function obsius_core_filter_portfolio_list_double_image_double_image_overlay( $variations ) {
		$variations['overlay'] = esc_html__( 'Overlay', 'obsius-core' );

		return $variations;
	}

	add_filter( 'obsius_core_filter_portfolio_list_double_image_double_image_animation_options', 'obsius_core_filter_portfolio_list_double_image_double_image_overlay' );
}
