<?php

if ( ! function_exists( 'obsius_core_add_banner_variation_link_button' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function obsius_core_add_banner_variation_link_button( $variations ) {
		$variations['link-button'] = esc_html__( 'Link Button', 'obsius-core' );

		return $variations;
	}

	add_filter( 'obsius_core_filter_banner_layouts', 'obsius_core_add_banner_variation_link_button' );
}
