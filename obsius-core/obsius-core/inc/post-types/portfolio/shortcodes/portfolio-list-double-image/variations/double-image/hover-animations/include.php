<?php

include_once OBSIUS_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-list-double-image/variations/double-image/hover-animations/hover-animations.php';

foreach ( glob( OBSIUS_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-list-double-image/variations/double-image/hover-animations/*/include.php' ) as $animation ) {
	include_once $animation;
}
