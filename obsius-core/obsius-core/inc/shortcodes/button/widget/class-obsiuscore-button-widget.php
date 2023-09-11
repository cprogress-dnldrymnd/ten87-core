<?php

if ( ! function_exists( 'obsius_core_add_button_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function obsius_core_add_button_widget( $widgets ) {
		$widgets[] = 'ObsiusCore_Button_Widget';

		return $widgets;
	}

	add_filter( 'obsius_core_filter_register_widgets', 'obsius_core_add_button_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class ObsiusCore_Button_Widget extends QodeFrameworkWidget {

		public function map_widget() {
			$widget_mapped = $this->import_shortcode_options(
				array(
					'shortcode_base' => 'obsius_core_button',
				)
			);
			if ( $widget_mapped ) {
				$this->set_base( 'obsius_core_button' );
				$this->set_name( esc_html__( 'Obsius Button', 'obsius-core' ) );
				$this->set_description( esc_html__( 'Add a button element into widget areas', 'obsius-core' ) );
			}
		}

		public function render( $atts ) {
			echo ObsiusCore_Button_Shortcode::call_shortcode( $atts ); // XSS OK
		}
	}
}
