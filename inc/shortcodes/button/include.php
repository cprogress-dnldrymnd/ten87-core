<?php

include_once OBSIUS_CORE_SHORTCODES_PATH . '/button/class-obsiuscore-button-shortcode.php';

foreach ( glob( OBSIUS_CORE_SHORTCODES_PATH . '/button/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
