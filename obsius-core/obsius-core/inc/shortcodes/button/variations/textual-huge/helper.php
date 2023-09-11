<?php

if ( ! function_exists( 'obsius_core_add_button_variation_textual_huge' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function obsius_core_add_button_variation_textual_huge( $variations ) {
		$variations['textual-huge'] = esc_html__( 'Textual Huge', 'obsius-core' );

		return $variations;
	}

	add_filter( 'obsius_core_filter_button_layouts', 'obsius_core_add_button_variation_textual_huge' );
}

if ( ! function_exists( 'obsius_core_add_button_variation_textual_huge_options_content_align' ) ) {
    /**
     * Function that add additional options for variation layout
     *
     * @param array $options
     *
     * @return array
     */
    function obsius_core_add_button_variation_textual_huge_options_content_align( $options, $default_layout ) {
        $button_options = array();

        $content_alignment_option = array(
            'field_type' => 'select',
            'name'       => 'content_alignment',
            'title'      => esc_html__( 'Content Alignment', 'obsius-core' ),
            'options'    => array(
                ''       => esc_html__( 'Default', 'obsius-core' ),
                'left'   => esc_html__( 'Left', 'obsius-core' ),
                'center' => esc_html__( 'Center', 'obsius-core' ),
                'right'  => esc_html__( 'Right', 'obsius-core' ),
            ),
            'dependency' => array(
                'show' => array(
                    'button_layout' => array(
                        'values'        => 'textual-huge',
                        'default_value' => $default_layout,
                    ),
                ),
            ),
        );

        $button_options[] = $content_alignment_option;

        return array_merge( $options, $button_options );
    }

    add_filter( 'obsius_core_filter_button_extra_options', 'obsius_core_add_button_variation_textual_huge_options_content_align', 10, 2 );
}

if ( ! function_exists( 'obsius_core_add_button_variation_textual_huge_classes_alignment' ) ) {
    /**
     * Function that return additional holder classes for this module
     *
     * @param array $holder_classes
     * @param array $atts
     *
     * @return array
     */
    function obsius_core_add_button_variation_textual_huge_classes_alignment( $holder_classes, $atts ) {

        if ( 'textual-huge' === $atts['button_layout'] ) {
            $holder_classes[] = ! empty( $atts['content_alignment'] ) ? 'qodef-alignment--' . $atts['content_alignment'] : 'qodef-alignment--center';
        }

        return $holder_classes;
    }

    add_filter( 'obsius_core_filter_button_variation_classes', 'obsius_core_add_button_variation_textual_huge_classes_alignment', 10, 2 );
}
