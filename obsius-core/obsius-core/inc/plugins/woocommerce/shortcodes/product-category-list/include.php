<?php

include_once OBSIUS_CORE_PLUGINS_PATH . '/woocommerce/shortcodes/product-category-list/media-custom-fields.php';
include_once OBSIUS_CORE_PLUGINS_PATH . '/woocommerce/shortcodes/product-category-list/class-obsiuscore-product-category-list-shortcode.php';

foreach ( glob( OBSIUS_CORE_PLUGINS_PATH . '/woocommerce/shortcodes/product-category-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
