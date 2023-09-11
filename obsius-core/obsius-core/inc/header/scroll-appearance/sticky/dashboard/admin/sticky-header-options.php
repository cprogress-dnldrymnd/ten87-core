<?php

if ( ! function_exists( 'obsius_core_add_sticky_header_options' ) ) {
	/**
	 * Function that add additional header layout global options
	 *
	 * @param object $page
	 * @param object $section
	 */
	function obsius_core_add_sticky_header_options( $page, $section ) {

		$sticky_section = $section->add_section_element(
			array(
				'name'       => 'qodef_sticky_header_section',
				'dependency' => array(
					'show' => array(
						'qodef_header_scroll_appearance' => array(
							'values'        => 'sticky',
							'default_value' => '',
						),
					),
				),
			)
		);

		$sticky_section->add_field_element(
			array(
				'field_type'    => 'select',
				'name'          => 'qodef_sticky_header_appearance',
				'title'         => esc_html__( 'Sticky Header Appearance', 'obsius-core' ),
				'description'   => esc_html__( 'Select the appearance of sticky header when you scrolling the page', 'obsius-core' ),
				'options'       => array(
					'down' => esc_html__( 'Show Sticky on Scroll Down/Up', 'obsius-core' ),
					'up'   => esc_html__( 'Show Sticky on Scroll Up', 'obsius-core' ),
				),
				'default_value' => 'down',
			)
		);

		$sticky_section->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_sticky_header_skin',
				'title'       => esc_html__( 'Sticky Header Skin', 'obsius-core' ),
				'description' => esc_html__( 'Choose a predefined sticky header style for header elements', 'obsius-core' ),
				'options'     => array(
					'none'  => esc_html__( 'None', 'obsius-core' ),
					'light' => esc_html__( 'Light', 'obsius-core' ),
					'dark'  => esc_html__( 'Dark', 'obsius-core' ),
				),
			)
		);

		$sticky_section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_sticky_header_scroll_amount',
				'title'       => esc_html__( 'Sticky Scroll Amount', 'obsius-core' ),
				'description' => esc_html__( 'Enter scroll amount for sticky header to appear', 'obsius-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px', 'obsius-core' ),
				),
			)
		);

		$sticky_section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_sticky_header_side_padding',
				'title'       => esc_html__( 'Sticky Header Side Padding', 'obsius-core' ),
				'description' => esc_html__( 'Enter side padding for sticky header area', 'obsius-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px or %', 'obsius-core' ),
				),
			)
		);

		$sticky_section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_sticky_header_background_color',
				'title'       => esc_html__( 'Sticky Header Background Color', 'obsius-core' ),
				'description' => esc_html__( 'Enter sticky header background color', 'obsius-core' ),
			)
		);

        $sticky_section->add_field_element(
            array(
                'field_type'    => 'select',
                'name'          => 'qodef_sticky_header_use_background_image_instead_of_color',
                'title'         => esc_html__( 'Use Sticky Header Background Image', 'obsius-core' ),
                'description'   => esc_html__( 'Use background image instead of background color', 'obsius-core' ),
                'options'       => obsius_core_get_select_type_options_pool( 'yes_no' ),
                'default_value' => 'yes',
            )
        );

        $sticky_section->add_field_element(
            array(
                'field_type'  => 'image',
                'name'        => 'qodef_sticky_header_background_image',
                'title'       => esc_html__( 'Sticky Header Background Image', 'obsius-core' ),
                'description' => esc_html__( 'Enter sticky header background image pattern which will be repeated in sticky header area (100x100px image is sufficient).', 'obsius-core' ),
            )
        );
	}

	add_action( 'obsius_core_action_after_header_scroll_appearance_options_map', 'obsius_core_add_sticky_header_options', 10, 2 );
}

if ( ! function_exists( 'obsius_core_add_sticky_header_logo_options' ) ) {
	/**
	 * Function that add additional header logo options
	 *
	 * @param object $page
	 * @param array $header_tab
	 * @param array $logo_image_section
	 */
	function obsius_core_add_sticky_header_logo_options( $page, $header_tab, $logo_image_section ) {

		if ( $header_tab ) {
			$logo_image_section->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_logo_sticky',
					'title'       => esc_html__( 'Logo - Sticky', 'obsius-core' ),
					'description' => esc_html__( 'Choose sticky logo image', 'obsius-core' ),
					'multiple'    => 'no',
				)
			);
		}
	}

	add_action( 'obsius_core_action_after_header_logo_image_section_options_map', 'obsius_core_add_sticky_header_logo_options', 10, 3 );
}

if ( ! function_exists( 'obsius_core_add_sticky_header_logo_svg_options' ) ) {
	/**
	 * Function that add additional header logo options
	 *
	 * @param object $page
	 * @param array $header_tab
	 * @param array $logo_svg_path_section
	 */
	function obsius_core_add_sticky_header_logo_svg_options( $page, $header_tab, $logo_svg_path_section ) {

		if ( $header_tab ) {
			$logo_svg_path_section->add_field_element(
				array(
					'field_type'  => 'textarea',
					'name'        => 'qodef_logo_sticky_svg_path',
					'title'       => esc_html__( 'Logo Sticky - SVG Path', 'obsius-core' ),
					'description' => esc_html__( 'Enter your logo icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'obsius-core' ),
				)
			);
		}
	}

	add_action( 'obsius_core_action_before_header_logo_svg_path_section_options_map', 'obsius_core_add_sticky_header_logo_svg_options', 10, 3 );
}
