<?php

if ( ! function_exists( 'obsius_core_add_lines_spinner_layout_option' ) ) {
	/**
	 * Function that set new value into page spinner layout options map
	 *
	 * @param array $layouts - module layouts
	 *
	 * @return array
	 */
	function obsius_core_add_lines_spinner_layout_option( $layouts ) {
		$layouts['lines'] = esc_html__( 'Lines', 'obsius-core' );

		return $layouts;
	}

	add_filter( 'obsius_core_filter_page_spinner_layout_options', 'obsius_core_add_lines_spinner_layout_option' );
}
