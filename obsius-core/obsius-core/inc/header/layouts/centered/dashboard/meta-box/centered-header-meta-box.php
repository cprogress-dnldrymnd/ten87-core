<?php

if ( ! function_exists( 'obsius_core_add_centered_header_meta' ) ) {
	/**
	 * Function that add additional header layout meta box options
	 *
	 * @param object $page
	 */
	function obsius_core_add_centered_header_meta( $page ) {

		$section = $page->add_section_element(
			array(
				'name'       => 'qodef_centered_header_section',
				'title'      => esc_html__( 'Centered Header', 'obsius-core' ),
				'dependency' => array(
					'show' => array(
						'qodef_header_layout' => array(
							'values'        => 'centered',
							'default_value' => '',
						),
					),
				),
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_centered_header_height',
				'title'       => esc_html__( 'Header Height', 'obsius-core' ),
				'description' => esc_html__( 'Enter header height', 'obsius-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px', 'obsius-core' ),
				),
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_centered_header_background_color',
				'title'       => esc_html__( 'Header Background Color', 'obsius-core' ),
				'description' => esc_html__( 'Enter header background color', 'obsius-core' ),
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_centered_header_border_color',
				'title'       => esc_html__( 'Header Border Color', 'obsius-core' ),
				'description' => esc_html__( 'Enter header border color', 'obsius-core' ),
			)
		);
	}

	add_action( 'obsius_core_action_after_page_header_meta_map', 'obsius_core_add_centered_header_meta' );
}
