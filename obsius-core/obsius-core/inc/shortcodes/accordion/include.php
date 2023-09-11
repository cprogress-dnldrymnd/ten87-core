<?php

include_once OBSIUS_CORE_SHORTCODES_PATH . '/accordion/class-obsiuscore-accordion-shortcode.php';
include_once OBSIUS_CORE_SHORTCODES_PATH . '/accordion/class-obsiuscore-accordion-child-shortcode.php';

foreach ( glob( OBSIUS_CORE_SHORTCODES_PATH . '/accordion/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
