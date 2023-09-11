<?php

include_once OBSIUS_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-list-table/helper.php';
include_once OBSIUS_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-list-table/class-obsiuscore-portfolio-list-table-shortcode.php';

foreach ( glob( OBSIUS_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-list-table/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
