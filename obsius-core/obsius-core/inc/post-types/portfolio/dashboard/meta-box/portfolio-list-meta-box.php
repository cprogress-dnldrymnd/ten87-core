<?php

if ( ! function_exists( 'obsius_core_add_portfolio_item_list_meta_boxes' ) ) {
	/**
	 * Function that add general meta box options for this module
	 *
	 * @param object $page
	 */
	function obsius_core_add_portfolio_item_list_meta_boxes( $page ) {

		if ( $page ) {

			$list_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-list',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'List Settings', 'obsius-core' ),
					'description' => esc_html__( 'Portfolio list settings', 'obsius-core' ),
				)
			);

			$list_tab->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_portfolio_list_image',
					'title'       => esc_html__( 'Portfolio List Image', 'obsius-core' ),
					'description' => esc_html__( 'Upload image to be displayed on portfolio list instead of featured image', 'obsius-core' ),
				)
			);

            $list_tab->add_field_element(
                array(
                    'field_type'  => 'image',
                    'name'        => 'qodef_portfolio_list_double_image',
                    'title'       => esc_html__( 'Portfolio List Double Image', 'obsius-core' ),
                    'description' => esc_html__( 'Upload image to be displayed on portfolio list double image element as secondary image', 'obsius-core' ),
                )
            );

            $list_tab->add_field_element(
                array(
                    'field_type'  => 'text',
                    'name'        => 'qodef_portfolio_list_client',
                    'title'       => esc_html__( 'Portfolio List Client', 'obsius-core' ),
                    'description' => esc_html__( 'Set Client name to be displayed on portfolio list table element.', 'obsius-core' ),
                )
            );

            $list_tab->add_field_element(
                array(
                    'field_type'  => 'text',
                    'name'        => 'qodef_portfolio_list_year',
                    'title'       => esc_html__( 'Portfolio List Year', 'obsius-core' ),
                    'description' => esc_html__( 'Set Year to be displayed on portfolio list table element.', 'obsius-core' ),
                )
            );

			$list_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_masonry_image_dimension_portfolio_item',
					'title'       => esc_html__( 'Image Dimension', 'obsius-core' ),
					'description' => esc_html__( 'Choose an image layout for "masonry behavior" portfolio list. If you are using fixed image proportions on the list, choose an option other than default', 'obsius-core' ),
					'options'     => obsius_core_get_select_type_options_pool( 'masonry_image_dimension' ),
				)
			);

            $list_tab->add_field_element(
                array(
                    'field_type'    => 'select',
                    'name'          => 'replace_image_with_decoration_portfolio_item',
                    'title'         => esc_html__( 'Display as decoration', 'obsius-core' ),
                    'description'   => esc_html__( 'Display decoration shape instead if the image in default portfolio list (enabling this option will exclude item form the portfolio single navigation, archives, search results, and they won\'t be clickable on the default portfolio list )', 'obsius-core' ),
                    'options'     => array(
                        ''                 => esc_html__( 'Default (No)', 'obsius-core' ),
                        'decoration-shape' => esc_html__( 'Decoration Shape', 'obsius-core' ),
                        'decoration-glow'  => esc_html__( 'Decoration Glow', 'obsius-core' ),
                    ),
                    'default_value' => '',
                )
            );

			$list_tab->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_portfolio_item_padding',
					'title'       => esc_html__( 'Portfolio Item Custom Padding', 'obsius-core' ),
					'description' => esc_html__( 'Choose item padding when it appears in portfolio list (ex. 5% 5% 5% 5%)', 'obsius-core' ),
				)
			);

			$list_tab->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_portfolio_single_external_link',
					'title'       => esc_html__( 'Portfolio External Link', 'obsius-core' ),
					'description' => esc_html__( 'Enter URL to link from Portfolio List element', 'obsius-core' ),
				)
			);

			$list_tab->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_portfolio_single_external_link_target',
					'title'      => esc_html__( 'Portfolio External Link Target', 'obsius-core' ),
					'options'    => obsius_core_get_select_type_options_pool( 'link_target' ),
				)
			);

			// Hook to include additional options after module options
			do_action( 'obsius_core_action_after_portfolio_list_meta_box_map', $list_tab );
		}
	}

	add_action( 'obsius_core_action_after_portfolio_meta_box_map', 'obsius_core_add_portfolio_item_list_meta_boxes' );
}
