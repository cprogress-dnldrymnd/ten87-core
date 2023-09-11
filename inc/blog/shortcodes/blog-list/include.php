<?php

include_once OBSIUS_CORE_INC_PATH . '/blog/shortcodes/blog-list/class-obsiuscore-blog-list-shortcode.php';

foreach ( glob( OBSIUS_CORE_INC_PATH . '/blog/shortcodes/blog-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
