<?php

if ( ! function_exists( 'obsius_core_add_button_variation_outlined_revealing' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function obsius_core_add_button_variation_outlined_revealing( $variations ) {
		$variations['outlined-revealing'] = esc_html__( 'Outlined Revealing', 'obsius-core' );

		return $variations;
	}

	add_filter( 'obsius_core_filter_button_layouts', 'obsius_core_add_button_variation_outlined_revealing' );
}
