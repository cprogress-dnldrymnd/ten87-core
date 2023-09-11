<?php

include_once OBSIUS_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-list-double-image/helper.php';
include_once OBSIUS_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-list-double-image/class-obsiuscore-portfolio-list-double-image-shortcode.php';

foreach ( glob( OBSIUS_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-list-double-image/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
