<?php

if ( ! function_exists( 'obsius_core_add_portfolio_title_options' ) ) {
	/**
	 * Function that add title options for portfolio module
	 */
	function obsius_core_add_portfolio_title_options( $tab ) {

		if ( $tab ) {
			$tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_enable_portfolio_title',
					'title'       => esc_html__( 'Enable Title on Portfolio Single', 'obsius-core' ),
					'description' => esc_html__( 'Use this option to enable/disable portfolio single title', 'obsius-core' ),
					'options'     => obsius_core_get_select_type_options_pool( 'yes_no' ),
				)
			);

			$tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_set_portfolio_title_area_in_grid',
					'title'       => esc_html__( 'Portfolio Title in Grid', 'obsius-core' ),
					'description' => esc_html__( 'Enabling this option will set portfolio title area to be in grid', 'obsius-core' ),
					'options'     => obsius_core_get_select_type_options_pool( 'yes_no' ),
				)
			);
		}
	}

	add_action( 'obsius_core_action_after_portfolio_options_single', 'obsius_core_add_portfolio_title_options' );
}
