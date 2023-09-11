<?php

include_once OBSIUS_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-category-list/class-obsiuscore-portfolio-category-list-shortcode.php';

foreach ( glob( OBSIUS_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-category-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
