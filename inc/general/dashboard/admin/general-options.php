<?php

if ( ! function_exists( 'obsius_core_add_general_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function obsius_core_add_general_options( $page ) {

		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_main_color',
					'title'       => esc_html__( 'Main Color', 'obsius-core' ),
					'description' => esc_html__( 'Choose the most dominant theme color', 'obsius-core' ),
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_page_background_color',
					'title'       => esc_html__( 'Page Background Color', 'obsius-core' ),
					'description' => esc_html__( 'Set background color', 'obsius-core' ),
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_page_background_image',
					'title'       => esc_html__( 'Page Background Image', 'obsius-core' ),
					'description' => esc_html__( 'Set background image', 'obsius-core' ),
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_page_background_repeat',
					'title'       => esc_html__( 'Page Background Image Repeat', 'obsius-core' ),
					'description' => esc_html__( 'Set background image repeat', 'obsius-core' ),
					'options'     => array(
						''          => esc_html__( 'Default', 'obsius-core' ),
						'no-repeat' => esc_html__( 'No Repeat', 'obsius-core' ),
						'repeat'    => esc_html__( 'Repeat', 'obsius-core' ),
						'repeat-x'  => esc_html__( 'Repeat-x', 'obsius-core' ),
						'repeat-y'  => esc_html__( 'Repeat-y', 'obsius-core' ),
					),
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_page_background_size',
					'title'       => esc_html__( 'Page Background Image Size', 'obsius-core' ),
					'description' => esc_html__( 'Set background image size', 'obsius-core' ),
					'options'     => array(
						''        => esc_html__( 'Default', 'obsius-core' ),
						'contain' => esc_html__( 'Contain', 'obsius-core' ),
						'cover'   => esc_html__( 'Cover', 'obsius-core' ),
					),
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_page_background_attachment',
					'title'       => esc_html__( 'Page Background Image Attachment', 'obsius-core' ),
					'description' => esc_html__( 'Set background image attachment', 'obsius-core' ),
					'options'     => array(
						''       => esc_html__( 'Default', 'obsius-core' ),
						'fixed'  => esc_html__( 'Fixed', 'obsius-core' ),
						'scroll' => esc_html__( 'Scroll', 'obsius-core' ),
					),
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_page_content_padding',
					'title'       => esc_html__( 'Page Content Padding', 'obsius-core' ),
					'description' => esc_html__( 'Set padding that will be applied for page content in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'obsius-core' ),
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_page_content_padding_mobile',
					'title'       => esc_html__( 'Page Content Padding Mobile', 'obsius-core' ),
					'description' => esc_html__( 'Set padding that will be applied for page content on mobile screens (1024px and below) in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'obsius-core' ),
				)
			);

			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_boxed',
					'title'         => esc_html__( 'Boxed Layout', 'obsius-core' ),
					'description'   => esc_html__( 'Set boxed layout', 'obsius-core' ),
					'default_value' => 'no',
				)
			);

			$boxed_section = $page->add_section_element(
				array(
					'name'       => 'qodef_boxed_section',
					'title'      => esc_html__( 'Boxed Layout Section', 'obsius-core' ),
					'dependency' => array(
						'hide' => array(
							'qodef_boxed' => array(
								'values'        => 'no',
								'default_value' => '',
							),
						),
					),
				)
			);

			$boxed_section->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_boxed_background_color',
					'title'       => esc_html__( 'Boxed Background Color', 'obsius-core' ),
					'description' => esc_html__( 'Set boxed background color', 'obsius-core' ),
				)
			);

			$boxed_section->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_boxed_background_pattern',
					'title'       => esc_html__( 'Boxed Background Pattern', 'obsius-core' ),
					'description' => esc_html__( 'Set boxed background pattern', 'obsius-core' ),
				)
			);

			$boxed_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_boxed_background_pattern_behavior',
					'title'       => esc_html__( 'Boxed Background Pattern Behavior', 'obsius-core' ),
					'description' => esc_html__( 'Set boxed background pattern behavior', 'obsius-core' ),
					'options'     => array(
						'fixed'  => esc_html__( 'Fixed', 'obsius-core' ),
						'scroll' => esc_html__( 'Scroll', 'obsius-core' ),
					),
				)
			);

			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_passepartout',
					'title'         => esc_html__( 'Passepartout', 'obsius-core' ),
					'description'   => esc_html__( 'Enabling this option will display a passepartout around website content', 'obsius-core' ),
					'default_value' => 'no',
				)
			);

			$passepartout_section = $page->add_section_element(
				array(
					'name'       => 'qodef_passepartout_section',
					'title'      => esc_html__( 'Passepartout Section', 'obsius-core' ),
					'dependency' => array(
						'hide' => array(
							'qodef_passepartout' => array(
								'values'        => 'no',
								'default_value' => '',
							),
						),
					),
				)
			);

			$passepartout_section->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_passepartout_color',
					'title'       => esc_html__( 'Passepartout Color', 'obsius-core' ),
					'description' => esc_html__( 'Choose background color for passepartout', 'obsius-core' ),
				)
			);

			$passepartout_section->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_passepartout_image',
					'title'       => esc_html__( 'Passepartout Background Image', 'obsius-core' ),
					'description' => esc_html__( 'Set background image for passepartout', 'obsius-core' ),
				)
			);

			$passepartout_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_passepartout_size',
					'title'       => esc_html__( 'Passepartout Size', 'obsius-core' ),
					'description' => esc_html__( 'Enter size amount for passepartout', 'obsius-core' ),
					'args'        => array(
						'suffix' => esc_html__( 'px or %', 'obsius-core' ),
					),
				)
			);

			$passepartout_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_passepartout_size_responsive',
					'title'       => esc_html__( 'Passepartout Responsive Size', 'obsius-core' ),
					'description' => esc_html__( 'Enter size amount for passepartout for smaller screens (1024px and below)', 'obsius-core' ),
					'args'        => array(
						'suffix' => esc_html__( 'px or %', 'obsius-core' ),
					),
				)
			);

			$page->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_content_width',
					'title'         => esc_html__( 'Initial Width of Content', 'obsius-core' ),
					'description'   => esc_html__( 'Choose the initial width of content which is in grid (applies to pages set to "Default Template" and rows set to "In Grid")', 'obsius-core' ),
					'options'       => obsius_core_get_select_type_options_pool( 'content_width', false ),
					'default_value' => '1100',
				)
			);

			// Hook to include additional options after module options
			do_action( 'obsius_core_action_after_general_options_map', $page );

			$page->add_field_element(
				array(
					'field_type'  => 'textarea',
					'name'        => 'qodef_custom_js',
					'title'       => esc_html__( 'Custom JS', 'obsius-core' ),
					'description' => esc_html__( 'Enter your custom JavaScript here', 'obsius-core' ),
				)
			);
		}
	}

	add_action( 'obsius_core_action_default_options_init', 'obsius_core_add_general_options', obsius_core_get_admin_options_map_position( 'general' ) );
}
