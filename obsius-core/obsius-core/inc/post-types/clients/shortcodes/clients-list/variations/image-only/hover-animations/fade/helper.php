<?php

if ( ! function_exists( 'obsius_core_filter_clients_list_image_only_fade' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function obsius_core_filter_clients_list_image_only_fade( $variations ) {
		$variations['fade'] = esc_html__( 'Fade', 'obsius-core' );

		return $variations;
	}

	add_filter( 'obsius_core_filter_clients_list_image_only_animation_options', 'obsius_core_filter_clients_list_image_only_fade' );
}
