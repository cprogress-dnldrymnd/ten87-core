<?php

if ( ! function_exists( 'obsius_core_add_portfolio_category_options' ) ) {
	/**
	 * Function that add general taxonomy options for this module
	 */
	function obsius_core_add_portfolio_category_options() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope' => array( 'portfolio-category' ),
				'type'  => 'taxonomy',
				'slug'  => 'portfolio-category',
			)
		);

		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type' => 'image',
					'name'       => 'qodef_portfolio_category_image',
					'title'      => esc_html__( 'Portfolio Category Image', 'obsius-core' ),
				)
			);
		}
	}

	add_action( 'obsius_core_action_register_cpt_tax_fields', 'obsius_core_add_portfolio_category_options' );
}
