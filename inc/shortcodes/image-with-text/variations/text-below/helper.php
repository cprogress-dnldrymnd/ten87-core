<?php

if ( ! function_exists( 'obsius_core_add_image_with_text_variation_text_below' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function obsius_core_add_image_with_text_variation_text_below( $variations ) {
		$variations['text-below'] = esc_html__( 'Text Below', 'obsius-core' );

		return $variations;
	}

	add_filter( 'obsius_core_filter_image_with_text_layouts', 'obsius_core_add_image_with_text_variation_text_below' );
}
