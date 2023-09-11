<?php

include_once OBSIUS_CORE_INC_PATH . '/social-share/shortcodes/social-share/class-obsiuscore-social-share-shortcode.php';

foreach ( glob( OBSIUS_CORE_INC_PATH . '/social-share/shortcodes/social-share/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
