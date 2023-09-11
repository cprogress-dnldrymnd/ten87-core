<?php

if ( ! function_exists( 'obsius_core_add_yith_wishlist_options' ) ) {
	/**
	 * Function that add general options for this module
	 *
	 * @param object $page
	 */
	function obsius_core_add_yith_wishlist_options( $page ) {

		if ( $page ) {

			$yith_wishlist_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-yith-wishlist',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'YITH Wishlist', 'obsius-core' ),
					'description' => esc_html__( 'Settings related to YITH Wishlist', 'obsius-core' ),
				)
			);

			$yith_wishlist_tab->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_woo_yith_wishlist_predefined_style',
					'title'         => esc_html__( 'Enable Predefined Style', 'obsius-core' ),
					'description'   => esc_html__( 'Enabling this option will set predefined style for YITH Wishlist plugin', 'obsius-core' ),
					'options'       => obsius_core_get_select_type_options_pool( 'no_yes', false ),
					'default_value' => 'yes',
				)
			);
		}
	}

	add_action( 'obsius_core_action_after_woo_options_map', 'obsius_core_add_yith_wishlist_options' );
}
