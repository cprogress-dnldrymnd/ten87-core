<?php

if ( ! function_exists( 'obsius_core_add_standard_mobile_header_options' ) ) {
	/**
	 * Function that add additional header layout options
	 *
	 * @param object $page
	 * @param array  $general_tab
	 */
	function obsius_core_add_standard_mobile_header_options( $page, $general_tab ) {

		$section = $general_tab->add_section_element(
			array(
				'name'       => 'qodef_standard_mobile_header_section',
				'title'      => esc_html__( 'Standard Mobile Header', 'obsius-core' ),
				'dependency' => array(
					'show' => array(
						'qodef_mobile_header_layout' => array(
							'values'        => 'standard',
							'default_value' => '',
						),
					),
				),
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_standard_mobile_header_height',
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
				'name'        => 'qodef_standard_mobile_header_side_padding',
				'title'       => esc_html__( 'Header Side Padding', 'obsius-core' ),
				'description' => esc_html__( 'Enter side padding for header area', 'obsius-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px or %', 'obsius-core' ),
				),
				'dependency'  => array(
					'show' => array(
						'qodef_mobile_header_in_grid' => array(
							'values'        => 'no',
							'default_value' => 'no',
						),
					),
				),
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_standard_mobile_header_background_color',
				'title'       => esc_html__( 'Header Background Color', 'obsius-core' ),
				'description' => esc_html__( 'Enter header background color', 'obsius-core' ),
			)
		);
	}

	add_action( 'obsius_core_action_after_mobile_header_options_map', 'obsius_core_add_standard_mobile_header_options', 10, 2 );
}
