<?php

if ( ! function_exists( 'obsius_core_add_portfolio_category_list_variation_gallery' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function obsius_core_add_portfolio_category_list_variation_gallery( $variations ) {
		$variations['gallery'] = esc_html__( 'Gallery', 'obsius-core' );

		return $variations;
	}

	add_filter( 'obsius_core_filter_portfolio_category_list_layouts', 'obsius_core_add_portfolio_category_list_variation_gallery' );
}
