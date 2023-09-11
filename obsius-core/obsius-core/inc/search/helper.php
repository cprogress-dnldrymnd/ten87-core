<?php

if ( ! function_exists( 'obsius_core_search_include_widgets' ) ) {
	/**
	 * Function that includes widgets
	 */
	function obsius_core_search_include_widgets() {
		foreach ( glob( OBSIUS_CORE_INC_PATH . '/search/widgets/*/include.php' ) as $widget ) {
			include_once $widget;
		}
	}

	add_action( 'qode_framework_action_before_widgets_register', 'obsius_core_search_include_widgets' );
}

if ( ! function_exists( 'obsius_core_search_include_layout' ) ) {
	/**
	 * Function that includes module variations
	 *
	 * @instance ObsiusCore_Headers
	 */
	function obsius_core_search_include_layout() {
		$header_object = ObsiusCore_Headers::get_instance()->get_header_object();

		if ( ! empty( $header_object ) ) {
			$search_layout = $header_object->get_search_layout();
			$layouts       = apply_filters( 'obsius_core_filter_register_search_layouts', $header_layouts_option = array() );

			if ( ! empty( $layouts ) ) {
				foreach ( $layouts as $key => $value ) {
					if ( $search_layout === $key ) {
						$value::get_instance();
					}
				}
			}
		}
	}

	add_action( 'wp', 'obsius_core_search_include_layout' );
}

if ( ! function_exists( 'obsius_core_set_search_page_page_title' ) ) {
	/**
	 * Function that enable/disable page title area for search page
	 *
	 * @param bool $enable_page_title
	 *
	 * @return bool
	 */
	function obsius_core_set_search_page_page_title( $enable_page_title ) {
		$option = 'no' !== obsius_core_get_post_value_through_levels( 'qodef_search_page_enable_page_title' );

		if ( is_search() && '' !== $option ) {
			$enable_page_title = $option;
		}

		return $enable_page_title;
	}

	add_filter( 'obsius_filter_enable_page_title', 'obsius_core_set_search_page_page_title' );
}

if ( ! function_exists( 'obsius_core_set_search_page_sidebar_layout' ) ) {
	/**
	 * Function that return sidebar layout
	 *
	 * @param string $layout
	 *
	 * @return string
	 */
	function obsius_core_set_search_page_sidebar_layout( $layout ) {

		if ( is_search() ) {
			$option = obsius_core_get_post_value_through_levels( 'qodef_search_page_sidebar_layout' );

			if ( ! empty( $option ) ) {
				$layout = $option;
			}
		}

		return $layout;
	}

	add_filter( 'obsius_filter_sidebar_layout', 'obsius_core_set_search_page_sidebar_layout' );
}

if ( ! function_exists( 'obsius_core_set_search_page_custom_sidebar_name' ) ) {
	/**
	 * Function that return sidebar name
	 *
	 * @param string $sidebar_name
	 *
	 * @return string
	 */
	function obsius_core_set_search_page_custom_sidebar_name( $sidebar_name ) {

		if ( is_search() ) {
			$option = obsius_core_get_post_value_through_levels( 'qodef_search_page_custom_sidebar' );

			if ( ! empty( $option ) ) {
				$sidebar_name = $option;
			}
		}

		return $sidebar_name;
	}

	add_filter( 'obsius_filter_sidebar_name', 'obsius_core_set_search_page_custom_sidebar_name' );
}

if ( ! function_exists( 'obsius_core_set_search_page_sidebar_grid_gutter_classes' ) ) {
	/**
	 * Function that returns grid gutter classes
	 *
	 * @param string $classes
	 *
	 * @return string
	 */
	function obsius_core_set_search_page_sidebar_grid_gutter_classes( $classes ) {

		if ( is_search() ) {
			$option = obsius_core_get_post_value_through_levels( 'qodef_search_page_sidebar_grid_gutter' );

			if ( ! empty( $option ) ) {
				$classes = 'qodef-gutter--' . esc_attr( $option );
			}
		}

		return $classes;
	}

	add_filter( 'obsius_filter_grid_gutter_classes', 'obsius_core_set_search_page_sidebar_grid_gutter_classes' );
}

if ( ! function_exists( 'obsius_core_set_search_page_post_excerpt_length' ) ) {
	/**
	 * Function that set number of characters for excerpt on blog list page
	 *
	 * @param int $excerpt_length
	 *
	 * @return int
	 */
	function obsius_core_set_search_page_post_excerpt_length( $excerpt_length ) {
		$option = obsius_core_get_post_value_through_levels( 'qodef_search_page_excerpt_number_of_characters' );

		if ( '' !== $option ) {
			$excerpt_length = $option;
		}

		return $excerpt_length;
	}

	add_filter( 'obsius_filter_search_page_excerpt_length', 'obsius_core_set_search_page_post_excerpt_length' );
}
