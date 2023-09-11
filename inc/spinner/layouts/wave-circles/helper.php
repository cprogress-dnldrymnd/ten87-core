<?php

if ( ! function_exists( 'obsius_core_add_wave_circles_spinner_layout_option' ) ) {
	/**
	 * Function that set new value into page spinner layout options map
	 *
	 * @param array $layouts - module layouts
	 *
	 * @return array
	 */
	function obsius_core_add_wave_circles_spinner_layout_option( $layouts ) {
		$layouts['wave-circles'] = esc_html__( 'Wave Circles', 'obsius-core' );

		return $layouts;
	}

	add_filter( 'obsius_core_filter_page_spinner_layout_options', 'obsius_core_add_wave_circles_spinner_layout_option' );
}
