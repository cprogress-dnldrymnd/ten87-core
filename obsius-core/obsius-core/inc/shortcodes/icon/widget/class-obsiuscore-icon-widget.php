<?php

if ( ! function_exists( 'obsius_core_add_icon_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function obsius_core_add_icon_widget( $widgets ) {
		$widgets[] = 'ObsiusCore_Icon_Widget';

		return $widgets;
	}

	add_filter( 'obsius_core_filter_register_widgets', 'obsius_core_add_icon_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class ObsiusCore_Icon_Widget extends QodeFrameworkWidget {

		public function map_widget() {
			$widget_mapped = $this->import_shortcode_options(
				array(
					'shortcode_base' => 'obsius_core_icon',
				)
			);

			if ( $widget_mapped ) {
				$this->set_base( 'obsius_core_icon' );
				$this->set_name( esc_html__( 'Obsius Icon', 'obsius-core' ) );
				$this->set_description( esc_html__( 'Add a icon element into widget areas', 'obsius-core' ) );
			}
		}

		public function render( $atts ) {
			echo ObsiusCore_Icon_Shortcode::call_shortcode( $atts ); // XSS OK
		}
	}
}
