<?php

include_once OBSIUS_CORE_SHORTCODES_PATH . '/text-marquee/class-obsiuscore-text-marquee-shortcode.php';

foreach ( glob( OBSIUS_CORE_INC_PATH . '/shortcodes/text-marquee/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
