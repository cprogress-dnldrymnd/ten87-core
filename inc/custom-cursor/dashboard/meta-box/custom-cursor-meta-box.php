<?php

if ( ! function_exists( 'obsius_core_add_custom_cursor_meta_box' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function obsius_core_add_custom_cursor_meta_box( $general_tab ) {

		if ( $general_tab ) {

			$general_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_custom_cursor',
					'title'         => esc_html__( 'Enable Custom Cursor', 'obsius-core' ),
					'default_value' => '',
					'options'       => obsius_core_get_select_type_options_pool( 'yes_no' ),
				)
			);

			$custom_cursor = $general_tab->add_section_element(
				array(
					'name'       => 'qodef_custom_cursor_section',
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
				)
			);

			$custom_cursor->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_custom_cursor_large_dot_color',
					'title'       => esc_html__( 'Large Dot Color', 'obsius-core' ),
					'description' => esc_html__( 'Set custom cursor large dot color', 'obsius-core' ),
				)
			);
		}
	}

	add_action( 'obsius_core_action_after_general_page_meta_box_map', 'obsius_core_add_custom_cursor_meta_box' );
}
