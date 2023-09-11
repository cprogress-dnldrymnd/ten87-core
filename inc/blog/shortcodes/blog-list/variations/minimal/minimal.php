<?php

if ( ! function_exists( 'obsius_core_add_blog_list_variation_minimal' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function obsius_core_add_blog_list_variation_minimal( $variations ) {
		$variations['minimal'] = esc_html__( 'Minimal', 'obsius-core' );

		return $variations;
	}

	add_filter( 'obsius_core_filter_blog_list_layouts', 'obsius_core_add_blog_list_variation_minimal' );
	add_filter( 'obsius_core_filter_simple_blog_list_widget_layouts', 'obsius_core_add_blog_list_variation_minimal' );
}
