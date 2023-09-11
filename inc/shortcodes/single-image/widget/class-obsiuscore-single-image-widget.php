<?php

if ( ! function_exists( 'obsius_core_add_single_image_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function obsius_core_add_single_image_widget( $widgets ) {
		$widgets[] = 'ObsiusCore_Single_Image_Widget';

		return $widgets;
	}

	add_filter( 'obsius_core_filter_register_widgets', 'obsius_core_add_single_image_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class ObsiusCore_Single_Image_Widget extends QodeFrameworkWidget {

		public function map_widget() {
			$widget_mapped = $this->import_shortcode_options(
				array(
					'shortcode_base' => 'obsius_core_single_image',
					'exclude'        => array( 'custom_class', 'parallax_item' ),
				)
			);
			if ( $widget_mapped ) {
				$this->set_base( 'obsius_core_single_image' );
				$this->set_name( esc_html__( 'Obsius Single Image', 'obsius-core' ) );
				$this->set_description( esc_html__( 'Add a single image element into widget areas', 'obsius-core' ) );
			}
		}

		public function render( $atts ) {
			echo ObsiusCore_Single_Image_Shortcode::call_shortcode( $atts ); // XSS OK
		}
	}
}
