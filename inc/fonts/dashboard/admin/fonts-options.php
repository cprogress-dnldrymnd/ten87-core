<?php

if ( ! function_exists( 'obsius_core_add_fonts_options' ) ) {
	/**
	 * Function that add options for this module
	 */
	function obsius_core_add_fonts_options() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope'       => OBSIUS_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'fonts',
				'title'       => esc_html__( 'Fonts', 'obsius-core' ),
				'description' => esc_html__( 'Global Fonts Options', 'obsius-core' ),
				'icon'        => 'fa fa-cog',
			)
		);

		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_google_fonts',
					'title'         => esc_html__( 'Enable Google Fonts', 'obsius-core' ),
					'default_value' => 'yes',
					'args'          => array(
						'custom_class' => 'qodef-enable-google-fonts',
					),
				)
			);

			$google_fonts_section = $page->add_section_element(
				array(
					'name'       => 'qodef_google_fonts_section',
					'title'      => esc_html__( 'Google Fonts Options', 'obsius-core' ),
					'dependency' => array(
						'show' => array(
							'qodef_enable_google_fonts' => array(
								'values'        => 'yes',
								'default_value' => '',
							),
						),
					),
				)
			);

			$page_repeater = $google_fonts_section->add_repeater_element(
				array(
					'name'        => 'qodef_choose_google_fonts',
					'title'       => esc_html__( 'Google Fonts to Include', 'obsius-core' ),
					'description' => esc_html__( 'Choose Google Fonts which you want to use on your website', 'obsius-core' ),
					'button_text' => esc_html__( 'Add New Google Font', 'obsius-core' ),
				)
			);

			$page_repeater->add_field_element(
				array(
					'field_type'  => 'googlefont',
					'name'        => 'qodef_choose_google_font',
					'title'       => esc_html__( 'Google Font', 'obsius-core' ),
					'description' => esc_html__( 'Choose Google Font', 'obsius-core' ),
					'args'        => array(
						'include' => 'google-fonts',
					),
				)
			);

			$google_fonts_section->add_field_element(
				array(
					'field_type'  => 'checkbox',
					'name'        => 'qodef_google_fonts_weight',
					'title'       => esc_html__( 'Google Fonts Weight', 'obsius-core' ),
					'description' => esc_html__( 'Choose a default Google Fonts weights for your website. Impact on page load time', 'obsius-core' ),
					'options'     => array(
						'100'  => esc_html__( '100 Thin', 'obsius-core' ),
						'100i' => esc_html__( '100 Thin Italic', 'obsius-core' ),
						'200'  => esc_html__( '200 Extra-Light', 'obsius-core' ),
						'200i' => esc_html__( '200 Extra-Light Italic', 'obsius-core' ),
						'300'  => esc_html__( '300 Light', 'obsius-core' ),
						'300i' => esc_html__( '300 Light Italic', 'obsius-core' ),
						'400'  => esc_html__( '400 Regular', 'obsius-core' ),
						'400i' => esc_html__( '400 Regular Italic', 'obsius-core' ),
						'500'  => esc_html__( '500 Medium', 'obsius-core' ),
						'500i' => esc_html__( '500 Medium Italic', 'obsius-core' ),
						'600'  => esc_html__( '600 Semi-Bold', 'obsius-core' ),
						'600i' => esc_html__( '600 Semi-Bold Italic', 'obsius-core' ),
						'700'  => esc_html__( '700 Bold', 'obsius-core' ),
						'700i' => esc_html__( '700 Bold Italic', 'obsius-core' ),
						'800'  => esc_html__( '800 Extra-Bold', 'obsius-core' ),
						'800i' => esc_html__( '800 Extra-Bold Italic', 'obsius-core' ),
						'900'  => esc_html__( '900 Ultra-Bold', 'obsius-core' ),
						'900i' => esc_html__( '900 Ultra-Bold Italic', 'obsius-core' ),
					),
				)
			);

			$google_fonts_section->add_field_element(
				array(
					'field_type'  => 'checkbox',
					'name'        => 'qodef_google_fonts_subset',
					'title'       => esc_html__( 'Google Fonts Style', 'obsius-core' ),
					'description' => esc_html__( 'Choose a default Google Fonts style for your website. Impact on page load time', 'obsius-core' ),
					'options'     => array(
						'latin'        => esc_html__( 'Latin', 'obsius-core' ),
						'latin-ext'    => esc_html__( 'Latin Extended', 'obsius-core' ),
						'cyrillic'     => esc_html__( 'Cyrillic', 'obsius-core' ),
						'cyrillic-ext' => esc_html__( 'Cyrillic Extended', 'obsius-core' ),
						'greek'        => esc_html__( 'Greek', 'obsius-core' ),
						'greek-ext'    => esc_html__( 'Greek Extended', 'obsius-core' ),
						'vietnamese'   => esc_html__( 'Vietnamese', 'obsius-core' ),
					),
				)
			);

			$page_repeater = $page->add_repeater_element(
				array(
					'name'        => 'qodef_custom_fonts',
					'title'       => esc_html__( 'Custom Fonts', 'obsius-core' ),
					'description' => esc_html__( 'Add custom fonts', 'obsius-core' ),
					'button_text' => esc_html__( 'Add New Custom Font', 'obsius-core' ),
				)
			);

			$page_repeater->add_field_element(
				array(
					'field_type' => 'file',
					'name'       => 'qodef_custom_font_ttf',
					'title'      => esc_html__( 'Custom Font TTF', 'obsius-core' ),
					'args'       => array(
						'allowed_type' => 'application/octet-stream',
					),
				)
			);

			$page_repeater->add_field_element(
				array(
					'field_type' => 'file',
					'name'       => 'qodef_custom_font_otf',
					'title'      => esc_html__( 'Custom Font OTF', 'obsius-core' ),
					'args'       => array(
						'allowed_type' => 'application/octet-stream',
					),
				)
			);

			$page_repeater->add_field_element(
				array(
					'field_type' => 'file',
					'name'       => 'qodef_custom_font_woff',
					'title'      => esc_html__( 'Custom Font WOFF', 'obsius-core' ),
					'args'       => array(
						'allowed_type' => 'application/octet-stream',
					),
				)
			);

			$page_repeater->add_field_element(
				array(
					'field_type' => 'file',
					'name'       => 'qodef_custom_font_woff2',
					'title'      => esc_html__( 'Custom Font WOFF2', 'obsius-core' ),
					'args'       => array(
						'allowed_type' => 'application/octet-stream',
					),
				)
			);

			$page_repeater->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_custom_font_name',
					'title'      => esc_html__( 'Custom Font Name', 'obsius-core' ),
				)
			);

			// Hook to include additional options after module options
			do_action( 'obsius_core_action_after_page_fonts_options_map', $page );
		}
	}

	add_action( 'obsius_core_action_default_options_init', 'obsius_core_add_fonts_options', obsius_core_get_admin_options_map_position( 'fonts' ) );
}
