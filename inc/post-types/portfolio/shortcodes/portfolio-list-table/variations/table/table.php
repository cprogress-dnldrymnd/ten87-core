<?php

if ( ! function_exists( 'obsius_core_add_portfolio_list_table_variation_table' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function obsius_core_add_portfolio_list_table_variation_table( $variations ) {
		$variations['table'] = esc_html__( 'Table', 'obsius-core' );

		return $variations;
	}

	add_filter( 'obsius_core_filter_portfolio_list_table_layouts', 'obsius_core_add_portfolio_list_table_variation_table' );
}
