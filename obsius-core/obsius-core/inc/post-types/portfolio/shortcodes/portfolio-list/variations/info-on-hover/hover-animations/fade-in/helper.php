<?php

if ( ! function_exists( 'obsius_core_filter_portfolio_list_info_on_hover_fade_in' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function obsius_core_filter_portfolio_list_info_on_hover_fade_in( $variations ) {
		$variations['fade-in'] = esc_html__( 'Fade In', 'obsius-core' );

		return $variations;
	}

	add_filter( 'obsius_core_filter_portfolio_list_info_on_hover_animation_options', 'obsius_core_filter_portfolio_list_info_on_hover_fade_in' );
}
