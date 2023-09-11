<?php

if ( ! function_exists( 'obsius_core_add_portfolio_single_variation_gallery_big' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function obsius_core_add_portfolio_single_variation_gallery_big( $variations ) {
		$variations['gallery-big'] = esc_html__( 'Gallery - Big', 'obsius-core' );

		return $variations;
	}

	add_filter( 'obsius_core_filter_portfolio_single_layout_options', 'obsius_core_add_portfolio_single_variation_gallery_big' );
}
