<?php

if ( ! function_exists( 'obsius_core_filter_portfolio_list_info_follow' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function obsius_core_filter_portfolio_list_info_follow( $variations ) {
		$variations['follow'] = esc_html__( 'Follow', 'obsius-core' );

		return $variations;
	}

	add_filter( 'obsius_core_filter_portfolio_list_info_follow_animation_options', 'obsius_core_filter_portfolio_list_info_follow' );
}
