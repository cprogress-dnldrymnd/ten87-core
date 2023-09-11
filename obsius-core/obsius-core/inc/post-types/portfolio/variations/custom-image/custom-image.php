<?php

if ( ! function_exists( 'obsius_core_add_portfolio_single_variation_custom_image' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function obsius_core_add_portfolio_single_variation_custom_image( $variations ) {
		$variations['custom-image'] = esc_html__( 'Custom Image', 'obsius-core' );

		return $variations;
	}

	add_filter( 'obsius_core_filter_portfolio_single_layout_options', 'obsius_core_add_portfolio_single_variation_custom_image' );
}

if ( ! function_exists( 'obsius_core_portfolio_custom_image_imagesingle_image_media' ) ) {
	/**
	 * Function that load media part template
	 *
	 */
	function obsius_core_portfolio_custom_image_imagesingle_image_media() {
		$params   = array ();
		$item_layout = apply_filters( 'obsius_core_filter_portfolio_single_layout', '' );

		if ( is_singular( 'portfolio-item' ) && 'custom-image' === $item_layout ) {

			obsius_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/image-background' );
		}
	}

	add_action( 'obsius_action_before_page_inner', 'obsius_core_portfolio_custom_image_imagesingle_image_media' );
}