<?php

include_once OBSIUS_CORE_SHORTCODES_PATH . '/counter/class-obsiuscore-counter-shortcode.php';

foreach ( glob( OBSIUS_CORE_SHORTCODES_PATH . '/counter/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
