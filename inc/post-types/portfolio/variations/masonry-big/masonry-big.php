<?php

if ( ! function_exists( 'obsius_core_add_portfolio_single_variation_masonry_big' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function obsius_core_add_portfolio_single_variation_masonry_big( $variations ) {
		$variations['masonry-big'] = esc_html__( 'Masonry - Big', 'obsius-core' );

		return $variations;
	}

	add_filter( 'obsius_core_filter_portfolio_single_layout_options', 'obsius_core_add_portfolio_single_variation_masonry_big' );
}

if ( ! function_exists( 'obsius_core_include_masonry_for_portfolio_single_variation_masonry_big' ) ) {
	/**
	 * Function that include masonry scripts for current module layout
	 *
	 * @param string $post_type
	 *
	 * @return string
	 */
	function obsius_core_include_masonry_for_portfolio_single_variation_masonry_big( $post_type ) {
		$portfolio_template = obsius_core_get_post_value_through_levels( 'qodef_portfolio_single_layout' );

		if ( 'masonry-big' === $portfolio_template ) {
			$post_type = 'portfolio-item';
		}

		return $post_type;
	}

	add_filter( 'obsius_filter_allowed_post_type_to_enqueue_masonry_scripts', 'obsius_core_include_masonry_for_portfolio_single_variation_masonry_big' );
}
