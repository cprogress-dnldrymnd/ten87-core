<?php

include_once OBSIUS_CORE_SHORTCODES_PATH . '/pricing-table/class-obsiuscore-pricing-table-shortcode.php';

foreach ( glob( OBSIUS_CORE_SHORTCODES_PATH . '/pricing-table/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
