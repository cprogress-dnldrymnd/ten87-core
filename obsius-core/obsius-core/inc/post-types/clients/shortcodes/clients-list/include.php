<?php

include_once OBSIUS_CORE_CPT_PATH . '/clients/shortcodes/clients-list/class-obsiuscore-clients-list-shortcode.php';

foreach ( glob( OBSIUS_CORE_CPT_PATH . '/clients/shortcodes/clients-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
