<?php

if ( ! function_exists( 'obsius_core_include_portfolio_single_post_navigation_template' ) ) {
	/**
	 * Function which includes additional module on single portfolio page
	 */
	function obsius_core_include_portfolio_single_post_navigation_template() {
		obsius_core_template_part( 'post-types/portfolio', 'templates/single/single-navigation/templates/single-navigation' );
	}

	add_action( 'obsius_core_action_after_portfolio_single_item', 'obsius_core_include_portfolio_single_post_navigation_template' );
}
