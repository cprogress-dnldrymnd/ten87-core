<?php

include_once OBSIUS_CORE_SHORTCODES_PATH . '/process/class-obsiuscore-process-shortcode.php';

foreach ( glob( OBSIUS_CORE_SHORTCODES_PATH . '/process/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
