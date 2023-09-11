<?php

if ( ! function_exists( 'obsius_core_add_preview_product_slider_variation_info_left' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function obsius_core_add_preview_product_slider_variation_info_left( $variations ) {
		$variations['info-left'] = esc_html__( 'Info Left', 'obsius-core' );

		return $variations;
	}

	add_filter( 'obsius_core_filter_preview_product_slider_layouts', 'obsius_core_add_preview_product_slider_variation_info_left' );
}

if ( ! function_exists( 'obsius_core_register_shop_list_info_left_actions' ) ) {
	/**
	 * Function that override product item layout for current variation type
	 */
	function obsius_core_register_shop_list_info_left_actions() {

		// Add additional tags around product list item
		add_action( 'woocommerce_before_shop_loop_item', 'obsius_add_preview_product_slider_item_holder', 5 ); // permission 5 is set because woocommerce_template_loop_product_link_open hook is added on 10
		add_action( 'woocommerce_after_shop_loop_item', 'obsius_add_preview_product_slider_item_holder_end', 30 ); // permission 30 is set because woocommerce_template_loop_add_to_cart hook is added on 10

		// Add additional tags around product list item image
		add_action( 'woocommerce_before_shop_loop_item_title', 'obsius_add_preview_product_slider_item_image_holder', 5 ); // permission 5 is set because woocommerce_show_product_loop_sale_flash hook is added on 10
		add_action( 'woocommerce_before_shop_loop_item_title', 'obsius_add_preview_product_slider_item_image_holder_end', 30 ); // permission 30 is set because woocommerce_template_loop_product_thumbnail hook is added on 10

		// Add additional tags around content inside product list item image
		add_action( 'woocommerce_before_shop_loop_item_title', 'obsius_add_preview_product_slider_item_additional_image_holder', 15 ); // permission 15 is set because woocommerce_template_loop_product_thumbnail hook is added on 10
		add_action( 'woocommerce_before_shop_loop_item_title', 'obsius_add_preview_product_slider_item_additional_image_holder_end', 25 ); // permission 25 is set because obsius_add_preview_product_slider_item_image_holder_end hook is added on 30

		// Add additional tags around product list item content
		add_action( 'woocommerce_shop_loop_item_title', 'obsius_add_preview_product_slider_item_content_holder', 5 ); // permission 5 is set because woocommerce_template_loop_product_title hook is added on 10
		add_action( 'woocommerce_after_shop_loop_item', 'obsius_add_preview_product_slider_item_content_holder_end', 20 ); // permission 30 is set because woocommerce_template_loop_add_to_cart hook is added on 10

		// Add product categories on list
		add_action( 'woocommerce_shop_loop_item_title', 'obsius_add_preview_product_slider_item_categories', 8 ); // permission 8 is set to be before woocommerce_template_loop_product_title hook it's added on 10

		// Change add to cart position on product list
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 ); // permission 10 is default
		add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 20 ); // permission 20 is set because obsius_add_preview_product_slider_item_additional_image_holder hook is added on 15
	}

	add_action( 'obsius_core_action_shop_list_item_layout_info-left', 'obsius_core_register_shop_list_info_left_actions' );
}
