<?php

if ( ! function_exists( 'obsius_core_add_header_options' ) ) {
	/**
	 * Function that add header options for this module
	 */
	function obsius_core_add_header_options() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope'       => OBSIUS_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'layout'      => 'tabbed',
				'slug'        => 'header',
				'icon'        => 'fa fa-cog',
				'title'       => esc_html__( 'Header', 'obsius-core' ),
				'description' => esc_html__( 'Global Header Options', 'obsius-core' ),
			)
		);

		if ( $page ) {
			$general_tab = $page->add_tab_element(
				array(
					'name'  => 'tab-header-general',
					'icon'  => 'fa fa-cog',
					'title' => esc_html__( 'General Settings', 'obsius-core' ),
				)
			);

			$general_tab->add_field_element(
				array(
					'field_type'    => 'radio',
					'name'          => 'qodef_header_layout',
					'title'         => esc_html__( 'Header Layout', 'obsius-core' ),
					'description'   => esc_html__( 'Choose a header layout to set for your website', 'obsius-core' ),
					'args'          => array( 'images' => true ),
					'options'       => apply_filters( 'obsius_core_filter_header_layout_option', array() ),
					'default_value' => apply_filters( 'obsius_core_filter_header_layout_default_option_value', '' ),
				)
			);

			$general_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_header_skin',
					'title'       => esc_html__( 'Header Skin', 'obsius-core' ),
					'description' => esc_html__( 'Choose a predefined header style for header elements', 'obsius-core' ),
					'options'     => array(
						'none'  => esc_html__( 'None', 'obsius-core' ),
						'light' => esc_html__( 'Light', 'obsius-core' ),
						'dark'  => esc_html__( 'Dark', 'obsius-core' ),
					),
				)
			);

			// Hook to include additional options after module options
			do_action( 'obsius_core_action_after_header_options_map', $page, $general_tab );
		}
	}

	add_action( 'obsius_core_action_default_options_init', 'obsius_core_add_header_options', obsius_core_get_admin_options_map_position( 'header' ) );
}
