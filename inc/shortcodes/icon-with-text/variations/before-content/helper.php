<?php

if ( ! function_exists( 'obsius_core_add_icon_with_text_variation_before_content' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function obsius_core_add_icon_with_text_variation_before_content( $variations ) {
		$variations['before-content'] = esc_html__( 'Before Content', 'obsius-core' );

		return $variations;
	}

	add_filter( 'obsius_core_filter_icon_with_text_layouts', 'obsius_core_add_icon_with_text_variation_before_content' );
}
