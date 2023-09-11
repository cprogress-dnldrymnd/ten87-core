<?php

if ( ! function_exists( 'obsius_core_add_blog_list_variation_metro' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function obsius_core_add_blog_list_variation_metro( $variations ) {
		$variations['metro'] = esc_html__( 'Metro', 'obsius-core' );

		return $variations;
	}

	add_filter( 'obsius_core_filter_blog_list_layouts', 'obsius_core_add_blog_list_variation_metro' );
}
