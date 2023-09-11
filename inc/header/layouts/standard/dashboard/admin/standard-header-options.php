<?php

if ( ! function_exists( 'obsius_core_add_standard_header_options' ) ) {
	/**
	 * Function that add additional header layout options
	 *
	 * @param object $page
	 * @param array $general_header_tab
	 */
	function obsius_core_add_standard_header_options( $page, $general_header_tab ) {

		$section = $general_header_tab->add_section_element(
			array(
				'name'        => 'qodef_standard_header_section',
				'title'       => esc_html__( 'Standard Header', 'obsius-core' ),
				'description' => esc_html__( 'Standard header settings', 'obsius-core' ),
				'dependency'  => array(
					'show' => array(
						'qodef_header_layout' => array(
							'values'        => 'standard',
							'default_value' => '',
						),
					),
				),
			)
		);

		$section->add_field_element(
			array(
				'field_type'    => 'yesno',
				'name'          => 'qodef_standard_header_in_grid',
				'title'         => esc_html__( 'Content in Grid', 'obsius-core' ),
				'description'   => esc_html__( 'Set content to be in grid', 'obsius-core' ),
				'default_value' => 'no',
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_standard_header_height',
				'title'       => esc_html__( 'Header Height', 'obsius-core' ),
				'description' => esc_html__( 'Enter header height', 'obsius-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px', 'obsius-core' ),
				),
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_standard_header_side_padding',
				'title'       => esc_html__( 'Header Side Padding', 'obsius-core' ),
				'description' => esc_html__( 'Enter side padding for header area', 'obsius-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px or %', 'obsius-core' ),
				),
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_standard_header_background_color',
				'title'       => esc_html__( 'Header Background Color', 'obsius-core' ),
				'description' => esc_html__( 'Enter header background color', 'obsius-core' ),
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_standard_header_border_color',
				'title'       => esc_html__( 'Header Border Color', 'obsius-core' ),
				'description' => esc_html__( 'Enter header border color', 'obsius-core' ),
			)
		);

		$section->add_field_element(
			array(
				'field_type'    => 'select',
				'name'          => 'qodef_standard_header_menu_position',
				'title'         => esc_html__( 'Menu position', 'obsius-core' ),
				'default_value' => 'right',
				'options'       => array(
					'left'   => esc_html__( 'Left', 'obsius-core' ),
					'center' => esc_html__( 'Center', 'obsius-core' ),
					'right'  => esc_html__( 'Right', 'obsius-core' ),
				),
			)
		);
	}

	add_action( 'obsius_core_action_after_header_options_map', 'obsius_core_add_standard_header_options', 10, 2 );
}
