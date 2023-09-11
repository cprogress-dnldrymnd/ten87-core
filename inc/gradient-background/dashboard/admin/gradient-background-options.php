<?php

if ( ! function_exists( 'obsius_core_add_gradient_background_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function obsius_core_add_gradient_background_options( $page ) {

		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_gradient_background',
					'title'         => esc_html__( 'Enable Gradient Background', 'obsius-core' ),
					'default_value' => 'no'
				)
			);
		}

		$custom_cursor = $page->add_section_element(
			array(
				'name'       => 'qodef_gradient_background_section',
				'title'      => esc_html__( 'Gradient Background Section', 'obsius-core' ),
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
                    'top-center' => esc_html__( 'Top Center', 'obsius-core' ),
                    'top-left'   => esc_html__( 'Top Left', 'obsius-core' ),
                    'top-right'  => esc_html__( 'Top Right', 'obsius-core' ),
                    'none'       => esc_html__( 'None', 'obsius-core' ),
                ),
				'dependency'  => array(
					'show' => array(
						'qodef_gradient_background' => array(
							'values'        => 'yes',
							'default_value' => ''
						)
					)
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
                    'bottom-center' => esc_html__( 'Bottom Center', 'obsius-core' ),
                    'bottom-left'   => esc_html__( 'Bottom Left', 'obsius-core' ),
                    'bottom-right'  => esc_html__( 'Bottom Right', 'obsius-core' ),
                    'none'          => esc_html__( 'None', 'obsius-core' ),
                ),
				'dependency'  => array(
					'show' => array(
						'qodef_gradient_background' => array(
							'values'        => 'yes',
							'default_value' => ''
						)
					)
				)
			)
		);
	}

	add_action( 'obsius_core_action_after_general_options_map', 'obsius_core_add_gradient_background_options' );
}
