<?php

if ( ! function_exists( 'obsius_core_add_icon_with_text_variation_before_title' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function obsius_core_add_icon_with_text_variation_before_title( $variations ) {
		$variations['before-title'] = esc_html__( 'Before Title', 'obsius-core' );

		return $variations;
	}

	add_filter( 'obsius_core_filter_icon_with_text_layouts', 'obsius_core_add_icon_with_text_variation_before_title' );
}
