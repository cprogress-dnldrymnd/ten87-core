<?php

if ( ! function_exists( 'obsius_core_add_link_typography_options' ) ) {
	/**
	 * Function that add general options for this module
	 *
	 * @param object $page
	 */
	function obsius_core_add_link_typography_options( $page ) {

		if ( $page ) {
			$link_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-link',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Link Typography', 'obsius-core' ),
					'description' => esc_html__( 'Set values for link', 'obsius-core' ),
				)
			);

			$link_typography_section = $link_tab->add_section_element(
				array(
					'name'  => 'qodef_link_typography_section',
					'title' => esc_html__( 'General Typography', 'obsius-core' ),
				)
			);

			$link_typography_row = $link_typography_section->add_row_element(
				array(
					'name' => 'qodef_link_typography_row',
				)
			);

			$link_typography_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_link_color',
					'title'      => esc_html__( 'Color', 'obsius-core' ),
					'args'       => array(
						'col_width' => 4,
					),
				)
			);

			$link_typography_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_link_hover_color',
					'title'      => esc_html__( 'Hover Color', 'obsius-core' ),
					'args'       => array(
						'col_width' => 4,
					),
				)
			);

			$link_typography_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_link_font_weight',
					'title'      => esc_html__( 'Font Weight', 'obsius-core' ),
					'options'    => obsius_core_get_select_type_options_pool( 'font_weight' ),
					'args'       => array(
						'col_width' => 4,
					),
				)
			);

			$link_typography_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_link_font_style',
					'title'      => esc_html__( 'Font Style', 'obsius-core' ),
					'options'    => obsius_core_get_select_type_options_pool( 'font_style' ),
					'args'       => array(
						'col_width' => 4,
					),
				)
			);

			$link_typography_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_link_text_decoration',
					'title'      => esc_html__( 'Text Decoration', 'obsius-core' ),
					'options'    => obsius_core_get_select_type_options_pool( 'text_decoration' ),
					'args'       => array(
						'col_width' => 4,
					),
				)
			);

			$link_typography_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_link_hover_text_decoration',
					'title'      => esc_html__( 'Hover Text Decoration', 'obsius-core' ),
					'options'    => obsius_core_get_select_type_options_pool( 'text_decoration' ),
					'args'       => array(
						'col_width' => 4,
					),
				)
			);
		}
	}

	add_action( 'obsius_core_action_after_typography_options_map', 'obsius_core_add_link_typography_options' );
}
