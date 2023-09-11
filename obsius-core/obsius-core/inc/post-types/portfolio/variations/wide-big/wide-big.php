<?php

if ( ! function_exists( 'obsius_core_add_portfolio_single_variation_wide_big' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function obsius_core_add_portfolio_single_variation_wide_big( $variations ) {
		$variations['wide-big'] = esc_html__( 'Wide - Big', 'obsius-core' );

		return $variations;
	}

	add_filter( 'obsius_core_filter_portfolio_single_layout_options', 'obsius_core_add_portfolio_single_variation_wide_big' );
}
