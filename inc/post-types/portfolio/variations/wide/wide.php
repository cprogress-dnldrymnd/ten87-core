<?php

if ( ! function_exists( 'obsius_core_add_portfolio_single_variation_wide' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function obsius_core_add_portfolio_single_variation_wide( $variations ) {
		$variations['wide'] = esc_html__( 'Wide', 'obsius-core' );

		return $variations;
	}

	add_filter( 'obsius_core_filter_portfolio_single_layout_options', 'obsius_core_add_portfolio_single_variation_wide' );
}
