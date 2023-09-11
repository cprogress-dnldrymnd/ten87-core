<?php

include_once OBSIUS_CORE_SHORTCODES_PATH . '/single-image/class-obsiuscore-single-image-shortcode.php';

foreach ( glob( OBSIUS_CORE_SHORTCODES_PATH . '/single-image/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
