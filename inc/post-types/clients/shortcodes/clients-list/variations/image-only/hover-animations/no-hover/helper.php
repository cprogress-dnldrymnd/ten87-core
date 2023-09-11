<?php

if ( ! function_exists( 'obsius_core_filter_clients_list_image_only_no_hover' ) ) {
    /**
     * Function that add variation layout for this module
     *
     * @param array $variations
     *
     * @return array
     */
    function obsius_core_filter_clients_list_image_only_no_hover( $variations ) {
        $variations['no-hover'] = esc_html__( 'No Hover', 'obsius-core' );

        return $variations;
    }

    add_filter( 'obsius_core_filter_clients_list_image_only_animation_options', 'obsius_core_filter_clients_list_image_only_no_hover' );
}