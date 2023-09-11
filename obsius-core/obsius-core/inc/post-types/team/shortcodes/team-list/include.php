<?php

include_once OBSIUS_CORE_CPT_PATH . '/team/shortcodes/team-list/class-obsiuscore-team-list-shortcode.php';

foreach ( glob( OBSIUS_CORE_CPT_PATH . '/team/shortcodes/team-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
