<?php

include_once OBSIUS_CORE_SHORTCODES_PATH . '/custom-font/class-obsiuscore-custom-font-shortcode.php';

foreach ( glob( OBSIUS_CORE_SHORTCODES_PATH . '/custom-font/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
