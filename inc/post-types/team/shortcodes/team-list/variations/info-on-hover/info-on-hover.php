<?php

if ( ! function_exists( 'obsius_core_add_team_list_variation_info_on_hover' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function obsius_core_add_team_list_variation_info_on_hover( $variations ) {
		$variations['info-on-hover'] = esc_html__( 'Info on Hover', 'obsius-core' );

		return $variations;
	}

	add_filter( 'obsius_core_filter_team_list_layouts', 'obsius_core_add_team_list_variation_info_on_hover' );
}
