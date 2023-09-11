<?php

include_once OBSIUS_CORE_SHORTCODES_PATH . '/tabs/class-obsiuscore-tab-shortcode.php';
include_once OBSIUS_CORE_SHORTCODES_PATH . '/tabs/class-obsiuscore-tab-child-shortcode.php';

foreach ( glob( OBSIUS_CORE_SHORTCODES_PATH . '/tabs/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
