<?php

if ( ! function_exists( 'obsius_core_add_team_single_meta_box' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function obsius_core_add_team_single_meta_box() {
		$qode_framework = qode_framework_get_framework_root();
		$has_single     = obsius_core_team_has_single();

		$page = $qode_framework->add_options_page(
			array(
				'scope' => array( 'team' ),
				'type'  => 'meta',
				'slug'  => 'team',
				'title' => esc_html__( 'Team Single', 'obsius-core' ),
			)
		);

		if ( $page ) {
			$section = $page->add_section_element(
				array(
					'name'        => 'qodef_team_general_section',
					'title'       => esc_html__( 'General Settings', 'obsius-core' ),
					'description' => esc_html__( 'General information about team member.', 'obsius-core' ),
				)
			);

			$section_team_label = $page->add_section_element(
				array(
					'name'        => 'qodef_team_label_section',
					'title'       => esc_html__( 'Team Label Item', 'wonderment-core' ),
					'description' => esc_html__( 'Team label - information about team.', 'wonderment-core' )
				)
			);

			if ( $has_single ) {
				$section->add_field_element(
					array(
						'field_type'  => 'select',
						'name'        => 'qodef_team_single_layout',
						'title'       => esc_html__( 'Single Layout', 'obsius-core' ),
						'description' => esc_html__( 'Choose default layout for team single', 'obsius-core' ),
						'options'     => array(
							'' => esc_html__( 'Default', 'obsius-core' ),
						),
					)
				);
			}

			$section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_team_member_role',
					'title'       => esc_html__( 'Role', 'obsius-core' ),
					'description' => esc_html__( 'Enter team member role', 'obsius-core' ),
				)
			);

			$section_team_label->add_field_element( array(
				'field_type'    => 'yesno',
				'default_value' => 'no',
				'name'          => 'qodef_show_team_label',
				'title'         => esc_html__( 'Enable Team Label Item', 'obsius-core' ),
				'description'   => esc_html__( 'Enabling this option will show settings about the team', 'obsius-core' ),
			) );

			$section_team_label->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_team_button_text',
					'title'       => esc_html__( 'Team Button Text', 'obsius-core' ),
					'description' => esc_html__( 'Enter button text', 'obsius-core' ),
					'dependency'    => array(
						'show' => array(
							'qodef_show_team_label' => array(
								'values'        => 'yes',
								'default_value' => ''
							)
						)
					),
				)
			);

			$section_team_label->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_team_button_link',
					'title'       => esc_html__( 'Team Button Link', 'obsius-core' ),
					'description' => esc_html__( 'Enter button Link', 'obsius-core' ),
					'dependency'    => array(
						'show' => array(
							'qodef_show_team_label' => array(
								'values'        => 'yes',
								'default_value' => ''
							)
						)
					),
				)
			);

			$social_icons_repeater = $section->add_repeater_element(
				array(
					'name'        => 'qodef_team_member_social_icons',
					'title'       => esc_html__( 'Social Networks', 'obsius-core' ),
					'description' => esc_html__( 'Populate team member social networks info', 'obsius-core' ),
					'button_text' => esc_html__( 'Add New Network', 'obsius-core' ),
				)
			);

			$social_icons_repeater->add_field_element(
				array(
					'field_type' => 'iconpack',
					'name'       => 'qodef_team_member_icon',
					'title'      => esc_html__( 'Icon', 'obsius-core' ),
				)
			);

			$social_icons_repeater->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_team_member_icon_link',
					'title'      => esc_html__( 'Icon Link', 'obsius-core' ),
				)
			);

			$social_icons_repeater->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_team_member_icon_target',
					'title'      => esc_html__( 'Icon Target', 'obsius-core' ),
					'options'    => obsius_core_get_select_type_options_pool( 'link_target' ),
				)
			);

			if ( $has_single ) {
				$section->add_field_element(
					array(
						'field_type'  => 'date',
						'name'        => 'qodef_team_member_birth_date',
						'title'       => esc_html__( 'Birth Date', 'obsius-core' ),
						'description' => esc_html__( 'Enter team member birth date', 'obsius-core' ),
					)
				);

				$section->add_field_element(
					array(
						'field_type'  => 'text',
						'name'        => 'qodef_team_member_email',
						'title'       => esc_html__( 'E-mail', 'obsius-core' ),
						'description' => esc_html__( 'Enter team member e-mail address', 'obsius-core' ),
					)
				);

				$section->add_field_element(
					array(
						'field_type'  => 'text',
						'name'        => 'qodef_team_member_address',
						'title'       => esc_html__( 'Address', 'obsius-core' ),
						'description' => esc_html__( 'Enter team member address', 'obsius-core' ),
					)
				);

				$section->add_field_element(
					array(
						'field_type'  => 'text',
						'name'        => 'qodef_team_member_education',
						'title'       => esc_html__( 'Education', 'obsius-core' ),
						'description' => esc_html__( 'Enter team member education', 'obsius-core' ),
					)
				);

				$section->add_field_element(
					array(
						'field_type'  => 'file',
						'name'        => 'qodef_team_member_resume',
						'title'       => esc_html__( 'Resume', 'obsius-core' ),
						'description' => esc_html__( 'Upload team member resume', 'obsius-core' ),
						'args'        => array(
							'allowed_type' => '[application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document]',
						),
					)
				);
			}

			// Hook to include additional options after module options
			do_action( 'obsius_core_action_after_team_meta_box_map', $page, $has_single );
		}
	}

	add_action( 'obsius_core_action_default_meta_boxes_init', 'obsius_core_add_team_single_meta_box' );
}
