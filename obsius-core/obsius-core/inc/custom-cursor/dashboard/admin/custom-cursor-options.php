<?php

if ( ! function_exists( 'obsius_core_add_custom_cursor_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function obsius_core_add_custom_cursor_options( $page ) {

		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_custom_cursor',
					'title'         => esc_html__( 'Enable Custom Cursor', 'obsius-core' ),
					'default_value' => 'yes'
				)
			);
		}

		$custom_cursor = $page->add_section_element(
			array(
				'name'       => 'qodef_custom_cursor_section',
				'title'      => esc_html__( 'Custom Cursor Section', 'obsius-core' ),
				'dependency' => array(
					'hide' => array(
						'qodef_custom_cursor' => array(
							'values'        => 'no',
							'default_value' => '',
						),
					),
				),
			)
		);

		$custom_cursor->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_custom_cursor_small_dot_color',
				'title'       => esc_html__( 'Small Dot Color', 'obsius-core' ),
				'description' => esc_html__( 'Set custom cursor small dot color', 'obsius-core' ),
				'dependency'  => array(
					'show' => array(
						'qodef_custom_cursor' => array(
							'values'        => 'yes',
							'default_value' => ''
						)
					)
				)
			)
		);

		$custom_cursor->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_custom_cursor_large_dot_color',
				'title'       => esc_html__( 'Large Dot Color', 'obsius-core' ),
				'description' => esc_html__( 'Set custom cursor large dot color', 'obsius-core' ),
				'dependency'  => array(
					'show' => array(
						'qodef_custom_cursor' => array(
							'values'        => 'yes',
							'default_value' => ''
						)
					)
				)
			)
		);
	}

	add_action( 'obsius_core_action_after_general_options_map', 'obsius_core_add_custom_cursor_options' );
}
