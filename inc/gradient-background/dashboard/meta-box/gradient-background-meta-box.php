<?php

if ( ! function_exists( 'obsius_core_add_gradient_background_meta_box' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function obsius_core_add_gradient_background_meta_box( $general_tab ) {

		if ( $general_tab ) {

			$general_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_gradient_background',
					'title'         => esc_html__( 'Enable Gradient Background', 'obsius-core' ),
					'default_value' => '',
					'options'       => obsius_core_get_select_type_options_pool( 'yes_no' ),
				)
			);

			$custom_cursor = $general_tab->add_section_element(
				array(
					'name'       => 'qodef_gradient_background_section',
					'dependency' => array(
						'hide' => array(
							'qodef_gradient_background' => array(
								'values'        => 'no',
								'default_value' => '',
							),
						),
					),
				)
			);

			$custom_cursor->add_field_element(
                array(
                    'field_type'  => 'select',
                    'name'        => 'qodef_gradient_background_top_position',
                    'title'       => esc_html__( 'Gradient Top Position', 'obsius-core' ),
                    'description' => esc_html__( 'Set gradient background top position', 'obsius-core' ),
                    'options'     => array(
                        ''           => esc_html__( 'Default', 'obsius-core' ),
                        'top-center' => esc_html__( 'Top Center', 'obsius-core' ),
                        'top-left'   => esc_html__( 'Top Left', 'obsius-core' ),
                        'top-right'  => esc_html__( 'Top Right', 'obsius-core' ),
                        'none'       => esc_html__( 'None', 'obsius-core' ),
                    )
                )
			);

			$custom_cursor->add_field_element(
                array(
                    'field_type'  => 'select',
                    'name'        => 'qodef_gradient_background_bottom_position',
                    'title'       => esc_html__( 'Gradient Bottom Position', 'obsius-core' ),
                    'description' => esc_html__( 'Set gradient background bottom position', 'obsius-core' ),
                    'options'     => array(
                        ''              => esc_html__( 'Default', 'obsius-core' ),
                        'bottom-center' => esc_html__( 'Bottom Center', 'obsius-core' ),
                        'bottom-left'   => esc_html__( 'Bottom Left', 'obsius-core' ),
                        'bottom-right'  => esc_html__( 'Bottom Right', 'obsius-core' ),
                        'none'          => esc_html__( 'None', 'obsius-core' ),
                    ),
                )
			);
		}
	}

	add_action( 'obsius_core_action_after_general_page_meta_box_map', 'obsius_core_add_gradient_background_meta_box' );
}
