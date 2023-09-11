<?php

if ( ! function_exists( 'obsius_core_add_portfolio_list_variation_info_follow' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function obsius_core_add_portfolio_list_variation_info_follow( $variations ) {
		$variations['info-follow'] = esc_html__( 'Info Follow', 'obsius-core' );

		return $variations;
	}

	add_filter( 'obsius_core_filter_portfolio_list_layouts', 'obsius_core_add_portfolio_list_variation_info_follow' );
}
