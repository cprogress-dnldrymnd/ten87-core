<?php

if ( ! function_exists( 'obsius_core_register_fullscreen_search_layout' ) ) {
	/**
	 * Function that add variation layout into global list
	 *
	 * @param array $search_layouts
	 *
	 * @return array
	 */
	function obsius_core_register_fullscreen_search_layout( $search_layouts ) {
		$search_layouts['fullscreen'] = 'ObsiusCore_Fullscreen_Search';

		return $search_layouts;
	}

	add_filter( 'obsius_core_filter_register_search_layouts', 'obsius_core_register_fullscreen_search_layout' );
}

if ( ! function_exists( 'obsius_core_register_full_screen_search_areas' ) ) {
    /**
     * Function which register widget areas for current module
     */
    function obsius_core_register_full_screen_search_areas() {
        register_sidebar(
            array(
                'id'            => 'qodef-fullscreen-search-area-left',
                'name'          => esc_html__( 'Fullscreen Search Area - Left', 'obsius-core' ),
                'description'   => esc_html__( 'Widgets added here will appear on the left side in fullscreen search area', 'obsius-core' ),
                'before_widget' => '<div id="%1$s" class="widget %2$s qodef-fullscreen-search-widget qodef-one">',
                'after_widget'  => '</div>',
            )
        );

        register_sidebar(
            array(
                'id'            => 'qodef-fullscreen-search-area-right',
                'name'          => esc_html__( 'Fullscreen Search Area - Right', 'obsius-core' ),
                'description'   => esc_html__( 'Widgets added here will appear on the right side in fullscreen search area', 'obsius-core' ),
                'before_widget' => '<div id="%1$s" class="widget %2$s qodef-fullscreen-search-widget qodef-two">',
                'after_widget'  => '</div>',
            )
        );
    }

    add_action( 'widgets_init', 'obsius_core_register_full_screen_search_areas' );
}
