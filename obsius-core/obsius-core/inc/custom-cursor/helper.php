<?php

if ( ! function_exists( 'obsius_core_is_custom_cursor_enabled' ) ) {
	/**
	 * Function that check is module enabled
	 *
	 * @return bool
	 */
	function obsius_core_is_custom_cursor_enabled() {
		return obsius_core_get_post_value_through_levels( 'qodef_custom_cursor' ) !== 'no';
	}
}

if ( ! function_exists( 'obsius_core_add_custom_cursor_body_classes' ) ) {
	/**
	 * Function that add additional class name into global class list for body tag
	 *
	 * @param array $classes
	 *
	 * @return array
	 */
	function obsius_core_add_custom_cursor_body_classes( $classes ) {
		$classes[] = obsius_core_is_custom_cursor_enabled() ? 'qodef-custom-cursor--enabled' : '';

		return $classes;
	}

	add_filter( 'body_class', 'obsius_core_add_custom_cursor_body_classes' );
}

if ( ! function_exists( 'obsius_core_load_custom_cursor' ) ) {
	/**
	 * Loads Back To Top HTML
	 */
	function obsius_core_load_custom_cursor() {

		if ( obsius_core_is_custom_cursor_enabled() ) {
			$parameters = array();

			obsius_core_template_part( 'custom-cursor', 'templates/custom-cursor', '', $parameters );
		}
	}

	add_action( 'obsius_action_before_wrapper_close_tag', 'obsius_core_load_custom_cursor' );
}

if ( ! function_exists( 'obsius_core_set_page_custom_cursor_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param string $style
	 *
	 * @return string
	 */
	function obsius_core_set_page_custom_cursor_styles( $style ) {
		if ( obsius_core_is_custom_cursor_enabled() ) {
			$small_dot_styles = array();
			$large_dot_styles = array();

			$small_dot_color = obsius_core_get_post_value_through_levels( 'qodef_custom_cursor_small_dot_color' );
			$large_dot_color = obsius_core_get_post_value_through_levels( 'qodef_custom_cursor_large_dot_color' );

			if ( ! empty( $small_dot_color ) ) {
				$small_dot_styles['background-color'] = $small_dot_color . ' !important';
			}

			if ( ! empty( $large_dot_color ) ) {
				$large_dot_styles['border-color'] = $large_dot_color . ' !important';
			}

			if ( ! empty( $small_dot_styles ) ) {
				$style .= qode_framework_dynamic_style( '#qodef-custom-cursor .qodef-cursor-dot-small', $small_dot_styles );
			}

			if ( ! empty( $large_dot_styles ) ) {
				$style .= qode_framework_dynamic_style( '#qodef-custom-cursor .qodef-cursor-dot-large', $large_dot_styles );
			}
		}

		return $style;
	}

	add_filter( 'obsius_filter_add_inline_style', 'obsius_core_set_page_custom_cursor_styles' );
}
