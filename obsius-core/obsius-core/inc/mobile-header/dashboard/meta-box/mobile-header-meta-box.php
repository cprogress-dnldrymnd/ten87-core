<?php

if ( ! function_exists( 'obsius_core_add_page_mobile_header_meta_box' ) ) {
	/**
	 * Function that add general meta box options for this module
	 *
	 * @param object $page
	 */
	function obsius_core_add_page_mobile_header_meta_box( $page ) {

		if ( $page ) {
			$mobile_header_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-mobile-header',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Mobile Header Settings', 'obsius-core' ),
					'description' => esc_html__( 'Mobile header layout settings', 'obsius-core' ),
				)
			);

			$mobile_header_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_mobile_header_layout',
					'title'       => esc_html__( 'Mobile Header Layout', 'obsius-core' ),
					'description' => esc_html__( 'Choose a mobile header layout to set for your website', 'obsius-core' ),
					'args'        => array( 'images' => true ),
					'options'     => obsius_core_header_radio_to_select_options( apply_filters( 'obsius_core_filter_mobile_header_layout_option', array() ) ),
				)
			);

			$mobile_header_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_mobile_header_in_grid',
					'title'         => esc_html__( 'Content in Grid', 'obsius-core' ),
					'description'   => esc_html__( 'Set content to be in grid', 'obsius-core' ),
					'default_value' => '',
					'options'       => obsius_core_get_select_type_options_pool( 'no_yes' ),
				)
			);

			// Hook to include additional options after module options
			do_action( 'obsius_core_action_after_page_mobile_header_meta_map', $mobile_header_tab );
		}
	}

	add_action( 'obsius_core_action_after_general_meta_box_map', 'obsius_core_add_page_mobile_header_meta_box' );
}

if ( ! function_exists( 'obsius_core_add_general_mobile_header_meta_box_callback' ) ) {
	/**
	 * Function that set current meta box callback as general callback functions
	 *
	 * @param array $callbacks
	 *
	 * @return array
	 */
	function obsius_core_add_general_mobile_header_meta_box_callback( $callbacks ) {
		$callbacks['mobile-header'] = 'obsius_core_add_page_mobile_header_meta_box';

		return $callbacks;
	}

	add_filter( 'obsius_core_filter_general_meta_box_callbacks', 'obsius_core_add_general_mobile_header_meta_box_callback' );
}
