<?php

include_once OBSIUS_CORE_PLUGINS_PATH . '/woocommerce/shortcodes/preview-product-slider/class-obsiuscore-preview-product-slider-shortcode.php';

foreach ( glob( OBSIUS_CORE_PLUGINS_PATH . '/woocommerce/shortcodes/preview-product-slider/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
