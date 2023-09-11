<?php

if ( ! function_exists( 'obsius_core_add_icon_with_text_variation_after_content' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function obsius_core_add_icon_with_text_variation_after_content( $variations ) {
		$variations['after-content'] = esc_html__( 'After Content', 'obsius-core' );

		return $variations;
	}

	add_filter( 'obsius_core_filter_icon_with_text_layouts', 'obsius_core_add_icon_with_text_variation_after_content' );
}
