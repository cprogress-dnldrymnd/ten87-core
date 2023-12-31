<?php

if ( ! function_exists( 'obsius_core_add_social_share_variation_dropdown' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function obsius_core_add_social_share_variation_dropdown( $variations ) {
		$variations['dropdown'] = esc_html__( 'Dropdown', 'obsius-core' );

		return $variations;
	}

	add_filter( 'obsius_core_filter_social_share_layouts', 'obsius_core_add_social_share_variation_dropdown' );
}
