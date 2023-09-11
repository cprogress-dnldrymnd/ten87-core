<?php

if ( ! function_exists( 'obsius_core_add_yith_color_and_label_variations_plugin_button_icon' ) ) {
	/**
	 * Function that add additional class name into global class list for body tag
	 *
	 * @param array $classes
	 *
	 * @return array
	 */
	function obsius_core_add_yith_color_and_label_variations_plugin_button_icon( $classes ) {

		$option = obsius_core_get_post_value_through_levels( 'qodef_enable_woo_yith_color_and_label_variations_predefined_style' );

		if ( 'yes' === $option ) {
			$classes[] = 'qodef-yith-wccl--predefined';
		}

		return $classes;
	}

	add_filter( 'body_class', 'obsius_core_add_yith_color_and_label_variations_plugin_button_icon' );
}
