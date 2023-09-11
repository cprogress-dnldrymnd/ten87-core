<?php

if ( ! function_exists( 'obsius_core_add_banner_variation_link_overlay' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function obsius_core_add_banner_variation_link_overlay( $variations ) {
		$variations['link-overlay'] = esc_html__( 'Link Overlay', 'obsius-core' );

		return $variations;
	}

	add_filter( 'obsius_core_filter_banner_layouts', 'obsius_core_add_banner_variation_link_overlay' );
}
