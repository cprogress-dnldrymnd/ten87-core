<?php

if ( ! function_exists( 'obsius_core_is_gradient_background_enabled' ) ) {
	/**
	 * Function that check is module enabled
	 *
	 * @return bool
	 */
	function obsius_core_is_gradient_background_enabled() {
		return obsius_core_get_post_value_through_levels( 'qodef_gradient_background' ) !== 'no';
	}
}

if ( ! function_exists( 'obsius_core_add_gradient_background_body_classes' ) ) {
	/**
	 * Function that add additional class name into global class list for body tag
	 *
	 * @param array $classes
	 *
	 * @return array
	 */
	function obsius_core_add_gradient_background_body_classes( $classes ) {
		$classes[] = obsius_core_is_gradient_background_enabled() ? 'qodef-gradient-background--enabled' : '';

		/* top gradient */
        $classes[] = 'qodef-gradient--' . obsius_core_get_post_value_through_levels( 'qodef_gradient_background_top_position' );

        /* bottom gradient */
        $classes[] = 'qodef-gradient--' . obsius_core_get_post_value_through_levels( 'qodef_gradient_background_bottom_position' );

		return $classes;
	}

	add_filter( 'body_class', 'obsius_core_add_gradient_background_body_classes' );
}
