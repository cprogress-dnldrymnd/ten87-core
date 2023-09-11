<?php

include_once OBSIUS_CORE_INC_PATH . '/header/top-area/class-obsiuscore-top-area.php';
include_once OBSIUS_CORE_INC_PATH . '/header/top-area/helper.php';

foreach ( glob( OBSIUS_CORE_INC_PATH . '/header/top-area/dashboard/*/*.php' ) as $dashboard ) {
	include_once $dashboard;
}
