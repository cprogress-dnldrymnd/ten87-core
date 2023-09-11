<?php

include_once OBSIUS_CORE_SHORTCODES_PATH . '/countdown/class-obsiuscore-countdown-shortcode.php';

foreach ( glob( OBSIUS_CORE_SHORTCODES_PATH . '/countdown/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
