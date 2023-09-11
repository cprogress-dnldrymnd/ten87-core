<?php

include_once OBSIUS_CORE_PLUGINS_PATH . '/woocommerce/shortcodes/product-list/class-obsiuscore-product-list-shortcode.php';

foreach ( glob( OBSIUS_CORE_PLUGINS_PATH . '/woocommerce/shortcodes/product-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
