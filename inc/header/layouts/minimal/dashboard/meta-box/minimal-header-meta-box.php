<?php

if ( ! function_exists( 'obsius_core_add_minimal_header_meta' ) ) {
	/**
	 * Function that add additional header layout meta box options
	 *
	 * @param object $page
	 */
	function obsius_core_add_minimal_header_meta( $page ) {

		$section = $page->add_section_element(
			array(
				'name'       => 'qodef_minimal_header_section',
				'title'      => esc_html__( 'Minimal Header', 'obsius-core' ),
				'dependency' => array(
					'show' => array(
						'qodef_header_layout' => array(
							'values'        => 'minimal',
							'default_value' => '',
						),
					),
				),
			)
		);

		$section->add_field_element(
			array(
				'field_type'    => 'select',
				'name'          => 'qodef_minimal_header_in_grid',
				'title'         => esc_html__( 'Content in Grid', 'obsius-core' ),
				'description'   => esc_html__( 'Set content to be in grid', 'obsius-core' ),
				'default_value' => '',
				'options'       => obsius_core_get_select_type_options_pool( 'no_yes' ),
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_minimal_header_height',
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
				'name'        => 'qodef_minimal_header_side_padding',
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
				'name'        => 'qodef_minimal_header_background_color',
				'title'       => esc_html__( 'Header Background Color', 'obsius-core' ),
				'description' => esc_html__( 'Enter header background color', 'obsius-core' ),
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_minimal_header_border_color',
				'title'       => esc_html__( 'Header Border Color', 'obsius-core' ),
				'description' => esc_html__( 'Enter header border color', 'obsius-core' ),
			)
		);
	}

	add_action( 'obsius_core_action_after_page_header_meta_map', 'obsius_core_add_minimal_header_meta' );
}
