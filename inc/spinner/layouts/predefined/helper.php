<?php

if ( ! function_exists( 'obsius_core_add_predefined_spinner_layout_option' ) ) {
    /**
     * Function that set new value into page spinner layout options map
     *
     * @param array $layouts - module layouts
     *
     * @return array
     */
    function obsius_core_add_predefined_spinner_layout_option( $layouts ) {
        $layouts['predefined'] = esc_html__( 'Predefined', 'obsius-core' );

        return $layouts;
    }

    add_filter( 'obsius_core_filter_page_spinner_layout_options', 'obsius_core_add_predefined_spinner_layout_option' );
}

if ( ! function_exists( 'obsius_core_set_predefined_spinner_layout_as_default_option' ) ) {
    /**
     * Function that set default value for page spinner layout options map
     *
     * @param string $default_value
     *
     * @return string
     */
    function obsius_core_set_predefined_spinner_layout_as_default_option( $default_value ) {
        return 'predefined';
    }

    add_filter( 'obsius_core_filter_page_spinner_default_layout_option', 'obsius_core_set_predefined_spinner_layout_as_default_option' );
}
