<?php

include_once OBSIUS_CORE_SHORTCODES_PATH . '/image-with-text/class-obsiuscore-image-with-text-shortcode.php';

foreach ( glob( OBSIUS_CORE_SHORTCODES_PATH . '/image-with-text/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
