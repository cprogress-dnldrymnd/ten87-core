<?php

if ( ! function_exists( 'obsius_core_add_clients_list_variation_image_only' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function obsius_core_add_clients_list_variation_image_only( $variations ) {
		$variations['image-only'] = esc_html__( 'Image Only', 'obsius-core' );

		return $variations;
	}

	add_filter( 'obsius_core_filter_clients_list_layouts', 'obsius_core_add_clients_list_variation_image_only' );
}
