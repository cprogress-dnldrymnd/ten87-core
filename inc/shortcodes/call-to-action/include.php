<?php

include_once OBSIUS_CORE_SHORTCODES_PATH . '/call-to-action/class-obsiuscore-call-to-action-shortcode.php';

foreach ( glob( OBSIUS_CORE_SHORTCODES_PATH . '/call-to-action/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
