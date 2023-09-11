<?php

include_once OBSIUS_CORE_SHORTCODES_PATH . '/banner/class-obsiuscore-banner-shortcode.php';

foreach ( glob( OBSIUS_CORE_INC_PATH . '/shortcodes/banner/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
