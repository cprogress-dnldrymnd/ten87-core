<?php

include_once OBSIUS_CORE_SHORTCODES_PATH . '/icon-with-text/class-obsiuscore-icon-with-text-shortcode.php';

foreach ( glob( OBSIUS_CORE_SHORTCODES_PATH . '/icon-with-text/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
