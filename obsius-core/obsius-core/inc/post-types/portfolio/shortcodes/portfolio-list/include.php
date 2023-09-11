<?php

include_once OBSIUS_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-list/helper.php';
include_once OBSIUS_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-list/class-obsiuscore-portfolio-list-shortcode.php';

foreach ( glob( OBSIUS_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
