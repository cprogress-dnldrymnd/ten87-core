<?php

include_once OBSIUS_CORE_CPT_PATH . '/testimonials/shortcodes/testimonials-list/class-obsiuscore-testimonials-list-shortcode.php';

foreach ( glob( OBSIUS_CORE_CPT_PATH . '/testimonials/shortcodes/testimonials-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
