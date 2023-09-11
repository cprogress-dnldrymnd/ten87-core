<?php

if ( ! function_exists( 'obsius_core_include_instagram_shortcodes' ) ) {
	/**
	 * Function that includes shortcodes
	 */
	function obsius_core_include_instagram_shortcodes() {
		foreach ( glob( OBSIUS_CORE_PLUGINS_PATH . '/instagram/shortcodes/*/include.php' ) as $shortcode ) {
			include_once $shortcode;
		}
	}

	add_action( 'qode_framework_action_before_shortcodes_register', 'obsius_core_include_instagram_shortcodes' );
}

if ( ! function_exists( 'obsius_core_include_instagram_widgets' ) ) {
	/**
	 * Function that includes widgets
	 */
	function obsius_core_include_instagram_widgets() {
		foreach ( glob( OBSIUS_CORE_PLUGINS_PATH . '/instagram/shortcodes/*/widget/include.php' ) as $widget ) {
			include_once $widget;
		}
	}

	add_action( 'qode_framework_action_before_widgets_register', 'obsius_core_include_instagram_widgets' );
}

if ( ! function_exists( 'obsius_core_include_instagram_plugin_is_installed' ) ) {
	/**
	 * Function that set case is installed element for framework functionality
	 *
	 * @param bool $installed
	 * @param string $plugin - plugin name
	 *
	 * @return bool
	 */
	function obsius_core_include_instagram_plugin_is_installed( $installed, $plugin ) {
		if ( 'instagram' === $plugin ) {
			return defined( 'SBIVER' );
		}

		return $installed;
	}

	add_filter( 'qode_framework_filter_is_plugin_installed', 'obsius_core_include_instagram_plugin_is_installed', 10, 2 );
}

if ( ! function_exists( 'obsius_core_include_instagram_plugin_6_is_installed' ) ) {
    /**
     * Function that set case is installed element for framework functionality
     *
     * @param bool $installed
     * @param string $plugin - plugin name
     *
     * @return bool
     */
    function obsius_core_include_instagram_plugin_6_is_installed( $installed, $plugin ) {

        if ( 'instagram6' === $plugin ) {
            return defined( 'SBIVER' ) && SBIVER >= 6 ;
        }

        return $installed;
    }

    add_filter( 'qode_framework_filter_is_plugin_installed', 'obsius_core_include_instagram_plugin_6_is_installed', 10, 2 );
}

if ( ! function_exists( 'obsius_core_instagram_plugin_body_classes' ) ) {
    /**
     * Function that add additional class name into global class list for body tag
     *
     * @param array $classes
     *
     * @return array
     */
    function obsius_core_instagram_plugin_body_classes( $classes ) {

        $classes[] = 'qodef-sbi-instagram-plugin';

        return $classes;
    }
}

if ( qode_framework_is_installed( 'instagram6' ) ) {

    add_filter( 'body_class', 'obsius_core_instagram_plugin_body_classes' );

}
