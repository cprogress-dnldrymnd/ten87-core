<?php

if ( ! function_exists( 'obsius_core_cf7_add_submit_form_tag' ) ) {
	/**
	 * Function that override default submit buttom html tag
	 */
	function obsius_core_cf7_add_submit_form_tag() {
		wpcf7_add_form_tag( 'submit', 'obsius_core_cf7_submit_form_tag_handler' );
	}
}

if ( ! function_exists( 'obsius_core_cf7_submit_form_tag_handler' ) ) {
	/**
	 * Function that override default submit buttom html tag
	 *
	 * @param array $tag
	 *
	 * @return string
	 */
	function obsius_core_cf7_submit_form_tag_handler( $tag ) {
		$tag   = new WPCF7_FormTag( $tag );
		$class = wpcf7_form_controls_class( $tag->type );
		$svg = obsius_core_get_svg_icon('button-arrow');

		$atts             = array();
		$atts['class']    = $tag->get_class_option( $class );
		$atts['class']   .= ' qodef-button qodef-size--normal qodef-html--link qodef-layout--outlined qodef-m';
		$atts['id']       = $tag->get_id_option();
		$atts['tabindex'] = $tag->get_option( 'tabindex', 'int', true );

		$value = isset( $tag->values[0] ) ? $tag->values[0] : '';
		if ( empty( $value ) ) {
			$value = esc_html__( 'Send', 'obsius-core' );
		}

		$atts['type'] = 'submit';
		$atts         = wpcf7_format_atts( $atts );

		$html = sprintf( '<button %1$s><span class="qodef-m-text">%2$s</span>' . $svg . '</button>', $atts, $value );

		return $html;
	}
}
