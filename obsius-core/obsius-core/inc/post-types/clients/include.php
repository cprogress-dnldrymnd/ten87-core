<?php

include_once OBSIUS_CORE_CPT_PATH . '/clients/helper.php';

foreach ( glob( OBSIUS_CORE_CPT_PATH . '/clients/dashboard/meta-box/*.php' ) as $module ) {
	include_once $module;
}
