<?php

if ( ! function_exists( 'obsius_core_add_social_share_variation_list' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function obsius_core_add_social_share_variation_list( $variations ) {
		$variations['list'] = esc_html__( 'List', 'obsius-core' );

		return $variations;
	}

	add_filter( 'obsius_core_filter_social_share_layouts', 'obsius_core_add_social_share_variation_list' );
}
