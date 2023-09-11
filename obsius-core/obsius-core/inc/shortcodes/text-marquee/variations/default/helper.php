<?php

if ( ! function_exists( 'obsius_core_add_text_marquee_variation_default' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function obsius_core_add_text_marquee_variation_default( $variations ) {
		$variations['default'] = esc_html__( 'Default', 'obsius-core' );

		return $variations;
	}

	add_filter( 'obsius_core_filter_text_marquee_layouts', 'obsius_core_add_text_marquee_variation_default' );
}
