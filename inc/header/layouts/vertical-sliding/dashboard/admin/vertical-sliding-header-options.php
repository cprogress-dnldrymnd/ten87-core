<?php

if ( ! function_exists( 'obsius_core_add_vertical_sliding_header_options' ) ) {
	/**
	 * Function that add additional header layout options
	 *
	 * @param object $page
	 * @param array $general_header_tab
	 */
	function obsius_core_add_vertical_sliding_header_options( $page, $general_header_tab ) {

		$section = $general_header_tab->add_section_element(
			array(
				'name'       => 'qodef_vertical_sliding_header_section',
				'title'      => esc_html__( 'Vertical Sliding Header', 'obsius-core' ),
				'dependency' => array(
					'show' => array(
						'qodef_header_layout' => array(
							'values'        => 'vertical-sliding',
							'default_value' => '',
						),
					),
				),
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_vertical_sliding_header_background_color',
				'title'       => esc_html__( 'Header Background Color', 'obsius-core' ),
				'description' => esc_html__( 'Enter header background color', 'obsius-core' ),
			)
		);

		$section->add_field_element(
			array(
				'field_type'    => 'select',
				'name'          => 'qodef_vertical_sliding_menu_icon_source',
				'title'         => esc_html__( 'Icon Source', 'obsius-core' ),
				'options'       => obsius_core_get_select_type_options_pool( 'icon_source', false ),
				'default_value' => 'icon_pack',
			)
		);

		$section->add_field_element(
			array(
				'field_type'    => 'select',
				'name'          => 'qodef_vertical_sliding_menu_icon_pack',
				'title'         => esc_html__( 'Icon Pack', 'obsius-core' ),
				'options'       => qode_framework_icons()->get_icon_packs( array( 'linea-icons', 'dripicons', 'simple-line-icons' ) ),
				'default_value' => 'elegant-icons',
				'dependency'    => array(
					'show' => array(
						'qodef_vertical_sliding_menu_icon_source' => array(
							'values'        => 'icon_pack',
							'default_value' => 'icon_pack',
						),
					),
				),
			)
		);

		$section_svg_path = $general_header_tab->add_section_element(
			array(
				'title'      => esc_html__( 'SVG Path', 'obsius-core' ),
				'name'       => 'qodef_vertical_sliding_menu_svg_path_section',
				'dependency' => array(
					'show' => array(
						'qodef_vertical_sliding_menu_icon_source' => array(
							'values'        => 'svg_path',
							'default_value' => 'icon_pack',
						),
					),
				),
			)
		);

		$section_svg_path->add_field_element(
			array(
				'field_type'  => 'textarea',
				'name'        => 'qodef_vertical_sliding_menu_icon_svg_path',
				'title'       => esc_html__( 'Header Menu Open Icon SVG Path', 'obsius-core' ),
				'description' => esc_html__( 'Enter your header menu open icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'obsius-core' ),
			)
		);

		$section_svg_path->add_field_element(
			array(
				'field_type'  => 'textarea',
				'name'        => 'qodef_vertical_sliding_menu_close_icon_svg_path',
				'title'       => esc_html__( 'Header Menu Close Icon SVG Path', 'obsius-core' ),
				'description' => esc_html__( 'Enter your header menu close icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'obsius-core' ),
			)
		);
	}

	add_action( 'obsius_core_action_after_header_options_map', 'obsius_core_add_vertical_sliding_header_options', 10, 2 );
}

if ( ! function_exists( 'obsius_core_add_vertical_sliding_header_logo_options' ) ) {
	/**
	 * Function that add additional header logo options
	 *
	 * @param object $page
	 * @param array $header_tab
	 * @param array $logo_image_section
	 */
	function obsius_core_add_vertical_sliding_header_logo_options( $page, $header_tab, $logo_image_section ) {

		if ( $header_tab ) {
			$logo_image_section->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_logo_vertical_sliding',
					'title'       => esc_html__( 'Logo - Vertical Sliding', 'obsius-core' ),
					'description' => esc_html__( 'Choose vertical sliding area logo image', 'obsius-core' ),
					'multiple'    => 'no',
				)
			);
		}
	}

	add_action( 'obsius_core_action_after_header_logo_image_section_options_map', 'obsius_core_add_vertical_sliding_header_logo_options', 10, 3 );
}
