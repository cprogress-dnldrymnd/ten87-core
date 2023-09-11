<?php

if ( ! function_exists( 'obsius_core_add_button_variation_outlined' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function obsius_core_add_button_variation_outlined( $variations ) {
		$variations['outlined'] = esc_html__( 'Outlined', 'obsius-core' );

		return $variations;
	}

	add_filter( 'obsius_core_filter_button_layouts', 'obsius_core_add_button_variation_outlined' );
}
